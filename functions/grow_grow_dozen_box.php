<?php

	//if (!in_category('16') || !is_category('16')){
			/* print grow dozen article. if none found, print a "in the field" one */
			
			//try to get "grow dozen" article
			$cat = 16;
			global $current_issue;
			$r = query_posts(array('category__and' => array($cat,85,$current_issue), "showposts" => '1') );
				if(count($r)==0){
					//if no grow dozenarticle, use "in the field" category instead
					$cat = 470;
					$r = query_posts(array('category__and' => array($cat,85,$current_issue), "showposts" => '1') );
				}
			
			
			while (have_posts()) : the_post();?>
	
			<div class="box">
				<div class="box_title">IN THE FIELD</div>
					<div class="box_all"><a href="<?php echo get_category_link($cat);?>">VIEW ALL</a></div>
					<div class="box_content">
                    <?php
					   //get article image from flickr
                    	grow_get_article_image($size='small');
					?> 
                        <h2>
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?>
                        <?php if ($post->post_excerpt!=""){
                                    echo '<div class="tabs_excerpt">'.$post->post_excerpt.'</div>'; 
                                }?>
                            </a>
                        </h2>  
                    <?php //echo strip_tags(the_content(), '<a><strong>'); ?> 
                        <?php 
                        $content = $post->post_content;
                        $excerpt_length = 20;
                        $words = explode(' ', $content, $excerpt_length + 1);
                        if(count($words) > $excerpt_length) :
                            array_pop($words);
                            $content = implode(' ', $words);
                        endif;
                        //echo $content;?>
                        <!--<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"> [...more]</a>-->
    </div>
	
			</div><!--//Grow Dozen-->
			<?php endwhile;	?>
   <?php //} ?>