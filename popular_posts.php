<?php
/*
Template Name: Popular posts
*/
?>

<?php get_header(); ?>

<div id="content">

	<h2 class="pagetitle">Most Popular Articles</h2>
	<?php 
		global $wpdb;
		$posts = $wpdb->get_results("
			SELECT ID, post_title, post_excerpt, guid
			FROM $wpdb->posts
			LEFT JOIN $wpdb->ak_popularity pop
			ON $wpdb->posts.ID = pop.post_id
			$join
			WHERE post_status = 'publish'
			AND post_date < NOW() 
			AND post_type='post' 
			$where
			$groupby
			ORDER BY pop.total DESC
			LIMIT 10"
		);
		if ($posts) {
			foreach ($posts as $post) {?>
			<?php setup_postdata($post); ?>

<div class="post">
		
			<?php if ( get_post_meta($post->ID, 'image', true) ) { ?>
				<a title="Permanent Link to <?php the_title(); ?>" href="<?php echo get_permalink($post->ID); ?>" rel="bookmark">
				<img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&amp;h=75&amp;w=75&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			
                </a>
				
			<?php } ?>		

			<h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php echo get_permalink($post->ID); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?></p>
            <?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php grow_comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
		</div>

	<?php 		}
	
		}
	?>



</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
