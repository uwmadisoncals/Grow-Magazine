<?php 
/* Template Name: Issues - Single
*/
?>
<?php //get issue id, otherwise, default to current issue

	if ($_REQUEST["issue_id"]!=""){
		$current_issue = $_GET["issue_id"];
	} else {
		$current_issue = get_option('current_issue');
	}
	
	$is_issue_page =1;
	
	get_header(); 
	?>
    
    
	    
<div id="content">
	<?php 
	
		//GET MAIN FEATURED STORY
		include(TEMPLATEPATH . '/featured-article-current-issue.php'); 	
	?>

	 
    <div id="featured_list">
   	<h1>ALSO FEATURED</h1>
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
    
    <div id="departments" class="current_issue_depts">
    <h2 class="departments_title">Departments</h2>
		<?php 
		
		$include = "18,19,20,21,183,27,15,22,28";
		
		//get all categories under "departments"
		
		//create list of subcategories to exclude first (grow dozen)
		$cat_exc =  get_categories('child_of=16&hierarchical=0');
		foreach ($cat_exc as $exc){
			$excs[] = $exc->cat_ID;	
		}
		
		//add Final Exam category to exclude list if issue being displayed is a past issue
		if ($current_issue==get_option('current_issue')){
			$include.=',24';
		}
		
		
				
		$exclude = implode(",", $excs);
			
		
			
		$categories =  get_categories('child_of=14&hierarchical=0&include='.$include.'&exclude='.$exclude);
		
		$class="";
		//get earticles that are on each category and belong to issue
		foreach ($categories as $cat){
       		query_posts(array('category__and' => array($cat->cat_ID,$current_issue), "orderby" => "post_date", "order" => "desc"));
			$i=0;
			while (have_posts()) : the_post();?>
        	<div class="dept_box_current_issue_depts <?php echo $odd?>">
				<?php if ($i==0){ ?>
                <h1><?php echo $cat->cat_name;?></h1>		
   		        <?php } ?>
                <ul class="dept_items">
                	<li ><h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        	       <p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <!--<a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">[...more]</a>--></p>
        	<?php	//$odd = ( empty( $odd ) ) ? 'alt' : '';?>
					</li>
                </ul>
            </div>	
			<?php 
			$i++;
			endwhile; ?>
	
	<?php }?>
    </div>
    
    </div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>