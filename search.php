<?php get_header(); ?>
<div id="content">
	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Results for "<em><?php the_search_query() ?></em>"</h2>

		<?php while (have_posts()) : the_post(); ?>

			<div class="post">
				<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
				<?php
                    $title 	= get_the_title();
                    $keys= explode(" ",$s);
                    $title 	= preg_replace('/('.implode('|', $keys) .')/iu',
                        '<strong class="search-excerpt">\0</strong>',
                        $title);
                ?>				
				
				<?php echo $title; ?></a></h2>
                <p><?php the_excerpt();?></p>
                <p><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
	
            </div>

		<?php endwhile; ?>
<!--        <h3>Didn't find what you were looking for? Refine your search!</h3>
        <?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php related_searches(); ?>
-->    	<ul>
			<li><?php next_post_link('&laquo; Older Entries') ?></li>
			<li><?php previous_post_link('Newer Entries &raquo;') ?></li>
		</ul>

	<?php else : ?>

		<h2 class="pagetitle">No posts found. Please try a new search.</h2>
        
        <div class="post">
        	<?php spell_suggest(); ?>
		</div>
		<?php //include (TEMPLATEPATH . '/searchform.php'); ?>

	<?php endif; ?>
		</div><!--/content-->
<?php get_sidebar(); ?>

<?php get_footer(); ?>