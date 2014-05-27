<?php 
 
function qnd_post_exclusion( $posts ){
	global $wpdb;
	global $current_issue;
	//echo $current_issue;
		
	$issue_publish = get_option("issue_publish");
	$issues = get_categories('child_of=10&hide_empty=false&exclude='.$current_issue); //exclude $current_issue category in case admin sets a temporary $current_issue during testind

	//echo 'here'.$issue_publish;

	 $excluded_cats = array();
	 
	 foreach ($issues as $issue){
	 	if(!in_array($issue->cat_ID, $issue_publish)){
			$excluded_cats[] = $issue->cat_ID;	
		}
	  }
 
 	//print_r($excluded_cats);
 
	//If we are using admin or previewing post, don't exclude posts based on categories
	if (is_admin() || is_preview()) { return $posts; }
 
		//create an array to hold the posts we want to show
		$new_posts = array();
 
		//loop through all the post objects
		foreach( $posts as $post ){
 
			//for each object get an array of applicable categories
			$cats = get_the_category( $post->ID );
 
			//create a variable that determins if this post should be included
			//the default is true, i.e. include the post
			$include = true;
 
			//loop through all the categories applicable to the post
			foreach( $cats as $cat) {
 
				foreach ($excluded_cats as $ec) {
					//echo $ec;
					//if the post is assigned to our undesirable category then do not include it
					if ( $cat->cat_ID == $ec ) { $include = false; }
				}
			}
			//if we want to include it then add the post object to the new posts array
			if ( $include === true ) { $new_posts[] = $post; }
		}
 
	//send the new post array back to be used by WordPress
	return $new_posts;
}

//Run everything

add_filter('the_posts', 'qnd_post_exclusion' , 1 );
?>