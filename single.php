<?php get_header(); ?>

<div id="content">

		<?php if (have_posts()) : ?>
	
			<?php while (have_posts()) : the_post(); ?>
            
           <?php 
				//if this is a packaged article, load package template
				if(get_post_meta($post->ID, 'grow_post_package_check_value', true)){
						
					include("includes/layouts/single_packaged.php");
			
				} else {
					
					//load default single layout
					include("includes/layouts/single_default.php");
				
				}	
			   
		    ?> 

		<?php comments_template(); ?>
        
		<?php endwhile; ?>

	<?php endif; ?>							

</div><!--/content-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>