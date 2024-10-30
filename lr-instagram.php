<?php 
/*
Plugin Name: Logicrays Social Media Feed
Plugin URI: https://wordpress.org/plugins/logicrays-instagram-feed/
Description: This is just a plugin,For giving Instagram Feed in your website.
Author: LogicRays WordPress Team
Author URI: http://www.logicrays.com/
Version: 1.0
*/
define("lri_text_domain","lri_instagram_feed" );
define('lri_instagramfeedpath', plugins_url('', __FILE__));
add_action('admin_menu', 'lri_instagram_menu');
  
function lri_instagram_menu(){
add_menu_page('Lr Instagram feed','LR Instagram feed', 'manage_options','lri-instagram-feed', 'lri_instagram_settings');
add_submenu_page('lri-instagram-feed', _('Free plugins'), _('Free plugins'), 'manage_options', 'check_our_free_plugins', 'check_our_free_plugins');
}

add_action( 'plugin_action_links_' . plugin_basename(__FILE__), 'lri_action_links' );
function lri_action_links( $links ) {
 $links = array_merge( array(
  '<a href="' . esc_url( admin_url( '/admin.php?page=lri-instagram-feed' ) ) . '">' . __( 'Settings', 'lri_instagram_feed' ) . '</a>'
 ), $links );
 return $links;
}

