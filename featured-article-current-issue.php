<?php global $current_issue; ?>
	

    <div id="featured_main" class="current_issue">
            <div id="current_issue_img">
	         <?php 
			 	$issue_images = get_option("issue_images");
				$cat_name = str_replace(" ", "_", get_cat_name($current_issue));
				if ($issue_images[$cat_name]!=""){ ?>
					<img src="<?php echo $issue_images[$cat_name];?>"/>
                <?php	}
			 ?>
      		</div>
            <div id="current_issue_desc">
            <h2 class="pagetitle">
            	<?php echo get_cat_name($current_issue);?>
            </h2>
            <div id="current_issue_excerpt">
            	<h1>ON THE COVER</h1>
				<?php 
				//get article categorized as "on the cover" in current issue
				query_posts(array('category__and' => array(184,$current_issue), "showposts" => '1') );?>	
    			<?php	while (have_posts()) : the_post();?>
                	<h2><a href="<?php the_permalink()?>"><?php echo the_title();?></a></h2>
                	<h3><?php the_excerpt();?></h3>
				<?php  endwhile; ?>		
    		</div>
            </div>

    </div><!--/featured_main-->
    