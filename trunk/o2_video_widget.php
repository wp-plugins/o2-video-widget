<?php 
/*
  Plugin Name: O2 Video Widget v1.1
  Description: Shows the latest O2 videos on your website, automatically updated and kept fresh.
  Author: O2 - Official Plugin
  Version: 1.1
  Author URI: http://www.o2.co.uk/
*/
		 function widget_o2_video_2($args) {
			$options = get_option("widget_o2_video-2");
			if (!is_array( $options ))
			{
				$options = array(
				  'o2-widget-channel-2' => 'O2GuruTV',
				  'o2-widget-size-2' => 'small',
				  'cache_content' => 'no'
				  );
			}
			
			//add_action('wp_print_footer_scripts', 'o2_video_sidebar_scripts', 1);
			
	?>
			<div id="o2-vid-widget-container" class="<?php echo $options['o2-widget-size-2']; ?>">
				<div id="o2-vid-widget-logo"><a href="http://www.o2.co.uk" target="_blank"><img src="<?php echo plugins_url('o2_widget_logo.png',__FILE__) ?>" alt="Ask an O2 Guru" /></a></div>
				<ul>
				<?php
					if ($options['o2-widget-size-2']=='medium') $count = 4;
					elseif ($options['o2-widget-size-2']=='large') $count = 4;
					else $count = 2;
					$xml = simplexml_load_file('http://gdata.youtube.com/feeds/api/playlists/BD5E1A182D7E12D1');
					
					$i = 0;
					
					foreach ($xml->entry as $item) {
						if ($count == $i) break;
						//preg_match('/\d{2}:\d{2}/', $item->description, $duration);<span class="duration">'.$duration[0].'</span>
						if($i%2==1) echo '<li class="even">';
						else echo '<li>';
						echo '<a href="'.preg_replace('/&feature.*/','',$item->link['href']).'">';
						echo '<span class="clip"><span class="overlay"></span><img src="'.preg_replace('/.*watch\?v=(.*)&.*/','http://i.ytimg.com/vi/$1/default.jpg',$item->link['href']).'" alt="" /></span></a>';
						echo '<p><a href="'.preg_replace('/(.*)&.*/','$1',$item->link['href']).'">'.$item->title.'</a></p>';
						echo '</li>';
						$i++;
					}
				?>
				</ul>
				<p id="o2-vid-widget-footer"><a href="http://www.o2.co.uk/guru" target="_blank">Chat to an O2 Guru for free online <img src="<?php echo plugins_url('o2_widget_footer.png',__FILE__) ?>" alt="O2 Guru TV" /></a></p>
			</div><!--o2-vid-widget-container-->
			<?php
		}
		
		function widget_o2_video_control_2() { 
			$options = get_option("widget_o2_video-2");
			if (!is_array( $options )) {
				$options = array();
			}
			if($options['cache_content'] == 'yes') {
				$cache = 'checked';
			} else { 
				$cache = ''; 
			}
			?>
				<p>
					<!--<label># Channel:<br /> </label><input type="text" id="o2-widget-channel-2" name="o2-widget-channel-2" value="<?php echo $options['o2-widget-channel-2'];?>"><br />-->
					<?php $options['o2-widget-channel-2'] = 'O2GuruTV'; ?>
					<label># Style:<br /> </label>
					<select name="o2-widget-size-2" class="widefat" id="o2-widget-size-2">
						<option value="small" <?php if($options['o2-widget-size-2'] == "small"){ echo "selected='selected'";} ?>>Single Column</option>
						<option value="medium" <?php if($options['o2-widget-size-2'] == "medium"){ echo "selected='selected'";} ?>>Double Columns</option>
						<option value="large" <?php if($options['o2-widget-size-2'] == "large"){ echo "selected='selected'";} ?>>Horizontal</option>            
					</select><br />

					<input type="hidden" id="o2_video_sub" name="o2_video_sub" value="1" />
				</p>
			<?php 
			if ($_POST['o2_video_sub'])
			{	
				if($_POST['cache_content'] == 'cache_content') {
					$cacheit = 'yes';
				} else {
					$cacheit = 'no';
				}
				$options['o2-widget-channel-2'] = $_POST['o2-widget-channel-2'];
				$options['o2-widget-size-2'] = $_POST['o2-widget-size-2'];
				$options['cache_content'] = $cacheit;

				update_option("widget_o2_video-2", $options);
			}
		}

		function o2_video_sidebar_init_2() {
			wp_register_sidebar_widget('o2_video_widget_2', 'O2 Video Widget', 'widget_o2_video_2');
			wp_register_widget_control('o2_video_widget_2', 'O2 Video Widget', 'widget_o2_video_control_2');
		}

		add_action("widgets_init", "o2_video_sidebar_init_2");

		$o2_video_style_url = str_replace(' ', '%20', plugins_url('style.css',__FILE__));
		wp_enqueue_style('o2_video_widget_style_sheet', $o2_video_style_url);
		
		wp_deregister_script('jquery');
		
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js', false, '1.6.2');
        wp_enqueue_script('jquery');

		preg_match('/MSIE \d/',$_SERVER['HTTP_USER_AGENT'],$match);
		if (!empty($match)) {
			if ($match[0] != 'MSIE 9') {
				wp_register_script('ddpng', plugins_url('pngfix.js',__FILE__), false, '1.0');
				wp_enqueue_script('ddpng');
				
				wp_register_script('csspie', plugins_url('pie.js',__FILE__), false, '1.0');
				p_enqueue_script('csspie');
			}
		}
		if ( ! is_admin() ) {
			wp_enqueue_script('o2_video_widget_script',plugins_url('script.js', __FILE__ ),array('jquery'),false,true);
		}
        
	?>