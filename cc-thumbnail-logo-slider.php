<?php
/**
 * Plugin Name: CC Thumbnail Logo Slider
 * Plugin URI: http://www.wordpress.org/extend/plugins/cc_tls-thumbnail-logo-slider
 * Description: Create a thumbnail logo slider anywhere in your website.
 * Version: 1.0.0
 * Author: cygnusplugins
 * Author URI: http://codecygnus.com
 * Text Domain: cc-thumbnail-logo-slider
 * License: GPL2 or Later
 */

  // this function registers our settings in the db
  add_action('admin_init', 'cc_tls_register_settings');
  function cc_tls_register_settings() {
      register_setting('cc_tls_slider_settings', 'cc_tls_slider_settings');
  }
  
  // Loading the css and JavaScript files.

  function my_enqueued_assets() {
      wp_enqueue_style( 'slick-css1', plugin_dir_url( __FILE__ ) . 'css/slick.css');
      wp_enqueue_script( 'slick1-js', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array( 'jquery-migrate' ), '1.0', true );
      wp_enqueue_script( 'slick2-js', plugin_dir_url( __FILE__ ) . 'js/slick-loader.js', array( 'slick1-js' ), '1.0', true);
  }
  
  add_action( 'wp_enqueue_scripts', 'my_enqueued_assets' );
  add_action('admin_menu', 'cc_tls_thumbnail_plugin_menu');
  add_action( 'admin_enqueue_scripts', 'cc_tls_admin_enqueued_assets' );
  add_shortcode('CC-slider', 'cc_tls_header_thumbnail_slider'); 
  
  // pull the settings from the db
  $cc_tls_slider_settings = get_option('cc_tls_slider_settings');

/**
 * cc_tls_admin_enqueued_assets()
 * Enqueues the the scripts and styles
 * files along with the other wp files
 * to the wp admin 
 * 
 */
 
  function cc_tls_admin_enqueued_assets() {
      wp_enqueue_script( 'thumbs-admin-js', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), '1.0', true);
  }
  
/**
 * cc_tls_thumbnail_plugin_menu
 * Adding and registering the 
 * Plugin to admin side bar menu
 * and necessary options of the plugin
 * 
 */
  function cc_tls_thumbnail_plugin_menu(){
    $page_title		=	'CC Slider';
    $menu_title		=	'CC Slider';
    $capability		=	'manage_options';
    $menu_slug		=	'cctls-slider-settings';
    $function	  	=	'cc_tls_slider_settings_page';
    $icon		    	=	plugin_dir_url( __FILE__ ).'cc.png';
    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon);
}

// add "Settings" link to plugin page

add_filter('plugin_action_links_' . plugin_basename(__FILE__) , 'cc_tls_plugin_action_links');
function cc_tls_plugin_action_links($links) {
    $cc_tls_settings_link = sprintf( '<a href="%s">%s</a>', admin_url( 'upload.php?page=cc_tls-slider-settings' ), __('Settings') );
    array_unshift($links, $cc_tls_settings_link);
    return $links;
}

/*
 * 
 * Front End Code to Show the slider
 * 
 */

function cc_tls_header_thumbnail_slider() {
  global $cc_tls_slider_settings;
    $imgPath = plugin_dir_url( __FILE__ ).'img';
    global $wpdb;
    $cc_tls_sliderImages = explode(',',$cc_tls_slider_settings['slider_images']);
    $cc_tls_slider_count = count($cc_tls_sliderImages);
    $formatted = implode(',',array_fill(0, $cc_tls_slider_count, '%d'));
    $query = "SELECT guid, post_title FROM ".$wpdb->prefix."posts WHERE id in ( $formatted )";
    $query = $wpdb->prepare($query, $cc_tls_sliderImages);
    $results = $wpdb->get_results( $query, OBJECT );
    $cc_tls_sliderContent = '';
    if ($results) {
        $cc_tls_sliderContent = "<style type='text/css'>
            #slick-container img {
            width:".$cc_tls_slider_settings['slider_width']."px; 
            height:". $cc_tls_slider_settings['slider_height']."px; 
        } </style>";
        $options = array("slidesToShow" => $cc_tls_slider_settings['per_image'],"slidesToScroll" =>$cc_tls_slider_settings['slider_scroll'],"autoplay" => $cc_tls_slider_settings['slider_Play'], "speed" => $cc_tls_slider_settings['slider_speed'],"arrows" =>$cc_tls_slider_settings['slider_arrows'] );
        $cc_tls_sliderContent .= "<div id='slick-container'><div class='multiple-items' data-slick='".json_encode($options)."'>";
       
                foreach($results as $result) {
                    $cc_tls_sliderContent .= "<div><a class='slick-list' href='#'><img src='$result->guid'/></a></div>";
                }
        $cc_tls_sliderContent .= "</div></div>";
   }
   return $cc_tls_sliderContent;
}


/*============================================================================================*/

// display the settings administration code

