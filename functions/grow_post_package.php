<?php 

function grow_add_meta_boxes(){
	//Package options
	add_meta_box('grow_post_package_box', 'Package Options', 'grow_post_package_box', 'post', 'normal', 'high');
}

/*Creates box with options to create package */


function grow_post_package_box(){
	global $post;
	global $wpdb;
	
	
	//option to create package
		//get current value
		$post_package_check = get_post_meta($post->ID, 'grow_post_package_check_value', true);	
	
		//create noncename field to verify data
		echo '<input type="hidden" name="grow_post_package_check_noncename" id="grow_post_package_check_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
	
	
		//print title
			echo '<p><input type="checkbox" id="grow_post_package_check_value" name="grow_post_package_check_value"  value="y"';
			
			if ($post_package_check=='y'){ 
				echo ' checked="checked" ';
			} 		
			
			echo '/> This is packaged article.</p>';
		
		
		
	echo '<div id="list_linked_options">';

	//set grow_post_package_linked_posts_value field
	
		$linked_posts_box = array('name' => 'grow_post_package_linked_posts',
								  'title' => 'Linked Posts',
								  'description' => 'Select posts that will be linked to from this story.',
								  'default_value');
		
		
		//get current value
		$linked_posts_value = get_post_meta($post->ID, $linked_posts_box['name'].'_value', true);	
	
		//create noncename field to verify data
		echo '<input type="hidden" name="'.$linked_posts_box['name'].'_noncename" id="'.$linked_posts_box['name'].'_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';
		

		//print title
		echo '<p><strong>'.$linked_posts_box['title'].'</strong></p>';
		echo '<p>'.$linked_posts_box['description'].'</p>';  			


		//print list
		
		  //first, get meta value from saved "grow_post_package_linked_posts_value" custom field
		  //to see which ones have already been selected
		  if (get_post_meta($post->ID, 'grow_post_package_linked_posts_value', true)!=""){
		  	  $linked_posts = get_post_meta($post->ID, 'grow_post_package_linked_posts_value', true);
		  	  $linked_posts = unserialize($linked_posts);
		  }
		  
		  
		  //get current post's issue (i.e Spring 2010) and make sure only posts from this issue are displayed
		 
		  foreach(get_categories('child_of=10') as $issue_cat){
				foreach((get_the_category()) as $post_cat) { 
					if($post_cat->cat_ID == $issue_cat->cat_ID){
						$issue_id = $issue_cat->cat_ID;
					} 
				} 
		  }
		
		$query = "SELECT * FROM $wpdb->posts WHERE post_type='post'AND (post_status='publish' OR post_status='draft') AND ID<>$post->ID ORDER BY post_date ASC";
		$posts_list = $wpdb->get_results($query);

		echo '<div  class="inside top-border">
			  <div id="list_linked_posts">
			  <ul >';
				if ($posts_list){
					foreach($posts_list as $p){
	
						//if post is in current posts issue, display
						if (in_category($issue_id, $p->ID)){	
							echo '<li>
									 <label>
									 <input 
										type="checkbox" 
										name="'.$linked_posts_box['name'].'_value[]" 
										value="'.$p->ID.'"';
										
										//check if current posts has already been selected
										for($j=0; $j<count($linked_posts);$j++){
											if($p->ID==$linked_posts[$j]){ echo 'checked="checked"';}
										}
										
							echo   '/> '.$p->post_title.'
								  </label>
								  </li>';
						}
					}
				}	
				
				
			echo '</ul>
			  </div>
			  </div>
			  </div>';


	//grow_post_package_linked_posts_value-hidden
	//Store current grow_post_package_linked_posts_value on hidden field, to be sent 
	//during save_post action to update package_post_parent_id in all linked posts
	
	
		//get current value
		$linked_posts = get_post_meta($post->ID, 'grow_post_package_linked_posts_value', true);
	
		//create noncename field to verify data
		echo '<input type="hidden" name="grow_post_package_linked_posts_value-hidden_noncename" id="grow_post_package_linked_posts_value-hidden_noncename" value="'.wp_create_nonce(plugin_basename(__FILE__)).'" />';

		//print hidden field
			echo '<input type="hidden" id="grow_post_package_linked_posts_value-hidden" name="grow_post_package_linked_posts_value-hidden"  value=\''.$linked_posts.'\'/>';
}

