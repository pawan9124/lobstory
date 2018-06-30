<!-- Sidebar
================================================== -->
<?php 
$sidebar_id = 'sidebar-activity';
if ( is_active_sidebar( $sidebar_id ) ) :
    dynamic_sidebar($sidebar_id);
endif;