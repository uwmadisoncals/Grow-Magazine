        <br class="dirtyLittleTrick"/>
        <div id="footer">
 				<div id="footer_nav">
                <ul>
                  
                   <?php  $categories = array(3,4,5,6,7,8);
				   foreach ($categories as $cat){?>
                    
                    <li class="cat-item cat-item-<?php echo $cat;?> <?php if(is_category($cat)){ echo " current-cat";}?>" >
                    	<a href="<?php echo get_category_link($cat);?>" title="View all posts filed under <?php echo get_cat_name($cat);?>"><?php echo get_cat_name($cat);?></a></li>
                   <?php } ?>
                </ul>
                </div>
        <?php wp_footer(); ?>

 	   <?php  global $wpjsl; 
	   		  echo $wpjsl;
		?> 

            <div id="copyright">
       	  &copy; Copyright <?php echo date('Y', time());?> Grow Magazine. All rights reserved. <a href="http://www.wisc.edu" target="_blank">University of Wisconsin-Madison</a> - <a href="http://www.cals.wisc.edu" target="_blank">College of Agricultural and Life Sciences</a> Communication Program. </div>
		</div> <!--#footer-->
	</div> <!--#page-->
    </body>
</html>