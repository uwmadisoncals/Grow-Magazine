<?php 
		
query_posts(array('category__and' => array(26,$current_issue), "showposts" => '1') );

while (have_posts()) : the_post();?>

	<div id="featured_main">
	
			<?php if ( get_post_meta($post->ID, 'image_featured_article', true) ) { ?> <!-- DISPLAYS THE IMAGE URL SPECIFIED IN THE CUSTOM FIELD -->
			
            <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">    
            	<div class="pic" style="background: #FFF url(<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image_featured_article", $single = true); ?>&h=317&w=627&zc=1&q=90) no-repeat top left;">
      			</div>
            </a>		
			
		<?php }  ?> 
	</div><!--/featured_main-->


<?php endwhile; ?>