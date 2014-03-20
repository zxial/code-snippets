<?php
/*
 * Plugin Name: WP APP JSON
 * Plugin URI: http://zxial.me/projects/wp_app_json/
 * Description: Provide JSON data to mobile APPs. Here's the scenarios that you could use this plugin: you want to develop a mobile app or app on mac, and the app is to show the list of your blogs(in category, tag, or keywords), after the app user click one item in the blog list, you would like to show him the detail page of the item, but the logos/banners/sidebar of blog is suitable only for a desktop other than a mobile device or you want to do something different. In the case here, WP APP JSON maybe could help.  
 * Version: 1.0.1
 * Author: Zxial
 * Author URI: http://zxial.me/
 * License: GPLv2 or later
 */

define('WP_APPJSON_PLUGIN_URL', plugins_url('', __FILE__));
define('WP_APPJSON_PLUGIN_DIR', WP_PLUGIN_DIR.'/'. dirname(plugin_basename(__FILE__)));
define('WP_APPJSON_PLUGIN_FILE',  __FILE__);

add_action('parse_request', 'wp_app_json_redirect', 4);
function wp_app_json_redirect($wp){
	$secrets = get_option('wp_app_json_secrets',wp_app_json_get_default_option('wp_app_json_secrets'));
    if(isset($_GET[$secrets]) ){
        global $appjsonObj;
        if(!isset($appjsonObj)){
            $appjsonObj = new wp_appjson();
            $appjsonObj->route($secrets);
            exit;
        }
    }
}

class wp_appjson {
    private $keyword= '';
    private $response= '';
    private $paged = 1;

    public function route($secrets){

        if(isset($_GET['debug'])){
            $this->response = 'RESPONSE';                                
             //$this->responseMsg();
        }else{
            if(isset($_GET[$secrets])){
                if (isset($_GET["gl"])) {
                    // Get List 
                    $this->keyword = strtolower(trim($_GET['k']));
                    if(eregi("^[0-9]+$",$_GET['p']))
                        $this->paged = (int)trim($_GET['p']);
                    else
                        $this->paged = 0;
                    //echo $this->keyword;
                    $this->getlist();
                }elseif (isset($_GET["dt"])) {
                    // Get detail page
                    $this->getdetail();
                }
            }
        }
        echo $this->response;
        exit;
    }

    public function getlist(){

        $post_count = get_option('wp_app_json_secrets',wp_app_json_get_default_option('wp_app_json_postcount'));
        $app_query_array = array(
            's' => $this->keyword,
            'posts_per_page' => $post_count , 
            'post_status' => 'publish', 
            'paged' => $this->paged,
            'ignore_sticky_posts' => 1 
        );


        $posts_query = new WP_Query($app_query_array);

        $items = '';

        $counter = 0;

        if($posts_query->have_posts()){
            //$this->response = '{';
            $arr_resp = array('msg' => '1');
            while ($posts_query->have_posts()) {
                $posts_query->the_post();

                global $post;

                $title = get_the_title(); 
                $excerpt = get_post_excerpt($post,150);

                $thumb = $this->get_post_thumb($post, array(80,80));

                $link = get_permalink();

                //$items = $items . $this->get_item($title, $excerpt, $thumb, $link);

                $counter ++;
                array_push($arr_resp, array('ID' => $post->ID,
                    'title' => $title,
                    'excerpt' => $excerpt,
                    'thumb' => $thumb));
                $this->response = json_encode($arr_resp);
            }
        }else{
            $this->response = 'not-found';
        }
    }

    private function getdetail(){
        $pid = 0;
        //echo 'getdetail';
        if(eregi("^[0-9]+$",$_GET['pid'])){
            $pid = (int)$_GET['pid'];
            $dpost = get_post($pid);
        }else{
            $dpost = get_post();
        }
        //echo $pid;
        if($dpost){
            $this->response = '';//start to construct output
	
	// if you want to change the style of detail page, you could rewrite the style css here.
            $this->response .= '<html><head><link rel="stylesheet" id="mobile-css"  href="'.WP_APPJSON_PLUGIN_URL.'/style.css" type="text/css" media="all" /></head><body>';
	//Add custom header.
	$this->response .= get_option('wp_app_json_header',wp_app_json_get_default_option('wp_app_json_header'));
            $this->response .= '<section><h1>'.$dpost->post_title.'</h1></section>';
            $this->response .= '<span class="postdate">'.date_i18n( get_option( 'date_format' ),strtotime($dpost->post_date)). '</span> <span class="postauthor">' .get_userdata($dpost->post_author)->display_name . '</span><br/><hr/>';
            $this->response .= get_option('wp_app_json_banner',wp_app_json_get_default_option('wp_app_json_banner'));
            $pcontent = $dpost->post_content;
            $this->response .= '<section>'.$dpost->post_content.'</section>';
            $this->response .= '<hr/>';
	$this->response .= get_option('wp_app_json_footer',wp_app_json_get_default_option('wp_app_json_footer'));

            $this->response .= '</body></html>';
        }else{
            echo 'error';
        }


    }

    private function get_post_thumb($post,$size){
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        if($thumbnail_id){
            $thumb = wp_get_attachment_image_src($thumbnail_id, $size);
            $thumb = $thumb[0];
        }else{
            $thumb = get_option('wp_app_json_secrets',wp_app_json_get_default_option('wp_app_json_thumburl'));
        }
        return $thumb;
    }
}

add_action('admin_menu', 'wp_app_json_plugin_menu');
add_action( 'admin_init', 'wp_app_json_register_settings' );


function wp_app_json_plugin_menu() {
        add_options_page('WP APP JSON Options', 'WP APP JSON', 'manage_options', 'wp-app-json-options.php', 'wp_app_json_option_page');
}

include(WP_APPJSON_PLUGIN_DIR.'/wp-app-json-options.php');
