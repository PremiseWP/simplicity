<?php
/**
 * Simplicity Meta Box for All posts or pages
 *
 * @package Simplicity\Classes
 */

/**
 * The Class.
 */
class PWPS_Meta_Box {

    /**
     * Hook into the appropriate actions when the class is constructed.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
        add_action( 'save_post',      array( $this, 'save'         ) );
    }

    /**
     * Adds the meta box container.
     */
    public function add_meta_box( $post_type ) {
        add_meta_box(
            'pwps-meta-box',
            __( 'Simplicity Page Settings', '' ),
            array( $this, 'render_meta_box_content' ),
            $post_type,
            'advanced',
            'high'
        );
    }

    /**
     * Save the meta when the post is saved.
     *
     * @param int $post_id The ID of the post being saved.
     */
    public function save( $post_id ) {

        /*
         * We need to verify this came from the our screen and with proper authorization,
         * because save_post can be triggered at other times.
         */

        // Check if our nonce is set.
        if ( ! isset( $_POST['pwps_page_nonce'] ) ) {
            return $post_id;
        }

        $nonce = $_POST['pwps_page_nonce'];

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'pwps_secret' ) ) {
            return $post_id;
        }

        /*
         * If this is an autosave, our form has not been submitted,
         * so we don't want to do anything.
         */
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return $post_id;
        }

        // Check the user's permissions.
        if ( 'page' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            }
        } else {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }
        }

        /* OK, it's safe for us to save the data now. */

        // Sanitize the user input.
        $mydata = $_POST['pwps_page_options'];

        // Update the meta field.
        update_post_meta( $post_id, 'pwps_page_options', $mydata );
    }


    /**
     * Render Meta Box content.
     *
     * @param WP_Post $post The post object.
     */
    public function render_meta_box_content( $post ) {

        // Add an nonce field so we can check for it later.
        wp_nonce_field( 'pwps_secret', 'pwps_page_nonce' );

        premise_field( 'textarea', array(
            'name' => 'pwps_page_options[custom-css]',
            'label' => 'Custom CSS',
            'placeholder' => '.your_class {...',
            'context' => 'post',
        ) );

        premise_field( 'textarea', array(
            'name' => 'pwps_page_options[custom-js]',
            'label' => 'Custom JS',
            'placeholder' => '(function($){...',
            'context' => 'post',
        ) );
    }
}

?>