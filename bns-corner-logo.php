<?php
/*
Plugin Name: BNS Corner Logo
Plugin URI: http://buynowshop.com/plugins/bns-corner-logo/
Description: Widget to display a user selected image as a logo; or, used as a plugin that displays the image fixed in one of the four corners of the display.
Version: 1.0
Author: Edward Caissie
Author URI: http://edwardcaissie.com/
*/

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
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bns-corner-logo' );

		/* Create the widget. */
		$this->WP_Widget( 'bns-corner-logo', 'BNS Corner Logo', $widget_ops, $control_ops );
	}
	
  function widget( $args, $instance ) {
		extract( $args );

		/* User-selected settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$image_url = $instance['image_url'];
		$image_alt_text = $instance['image_alt_text'];
		$image_link = $instance['image_link'];
		$widget_plugin = $instance['widget_plugin'];		
		$logo_location = $instance['logo_location'];
		
		if ( !$widget_plugin ) {

  		/* Before widget (defined by themes). */
	   	echo $before_widget;
		
  		/* Title of widget (before and after defined by themes). */
	   	if ( $title )
		  	echo $before_title . $title . $after_title;
			
  		/* Display image based on widget settings. */ ?>
        <div class="bns-logo" align="center">
          <a style="border:none; background:none; text-decoration:none;" href="<?php echo $image_link; ?>">
            <img  style="border:none; background:none; text-decoration:none;" alt="<?php echo $image_alt_text; ?>" src="<?php echo $image_url; ?>" />
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
            
      <div class="bns-logo" style="position:fixed; <?php echo $logo_position; ?> z-index:5;">
        <a style="border:none; background:none; text-decoration:none;" href="<?php echo $image_link; ?>">
          <img  style="border:none; background:none; text-decoration:none;" alt="<?php echo $image_alt_text; ?>" src="<?php echo $image_url; ?>" />
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
  	$instance['title'] = strip_tags( $new_instance['title'] );
    $instance['image_url'] = strip_tags( $new_instance['image_url'] );
    $instance['image_alt_text'] = strip_tags( $new_instance['image_alt_text'] );
    $instance['image_link'] = strip_tags( $new_instance['image_link'] );
    $instance['widget_plugin'] = $new_instance['widget_plugin'];    
  	$instance['logo_location'] = $new_instance['logo_location'];
	
    return $instance;
	}
	
  function form( $instance ) {
  	/* Set up some default widget settings. */
  	$defaults = array(
      'title' => __('My Logo Image'),
      'image_url' => '',
      'image_alt_text' => '',
      'image_link' => '',
      'widget_plugin' => false,      
      'logo_location' => 'bottom-right'    
    );
  	$instance = wp_parse_args( (array) $instance, $defaults );
  ?>

  <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:'); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
	</p>

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

  <p>
		<input class="checkbox" type="checkbox" <?php checked( $instance['widget_plugin'], true ); ?> id="<?php echo $this->get_field_id( 'widget_plugin' ); ?>" name="<?php echo $this->get_field_name( 'widget_plugin' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'widget_plugin' ); ?>"><?php _e('Use like a Plugin?'); ?></label>
	</p>

  <p>
		<label for="<?php echo $this->get_field_id( 'logo_location' ); ?>"><?php _e('Plugin Logo Location:'); ?></label> 
		<select id="<?php echo $this->get_field_id( 'logo_location' ); ?>" name="<?php echo $this->get_field_name( 'logo_location' ); ?>" class="widefat" style="width:100%;">
		  <option <?php if ( 'bottom-right' == $instance['format'] ) echo 'selected="selected"'; ?>>Bottom-Right</option>
			<option <?php if ( 'bottom-left' == $instance['format'] ) echo 'selected="selected"'; ?>>Bottom-Left</option>
			<option <?php if ( 'top-right' == $instance['format'] ) echo 'selected="selected"'; ?>>Top-Right</option>
			<option <?php if ( 'top-left' == $instance['format'] ) echo 'selected="selected"'; ?>>Top-Left</option>
		</select>
	</p>

  <?php
	}
}
?>
