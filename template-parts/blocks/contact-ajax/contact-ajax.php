<?php
/**
 * Block Name: Contact-ajax
 *
 * This is the template that displays the contact form block.
 */
$message_success = get_field('message_success');
$text_button_send = get_field('text_button_send');
$color_ = get_field('color_');
$color_text_button_send = get_field('color_text_button_send');
$color_hover = get_field('color_hover');
$size_font_sent_message = get_field('size_font_sent_message');
$to = get_field('to');

//message after sending message ?>
<div id="messageSuccess" class="alert-message success" style="display:none">
  <span><?php echo $message_success; ?></span>
</div>
<div id="textError" class="alert-message error" style="display:none">
  <span>Error sorry try again later</span>
</div>

<div class="form1">
	<?php if( have_rows('input') ): ?>
    	<form action="#" id="contactForm" method="post">
    	<?php // loop through the rows of data
    	while ( have_rows('input') ) : the_row();
		// display a sub field value
		$label = get_sub_field('label');
		switch ($label) {
		case 'name': ?>
		<label for="name">name</label>
		<input type="text" name="name" id="name" value="" />
		<div id="nameError" class="alert-message error" style="display:none">
			<span>you forgot your name</span>
		</div><!--#nameError-->
		<?php
		break;
		case 'email': ?>
		<label for="email">email</label>
		<input type="email" name="email" id="email" value="" />
		<div id="emailError" class="alert-message error" style="display:none">
			<span>email no valid</span>
	    	</div><!--#emailError-->
		<?php
		break;
		case 'phone': ?>
		<label for="phone">phone</label>
		<input type="text" name="phone" id="phone" value="" />
		<div id="phoneError" class="alert-message error" style="display:none">
			<span>phone no valid</span>
		</div><!--#urlError-->
		<?php
		break;
		case 'url': ?>
		<label for="url">url</label>
		<input type="url" name="url" id="url" value="" />
		<div id="urlError" class="alert-message error" style="display:none">
			<span>url no valid</span>
		</div><!--#urlError-->
		<?php
		break;
		case 'subject': ?>
		<label for="subject">subject</label>
		<input type="text" name="subject" id="subject" value="" /><?php
		break;
		default: ?>
		<label for="subject">Message</label>
		<textarea name="message" id="message" rows="20" cols="30"></textarea>
		<div id="messageError" class="alert-message error" style="display:none">
                	<span>you forgot the message</span>
                </div><!--#messageError-->
		<?php
		break;
		}
	endwhile; ?>
	<?php wp_nonce_field('ajax_contact_nonce', 'security');?>
      	<button id="submit" type="submit"><?php echo $text_button_send; ?></button>
	<input type="hidden" name="action" value="contact" />
      	<input type="hidden" name="to" id="to" value="<?php echo $to; ?>" />
 	</form>
</div>
<?php else :
    // no rows found
endif;

?>

<style type="text/css">	
* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}
		
.form1 .inputError {
  border: 2px solid red;
}
	
.form1 input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border-radius: 4px;
  resize: vertical;
}
	
.form1 input[type=email], select, textarea {
  width: 100%;
  padding: 12px;
  border-radius: 4px;
  resize: vertical;
}
	
.form1 input[type=url], select, textarea {
  width: 100%;
  padding: 12px;
  border-radius: 4px;
  resize: vertical;
}
	
.form1 input[type=tel], select, textarea {
  width: 100%;
  padding: 12px;
  border-radius: 4px;
  resize: vertical;
}
	
textarea {
  height: 150px;
}
	
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}
	
.container {
  padding: 20px;
}
	
.alert-message.error {
  background-color: red;
  padding: 10px;
  line-height: 2em;
}
	
.alert-message span {
  color: white;
}
	
.form1 button {
  background-color: <?php echo $color_; ?>;
  color:  <?php echo $color_text_button_send; ?>;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
  margin-top: 10px;
  font-size: <?php echo $size_font_sent_message; ?>px;
}
	
.form1 button:hover {
  background-color: <?php echo $color_hover; ?>;
}
	
.alert-message.success {
  background-color: <?php echo $color_; ?>;
  padding: 10px;
  line-height: 2em;
}
	
</style>
