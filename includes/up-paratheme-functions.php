<?php




if ( ! defined('ABSPATH')) exit; // if direct access 




function up_paratheme_author_profile_info($author_id)
	{
		
		$user_url = get_the_author_meta( 'user_url', $author_id );		
		
		$facebook = get_the_author_meta( 'facebook', $author_id );
		$twitter = get_the_author_meta( 'twitter', $author_id );		
		$google_plus = get_the_author_meta( 'google-plus', $author_id );	
		$pinterest = get_the_author_meta( 'pinterest', $author_id );		
		$linkedin = get_the_author_meta( 'linkedin', $author_id );		
		$gender = get_the_author_meta( 'gender', $author_id );
		$display_name = get_the_author_meta( 'display_name', $author_id );		
		$first_name = get_the_author_meta( 'first_name', $author_id );		
		$last_name = get_the_author_meta( 'last_name', $author_id );		
		$profile_img = get_the_author_meta( 'profile_img', $author_id );		
		$profile_cover = get_the_author_meta( 'profile_cover', $author_id );
		$country = get_the_author_meta( 'country', $author_id );		
		
		
		$html .= '

			<ul class="author-info-list">
			<li><i class="fa fa-user"></i>'.ucfirst($display_name).'</li>			
			<li><i class="fa fa-globe"></i>'.ucfirst($country).'</li>
			<li><i class="fa fa-link"></i><a href="'.$user_url.'">'.$user_url.'</a></li> 


			</ul>';		
		$html .= '';
		
		
		
		return $html;
		
		}




function up_paratheme_post_author_about($author_id)
	{
		
		$description  = get_the_author_meta( 'description', $author_id );
		
		
		$html .= '<div class="author-about"><div class="description">'.$description."</div>";		
		$html .= '</div>';
		
		
		
		return $html;
		
		}







function up_paratheme_author_comment_list($author_id)
	{
		
		
		$profile_img = get_the_author_meta( 'profile_img', $author_id );
		
		
		
		
		
		
		
		$html = '';
		$html .= '<div class="comment-list">';
		
		
		$args = array(
			'user_id' => $author_id, // use user_id
		
		);
		
		
		$comments = get_comments($args);
		
			foreach($comments as $comment) :
				
				$html .= '<div class="comment">';
				$html .= '<div class="author-thumb"><img src="'.$profile_img.'" /></div>';
				$html .= '<div class="author-name">'.$comment->comment_author.'</div>';
				$html .= '<div class="author-comment">'.$comment->comment_content.'</div>';

				
				$html .= '</div>';
				
				
			endforeach;
		
		$html .= '</div>';
		
		
		
		return $html;
	}







function up_paratheme_author_post_list($author_id)
	{
		$posts_per_page = get_option('posts_per_page');
		
		global $wp_query;
		$wp_query = new WP_Query(
			array (
				'post_type' => 'post',
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => $posts_per_page,
				'author' => $author_id,
				
			) );
				
				
		
		if ( $wp_query->have_posts() ) :
		
		
		
		$html = '';
		$html.= '<div class="author-post-list" >';
		
		
		while ( $wp_query->have_posts() ) : $wp_query->the_post();
		
		global $product;

		$featured = get_post_meta( get_the_ID(), '_featured', true );
		
		
		
		
		$post_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $wcps_items_thumb_size );
		
		$post_thumb_url = $post_thumb['0'];

		
		
		$html.= '<div class="author-post" >';
			
		if($featured=="yes")
			{
			$html.= '<div class="featured"></div>';
			}
				
		
				
				
				
				
		$html.= '<div class="post-title"><i class="fa fa-file-text-o"></i>