function cc_tls_slider_settings_page(){
  global $cc_tls_slider_settings;
echo '<div class="wrap"> <h2>';
_e( 'Slider Settings', 'thumbnail-slider-settings' );


?>
<form method="post" action="options.php" id="thumbnail-settings">
  <?php settings_fields( 'cc_tls_slider_settings' );?>
<table class="form-table">
  <input type="hidden" name="cc_tls_slider_settings[slider_images]" value="<?php echo $cc_tls_slider_settings['slider_images'] ?>" id="slider_images" />
            <tr>
                <th scope="row"><?php _e('Size') ?></th>
                <td>
                    <?php _e('Width', 'thumbnail-slider-settings') ?>
                    <input type="number" name="cc_tls_slider_settings[slider_width]" value="<?php echo $cc_tls_slider_settings['slider_width']; ?>" size="4" /> 
                    <?php _e('Height', 'thumbnail-slider-settings') ?>
                    <input type="number" name="cc_tls_slider_settings[slider_height]" value="<?php echo $cc_tls_slider_settings['slider_height']; ?>" size="4" />
                </td>
            </tr>
            <tr>
              <tr>
                <th scope="row"><?php _e('Images Per Slide') ?></th>
                <td>
                 <input type="number" name="cc_tls_slider_settings[per_image]" value="<?php echo $cc_tls_slider_settings['per_image']; ?>" />Set number of images per slide
                </td>
            </tr>
            <tr>
              <tr>
                <th scope="row"><?php _e('Slides To Scroll') ?></th>
                <td>
                 <input type="number" name="cc_tls_slider_settings[slider_scroll]" value="<?php echo $cc_tls_slider_settings['slider_scroll']; ?>" />Set number of slides to scroll
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Auto Play') ?></th>
                <td>
                 <input type="radio" name="cc_tls_slider_settings[slider_Play]" value="1" <?php if($cc_tls_slider_settings['slider_Play']==1){echo 'checked="checked"';}?> /> On <input type="radio" name="cc_tls_slider_settings[slider_Play]" value="0" <?php if($cc_tls_slider_settings['slider_Play']==0){echo 'checked="checked"';}?>/> Off
                </td>
            </tr>
              <tr>
              <tr>
                <th scope="row"><?php _e('Slider Speed') ?></th>
                <td>
                 <input type="number" name="cc_tls_slider_settings[slider_speed]" value="<?php echo $cc_tls_slider_settings['slider_speed']; ?>" />Set slider speed in seconds
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Arrow') ?></th>
                <td>
                 <input type="radio" name="cc_tls_slider_settings[slider_arrows]" value="1" <?php if($cc_tls_slider_settings['slider_arrows']==1){echo 'checked="checked"';}?> /> On <input type="radio" name="cc_tls_slider_settings[slider_arrows]" value="0" <?php if($cc_tls_slider_settings['slider_arrows']==0){echo 'checked="checked"';}?>/> Off
                </td>
            </tr>
             <tr>
                <th scope="row"><?php _e('Select Images') ?></th>
                <td>
                 <?php cc_tls_MediaImages(); ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php _e('Shortcode to use') ?></th>
                <td>
                   [CC-slider]
                </td>
            </tr>
            </table>
            <?php  submit_button(); ?>
            </form> </div>
<?php 
} 

// Getting the images from media Library.

function cc_tls_MediaImages() {
    global $wpdb, $cc_tls_slider_settings;
    $query = 'SELECT id, guid, post_title FROM '.$wpdb->prefix.'posts WHERE post_type = "attachment" AND post_mime_type LIKE "image%"';
    $results = $wpdb->get_results( $query, OBJECT );
    echo "<pre>";
   // print_r($results);
    if ($results) {
        $cc_tls_sliderImages = $cc_tls_slider_settings['slider_images'];
        
        if ( $cc_tls_sliderImages != '') {
            $cc_tls_sliderImages = explode(',', $cc_tls_sliderImages); 
        }
        echo '<h4>';
        _e( 'Upload new images in media library and select the slider here', 'thumbnail-slider-settings' );
        echo '</h4>';
        echo '<table id="mediaImages">';
        $start = 0;
        $show = 5;
        foreach($results as $result) {
            if ($start%$show == 0) {
                echo '<tr>';
                $start ++;
            }
            if ($cc_tls_sliderImages && in_array($result->id, $cc_tls_sliderImages)) {
                echo '<td><input name="slider_images" type="checkbox" id="'.$result->post_title.'" value="'.$result->id.'" checked/></td>';
            } else {
                echo '<td><input name="slider_images" type="checkbox" id="'.$result->post_title.'" value="'.$result->id.'"/></td>';
            }
            echo '<td><label for="'.$result->post_title.'"><img src="'.$result->guid.'" width="150" height="150" /><label for="group1"></td>';
            if ($start%$show == 0) {
                echo '</tr>';
            } else {
                $start++;
            }
        }
        echo '</table>';
    }
}

