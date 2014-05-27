<?php 
/* Template Name: Home
*/
?>
<?php 
//exit();
//check whether this is a test. If not, load current_issue
global $current_user;

$current_issue = get_option('current_issue');

if (current_user_can('admin') && $_GET['tci']!="") {
	$current_issue = $_GET['tci'];
} 
?>

<?php 
	get_header(); ?>
  
	    
<div id="content">
	<?php 
	
		//GET MAIN FEATURED STORY
		include(TEMPLATEPATH . '/featured.php'); 
	?>

	 
    <div id="featured_list">
	<h1>ALSO FEATURED</h1>
    
	<?php 
		//GET OTHER FEATURED STORIES
	    
		
		query_posts(array('cat'=>'-26', 'category__and' => array(17, $current_issue), "showposts" => '3', 'orderby'=>'date', 'order'=> 'desc'));
 
if ($current_user->user_login=="admin" && $current_user->user_level==10) {
	//print_r(query_posts(array('cat'=>'-26', 'category__and' => array(17, $current_issue), "showposts" => '3')));
} ?>

<?php 		while (have_posts()) : the_post();
	?>
				
		<div class="post">
	
		<?php 
		//get article image from flickr
		grow_get_article_image($size='small');
		?>
        
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
               		query_posts(array('category__and' => array(25,$current_issue), "showposts" => '1', "orderby" => "date", "order" => "des"));
                
				while (have_posts()) : the_post();?>
				<?php 
                //get article image from flickr
                grow_get_article_image($size='medium');
                ?>
                                      
                
                <h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">[...more]</a></p>
	               <?php endwhile; ?>
            </div>

        </div>
        
        <div class="depts_left">
        	<div class="dept_box">
            	<h1>AROUND THE COLLEGE</h1>
					<?php 
               		query_posts(array('category__and' => array(20,$current_issue), "showposts" => '1', "orderby" => "post_date", "order" => "desc"));
                
                    while (have_posts()) : the_post();?>
					<?php 
					//get article image from flickr
					grow_get_article_image($size='medium');
                	?>

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
                
                    while (have_posts()) : the_post();?>
					<?php 
                    //get article image from flickr
                    grow_get_article_image($size='medium');
                    ?>
                    <h2><a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <p><?php echo strip_tags(get_the_excerpt(), '<a><strong>'); ?> <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" class="more">[...more]</a></p>
	               
	

				   
				   <?php endwhile; ?>
            </div>
		</div>    





    </div>
    
</div>

<?php get_sidebar(); ?>

<?php 
//echo "<br />Grow website ... <br />";
get_footer(); ?>