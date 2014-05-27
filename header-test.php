<?php global $current_issue;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
		
		<title>
			<?php if (is_front_page()) { echo bloginfo('name');
			} elseif (is_404()) {
			echo '404 Not Found';
			} elseif (is_category()) {
			echo 'Category:'; wp_title('');
			} elseif (is_search()) {
			echo 'Search Results';
			} elseif ( is_day() || is_month() || is_year() ) {
			echo 'Archives:'; wp_title('');
			} else {
			echo wp_title('');
			}
			?>
		</title>

	    <meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
		<meta name="description" content="<?php bloginfo('description') ?>" />
		<?php if(is_search()) { ?>
		<meta name="robots" content="noindex, nofollow" /> 
	    <?php }?>
	
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/style.css" media="print" />
        <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/style.css" media="screen" />
		<!--[if IE 7]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/style/css/ie.css" media="screen" />
		<![endif]-->
		<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
		<?php 
		
		//wp_head();
		global $wpjsl;
		$wpjsl = split_wp_head();
				
		?>
		
<!--<?php
    	if (is_front_page() || is_page('476') ){?>
    		<style type="text/css" media="screen"> 
				#page{
					background: #FFF url('<?php bloginfo('stylesheet_directory'); ?>/images/grow_home_bg_orange.gif') repeat-x top left;
				}
			</style>

	<?php } ?>
-->	

    <meta name="keywords" content= "Grow Magazine, Life Sciences, UW-Madison, University of Wisconsin-Madison, College of Agricultural and Life Sciences, CALS, Wisconsin, Agriculture, Agricultural policy and reform, Alumni, Animal Health, Bacteriology, Biochemistry, Bioenergy, Cheese, Conservation, Dairy, Farming, Fermentation, Food and drink, Food crops, Food science, Forest ecology, Fruit, Genomics, Horticulture, Human-wildlife interactions, Instruction, International research, Internships, Landscape architecture, Microbiology, Nutrient management, Organics, Pathogens, Pesticides, Plant breeding,  Restoration, Soil science, Students, Sustainable agriculture, Water quality, Wildlife ecology" />
    
    <meta name="description" content="Grow, Wisconsin's Magazine for the Life Sciences, is a magazine published by the University of Wisconsin-Madison College of Agricultural and Life Sciences. We report on the most intriguing aspects of CALS research, teaching and outreach in the areas of food and agriculture, health, energy, the environment and community development." />
	</head>

	<body>
      <noscript id="nojs">
         JavaScript is turned off in your web browser. To take full advantage of this site, please enable Javascript and then refresh the page.
      </noscript>
<div id="page" <?php if (is_front_page() || is_page('476') ){ echo "class=\"home\"";}?>>

		<div id ="header">
            <div id="utility_bar">
            	<div id="utility_bar_search">
                	<?php include (TEMPLATEPATH . "/searchform.php"); ?>
                </div>
                <ul>
                    <li class="page_item page-item-3"><a href="<?php echo get_option('home'); ?>" title="Home">Home</a></li>
                    <li class="issues_link"><a href="<?php echo get_page_link('4');?>" title="Current Issue">Issues</a></li>
                    <?php wp_list_pages('title_li=&include=2,6,8'); ?>
                </ul>
            </div>
            <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<p><?php bloginfo('description'); ?></p>
			
            <div id="nav2">
				<ul >
                   <?php  $categories = array(3,4,5,6,7,8);
				   foreach ($categories as $cat){?>
                    <li class="cat-item cat-item-<? echo $cat;?> <?php if(is_category($cat)){ echo " current-cat";}?>" >
                    	<a href="<?php echo get_category_link($cat);?>" title="View all posts filed under <?php echo get_cat_name($cat);?>"><?php echo get_cat_name($cat);?></a>
                        <ul class="children">
	                        <?php //akpc_most_popular_in_cat($limit = 5, $before = '<li>', $after = '</li>', $cat_ID = "$cat"); ?>
	                     <?php
                         $myposts = get_posts('numberposts=5&orderby=date&order=desc&category='.$cat);
						 foreach($myposts as $post) :	?>
    							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
 						 <?php endforeach; ?>

                        </ul>
                    </li>
			<?php 	
					} ?>   
				</ul>

			</div>
	      </div>
          <br class="dirtyLittleTrick"/>
