<?php 
//check whether this is a test. If not, load current_issue
global $current_user;
$current_issue = get_option('current_issue');

if (current_user_can('admin') && $_GET['tci']!="") {
	$current_issue = $_GET['tci'];
}
?>
	
<?php	
	//determine whether it is front page right here, before loop is reset
	if (is_front_page()){ 
		$is_front_page=1;
	}
	
	global $is_issue_page;
?>


<div id="sidebar">
    <div id="sb_content">
	
	<?php 
	if(admin_level('admin')){
			
			/* Widgetized sidebar, if you have the plugin installed. */
			if (dynamic_sidebar() ){
			
				
			}

			
		}
	?>
	
	<?php 	
            
		
	if ($is_issue_page==1){?>
        <div class="box">
            <div class="box_title">LIST OF ISSUES</div>
                <div class="box_content">
          		<div class="issues"><?php 
				
				$issues = get_categories('child_of=10&hide_empty=true');
	
					
				//order issues by season
				$season_order = array('spring' => 'mar', 'summer' => 'jul', 'fall' => 'sept', 'winter' => 'nov');
				foreach ($issues as $issue){
					$season_info = explode(" ", $issue->name);
					$m =  strtolower($season_info[0]);
					$y =  $season_info[1];
					
					//create a timestamp array to be used to order issues
					$key = time() - strtotime($season_order[$m].' '.$season_info[1]);
					
					//store in new array
					$ordered_issues[$key] = $issue;
					
					 
				}

				ksort($ordered_issues);
				$issues = $ordered_issues;
	
				//display issues 
				$issue_images = get_option("issue_images");
				$issue_pdf = get_option("issue_pdf");
				foreach ($issues as $issue){
					$name = str_replace(" ", "_", $issue->name); 
					$issue_image_path = $issue_images[$name];
					$issue_download_path = $issue_pdf[$name];
					//echo $issue_image_path;
					if ($issue_image_path!=""){
					?>
                    <div class="left">
						<a href="<?php echo get_permalink('4'); ?>/?issue_id=<?php echo $issue->term_id;?>" rel="bookmark">    
							<div class="issue_pic" style="background: #FFF url(<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo $issue_image_path; ?>&h=100&w=76&zc=1&q=90) no-repeat top left;">
                           </div>
		                       <span class="issue_title"><?php echo $issue->name?></span>
		                       <?php if ($issue_download_path!=""){ ?>
		                       <a href="<?php echo bloginfo('template_url'); echo $issue_download_path; ?>" class="issue_download">Download</a>
		                       <?php } else { ?>
		                       <span class="issue_download"></span>
		                       <?php } ?>
    					</a>
                	</div>
                <?php }
				} ?>

                
                </div>
                </div>
        </div><!--//Previous Issues-->
		<?php } ?>
        
 
       
    <?php if ( get_post_meta($post->ID, 'image', true) && is_single() && !in_category('16') && !in_category('17') && get_post_meta($post->ID, "gallery", true)=="") { ?>  

	<div class="ngg-widget">
        <img src="<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", true); ?>&amp;h=291&amp;w=291&amp;zc=1&amp;q=90" alt="<?php the_title(); ?>" class="th" />			

   </div>
    

	

	
	<?php }?>
           

	<?php 	
	/* Widgetized sidebar, if you have the plugin installed. */
		//if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : 
		//endif;?>

    <?php 
	
	//FLICKR BOX or IMAGE BOX
	global $current_user;
	
	if (is_single() && get_post_meta($post->ID, 'gallery', true)!=""){
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : 
		endif;	
	} else {
	
		if (is_single() && (get_post_meta($post->ID, 'flickr_slideshow_url', true))!="") {
			include ("functions/grow_flickr_box.php");
		} else 	if (is_single() && (get_post_meta($post->ID, 'flickr_image_url', true))!="") {
			include ("functions/grow_flickr_image.php");
		}
	}
	
	//VIDEO BOX
		 if (is_single('28') && $video_url = get_post_meta($post->ID, 'video_url', true)) {?>
        <div class="box">
            <div class="box_title">Related Video</div>
                <div class="box_all"><a href="#"></a></div>
                <div class="box_content video">
          		<div class="sb_video">

					<object style="visibility: visible;" id="vvqvideopreview" data="http://www.grow2.uwcalscommunication.com/wp-content/plugins/vipers-video-quicktags/resources/jw-flv-player/player.swf" type="application/x-shockwave-flash" height="238" width="291"><param value="transparent" name="wmode"><param value="true" name="allowfullscreen"><param value="always" name="allowscriptacess"><param value="file=http://www.grow2.uwcalscommunication.com/wp-content/uploads/fe.flv&amp;image=http://www.grow2.uwcalscommunication.com/wp-content/uploads/fe.jpg&amp;volume=100&amp;bufferlength=15&amp;skin=http://www.grow2.uwcalscommunication.com/wp-content/plugins/vipers-video-quicktags/resources/jw-flv-player/skins/.swf&amp;wmode=transparent&amp;allowfullscreen=true&amp;title=Focus Earth: May 9, 2009: Ford Focus and The Prince and the Rainforest&amp;date=5.9.09&amp;description=Focus Earth takes a look at a battle raging in Washington over a new climate change bill. Then, reports from the Midwest on the future of the Ford Motor Company, a fledgling biofuel industry, and Wisconsin's plan to become a leader in energy innovation. Finally, Focus Earth has the background on Prince Charles' new viral campaign to raise environmental awareness and save the rainforest." name="flashvars"></object>
                </div>               
                </div>
        </div><!--//Video box-->
		<?php } ?>

         <?php 
	
	// 	VIDEO BOX
		 if (is_single() && $video_url = get_post_meta($post->ID, 'video_url', true)) {?>
        <div class="box">
            <div class="box_title">Related Video</div>
                <div class="box_all"><a href="#"></a></div>
                <div class="box_content video">
          		<div class="sb_video">
					<?php echo tube_content("[youtube:$video_url&autoplay=0&rel=0&loop=0 291 238]");?>
                </div>               
                </div>
        </div><!--//Video box-->
		<?php } ?>


        <div class="box">
        	<div class="box_title">
            	<ul class="idTabs" id="tabs">
                <?php if (is_single() && wp_related_posts()!=false){?>
   	                	<li><a href="#rel" class="rel">RELATED</a></li>
                <?php } ?> 
                
                    	<?php if (!is_single()) { ?>
                        <li><span class="pop active selected">POPULAR</span></li>
                        <?php } else { ?>
                       	<li><a href="#pop" class="pop">POPULAR</a></li>
                        <?php } ?>

				
				<?php /*if ((!is_single()) || (is_single() && wp_related_posts()==false)){?>
                    	<li><a href="#rec" class="rec">MOST DISCUSSED</a></li>
                    <? }*/ ?> 
				</ul>
            </div>
           <?php if (is_single() && wp_related_posts()!=false){?>
            <div class="box_content tabs_content" id="rel">
                <?php echo wp_related_posts(); ?>
            </div>
			<?php } ?>            

            <div class="box_content tabs_content" id="pop">
           		<div class="ba_tabs"><a href="<?php echo  get_page_link('276');?>">MORE</a></div>
				<ul>
				<?php //if (function_exists('akpc_most_popular')) { akpc_most_popular($limit = 5, $before = '<div><li>', $after = '</li></div>'); } 
				
				//if(admin_level('admin')){
					//if(function_exists('uwcals_gamv_most_viewed_posts')){
					//	uwcals_gamv_most_viewed_posts($echo = true, $excerpt = true, $limit = 5, $before = '<div>', $after = '</div>');	}
				//}
				
				//wpp_get_mostpopular();
				
								
				?>
				<li>
					<a href="http://grow.cals.wisc.edu/environment/smart-birding" title="Permanent Link to Smart Birding" rel="bookmark">
						Smart Birding
						<br>
						<span class="uwcals_gamv_excerpt">A new birdsong app identifies feathered friends by their tweets</span>
					</a>
				</li>
				
				<li>
					<a href="http://grow.cals.wisc.edu/health/how-dna-profiling-works" title="Permanent Link to How DNA Profiling Works" rel="bookmark">
						How DNA Profiling Works
						<br>
						<span class="uwcals_gamv_excerpt">DNA profiling can be used to transform a stray hair into a prison sentence.</span>
					</a>
				</li>
				
				<li>
					<a href="http://grow.cals.wisc.edu/health/how-bacteria-move" title="Permanent Link to How Bacteria Move" rel="bookmark">
						How Bacteria Move
						<br>
						<span class="uwcals_gamv_excerpt">Microscopic locomotion is more than meets the eye.</span>
					</a>
				</li>
				
				<li>
					<a href="http://grow.cals.wisc.edu/health/vitamin-d-the-hype-and-the-hope" title="Permanent Link to Vitamin D–The Hype and the Hope" rel="bookmark">
						Vitamin D–The Hype and the Hope
						<br>
						<span class="uwcals_gamv_excerpt">It’s the “miracle vitamin” that was discovered by a CALS-trained researcher—-and our scientists have been prominent in exploring it ever since.What have we learned about the true benefits of vitamin D and its promise?</span>
					</a>
				</li>
				
				<li>
					<a href="http://grow.cals.wisc.edu/food/hunting-for-beginners" title="Permanent Link to Hunting for Beginners" rel="bookmark">
						Hunting for Beginners
						<br>
						<span class="uwcals_gamv_excerpt">By presenting a fresh vision of the sport to new audiences, a program aims to stem an alarming drop in hunters</span>
					</a>
				</li>

            	</ul>	
            </div>

			<?php /*if ((!is_single()) || (is_single() && wp_related_posts()==false)){?>
            <div class="box_content tabs_content" id="rec">
           		<div class="ba_tabs"><a href="<?php echo get_page_link('94');?>">MORE</a></div>
				<ul>
				<?php if (function_exists('mdv_most_commented')) {  mdv_most_commented(5, $before = '<div><li>', $after = '</li></div>', false, ''); } ?>
                </ul>
            </div> 
            <?php  }*/?>       
        </div>



       



        <?php if ($is_front_page!=1 && (is_single() && !in_category('26')) ){?>
        <div class="box"><!--Featured-->
	<?php
	
				$posts = query_posts(array('category__and' => array(26,$current_issue),"showposts" => '1', 'orderby'=>'date','order'=>'desc', 'showposts'=>'1') );
//print_r($posts);	
	if (count($posts)>0){
				foreach ($posts as $post) :
				setup_postdata($post);?>
            <div class="box_title">FEATURED ARTICLE</div>
           		<div class="box_all"><a href="<?php the_permalink()?>">READ</a></div>
          		<div class="box_content">
 							<?php if ( get_post_meta($post->ID, 'image_featured_article', true) ) { ?> 
                                        <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">    
                                            <div class="ft_pic" style="background: #FFF url(<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image_featured_article", $single = true); ?>&h=143&w=284&zc=1&q=90) no-repeat top left;">
                                            </div>
                                        </a>		
                                    <?php }  ?> 
									<h2>
                                    	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
										<?php //the_title(); ?>
                                    <?php if ($post->post_excerpt!=""){
												echo '<div class="tabs_excerpt">'.$post->post_excerpt.'</div>'; 
											}?>
                                        </a>
                                    </h2>  
                </div>
						<?php endforeach;
						} 
				?>
        </div><!--//Featured-->
        <?php } ?>



        
        <?php 
			//GROW DOZEN
			include('functions/grow_grow_dozen_box.php');
		
		?>
        
        
		
		<?php 
			query_posts(array('category__and' => array(24,$current_issue), "showposts" => '1') );
			while (have_posts()) : the_post();?>

        <div class="box">
            <div class="box_title">FINAL EXAM</div>
           		<div class="box_all"><a alt="Take the Final Exam" href="<?php the_permalink()?>" target="_blank">TAKE THE EXAM</a></div>
   		  <div class="box_content final_exam">
 							<?php if ( get_post_meta($post->ID, 'image', true) ) { ?> 
                                        <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink()?>" rel="bookmark">    
<!--                                            <div class="ft_pic" style="background: #FFF url(<?php echo bloginfo('template_url'); ?>/thumb.php?src=<?php echo get_post_meta($post->ID, "image", $single = true); ?>&h=143&w=284&zc=1&q=90) no-repeat top left;">
                                            </div>-->
                                        <div class="ft_pic"> </div></a>		
                                    <?php }  ?> 
<p>&nbsp;</p>
            						<h2><?php the_content()?></h2>

<!--<p>&nbsp;</p>
<p align="center"><a href="<?php the_permalink()?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" target="_blank">Do you think you know the answer?</a></p>
            <p align="center"><a href="<?php the_permalink()?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>" target="_blank">Ace our quiz and win Babcock Hall cheese!</a></p>-->
   		</div>
        </div><!--//Final Exam-->
	 <?php  endwhile; ?>   

   </div> <!--#sb_content-->
</div> <!--#sidebar-->