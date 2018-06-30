<?php
class NRGnetwork_VC_Templates{
    function __construct(){
        add_filter( 'vc_load_default_templates', array($this, 'custom_template_for_vc') );
    }

    public function custom_template_for_vc($templates){
        return $templates;
    }
}
if( function_exists('vc_map') )
    new NRGnetwork_VC_Templates();