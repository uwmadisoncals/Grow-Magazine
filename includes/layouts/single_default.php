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
                    //get article image from flickr
                    //grow_get_article_image($size='medium');
                    ?>
						
						<div id="post_utility_menu">
						<ul>
						<?php 
							if(function_exists('wp_print')) { 
								echo "<li>";
								echo print_link();
								echo "</li>";   
							}?>
							
							<li><a class="icon_comment" href="#respond">Leave a comment</a>


                            <li><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></li>
                            <li><a name="fb_share" type="button_count" href="http://www.facebook.com/sharer.php"></a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script></li>



                        </ul>
                        
						<?php if (current_user_can('level_10') && $current_user->user_login=="admin") {
							
						}
						?>
						
						
						
						<?php 
						//display "See Also" box
						
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


						<?php 
						//if current post is part of a package, dislay navigation menu
						$parent_package_post_id = get_post_meta($post->ID, 'grow_parent_package_post_id_value', true);
						if (!empty($parent_package_post_id)){?>
                            <div id="post_package_menu">
                            <?php 
                            //display package navigation
                                //get related articles?>
                                <h2><?php echo get_the_title($parent_package_post_id); ?><br/></h2>
                                
                                <?php							
                                $rel_posts_ids = get_post_meta($parent_package_post_id, 'grow_post_package_linked_posts_value', true);
                                if(!empty($rel_posts_ids)){ 
                                    echo '<li><h3>
											<a href="'.get_permalink($parent_package_post_id).'" rel="bookmark" title="'.get_the_title($parent_package_post_id).'">Introduction</a>
										   </h3></li>';
									grow_post_package_list($rel_posts_ids, false, false);
                                }?>
                            </div>                        
                        <?php } ?>
                        
						<?php if ($page>1){
								echo "<span class='page_of'>(Page $page of $numpages)</span>";
							} ?>
						<?php the_content('<span class="continue">Continue Reading</span>'); ?>
						<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                <p><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', '  '); ?>  <?php //comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
						
                        <p class="postmetadata alt">
							<small>
                            	<?php //edit_post_link('Edit this entry','','.'); ?>
                                
                            </small>
                        </p>

                    </div>
		
        		</div><!--/post-->