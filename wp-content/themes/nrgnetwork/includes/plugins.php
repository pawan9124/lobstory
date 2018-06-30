<?php
	require_once NRGnetwork_Std::file_require( get_template_directory().'/framework/classes/class.tgm.plugin.activation.php');
	add_action( 'tgmpa_register', 'nrgnetwork_register_required_plugins' );
	function nrgnetwork_register_required_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugin_url='http://demo.nrgthemes.com/projects/nrgnetworkwp/plugins';
		$plugins = array(
			array(
				'name'     			 => 'Envato Toolkit',
				'slug'     			 => 'envato-wordpress-toolkit',
				'source'   			 => $plugin_url.'/envato-wordpress-toolkit.zip',
				'required' 			 => true,
				'version' 			 => '1.7.3',
				'force_activation' 	 => false,
				'force_deactivation' => false,
				'external_url' 		 => '',
			),
            array(
                'name'             => 'BuddyPress',
                'slug'             => 'buddypress',
                'required'         => true,
                'force_activation' => false,
            ),
            array(
                'name'               => 'Visual Composer',
                'slug'               => 'js_composer',
                'source'             => $plugin_url.'/js_composer.zip',
                'required'           => true,
                'version'            => '4.12',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'               => 'Revolution Slider',
                'slug'               => 'revslider',
                'source'             => $plugin_url.'/revslider.zip',
                'required'           => false,
                'version'            => '5.2.5.4',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'               => 'Plugin for NRGnetwork Themes',
                'slug'               => 'nrgnetwork',
                'source'             => $plugin_url.'/nrgnetwork-plugin.zip',
                'required'           => true,
                'version'            => '1.3',
                'force_activation'   => false,
                'force_deactivation' => false,
                'external_url'       => '',
            ),
            array(
                'name'     => 'WooCommerce',
                'slug'     => 'woocommerce',
                'required' => false,
            ),
            array(
                'name'     => 'Contact Form 7',
                'slug'     => 'contact-form-7',
                'required' => false,
            ),
			array(
				'name'     => 'MailChimp for WordPress',
				'slug'     => 'mailchimp-for-wp',
				'required' => false,
			),

		);
	$config = array(
        'id'           => 'nrgnetwork_tgm',
        'default_path' => '',
        'menu'         => 'install-required-plugins',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
        'strings'      => array(
            'page_title'                      => esc_html__('Install Required Plugins', 'nrgnetwork'),
            'menu_title'                      => esc_html__('Install Plugins', 'nrgnetwork'),
            'installing'                      => esc_html__('Installing Plugin: %s', 'nrgnetwork'),
            'oops'                            => esc_html__('Something went wrong with the plugin API.', 'nrgnetwork'),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'nrgnetwork' ),
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'nrgnetwork' ),
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'nrgnetwork' ),
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'nrgnetwork' ),
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'nrgnetwork' ),
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'nrgnetwork' ),
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'nrgnetwork' ),
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'nrgnetwork' ),
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'nrgnetwork' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'nrgnetwork' ),
            'return'                          => esc_html__('Return to Required Plugins Installer', 'nrgnetwork'),
            'plugin_activated'                => esc_html__('Plugin activated successfully.', 'nrgnetwork'),
            'complete'                        => esc_html__('All plugins installed and activated successfully. %s', 'nrgnetwork'),
            'nag_type'                        => 'updated'
        )
    );
    tgmpa( $plugins, $config );
}