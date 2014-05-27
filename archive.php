<?php get_header(); ?>

<div id="content">
		<?php if (have_posts()) : ?>

		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		
		
		<?php /* If this is a category archive */ 
		
		if (is_category()) {
			if (is_category()) {
            
            //Print "Grow Dozen" if category is child of grwo dozen
			
			$grow_dozen_children = get_categories('child_of=16'); 
				foreach ($grow_dozen_children as $gdc){
					$gdc_ids[]=$gdc->cat_ID;
				}
			
				if (is_category($gdc_ids)){?>
					<h2 class="pagetitle no_border">Grow Dozen - <?php single_cat_title(); ?></h2>
					<h3 class="single_subhead">
						12 Alumni who are making a difference in the <?php single_cat_title(); ?> industry.
                    </h3>
                    <h4 class="author_info"></h4>
				<?php }

				else { 	?>
				
				<h2 class="pagetitle"><?php single_cat_title(); ?> - <?php if(is_category('Field Notes')){ echo 'CALS Around the World';}?></h2>
			
		<?php 	}
			}
		}/* If this is a tag archive */  elseif( is_tag() ) { ?>
		<h2 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2>Archive for <?php the_time('F jS, Y'); ?></h2>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2>Archive for <?php the_time('F, Y'); ?></h2>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2>Archive for <?php the_time('Y'); ?></h2>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2>Author Archive</h2>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2>Blog Archives</h2>
		<?php } ?>

		<?php while (have_posts()) : the_post(); ?>
		<?php 
		if (in_category($gdc_ids)){?>
        <div class="post_gd">
		
			<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
				<a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
				<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
                </a>
				
			<?php } ?>		

			<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?>
			<div class="entry_gd"><?php the_content();?></div>            

	
		</div><!--/post-->

<?php } else {// display regular posts?>
	
    <div class="post">
		
			<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
				<a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
				<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
                </a>
				
			<?php } ?>		

			<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?></p>
		</div><!--/post-->
<?php }?>	

		
		<?php endwhile; ?>
		<ul id="post_nav_links">
			<li><?php next_posts_link('&laquo; Older Entries') ?></li>
			<li><?php previous_posts_link('Newer Entries &raquo;') ?></li>
		</ul>

	<?php else : ?>

		<h2>Not Found</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