include_once 'lr-instagram-shortcode.php';
function lri_instagram_settings(){?>
<div class="wrap">
  <h2>Logicrays Instagram feed settings</h2>
  <form action="options.php" method="post">
    <?php settings_fields("section");?>
    <style>
  .lri_shortcode {display: block;float: left; clear: both;margin: 15px 0 0 0;padding: 15px 20px;   min-width: 808px;border: 1px solid #ccc;background: #eee;background: rgba(255,255,255,0.5);-moz-border-radius: 5px;-webkit-border-radius: 5px;border-radius: 5px;}
.box-item {margin-bottom: 30px; padding: 25px; border: 1px solid #eee;background: #fff;position: relative;
}
</style>
    <div class="lri_shortcode">
      <h3>Display your feed</h3>
      <p>Copy and paste this shortcode directly into the page, post or widget where you'd like to display the feed:[LR_INSTAGRAM_FEED]</p>
      <p>Check out our other free plugins: <a href="https://profiles.wordpress.org/logicrays#content-plugins" target="_blank"> Free plugins</a></p>
      <p>Like the plugin? Please rate us!</p>
    </div>
    <?php
	  do_settings_sections("instagram-options");
	  submit_button();
 	?>
  </form>
</div>
<?php
  }
  function lri_instagram_fields()
  {
	  add_settings_section("section", "", null, "instagram-options");
	  add_settings_field("lri_images_slider", "Enable Slider", "lri_images_slider_element", "instagram-options", "section");
	  add_settings_field("lri_iteamper_page", "Enable Slider", "lri_iteamper_page_element", "instagram-options", "section");
	  add_settings_field("lri_layout_type", "Layout type", "lri_layout_type_element", "instagram-options", "section");	
	  add_settings_field("lri_userid", "User ID", "lri_userid_element", "instagram-options", "section");
	  add_settings_field("lri_accesstoken", "Access token", "lri_accesstoken_element", "instagram-options", "section");
	  add_settings_field("lri_numberof_feed", "Number of feed", "lri_numberof_feed_element", "instagram-options", "section");
	  add_settings_field("lri_instagram_link", "Instagam account link", "lri_instagram_link_element", "instagram-options", "section");
	   add_settings_field("lri_view_all", "Button text", "lri_view_all_element", "instagram-options", "section");
	  
	  register_setting("section", "lri_layout_type");
	  register_setting("section", "lri_iteamper_page");
	  register_setting("section", "lri_images_slider");
	  register_setting("section", "lri_userid");
	  register_setting("section", "lri_accesstoken");
	  register_setting("section", "lri_numberof_feed");
	  register_setting("section", "lri_instagram_link");
	  register_setting("section", "lri_view_all");
  }
  	add_action("admin_init", "lri_instagram_fields");
  	add_action( 'wp_head', 'lri_style' );
  	function lri_style() {
	   wp_enqueue_script('carousel-js',lri_instagramfeedpath.'/js/owl.carousel.min.js', array('jquery')); 
	   wp_enqueue_style('fancybox-min-css', lri_instagramfeedpath.'/css/jquery.fancybox.css');
	   wp_enqueue_style('bootstrap-min-css', lri_instagramfeedpath.'/css/bootstrap.min.css');
	   wp_enqueue_style('theme-default-css', lri_instagramfeedpath.'/css/owl.theme.default.min.css');
	   wp_enqueue_style('owl-carousel-css', lri_instagramfeedpath.'/css/owl.carousel.min.css');
	   wp_enqueue_script('fancybox-js',lri_instagramfeedpath.'/js/jquery.fancybox.min.js', array('jquery'));	 
  }
    function lri_images_slider_element(){
  	$options = get_option('lri_images_slider');?>
    <select id="lri_images_slider" name='lri_images_slider[lri_images_slider]'>
    <option value='no' <?php selected( $options['lri_images_slider'], 'no'); ?>><?php _e( 'No',lri_text_domain); ?></option>
      <option value='yes' <?php selected( $options['lri_images_slider'], 'yes'); ?>><?php _e( 'Yes',lri_text_domain ); ?></option></select>
    <p class="description"><?php _e( 'show instagram images as a slider ?.'); ?></p>
<?php
  }
  function lri_iteamper_page_element(){
	$options = get_option('lri_iteamper_page');?>
		<select id="lri_iteamper_page" name='lri_iteamper_page[lri_iteamper_page]'>
    	<option value=2 <?php selected( $options['lri_iteamper_page'], 2); ?>>
			<?php _e( 2, lri_text_domain); ?></option>
      	<option value=3 <?php selected( $options['lri_iteamper_page'], 3); ?>>
	  		<?php _e(3, lri_text_domain ); ?>			</option>
     	<option value=4 <?php selected( $options['lri_iteamper_page'], 4); ?>>
	  		<?php _e(4, lri_text_domain ); ?></option>
      	<option value=5 <?php selected( $options['lri_iteamper_page'], 5); ?>>
	  		<?php _e(5, lri_text_domain ); ?></option>
      </select>
    <p class="description"><?php _e( 'show instagram images as a slider ?.'); ?></p>
	<?php
  }
  function lri_layout_type_element(){
  	$options = get_option('lri_layout_type');?>
		<select id="lri_layout_type" name='lri_layout_type[lri_layout_type]'>
  		<option value='col-md-6'<?php selected( $options['lri_layout_type'], 'col-md-6' ); ?>>
  			<?php _e( 'Two Column', lri_text_domain); ?>
  		</option>
  		<option value='col-md-4'<?php selected( $options['lri_layout_type'], 'col-md-4' ); ?>>
  		<?php _e( 'Three Column', lri_text_domain ); ?>
  		</option>
  		<option value='col-md-3'<?php selected( $options['lri_layout_type'], 'col-md-3' ); ?>>
  		<?php _e( 'Four Column', lri_text_domain ); ?>
 		</option>
		</select>
		<p class="description"><?php _e( 'Choose a column layout for instgram images.'); ?></p>
		<?php }
  
  function lri_userid_element(){?>
	<input type="text" name="lri_userid" size='40' id="lri_userid" value="<?php echo esc_attr(get_option('lri_userid')); ?>" placeholder="Instagram user id"/>
	<p class="description"><?php _e( 'Please enter Instagram user id.' ); ?>
  &nbsp;How do i get userid ? : Just replace "<strong>therock</strong>" with your username. https://www.instagram.com/therock/?__a=1 &nbsp;<strong>Check screenshot for more idea.</strong></p>
	<?php }

  function lri_accesstoken_element(){?>
	<input type="text" name="lri_accesstoken" size='40' id="lri_accesstoken" value="<?php echo esc_attr(get_option('lri_accesstoken')); ?>" placeholder="3923222219673a81a9f.dac8f60bea25d66dsds6saf1" />
<p class="description">
  <?php _e( 'Please enter Access token eg.3923222219673a81a9f.dac8f60bea25d66dsds6saf1' ); ?>
  &nbsp;<a href="https://www.instagram.com/developer/authentication" target="_blank">how to get access token ?</a></p>
<?php }

  function lri_numberof_feed_element()
  {	$options = get_option('lri_numberof_feed'); ?>
<input type="text" name="lri_numberof_feed" size='40' id="lri_numberof_feed" value="<?php echo esc_attr(get_option('lri_numberof_feed')); ?>" placeholder="9" />
<p class="description"><?php _e( 'number of feeds e.g 10,15,20 per page etc' ); ?></p>
<?php }

  function lri_instagram_link_element(){
	$options = get_option('lri_instagram_link'); ?>
<input type="text" name="lri_instagram_link" size='40' id="lri_instagram_link" value="<?php echo esc_attr(get_option('lri_instagram_link')); ?>" placeholder="https://www.instagram.com/your_page_name/" />
<p class="description"><?php _e( 'Add your instagram link for view more photos eg.https://www.instagram.com/your_page_name/' ); ?></p>
<?php }

  function lri_view_all_element()
  {	$options = get_option('lri_view_all');?>
<input type="text" name="lri_view_all" size='40' id="lri_view_all" value="<?php echo esc_attr(get_option('lri_view_all')); ?>" placeholder="View all" />
<p class="description"><?php _e( 'Add button text for View all images' ); ?></p>
<?php }
function check_our_free_plugins(){
	include_once 'lr-free-plugins.php';
}