'.get_the_title().'</div>
		<div class="post-content">'.wp_trim_words( get_the_content() , 30, '<a class="read-more" href="'. get_permalink() .'">Read More</a>' ).'</div>

		
		<div class="post-thumb"><a href="'.get_permalink().'"><img src="'.$post_thumb_url.'" /></a></div>
		

			</div>';
		
		endwhile;
		
		wp_reset_query();
		
		endif;
		

			
		$html .= '</div>';		
				
		return $html;	
				
				
				
	}
		
		
		
		

function up_paratheme_add_new_field()
	{


		$up_paratheme_input_fields_meta = get_option( 'up_paratheme_input_fields_meta' );
		
		if(empty($up_paratheme_input_fields_meta))
			{
				$up_paratheme_input_fields_meta = array();
			}
			
		$up_paratheme_input_fields_icon = get_option( 'up_paratheme_input_fields_icon' );
		
		if(empty($up_paratheme_input_fields_icon))
			{
				$up_paratheme_input_fields_icon = array();
			}
		$up_paratheme_input_fields_lable = get_option( 'up_paratheme_input_fields_lable' );
		
		if(empty($up_paratheme_input_fields_lable))
			{
				$up_paratheme_input_fields_lable = array();
			}
		
		$up_paratheme_input_fields_type = get_option( 'up_paratheme_input_fields_type' );
		
		if(empty($up_paratheme_input_fields_type))
			{
				$up_paratheme_input_fields_type = array();
			}
		
		$up_paratheme_input_fields_tooltip = get_option( 'up_paratheme_input_fields_tooltip' );
		
		if(empty($up_paratheme_input_fields_tooltip))
			{
				$up_paratheme_input_fields_tooltip = array();
			}
		

		
		$meta  = array($_POST["meta"] => $_POST["meta"]);
		$icon  = array($_POST["meta"] => $_POST["icon"]);
		$lable  = array($_POST["meta"] => $_POST["lable"]);
		$type  = array($_POST["meta"] => $_POST["type"]);
		$tooltip  = array($_POST["meta"] => $_POST["tooltip"]);


		$up_paratheme_input_fields_meta = array_merge( $up_paratheme_input_fields_meta, $meta );
		$up_paratheme_input_fields_icon =  array_merge( $up_paratheme_input_fields_icon, $icon );
		$up_paratheme_input_fields_lable =  array_merge( $up_paratheme_input_fields_lable, $lable );
		$up_paratheme_input_fields_type =  array_merge( $up_paratheme_input_fields_type, $type );
		$up_paratheme_input_fields_tooltip =  array_merge( $up_paratheme_input_fields_tooltip, $tooltip );


		
		update_option('up_paratheme_input_fields_meta', $up_paratheme_input_fields_meta);
		update_option('up_paratheme_input_fields_icon', $up_paratheme_input_fields_icon);
		update_option('up_paratheme_input_fields_lable', $up_paratheme_input_fields_lable);
		update_option('up_paratheme_input_fields_type', $up_paratheme_input_fields_type);
		update_option('up_paratheme_input_fields_tooltip', $up_paratheme_input_fields_tooltip);


		
		
		die();
	}

add_action('wp_ajax_up_paratheme_add_new_field', 'up_paratheme_add_new_field');
add_action('wp_ajax_nopriv_up_paratheme_add_new_field', 'up_paratheme_add_new_field');






