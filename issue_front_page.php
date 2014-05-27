<?php 
	
/*	$showfeatured = get_option('premiumnews_featured_entries'); // Number of other entries to be shown
	include(TEMPLATEPATH . '/includes/version.php');
	
*/	

 //get issue id

	$issue_id=$_GET["issue_id"];



	query_posts(array('category__and' => array(26,$issue_id), "showposts" => '1') );
	
	while (have_posts()) : the_post();?>
	
	<div id="featured_main">
	
			<?php if ( get_post_meta($post->ID, 'image', true) ) { ?> <!-- DISPLAYS THE IMAGE URL SPECIFIED IN THE CUSTOM FIELD -->
			
            <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">    
            	<div class="pic" style="background: #FFF url(<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&h=317&w=627&zc=1&q=90) no-repeat top left;">
      			</div>
            </a>		
			
		<?php }  ?> 
	</div><!--/featured_main-->


<?php endwhile; ?>