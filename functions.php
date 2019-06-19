<?php

//register an acf block contact form
function my_acf_contactFormAjax() {
// check function exists
  if( function_exists('acf_register_block') ) {
// register a contact form block
    acf_register_block(array(
    'name' => 'contact',
    'title' => __('Contact Form'),
    'description' => __('A contact form'),
    'render_template'   => 'template-parts/blocks/contact/contact.php',
    'category' => 'common',
    'icon' => 'email-alt',
    'keywords' => array( 'contact'),
    'mode'			=> 'preview',
    'enqueue_assets' 	=> function(){
      wp_enqueue_style( 'block-contact', get_template_directory_uri() . '/template-parts/blocks/contact/contact.css', array(), '1.0.0' );
      wp_enqueue_script( 'block-contact', get_template_directory_uri() . '/template-parts/blocks/contact/contact.js', array('jquery'), '1.0.0', true );
      wp_localize_script('block-contact', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
      }
    ));
  }
}

add_action('acf/init', 'my_acf_contactFormAjax');
