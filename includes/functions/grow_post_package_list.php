<?php 
function grow_post_package_list($rel_posts_ids, $display_thumbnail, $display_excerpt=true){
	global $wpdb;
	global $post;
	
	$rel_posts_ids = unserialize($rel_posts_ids);
	
	//print_r($rel_posts_ids);
	
	//create or statement
	foreach ($rel_posts_ids as $key => $value){
		$or.= ' ID = '.$value;
		if ($key != (count($rel_posts_ids)-1)) { $or.=' OR'; } 
	}
	
	$query = "SELECT * FROM $wpdb->posts WHERE post_type='post' AND ($or) AND (post_status='publish' OR post_status='draft') ORDER BY post_date DESC";
	
	//echo $query;
	$rel_posts = $wpdb->get_results($query);
	
	foreach($rel_posts as $rp):?>
	
	<li <?php if ($rp->ID==$post->ID){ echo 'class="current_post"';}?>>   
		
		<?php if (get_post_meta($rp->ID, 'flickr_image_url', true) && $display_thumbnail==true) {?>
				
					<?php 
						//get article image from flickr
						grow_get_article_image($size='small', $rp);
					?>
			   
		<?php } ?>     
	 
		<h3><a href="<?php echo get_permalink($rp->ID); ?>" rel="bookmark" title="Permanent Link to <?php echo $rp->post_title; ?>"><?php echo $rp->post_title; ?></a></h3>
		<?php if ($display_excerpt==true) echo '<p>'.$rp->post_excerpt.'</p>';
?>	</li>
	<?php endforeach;	


}


?>