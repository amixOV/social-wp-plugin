<?php
/* 
 *Plugin Name: plugin-learn
 * Description:       learn the basics with this plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            elico ovits
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
{Plugin Name} is free software: you can redistribute it and/or modify
*/


if ( ! defined( 'ABSPATH' ) ) {
    die;
}
add_action( 'admin_menu', 'learn_chck_send_post' );
add_action( 'admin_menu', 'learn_options_page' );
add_action( 'admin_enqueue_scripts', 'learn_style_and_script' );
add_action('template_redirect', 'print_to_screen');




//--------------- add a pluging page --------------//
function learn_options_page() {
    add_menu_page(
        ' my learn plugin  ' ,
        'Learn Options',
        'manage_options',
        'learn_option',
        'learn_options_page_html',
        'dashicons-groups', //   https://developer.wordpress.org/resource/dashicons
        //plugin_dir_url(__FILE__) . 'includes/icons/icon_learn.png',
        20
    );

    add_submenu_page(
        'learn_option',
        'Learn Design',
        'Learn Design',
        'manage_options',
        'learn_design',
        'learn_design_page_html'

    );

}

// ------------------add style and script-------------------//
function learn_style_and_script(){
    /*
    $url = '/' . basename(get_site_url()) . '/wp-admin/admin.php?';
    $admin_option_uri = $url . 'page=learn_option';
    $admin_design_uri = $url . 'page=learn_design';
    $this_page_uri = $_SERVER['REQUEST_URI'];
    $admin_design_uri = $url . 'page=learn_design';
    */
    if(isset($_GET['page'])){
        $this_page_name = $_GET['page'];    
        if($this_page_name === 'learn_option' || $this_page_name === 'learn_design'){
    
            $url_css = plugin_dir_url( __FILE__ ) . 'admin/css/plugin-learn.css';
            $url_js = plugin_dir_url( __FILE__ ) . 'admin/js/plugin-learn.js';
            wp_register_style( 'plugin-learn.css', $url_css );
            wp_enqueue_style( 'plugin-learn.css');
            
            wp_enqueue_script( 'js', $url_js );
            
            
            wp_register_style('st_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
            wp_register_script('sc_bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js');
            wp_enqueue_style('st_bootstrap');
            wp_enqueue_script('sc_bootstrap');
            
        }
        wp_enqueue_style( 'Heebo', 'https://fonts.googleapis.com/css?family=Heebo:400,300' , false); 

    }
}



/* ==============================================//

// תיקיות לסדר        -------------------------> DONE
// if(exist name of file)   --------------------> DONE
*  אבטחה
*  אייקונים            -------------------------> DONE
*  css  js  hover עיצוב          ---------------> DONE
*  לפצל לדפים נפרדים   ------------------------> DONE
*  בחירה באיזה דפים להציג את התוסף למשתמש  ---> DONE
*  בחירת גוונים לאדמין
*  בחירת הסדר של הרשתות לאדמין
* ( עוד לשוניות באדמין  ( לשונית לעיצוב  ------> DONE
*   רווחים בשם רשת נבחר עושה שגיאה

//==============================================*/

    function learn_chck_send_post(){
        if(isset($_POST['submit']) && $_POST['submit']){
          // myprint_r($_POST);
            learn_send_post();
            
        }
    }
    function learn_send_post(){
        learn_update_option(); //update all social array
        if($_FILES != ''){
            require_once ("includes/uploadfile.php");
        }

        if(isset($_POST['learn_is_social']) && $_POST['learn_is_social']){
            update_option('learn_is_social', $_POST['learn_is_social']);
        }else{
            update_option('learn_is_social', '');
        }
        

        if(isset($_POST['learn_add_new_social_name']) && $_POST['learn_add_new_social_name']){
            $learn_add_new = $_POST['learn_add_new_social_name'];
            $laern_new_soc_arr = learn_build_array($learn_add_new);
            $learn_soc_array = get_my_learn_soc_array();
            $learn_soc_array[$learn_add_new] =  $laern_new_soc_arr;
            update_option('learn_soc_name_array', $learn_soc_array);
        }

        if(isset($_POST['learn_delete_social_name']) && $_POST['learn_delete_social_name'] ){

            $my_learn_soc_array = get_my_learn_soc_array();
            $learn_name_to_delete = $_POST['learn_delete_social_name'];
            unset($my_learn_soc_array[$learn_name_to_delete]);
            update_option('learn_soc_name_array', $my_learn_soc_array);
            
        }

        if(isset($_POST['learn_what_page']) && $_POST['learn_what_page']){
            $learn_what_page = $_POST['learn_what_page'];
            update_option('learn_what_page', $learn_what_page);
            
        }
        
    }
    require_once ("includes/function.php");

    function learn_options_page_html() {
        require_once ("admin/learn-admin-page.php");
        
    } 
    

    function print_to_screen(){
        require_once ("user/learn-print-to-page.php");
    }

    
    function learn_design_page_html(){
         require_once ("admin/learn_design_page.php");
    }

    function myprint_r($my_array) {
        if (is_array($my_array)) {
            echo "<table border=1 cellspacing=0 cellpadding=3 style='width:50%; margin-right:250px;'>";
            echo '<tr><td colspan=2 style="background-color:#333333;"><strong><font color=white>ARRAY</font></strong></td></tr>';
            foreach ($my_array as $k => $v) {
                    echo '<tr><td valign="top" style="width:40px;background-color:#F0F0F0;">';
                    echo '<strong>' . $k . "</strong></td><td>";
                    myprint_r($v);
                    echo "</td></tr>";
            }
            echo "</table>";
            return;
        }
        echo $my_array;
    }

    

    /* --------------text editor------------/
        
        $content = get_option('amir_edit');
        $editor_id = 'amir_edit';
        wp_editor($content, $editor_id );
        
        ------------------------------------  
        wp_list_pages('show_date' , true);
        print_r (get_pages());
        print_r ( wp_page_menu());
        print_r ( wp_post_());
        
        ------------------------------------

        // --------------- shortCode ----------------//
        function amirs_html($type){
            return '<div> this text come from a shortcode </div>';
        }
        add_shortcode('amirs', 'amirs_html',1);
        echo do_shortcode('[amirs]');
        // -------------- End shortCode --------------//
    
    -------------------------------------*/ 
    
    // ------------------turn on and 4 off from the wp-config.php -------------------------//