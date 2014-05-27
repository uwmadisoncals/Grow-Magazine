<?php 
/* Template Name: Home - Test
*/
?>
<?php $current_issue = get_option('current_issue');?>
<?php 
	$current_issue=179;
	get_header("test"); ?>
  
	    
<div id="content">
	<?php 
	
		//GET MAIN FEATURED STORY
		include(TEMPLATEPATH . '/featured-test.php'); 
	
	//$current_issue;
	
	?>

	 
    <div id="featured_list">
	<h1>FEATURED</h1>
    
	<?php 
		//GET OTHER FEATURED STORIES
	    
		query_posts(array('cat'=>'-26', 'category__and' => array(17,$current_issue), "showposts" => '3'));

		while (have_posts()) : the_post();
	?>
				
		<div class="post">
		
			<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
				<a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
				<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
                </a>
				
			<?php } ?>		

			<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">[...more]</a></p>

			
		</div><!--/post-->
	<?php endwhile; ?>
	
    </div><!--/featured_list>-->
    
    <div id="departments">
    	<div class="depts_left">
        	<div class="dept_box">
            	<h1>AROUND THE COLLEGE</h1>
					<?php 
               		query_posts(array('category__and' => array(25,$current_issue), "showposts" => '1', "orderby" => "post_date", "order" => "desc"));
                
                    while (have_posts()) : the_post();
                	?>

					<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
                       <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
                            <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=170&amp;w=170&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
                          </a>  
                            
                    <?php } ?>	
                            
                    <h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">[...more]</a></p>
	               <?php endwhile; ?>
            </div>

        </div>
        
        <div class="depts_left">
        	<div class="dept_box">
            	<h1>KNOW HOW</h1>
					<?php 
               		query_posts(array('category__and' => array(20,$current_issue), "showposts" => '1', "orderby" => "post_date", "order" => "desc"));
                
                    while (have_posts()) : the_post();
                	?>
				<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
                       <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
                       <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=170&amp;w=170&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
  </a>
                            
                    <?php } ?>	
                                        <h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">[...more]</a></p>
	               <?php endwhile; ?>
            </div>
		</div>

<div class="depts_left" style="border:0px;">
        	<div class="dept_box" >
            	<h1>FIELD NOTES</h1>
					<?php 
               		query_posts(array('category__and' => array(27,$current_issue), "showposts" => '1', "orderby" => "post_date", "order" => "asc"));
                
                    while (have_posts()) : the_post();
                	?>
				<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
                       <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
                            <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=170&amp;w=170&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
                         </a>   
                            
                    <?php } ?>	
                    
                    <h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">[...more]</a></p>
	               <?php endwhile; ?>
            </div>
		</div>    
    </div>
    
</div>

<?php get_sidebar("test"); ?>

<?php get_footer("test"); ?>