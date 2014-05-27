<?php

function grow_issue_options() {
	

	global $wpdb;
	
	//add_option('issue_publish', '11', '', 'yes');
	
	//variables
	$opt_name =  array ("current_issue" => "current_issue",
						"issue_images" => "issue_images",
						"issue_pdf" => "issue_pdf",
						"issue_publish" => "issue_publish");
	$hidden_field_name = "submit_hidden";
	
	//read existing options
	$opt_val = array ("current_issue" => get_option($opt_name["current_issue"]),
					  "issue_images"=> get_option($opt_name["issue_images"]),
					  "issue_pdf"=> get_option($opt_name["issue_pdf"]),
					  "issue_publish"=> get_option($opt_name["issue_publish"]));
	
	
	
	//See if user has posted any information
	//if they did, the hidden field will be set to "Y"
	if ($_POST[$hidden_field_name]=="Y"){
		//read their posted value
		
		$opt_val =  array("current_issue" => $_POST[$opt_name['current_issue']],
						  "issue_images" => $_POST[$opt_name["issue_images"]],
						  "issue_pdf" => $_POST[$opt_name["issue_pdf"]],
						  "issue_publish" => $_POST[$opt_name["issue_publish"]]);
		
		
		//save the posted value to the database
		update_option($opt_name['current_issue'], $opt_val['current_issue']);
		update_option($opt_name['issue_images'], $opt_val['issue_images']);
		update_option($opt_name['issue_pdf'], $opt_val['issue_pdf']);
		update_option($opt_name['issue_publish'], $opt_val['issue_publish']);

	
	
	//Put an "options updated" message on the screen
	?>

    <p>&nbsp;</p>
    <div id="message" class="updated fade">
    <p><strong>
        <?php _e('Options saved.', 'grow_options_domain' ); ?>
        </strong></p>
    </div>

	<?php } ?>


    <div class="wrap">
    	<h1><?php _e("GROW - Issue Options", "grow_options_domain");?></h1>
		<?php 
		
		$issues = get_categories('child_of=10&hide_empty=0');
		
		/*echo "<pre>";
		print_r($issues);
		echo "</pre>";*/
	?>
    <form name="grow_issue_options" method = "post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">

        <table class="form-table">
        	<tbody>
            	<tr valign="top">
                	<th scope="row"><label for="curren_issue">Current Issue</label></th>
                    <td>
                    	<select name = "<?php echo $opt_name["current_issue"];?>">
             				<?php foreach ($issues as $issue){?>
                    			<option value="<?php echo $issue->term_id; ?>"
                        		<?php if ($opt_val['current_issue']==$issue->term_id) { echo " selected='selected' ";}?>><?php echo $issue->name; ?></option>
            			<?php } ?>
        				</select>
                        <span class="setting-description">Select issue to be displayed in home page.</span>
                    </td>
                </tr>
            	<tr valign="top">
                	<th scope="row"><label for="issue_images">Issues</label></th>
                    <td>
                    <table width="100%">
                      <tr>
                        <th width="15%" scope="col"><strong>Title</strong></th>
                        <th width="15%" scope="col"><strong>Publish</strong></th>
                        <th scope="col"><strong>Path to Image</strong> <span class="setting-description"> - Example: <code>/wp-content/uploads/2009/03/image.jpg</code></span></th>
                        <th scope="col"><strong>Path to PDF</strong> <span class="setting-description"> - Example: <code>/wp-content/uploads/2009/03/issue.pdf</code></span></th>
                        <th></th>
                      </tr>
                      <?php //$issue_images = get_option('issue_images');?>
                      <?php foreach ($issues as $issue){?>
                      <tr>
                        <td width="15%"><?php echo $issue->name; ?></td>
                        <?php $name = str_replace(" ", "_", $issue->name); ?>

                        <td width="15%">
			
                    	<input 
                        	type="checkbox" 
                            name="<?php echo $opt_name["issue_publish"];?>[]" 
                            value="<?php echo $issue->cat_ID?>"
							<?php 
									foreach($opt_val["issue_publish"] as $ip){
									if($issue->cat_ID == $ip)
										echo "checked=\"checked\"";
									}
							
							?>
                        />
						</td>
                        <td>
                        <input type="text" value="<?php echo $opt_val['issue_images'][$name];?>" name="<?php echo $opt_name["issue_images"];?>[<?php echo $name;?>]" class="regular-text code"/>
                        </td>
                        <td>
                        <input type="text" value="<?php echo $opt_val['issue_pdf'][$name];?>" name="<?php echo $opt_name["issue_pdf"];?>[<?php echo $name;?>]" class="regular-text code"/>
                        </td>
                        <td><a href="<?php echo get_bloginfo('url');?>?tci=<?php echo $issue->cat_ID;?>" target="_blank">Test as Current Issue</a></td>
                      </tr>
                       <?php 
					   
					   
					   } ?>
                    </table>
                    </td>
               </tr>
            </tbody>
        </table>
        
    <p class="submit">
		<input name="save" type="submit" value="Save changes" />    
		<input type="hidden" name="action" value="save" />
	</p>
		<input type="hidden" name=<?php echo $hidden_field_name; ?> value="Y" />

    </form>
    
    <?php //print_r($opt_val['issue_publish']);?>
    </div>
<?php } 

// Add Grow - Issue Options to Settings menu in admin
function grow_issue_options_menu() {
  add_options_page('GROW - Issue Options', 'GROW - Issue Options', 8, __FILE__, 'grow_issue_options');
}


//Run all of this

add_action('admin_menu', 'grow_issue_options_menu');

?>
