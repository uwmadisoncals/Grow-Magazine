<?php
if ( function_exists('register_sidebar') ) {
   register_sidebar(array(
       'before_widget' => '<li id="%1$s" class="widget %2$s">',
       'after_widget' => '</li>',
       'before_title' => '<h2 class="widgettitle">',
       'after_title' => '</h2>',
   ));
}

?>
<?php 
//GROW ADMIN ISSUE OPTIONS MENU
include("includes/functions/grow_issue_options_menu.php");


//grow_comments_popup_link is based on comments_popup_link on comment-template.php. Modified it to allow this function to be used in "most commented" page

function grow_comments_popup_link( $zero = 'No Comments', $one = '1 Comment', $more = '% Comments', $css_class = '', $none = 'Comments Off' ) {
	global $id, $wpcommentspopupfile, $wpcommentsjavascript, $post;

	//vq
	/*if ( is_single() || is_page() )
		return;*/

	$number = get_comments_number( $id );

	if ( 0 == $number && 'closed' == $post->comment_status && 'closed' == $post->ping_status ) {
		echo '<span' . ((!empty($css_class)) ? ' class="' . $css_class . '"' : '') . '>' . $none . '</span>';
		return;
	}

	if ( post_password_required() ) {
		echo __('Enter your password to view comments');
		return;
	}

	echo '<a href="';
	if ( $wpcommentsjavascript ) {
		if ( empty( $wpcommentspopupfile ) )
			$home = get_option('home');
		else
			$home = get_option('siteurl');
		echo $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
		echo '" onclick="wpopen(this.href); return false"';
	} else { // if comments_popup_script() is not in the template, display simple comment link
		if ( 0 == $number )
			echo get_permalink() . '#respond';
		else
			comments_link();
		echo '"';
	}

	if ( !empty( $css_class ) ) {
		echo ' class="'.$css_class.'" ';
	}
	$title = attribute_escape( get_the_title() );

	echo apply_filters( 'comments_popup_link_attributes', '' );

	echo ' title="' . sprintf( __('Comment on %s'), $title ) . '">';
	comments_number( $zero, $one, $more, $number );
	echo '</a>';
}





//function split_wp_head 
//Filters through wp_head hook and prints .css files in the header. 
//It also returns code for .js so they can be printed at the end of the document


function split_wp_head(){
		
		
		ob_start();
			wp_head();
			$wp_head =  ob_get_contents(); 
		ob_end_clean();
		
		//get all lines with .js 
		$wpjsl = strip_tags($wp_head, "<script>");
		$wpjsl = explode("\n", $wpjsl);
		
		//clean up $wpjsl to get rid of empty text 
		foreach ($wpjsl as $l){
			if (strstr($l, "<script")){
				$wpjsl2[] = $l;
			}
		}
		
		
		$wpcssl = strip_tags($wp_head, "<link><meta>");
		$wpcssl = explode("\n", $wpcssl);
		//print_r($wpcssl);
		
		//clean up $wpcssl to get rid of script text 
		foreach ($wpcssl as $l){
			if (strstr($l, "<meta") || strstr($l, "<link")){
				$wpcssl2[] = $l;
			}
		}
		
		echo implode("\n", $wpcssl2);		
	
		return implode("\n", $wpjsl2); 
		}



//GET ARTICLE'S FLICKR IMAGE
include("includes/functions/grow_get_article_flickr_image.php");




include("includes/functions/grow_post_package_list.php");


//PREVENT SCRIPTS FROM RUNNING IN ALL PAGES IF THEY ARE NOT NEEDED
	function my_deregister_javascript() {
		
		//contact-form-7
		//if ( !is_page(array(6,8)) && !is_admin()) {
		if(!is_page(8) && !is_page(6)){	
			wp_deregister_script( 'jquery' );
			wp_deregister_script( 'jquery-form' );
			
			//keep mmforms from running everyfreakingwhere
			remove_action('wp_head', array($mmf, 'wp_head'), 1);
			
			remove_action('activate_' . strtr(plugin_basename(__FILE__), '\\', '/'), array($mmf, 'set_initial'), 1);
			remove_action('init', array($mmf, 'load_plugin_textdomain'), 1);
			remove_action('admin_menu', array($mmf, 'remove_pages'), 1);
			remove_action('admin_head', array($mmf, 'admin_head'), 1);
			remove_action('wp_head', array($mmf, 'wp_head'), 1);
			remove_action('wp_print_scripts', array($mmf, 'load_js'), 1);
			remove_action('init', array($mmf, 'init_switch'), 11);
			remove_filter('the_content', array($mmf, 'the_content_filter'), 1);
			remove_filter('widget_text', array($mmf, 'widget_text_filter'), 1);
			if (remove_filter('the_content', 'wpautop'))
				remove_filter('the_content', array($mmf, 'wpautop_substitute'), 1);
				
			register_activation_hook(CONTACTFORM.'/mm-forms.php',array($mmf, 'mm_forms_install'), 1);
			//register_deactivation_hook(CONTACTFORM.'/mm-forms.php',array($mmf, 'mm_forms_uninstall'));
			remove_action('admin_notices', array($mmf, 'check_installation'), 1);
			remove_action('init', array($mmf, 'export_file'), 1);
			remove_action('init', array($mmf, 'mm_forms_tinymce_addbuttons'), 1);		
			unset($mmf);
		} 
		
	}
			//nggallery
		if ( !is_single()) {
			wp_deregister_script( 'swfobject' );
		}	

	//add_action( 'get_header', 'my_deregister_javascript', 1 );

 	//register idTAbs js
	if(is_front_page()){
		wp_register_script('idtabs', get_bloginfo('stylesheet_directory').'/functions/js/jquery.idtabs.min.js');
	wp_enqueue_script('idtabs', get_bloginfo('stylesheet_directory').'/functions/js/jquery.idtabs.min.js', '', '', true);
	}

//force wp to refresh RSS feed
add_filter( 'wp_feed_cache_transient_lifetime', create_function('$a', 'return 1;') );

//ADD POST THUMBNAILS

//add_theme_support( 'post-thumbnails' );
//set_post_thumbnail_size( 75, 75, true ); // Normal post thumbnails
//add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size


//scripts to execute in admin area
	if (is_admin()){
		
		//grow post package
		include('functions/grow_post_package.php');
	}




// DEV AREA --> RESTRICT EXECUTION TO ADMIN USER
if (current_user_can('level_10') && $current_user->user_login=="admin") {
	
//EXCLUDE POSTS BASED ON CATEGORY (I.E. BASED ON ISSUE). 
//This is used when issues haven't been activated in
//Admin > GROW - Issue Options panel and we don't want them to display yet

include("includes/functions/grow_exclude_posts.php");

 } //END DEV AREA 

function admin_level($user_login=''){
    global $current_user;
    get_currentuserinfo();
 
    if(current_user_can('level_10')) {
        if ($user_login!=''){
            if($current_user->user_login==$user_login){
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    } else {
        return false;
    }
}

if(admin_level('admin')){
$pids= array(4161,	
			 4399,
	4176,
	4182,
	4188,
	4191);
	
	foreach($pids as $pid){
	//delete_post_meta($pid, 'grow_parent_package_post_id_value');
	}
}
?>