function up_paratheme_reset()
	{
		
		$up_paratheme_input_fields_meta = array("facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google-plus","pinterest"=>"pinterest","linkedin"=>"linkedin","gender"=>"gender","first_name"=>"first_name","last_name"=>"last_name","profile_img"=>"profile_img","profile_cover"=>"profile_cover","country"=>"country");
	

		$up_paratheme_input_fields_lable = array("facebook"=>"Facebook","twitter"=>"Twitter","google-plus"=>"Google Plus","pinterest"=>"Pinterest","linkedin"=>"Linkedin","gender"=>"Gender","first_name"=>"First  Name","last_name"=>"Last Name","profile_img"=>"Profile Image","profile_cover"=>"Profile Cover","country"=>"Country");
		
			
		$up_paratheme_input_fields_type = array("facebook"=>"text","twitter"=>"text","google-plus"=>"text","pinterest"=>"text","linkedin"=>"text","gender"=>"text","first_name"=>"text","last_name"=>"text","profile_img"=>"file","profile_cover"=>"file","country"=>"text");
				
		$up_paratheme_input_fields_icon = array("facebook"=>"facebook","twitter"=>"twitter","google-plus"=>"google-plus","pinterest"=>"pinterest","linkedin"=>"linkedin","gender"=>"user","first_name"=>"pencil","last_name"=>"pencil","profile_img"=>"image","profile_cover"=>"image","country"=>"map-marker");
			

		$up_paratheme_input_fields_tooltip = array(
			"facebook"=>"Input field for Facebook",
			"twitter"=>"Input field for Twitter",
			"google-plus"=>"Input field for Google Plus",
			"pinterest"=>"Input field for  Pinterest",
			"linkedin"=>"Input field for linkedin",
			"gender"=>"Input field for Gender",
			"first_name"=>"Input field for First Name",
			"last_name"=>"Input field for Last Name",
			"profile_img"=>"Input field for Profile Image",
			"profile_cover"=>"Input field for Profile Cover",
			"country"=>"Input field for Country");
		
		
		
		update_option('up_paratheme_input_fields_meta', $up_paratheme_input_fields_meta);
		update_option('up_paratheme_input_fields_icon', $up_paratheme_input_fields_icon);
		update_option('up_paratheme_input_fields_lable', $up_paratheme_input_fields_lable);
		update_option('up_paratheme_input_fields_type', $up_paratheme_input_fields_type);
		update_option('up_paratheme_input_fields_tooltip', $up_paratheme_input_fields_tooltip);
		
	
		
		die();
	}

add_action('wp_ajax_up_paratheme_reset', 'up_paratheme_reset');
add_action('wp_ajax_nopriv_up_paratheme_reset', 'up_paratheme_reset');



function up_paratheme_delete_field()
	{

		$meta = $_POST["meta"];
		
		$up_paratheme_input_fields_meta = get_option( 'up_paratheme_input_fields_meta' );
		$up_paratheme_input_fields_icon = get_option( 'up_paratheme_input_fields_icon' );
		$up_paratheme_input_fields_lable = get_option( 'up_paratheme_input_fields_lable' );
		$up_paratheme_input_fields_type = get_option( 'up_paratheme_input_fields_type' );
		$up_paratheme_input_fields_tooltip = get_option( 'up_paratheme_input_fields_tooltip' );


		unset($up_paratheme_input_fields_meta[$meta]);
		unset($up_paratheme_input_fields_icon[$meta]);
		unset($up_paratheme_input_fields_lable[$meta]);
		unset($up_paratheme_input_fields_type[$meta]);
		unset($up_paratheme_input_fields_tooltip[$meta]);
		
		
		update_option('up_paratheme_input_fields_meta', $up_paratheme_input_fields_meta);
		update_option('up_paratheme_input_fields_icon', $up_paratheme_input_fields_icon);
		update_option('up_paratheme_input_fields_lable', $up_paratheme_input_fields_lable);
		update_option('up_paratheme_input_fields_type', $up_paratheme_input_fields_type);
		update_option('up_paratheme_input_fields_tooltip', $up_paratheme_input_fields_tooltip);
		

		
		die();
	}

add_action('wp_ajax_up_paratheme_delete_field', 'up_paratheme_delete_field');
add_action('wp_ajax_nopriv_up_paratheme_delete_field', 'up_paratheme_delete_field');




add_action( 'show_user_profile', 'up_paratheme_extra_fields' );
add_action( 'edit_user_profile', 'up_paratheme_extra_fields' );

