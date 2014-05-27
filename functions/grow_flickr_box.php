<?php


//get meta for flickr slideshow
$flickr_slideshow_url = get_post_meta($post->ID, 'flickr_slideshow_url', true);
//echo $flickr_slideshow_url;

//take "http://www.flickr.com" out of the url string
$fsu_substr = substr($flickr_slideshow_url,strlen('http://www.flickr.com'));
$page_show_url = urlencode($fsu_substr);
$page_show_back_url = urlencode("http://www.hotmail.com");
//get set_id
$fsu_substr_array = explode("/",$fsu_substr);
$set_id = $fsu_substr_array[4];

//display flickr slideshow
?>
<div class="box">
	<div class="box_title">Slideshow</div>
        <div class="box_content flickr">
        <div class="sb_flickr">
            <object width="291" height="219"> 
                <param name="flashvars" value="offsite=true&lang=en-us&page_show_url=<?php echo $page_show_url;?>&set_id=<?php echo $set_id;?>"></param> 
                <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=71649"></param> 
                <param name="allowFullScreen" value="true"></param>
                <embed type="application/x-shockwave-flash" 
                    src="http://www.flickr.com/apps/slideshow/show.swf?v=71649" 
                    allowFullScreen="true" 
                    flashvars="offsite=true&lang=en-us&page_show_url=<?php echo $page_show_url;?>&page_show_back_url=&set_id=<?php echo $set_id;?>" width="291" height="219"></embed>
            </object>
            </div>
        </div>
</div>



<!--<object width="400" height="300"> <param name="flashvars" value="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F43347564%40N03%2Fsets%2F72157622677202538%2Fshow%2F&page_show_back_url=%2Fphotos%2F43347564%40N03%2Fsets%2F72157622677202538%2F&set_id=72157622677202538&jump_to="></param> <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=71649"></param> <param name="allowFullScreen" value="true"></param><embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=71649" allowFullScreen="true" flashvars="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F43347564%40N03%2Fsets%2F72157622677202538%2Fshow%2F&page_show_back_url=%2Fphotos%2F43347564%40N03%2Fsets%2F72157622677202538%2F&set_id=72157622677202538&jump_to=" width="400" height="300"></embed></object> -->


<!--
<object width="288" height="216"> <param name="flashvars" value="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F99352964%40N00%2Fsets%2F72157622544565756%2Fshow%2Fwith%2F3993184125%2F&page_show_back_url=%2Fphotos%2F99352964%40N00%2Fsets%2F72157622544565756%2Fwith%2F3993184125%2F&set_id=72157622544565756&jump_to=3993184125"></param> <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=71649"></param> <param name="allowFullScreen" value="true"></param><embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=71649" allowFullScreen="true" flashvars="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F99352964%40N00%2Fsets%2F72157622544565756%2Fshow%2Fwith%2F3993184125%2F&page_show_back_url=%2Fphotos%2F99352964%40N00%2Fsets%2F72157622544565756%2Fwith%2F3993184125%2F&set_id=72157622544565756&jump_to=3993184125" width="288" height="216"></embed></object>



<br /><br />
<h3>Picasa</h3>

<embed type="application/x-shockwave-flash" src="http://picasaweb.google.com/s/c/bin/slideshow.swf" width="288" height="192" flashvars="host=picasaweb.google.com&captions=1&hl=en_US&feat=flashalbum&RGB=0x000000&feed=http%3A%2F%2Fpicasaweb.google.com%2Fdata%2Ffeed%2Fapi%2Fuser%2Fvigual%2Falbumid%2F5396970663711189809%3Falt%3Drss%26kind%3Dphoto%26hl%3Den_US" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
<br /><br />-->

