<?php
add_shortcode('LR_INSTAGRAM_FEED', 'lri_shortcode' );
function lri_shortcode() {
ob_start();
		// Supply a user id and an access token
		$userid = get_option('lri_userid');
		$accessToken = get_option('lri_accesstoken');
		$numberof_feed = get_option('lri_numberof_feed');
		$layout_type = get_option('lri_layout_type');
		$layout_type = $layout_type['lri_layout_type'];
		$lri_instagram_link = get_option('lri_instagram_link');
		$lri_view_all = get_option('lri_view_all');
		$lri_images_slider = get_option('lri_images_slider');
		$lri_images_slider = $lri_images_slider['lri_images_slider'];
		$lri_iteamper_page = get_option('lri_iteamper_page');
		$lri_iteamper_page = $lri_iteamper_page['lri_iteamper_page'];

$remote_wp = wp_remote_get( "https://api.instagram.com/v1/users/" . $userid . "/media/recent?access_token=" . $accessToken.'&count='.$numberof_feed.'');
$instagram_response = json_decode( $remote_wp['body'] );
?>
<?php if($lri_images_slider == 'no'){?>
<div class="row instagram-feeds">
<?php foreach ($instagram_response->data as $post): ?>
  <div class="<?php echo $layout_type;?>">
   <a href="<?= $post->images->standard_resolution->url ?>" data-fancybox="group">
	<img src="<?= $post->images->standard_resolution->url ?>" alt="" />
</a>
  </div>
  <?php endforeach; if($lri_instagram_link != ''){?>
  <a class="view-all" href="<?php echo $lri_instagram_link;?>"><?php echo $lri_view_all; ?></a>
  <?php }?>
</div>
<?php }else{?>
<div class="row owl-carousel owl-theme">
<?php foreach ($instagram_response->data as $post): ?>
  <div class="item">
  <a href="<?= $post->images->standard_resolution->url ?>" data-fancybox="group">
	<img src="<?= $post->images->standard_resolution->url ?>" alt="" />
</a>
  </div>
  <?php endforeach;?>
</div>
<?php }?>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('[data-fancybox="group"]').fancybox({
       loop:true,
    });
 
	jQuery('.owl-carousel').owlCarousel({
		items:<?php echo $lri_iteamper_page; ?>,
		loop:false,
		margin:10,
		nav:false,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:<?php echo $lri_iteamper_page; ?>
			}
		}
	});
});
</script>
    <style>.instagram-feeds .col-md-4{ margin-bottom:25px;}
    #fancybox-close{right: -30px !important;}
    </style>
<?php return ob_get_clean();}