<?php 
query_posts(array('category__and' => array(26,$current_issue), "showposts" => '1') );
while (have_posts()) : the_post();?>
	<div id="featured_main">
		<?php if ( get_post_meta($post->ID, 'image_featured_article', true) ) { ?> 
            <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">    
            	<img class="pic" src="<?php echo get_post_meta($post->ID, "image_featured_article", $single = true); ?>" alt="<?php the_title(); ?>"/>
            </a>	
		<?php }  ?> 
	</div><!--/featured_main-->
<?php endwhile; ?>