function up_paratheme_extra_fields( $user )
{
    ?>
        <h3>Extra Profile Fields</h3>

        <table class="form-table">
        
       
		<?php
		
		$up_paratheme_input_fields_meta = get_option( 'up_paratheme_input_fields_meta' );
		$up_paratheme_input_fields_lable = get_option( 'up_paratheme_input_fields_lable' );		
		$up_paratheme_input_fields_type = get_option( 'up_paratheme_input_fields_type' );
		$up_paratheme_input_fields_tooltip = get_option( 'up_paratheme_input_fields_tooltip' );		
		
		
		
            foreach ($up_paratheme_input_fields_meta as $value) {
                if(!empty($value))
                    {
                        ?>
                    <tr>                    
                	<th><label for="<?php echo $value; ?>"><?php echo $up_paratheme_input_fields_lable[$value]; ?></label></th>
                	<td>
                    <?php
                    	
						if($up_paratheme_input_fields_type[$value]== 'textarea')
							{
							?>
                            <textarea cols="30" rows="5" name="<?php echo $value; ?>" ><?php echo esc_attr(get_the_author_meta( $value, $user->ID )); ?></textarea>
                            <?php
							
							}
						else if($up_paratheme_input_fields_type[$value]== 'file')
							{
							?>
                            <input required type="text" size='40' id="upload_image<?php echo $value; ?>" name="<?php echo $value; ?>" value="<?php echo esc_attr(get_the_author_meta( $value, $user->ID )); ?>" />
                            <input id="upload_image_button<?php echo $value; ?>" class="up_paratheme_upload_button button" type="button" value="Upload Image" />
                            
                            
                            <script>
								jQuery(document).ready(function($){
	
									var custom_uploader; 
								 
									jQuery('#upload_image_button<?php echo $value; ?>').click(function(e) {
	
										e.preventDefault();
								 
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: 'Choose Image',
											button: {
												text: 'Choose Image'
											},
											multiple: false
										});
								
										//When a file is selected, grab the URL and set it as the text field's value
										custom_uploader.on('select', function() {
											attachment = custom_uploader.state().get('selection').first().toJSON();
											jQuery('#upload_image<?php echo $value; ?>').val(attachment.url);
										});
								 
										//Open the uploader dialog
										custom_uploader.open();
								 
									});
									
									
								})
							</script>
                            

							
							
							
							
							
							
							
							<?php
							
							}							
							
							
						else
							{
							?>
                            <input type="text" name="<?php echo $value; ?>" value="<?php echo esc_attr(get_the_author_meta( $value, $user->ID )); ?>" class="regular-text" />
                            <?php
							
							}
					
					?>


                    </td>
                    </tr>
                        <?php
                    
                    }
        
              
              
            }
        
        ?>
        


        </table>
    <?php
}




add_action( 'personal_options_update', 'save_up_paratheme_extra_fields' );
add_action( 'edit_user_profile_update', 'save_up_paratheme_extra_fields' );

function save_up_paratheme_extra_fields( $user_id )
{
	update_user_meta( $user_id, 'title', sanitize_text_field( $_POST['title'] ) );
	
	$up_paratheme_input_fields_meta = get_option( 'up_paratheme_input_fields_meta' );
		
	foreach ($up_paratheme_input_fields_meta as $value) {
		if(!empty($value))
			{
				update_user_meta( $user_id,$value, sanitize_text_field( $_POST[$value] ) );
			
			}
		}
	

}

























function up_paratheme_dark_color($input_color)
	{
		if(empty($input_color))
			{
				return "";
			}
		else
			{
				$input = $input_color;
			  
				$col = Array(
					hexdec(substr($input,1,2)),
					hexdec(substr($input,3,2)),
					hexdec(substr($input,5,2))
				);
				$darker = Array(
					$col[0]/2,
					$col[1]/2,
					$col[2]/2
				);
		
				return "#".sprintf("%02X%02X%02X", $darker[0], $darker[1], $darker[2]);
			}

		
		
	}
	
	
	

	