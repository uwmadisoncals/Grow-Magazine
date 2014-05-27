<?php 

	function grow_get_article_image($size='original', &$post=""){
	
		require_once("phpFlickr/phpFlickr.php");
		$f = new phpFlickr("a919d6d699c9ad288ec62d95c3821e95", "642b6e454c0ee3c0");


		if (!$post)
			global $post;
		
		switch($size){
			case 'large':
				$width=290;
				$height=290;
			break;
			case 'medium':
				$width=170;
				$height=170;
			break;
			case 'small':
				$width=75;
				$height=75;
			break;
		}
		
		if (($img_flickr = get_post_meta($post->ID, 'flickr_image_url', true))!=""){
			if (strstr($img_flickr, '_o.jpg') || strstr($img_flickr, '_d.jpg')){
				//find 'medium' size's link
				//http://farm5.static.flickr.com/4028/4503482454_744da2a799_o.jpg
				$a = explode ("/", $img_flickr);
				$b = explode('_', $a[count($a)-1]);
				$photo_id = $b[0];;
				
				$medium_size = $f->photos_getSizes($photo_id);
				$img_src = $medium_size[3]['source'];
			
			} else{

				if ($size=='small'){ 
					//replace '_m.' with _s.' to get squared image
					if (strstr($img_flickr, '_m')){
						$img_src = str_replace('_m.', '_s.', $img_flickr);	
					}
					else { 
						$img_src = $img_src = str_replace('.jpg', '_s.jpg', $img_flickr);
					}
				} else {
					$img_src = $img_flickr;
				}
			}
		
			
		}  

		else if(($img_gal = get_post_meta($post->ID, 'image', true))!=""){
			$img_src = get_bloginfo('template_url').'/thumb.php?src='.$img_gal.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=90';
		}
		
		else if(($img_gal = get_post_meta($post->ID, 'image_fullpath', true))!=""){
			$img_src = $img_gal.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=90';
		}
		
		if ($img_src!="" ) { ?>
		 <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
			<img src="<?php echo $img_src;?>" alt="<?php the_title(); ?>" class="th <?php echo $size;?>" />
		 </a>   
					
<?php 	}
	}

/*	}

} else {


function grow_get_article_image($size='original', &$post=""){




	if (!$post)
		global $post;
	
	switch($size){
		case 'large':
			$width=290;
			$height=290;
		break;
		case 'medium':
			$width=170;
			$height=170;
		break;
		case 'small':
			$width=75;
			$height=75;
		break;
	}
	
	if (($img_flickr = get_post_meta($post->ID, 'flickr_image_url', true))!=""){ 
		
		if ($size=='small'){ 
			//replace '_m.' with _s.' to get squared image
			if (strstr($img_flickr, '_m')){
				$img_src = str_replace('_m.', '_s.', $img_flickr);	
			}
			else { $img_src = $img_src = str_replace('.jpg', '_s.jpg', $img_flickr);}
		} else {
			$img_src = $img_flickr;
		}
	}
	else if(($img_gal = get_post_meta($post->ID, 'image', true))!=""){
		$img_src = get_bloginfo('template_url').'/thumb.php?src='.$img_gal.'&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=90';
	}
	
	if ($img_src!="" ) { ?>
	 <a title="Permanent Link to <?php the_title(); ?>" href="<?php the_permalink() ?>" rel="bookmark">
		<img src="<?php echo $img_src;?>" alt="<?php the_title(); ?>" class="th <?php echo $size;?>" />
	 </a>   
				
<?php 	}


}

}
*/
?>