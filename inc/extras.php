<?php
if ( ! function_exists( 'get_acd_theme_options' ) ) {
    /**
     * Get information from Theme Options and add it into wp_head
     */
    function get_acd_theme_options(){
        echo '<style id="acd-theme-options" type="text/css">';
        echo '/* Defined in ACD theme options of inc/extras.php */ ';
        global $typography_options;
        $typography = of_get_option('heading_typography');

        if ( $typography ) {
            $typo_css = '';

            if(isset($typography_options['faces'][$typography['face']])){
                $typo_css .= 'font-family: '. $typography_options['faces'][$typography['face']] . ';';
            }
            if(isset($typography_options['style'])){
                $typo_css .= '; font-weight: ' . $typography['style'] . ';';
            }
            // . '; font-size:' . $typography['size']
            //   . '; color:'.$typography['color']
            if(!empty($typo_css)){
                echo " h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .entry-title { $typo_css ;} ";
            }
        }

        $header_content_css = '';
        // $page_width = of_get_option('page_width');
        // if ( $page_width ) {
        //     $header_nav_css .= "max-width:{$page_width}px; margin: 0 auto;";
        // }

        $header_content_bg_url = of_get_option('header_background_url');
        if( !empty($header_content_bg_url) ) {
            $header_content_css .= "background-image: url( \"$header_content_bg_url\"); ";
            $header_content_css .= "background-position: bottom; ";
            $header_content_css .= "background-size: cover; ";
        }

        if(!empty($header_content_css)){
            echo " header#masthead { $header_content_css ;} ";
        }

        // $header_nav_menu_css = '';
        // $header_nav_position = of_get_option('header_nav_position');
        // $header_nav_position_str = $typography_options['horizontal-positions'][$header_nav_position];
        // if( !empty($header_nav_position_str)){
        //     $header_nav_menu_css .= " /* position: $header_nav_position_str; */ ";
        //     switch ($header_nav_position_str) {
        //         case 'left':
        //         case 'right':
        //             $header_nav_menu_css .= "float: $header_nav_position_str; ";
        //             break;
        //         case 'center':
        //         default:
        //             $header_nav_menu_css .=
        //                 "float: left; position: relative; left:50%; transform: translate(-50%, 0);";
        //                 // TODO FIX this for better browser compat, something like;
        //                 // "float: none; display: block; margin: auto;";
        //             break;
        //     }
        // }

        // if(!empty($header_nav_menu_css)){
        //     echo " header#masthead nav ul.nav { $header_nav_menu_css ;} ";
        // }


        echo '</style>';
    }

}

if ( ! function_exists( 'acd_header_menu' ) ) :
/**
 * Header menu (should you choose to use one)
 */
function acd_header_menu() {
  // display the WordPress Custom Menu if available
  wp_nav_menu(array(
    'menu'              => 'primary',
    'theme_location'    => 'primary',
    'depth'             => 2,
    'container'         => 'div',
    'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse navbar-left',
    'menu_class'        => 'nav navbar-nav',
    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
    'walker'            => new wp_bootstrap_navwalker()
  ));
} /* end header menu */
endif;


add_action( 'wp_head', 'get_acd_theme_options', 10 );

?>