//save meta boxes
	
function grow_save_meta_boxes($post_id){
	global $post;
    
	//list all boxes that will be saved
	$meta_boxes = array (array('name'=>'grow_post_package_linked_posts'),
						 array('name'=>'grow_post_package_check'));
	
	foreach($meta_boxes as $meta_box) {  
		// Verify  
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
			return $post_id;  
		}  
	
		if ( 'page' == $_POST['post_type'] ) {  
			if ( !current_user_can( 'edit_page', $post_id ))  
				 return $post_id;  
		} else {  
			if ( !current_user_can( 'edit_post', $post_id ))  
				return $post_id;  
		}  
	
		$data = $_POST[$meta_box['name'].'_value'];  
		
		
		//LINKED POSTS
		
			if ($meta_box['name'] == "grow_post_package_linked_posts" && $data!=''){
				
				//save id of current post as 'parent package post' meta in all linked
				//posts, so it can be identified that they belong to a package when visited
				
					//a.- delete grow_parent_package_post_id_value from all linked posts
					
					$n = 'grow_parent_package_post_id'; //name of meta value stored in linked posts
					
					//get current list of all linked posts stored in grow_post_package_linked_posts_value
					$lp = stripcslashes($_POST["grow_post_package_linked_posts_value-hidden"]);

					if($lp!=""){
						$p_ids = unserialize($lp);
						foreach($p_ids as $p_id){
							//echo $p_id;
							delete_post_meta($p_id, $n.'_value');
						}
					}
					//b.- add grow_parent_package_post_id_value using new list sent by user
					
					foreach ($data as $p_id){
						add_post_meta($p_id, $n.'_value', $post_id, true);
					}

				//now, serialize new lsit sent by user so it can be stored 
				//as 'grow_post_package_linked_posts_value' meta value of current post
				$data = serialize($data);

			}
			
		// END of LINKED POSTS
			
	   	//save meta data
		 if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
		 elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
			 update_post_meta($post_id, $meta_box['name'].'_value', $data);  
		 elseif($data == "")  
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));

	}// end foreach
}





//load custom admin css
function load_custom_admin_css(){
     echo "<link rel='stylesheet' href='".get_bloginfo("template_url")."/includes/css/custom_admin.css' type='text/css' media='all' />";
}


//jquery manipulation

function grow_meta_box_scripts(){ ?>

	<script language="javascript" type="text/javascript">
    
	jQuery(document).ready(function(){
		
		enable_package_options();		
	
		//hide grow_post_package_linked_posts_value and grow_post_package_check_value
		//and others for now until a better interface can be created for custom fields
		jQuery('tr:has(input[value=grow_post_package_check_value])').hide();
		jQuery('tr:has(input[value=grow_post_package_linked_posts_value])').hide();
		jQuery('tr:has(input[value=grow_parent_package_post_id_value])').hide();
		jQuery('tr:has(input[value=sociableoff])').hide();
	
	});
	
	jQuery('#grow_post_package_check_value').change(function(){enable_package_options();});

	//check whether to enable package options
	function enable_package_options(){
		if (jQuery('#grow_post_package_check_value').attr('checked')){
			jQuery('#list_linked_options').css('display', 'block');
			jQuery('#list_linked_options input:checkbox').removeAttr('disabled');
		} else {
			jQuery('#list_linked_options').css('display', 'none');
			jQuery('#list_linked_options input:checkbox').removeAttr('checked').attr('disabled', 'disabled');			
		}	
	}    
	
	
    </script>

<?php }


//RUN EVERYTHING
	//load custom admin css
	add_action('admin_print_styles', 'load_custom_admin_css');

	//create boxes
	add_action('admin_menu', 'grow_add_meta_boxes');
	
	//load javascript
	add_action ('admin_print_footer_scripts', 'grow_meta_box_scripts');

	//save boxes' content
	add_action('save_post', 'grow_save_meta_boxes');
	


?>