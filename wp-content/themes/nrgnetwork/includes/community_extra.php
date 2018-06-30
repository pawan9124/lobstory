<?php
class NRGnetwork_Community_Extra{
	function __construct(){
		add_filter('friends_notification_new_request_message', array($this, 'fb_notification_new_request_message'), 110, 2);
		add_filter('messages_notification_new_message_message', array($this, 'msg_notification_new_message_message'), 10, 7);
		add_action( 'admin_init', array($this, 'shared_uploads'));
		add_action( 'init', array($this, 'shared_uploads'));
		add_filter( 'authenticate', array($this, 'check_custom_authentication'), 30, 3);
		add_action('wp_head', array($this, 'print_open_graph_tags'));
	}

	public function shared_uploads(){
		$subscriber = get_role( 'subscriber' );
	    $subscriber->add_cap( 'upload_files' );
	}

	public function fb_notification_new_request_message($message = '', $initiator_name = '', $initiator_link = '', $all_requests_link = '', $settings_link = ''){
		$message  = sprintf( __('%1$s started following you on %2$s', 'nrgnetwork' ), $initiator_name, esc_url(home_url('/')) );
		return $message;
	}

	public function msg_notification_new_message_message($email_content = '', $sender_name = '', $subject = '', $content = '', $message_link = '', $settings_link = '', $ud = ''){
		$email_content = sprintf( __(
			'%1$s sent you a new message:

			Subject: %2$s

			"%3$s"
			', 'nrgnetwork' ), $sender_name, $subject, $content );
		return $email_content;
	}

	public function bulk_quick_edit_custom_box( $column_name, $post_type ){
		if( $post_type=='portfolio' && $column_name=='featured' ){
		?>
			<fieldset class="inline-edit-col-right inline-edit-featured">
				<div class="inline-edit-col column-<?php print wp_kses_post( $column_name ); ?>">
					<label class="inline-edit-group">
						<span class="title">Featured</span>
						<input type="checkbox" name="featured" />
					</label>
				</div>
			</fieldset>
		<?php
		}
	}

	public function portfolio_edit_columns($columns) {
        $columns = array(
            "cb"        => "<input type=\"checkbox\" />",
            "thumbnail column-comments" => "Image",
            "title"     => esc_html__("Portfolio Title", 'nrgnetwork'),
            "category"  => esc_html__("Categories", 'nrgnetwork'),
            "date"      => esc_html__("Date", 'nrgnetwork'),
        );
        return $columns;
    }

    // public function check_custom_authentication( $username ){
    public function check_custom_authentication( $user, $username, $password ){
    	global $wpdb;
     	if ( !username_exists( $username ) ) {
        	return;
	    }
        $userinfo = get_user_by( 'login', $username );
        $network_user_activation = NRGnetwork_Std::get_mod('network_user_activation');
        if( $network_user_activation=='email_activation' ){
        	$user_id = $userinfo->ID;
        	$user_activation = get_user_meta($user_id, 'user_activation', true);
        	if( $user_activation=='pending' ){
		        $user  = new WP_Error('authentication_failed', __('<strong>ERROR</strong>: User not activated. Please check your email.', 'nrgnetwork'));
        	}
        }
    	return $user;
    }

    public function print_open_graph_tags(){
    	global $post;
    	if( is_singular('post') || is_singular('portfolio') || is_singular('product') ){
    		print '<meta property="og:title" content="'.get_the_title().'" />';
		  	print '<meta property="og:type" content="article" />';
		  	print '<meta property="og:url" content="'.get_permalink().'" />';
		  	$img = wp_get_attachment_url( get_post_thumbnail_id( get_the_id() ), 'nrgnetwork-folio-grid' );
            if( !empty($img) ){
                print '<meta property="og:image" content="'.esc_attr($img).'" />';
            }
		  	print '<meta property="og:description" content="'.esc_attr( wp_trim_words( wp_strip_all_tags(do_shortcode($post->post_content)), 20 ) ).'" />';
    	}
    }
}
new NRGnetwork_Community_Extra();