<?php
/*
Plugin Name: BNS Corner Logo
Plugin URI: http://buynowshop.com/plugins/bns-corner-logo/
Description: Widget to display a user selected image as a logo; or, used as a plugin that displays the image fixed in one of the four corners of the display.
Version: 1.2.2.1
Author: Edward Caissie
Author URI: http://edwardcaissie.com/
*/

global $wp_version;
$exit_message = 'BNS Corner Logo requires WordPress version 2.8 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please Update!</a>';
if (version_compare($wp_version, "2.8", "<")) {
	exit ($exit_message);
}

/* Add BNS Logo Style sheet */
add_action( 'wp_head', 'add_BNS_Corner_Logo_Header_Code' );

function add_BNS_Corner_Logo_Header_Code() {
  echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('url') . '/wp-content/plugins/bns-corner-logo/css/bns-corner-logo-style.css" />' . "\n";
}

/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'load_my_bns_corner_logo_widget' );

/* Function that registers our widget. */
function load_my_bns_corner_logo_widget() {
	register_widget( 'BNS_Corner_Logo_Widget' );
}

class BNS_Corner_Logo_Widget extends WP_Widget {

	function BNS_Corner_Logo_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'bns-corner-logo', 'description' => __('Widget to display a logo; or, used as a plugin displays image fixed in one of the four corners.') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 400, 'height' => 350, 'id_base' => 'bns-corner-logo' );

		/* Create the widget. */
		$this->WP_Widget( 'bns-corner-logo', 'BNS Corner Logo', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title          = apply_filters('widget_title', $instance['title'] );
		$use_gravatar   = $instance['use_gravatar'];
		$gravatar_size  = $instance['gravatar_size'];
		$image_url		  = $instance['image_url'];
		$image_alt_text	= $instance['image_alt_text'];
		$image_link     = $instance['image_link'];
		$widget_plugin	= $instance['widget_plugin'];		
		$logo_location	= $instance['logo_location'];
		
		if ( !$widget_plugin ) {

			/* Before widget (defined by themes). */
			echo $before_widget;
		
			/* Title of widget (before and after defined by themes). */
			if ( $title )
				echo $before_title . $title . $after_title;
			
   		/* Display image based on widget settings. */ ?>
				<div class="bns-logo" align="center">
					<a style="border:none; background:none; text-decoration:none;" href="<?php echo $image_link; ?>">
            <img style="border:none; background:none; text-decoration:none;" alt="<?php if (!$use_gravatar) {echo $image_alt_text;} ?>"
              <?php if ($use_gravatar) { echo get_avatar('1', $gravatar_size); } else { ?> src="<?php echo $image_url;?>" /><?php } ?>
					</a>
				</div>
		
		<?php } else {
	  
			if ( $logo_location == "Bottom-Right" ) {
				$logo_position = "bottom:0; right:0;";
			} elseif ( $logo_location == "Bottom-Left" ) {
				$logo_position = "bottom:0; left:0;";
			} elseif ( $logo_location == "Top-Right" ) {
				$logo_position = "top:0; right:0;";
			} elseif ( $logo_location == "Top-Left" ) {
				$logo_position = "top:0; left:0;"; 
			}	
		?>
			  
			<div class="bns-logo" align="center" style="position:fixed; <?php echo $logo_position; ?> z-index:5;">
				<a style="border:none; background:none; text-decoration:none;" href="<?php echo $image_link; ?>">
            <img style="border:none; background:none; text-decoration:none;" alt="<?php if (!$use_gravatar) {echo $image_alt_text;} ?>"
              <?php if ($use_gravatar) { echo get_avatar('1', $gravatar_size); } else { ?> src="<?php echo $image_url;?>" /><?php } ?>
				</a>
			</div>

		<?php }
		
		/* End - Display image based on widget settings. */

		/* After widget (defined by themes). */
		if ( !$widget_plugin ) {
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags (if needed) and update the widget settings. */
		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['use_gravatar']   = $new_instance['use_gravatar'];
		$instance['gravatar_size']  = $new_instance['gravatar_size'];
		$instance['image_url']      = strip_tags( $new_instance['image_url'] );
		$instance['image_alt_text']	= strip_tags( $new_instance['image_alt_text'] );
		$instance['image_link']     = strip_tags( $new_instance['image_link'] );
		$instance['widget_plugin']	= $new_instance['widget_plugin'];    
		$instance['logo_location']	= $new_instance['logo_location'];

		return $instance;
	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array(
				'title'           => __('My Logo Image'),
				'use_gravatar'    => false,
				'gravatar_size'   => '96',
				'image_url'       => '',
				'image_alt_text'	=> '',
				'image_link'      => '',
				'widget_plugin'		=> false,      
				'logo_location'		=> 'Bottom-Right'
			);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
		
		<table width="100%">
		  <tr>
				<td width="30%">
      		<p>
      			<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['use_gravatar'], true ); ?> id="<?php echo $this->get_field_id( 'use_gravatar' ); ?>" name="<?php echo $this->get_field_name( 'use_gravatar' ); ?>" />
      			<label for="<?php echo $this->get_field_id( 'use_gravatar' ); ?>"><?php _e('Use your <a href="http://gravatar.com">Gravatar</a> image?'); ?></label>
      		</p>
        </td>
        <td>
          <p>
      			<label for="<?php echo $this->get_field_id( 'gravatar_size' ); ?>"><?php _e('Gravatar size in pixels (suggested max. 512):'); ?></label>
      			<input id="<?php echo $this->get_field_id( 'gravatar_size' ); ?>" name="<?php echo $this->get_field_name( 'gravatar_size' ); ?>" value="<?php echo $instance['gravatar_size']; ?>" style="width:100%;" />
      		</p>
        </td>
      </tr>
    </table>

		<p>
			<label for="<?php echo $this->get_field_id( 'image_url' ); ?>"><?php _e('URL of Image:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $instance['image_url']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'image_alt_text' ); ?>"><?php _e('ALT text of Image:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'image_alt_text' ); ?>" name="<?php echo $this->get_field_name( 'image_alt_text' ); ?>" value="<?php echo $instance['image_alt_text']; ?>" style="width:100%;" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'image_link' ); ?>"><?php _e('URL to follow:'); ?></label>
			<input id="<?php echo $this->get_field_id( 'image_link' ); ?>" name="<?php echo $this->get_field_name( 'image_link' ); ?>" value="<?php echo $instance['image_link']; ?>" style="width:100%;" />
		</p>

		<hr /> <!-- Separates functionality: Widget above - plugin below -->
		
		<p>
			<input class="checkbox" type="checkbox" <?php checked( (bool) $instance['widget_plugin'], true ); ?> id="<?php echo $this->get_field_id( 'widget_plugin' ); ?>" name="<?php echo $this->get_field_name( 'widget_plugin' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'widget_plugin' ); ?>"><?php _e('Use like a Plugin?'); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'logo_location' ); ?>"><?php _e('Plugin Logo Location:'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'logo_location' ); ?>" name="<?php echo $this->get_field_name( 'logo_location' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'Bottom-Right' == $instance['logo_location'] ) echo 'selected="selected"'; ?>>Bottom-Right</option>
				<option <?php if ( 'Bottom-Left' == $instance['logo_location'] ) echo 'selected="selected"'; ?>>Bottom-Left</option>
				<option <?php if ( 'Top-Right' == $instance['logo_location'] ) echo 'selected="selected"'; ?>>Top-Right</option>
				<option <?php if ( 'Top-Left' == $instance['logo_location'] ) echo 'selected="selected"'; ?>>Top-Left</option>
			</select>
		</p>

		<?php
	}
}
?>