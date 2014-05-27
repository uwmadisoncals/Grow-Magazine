<?php
/*
Template Name Posts: Test post
*/
?>

<?php get_header("test"); ?>

<div id="content">

		<?php if (have_posts()) : ?>
	
			<?php while (have_posts()) : the_post(); ?>

				<h1><!--<em>Categorized |</em>--> <?php //the_category(', ') ?></h1>								

				<div class="post" id="post-<?php the_ID(); ?>">
				
					<h2 class="singleh2"><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>				
					
					<?php if ($post->post_excerpt!=""){?>
					<h3 class="single_subhead">
						<?php echo get_the_excerpt();?>
                    </h3>
                    <?php } ?>
                    <?php $author =  get_post_custom_values('Author', $post_id);
							 if (count($author)>0){
							 	echo "<h4 class=\"author_info\">By ".$author[0]."</h4>";
							 }
					?>                    

					<div class="entry">
						<?php 
						//check whether article has an assigned gallery. If so, don't display "image"
						$galleries=  get_post_custom_values('gallery', $post_id);
						//if ( get_post_meta($post->ID, 'image', true) && !in_category('26') && !get_post_meta($post->ID, 'gallery', true)) { 
                          if ( get_post_meta($post->ID, 'image', true) && is_single() && in_category('16')) { ?>  
                            <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=125&amp;w=125&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
                            
                            
                        <?php } ?>		
						
						<div id="post_utility_menu">
						<ul>
						<?php 
							if(function_exists('wp_print')) { 
								echo "<li>";
								echo print_link();
								echo "</li>";   
							}?>
							
							<li><a class="icon_comment" href="#respond">Leave a comment</a>
							<li><a class="icon_share" id="share_links" 
                            		onclick="//javascript: toggle(this);">Share</a>
							
						<?php
						if (function_exists('sociable_html')) { ?>
							<div id="sociable" name="sociable">	<?php echo sociable_html(); ?></div>
						<?php	}
						?>
                        </ul>
                        

						<?php 
						$sa = get_post_meta($post->ID, 'see_also', true);
						if($sa!=""){	
                        	$see_also = get_post($sa);?>
                        	
                            <div id="see_also">
							
                                
                                <strong>SEE ALSO</strong><br/>
                            	<a href="<?php echo get_permalink($see_also->ID)?>">
                            		<?php echo $see_also->post_title;?>
                            	</a> 
                        	</div>
                    	<?php } ?>
                        
						</div>
						<?php if ($page>1){
								echo "<span class='page_of'>(Page $page of $numpages)</span>";
							} ?>
						<?php the_content('<span class="continue">Continue Reading</span>'); ?>
						<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                <p><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
						
                        <p class="postmetadata alt">
							<small>
                            	<?php //edit_post_link('Edit this entry','','.'); ?>
                                
                            </small>
                        </p>

                    </div>
		
        		</div><!--/post-->			
	
		<?php comments_template(); ?>
		<?php endwhile; ?>
			
	
	<?php endif; ?>							

		</div><!--/content-->

<?php get_sidebar("test"); ?>

<?php get_footer("test"); ?>