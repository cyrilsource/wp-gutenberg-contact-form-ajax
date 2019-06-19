<?php

//register an acf block contact form
function my_acf_contactFormAjax() {
// check function exists
  if( function_exists('acf_register_block') ) {
// register a contact form block
    acf_register_block(array(
    'name' => 'contact-ajax',
    'title' => __('Contact Form with ajax'),
    'description' => __('A contact form with ajax'),
    'render_template'   => 'template-parts/blocks/contact/contact-ajax.php',
    'category' => 'common',
    'icon' => 'email-alt',
    'keywords' => array( 'contact'),
    'mode'			=> 'preview',
    'enqueue_assets' 	=> function(){
      wp_enqueue_script( 'block-contact', get_template_directory_uri() . '/template-parts/blocks/contact/contact.js', array('jquery'), '1.0.0', true );
      wp_localize_script('block-contact', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
      }
    ));
  }
}

add_action('acf/init', 'my_acf_contactFormAjax');

//treatment ajax contact form
add_action ('wp_ajax_contact', '_ajax_contact');
add_action ('wp_ajax_nopriv_contact', '_ajax_contact');

function _ajax_contact() {  
	//variables declaration + protections 
	if (isset($_POST['name'])) {
		$name = wp_strip_all_tags($_POST['name']);
	}
	if (isset($_POST['email'])) {
		$email = sanitize_email($_POST['email']);
	  }
	if (isset($_POST['phone'])) {
		$phone = sanitize_text_field($_POST['phone']);
	  }
	if (isset($_POST['subject'])) {
		$subject = wp_strip_all_tags($_POST['subject']);
	  }
	if (isset($_POST['url'])) {
		$url = esc_url_raw($_POST['url']);
	  }
	if (isset($_POST['message'])) {
		$message = nl2br(stripslashes(wp_kses($_POST['message'], $GLOBALS['allowedtags'])));
	  }

	$to = $_POST['to'];

	//body message
	ob_start();
	if (isset($_POST['subject'])) { ?>
		<p style="margin:0; padding:0">Subject: <?php echo $subject;?></p>
	  <?php }
	if (isset($_POST['name'])) { ?>
	    	<p style="margin:0; padding:0">Name: <?php echo $name;?></p>
	  <?php }
	if (isset($_POST['email'])) { ?>
	   	<p style="margin:0; padding:0">Email: <?php echo $email;?></p>
	  <?php }
	if (isset($_POST['phone'])) { ?>
	    	<p style="margin:0; padding:0">Phone: <?php echo $phone;?></p>
	  <?php }
	if (isset($_POST['url'])) { ?>
	    	<p style="margin:0; padding:0">Url: <?php echo $url;?></p>
	  <?php }
	if (isset($_POST['message'])) { ?>
	    	<br/>
	  	<?php echo $message;
	    }
	$mail = ob_get_contents();
	ob_end_clean();

	//send mail

	//html content in mail
	add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

	if(wp_mail($to, 'from contact form', $mail)){
		wp_send_json('success');	
	}
	else {
		wp_send_json('error');
	}

}
