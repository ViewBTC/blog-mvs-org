<?php

require (TEMPLATEPATH. '/includes/pagemetabox.php');
function myScripts() {  
    $roll = '';
    if( is_home() && suxingme('sideroll_index_s') ){
        $roll = suxingme('sideroll_index');
    }else if( (is_category() || is_tag() || is_search()) && suxingme('sideroll_list_s') ){
        $roll = suxingme('sideroll_list');
    }else if( is_single() && suxingme('sideroll_post_s') ){
        $roll = suxingme('sideroll_post');
    }else if( is_page() && suxingme('sideroll_page_s') ){
        $roll = suxingme('sideroll_page');
    }

    wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '' ); 
    wp_register_script( 'suxingme', get_template_directory_uri() . '/js/suxingme.js', array('jquery'), '' ); 
    wp_localize_script( 'suxingme', 'suxingme_url', array("url_ajax"=>admin_url("admin-ajax.php"),"url_theme"=>get_template_directory_uri(),"roll"=>$roll,"headfixed"=>(suxingme("suxingme_head_fixed") ? suxingme("suxingme_head_fixed") :"0") ) ); 
    wp_register_script( 'owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '' );  
    wp_register_script('fastclick', get_template_directory_uri() . '/js/fastclick.min.js', array('jquery'), '' ); 
    wp_register_script('comments', get_template_directory_uri() . '/ajax-comment/ajax-comment.js', array('jquery'), '' ); 
    wp_register_script('baidushare', get_template_directory_uri() . '/js/baidushare.js', array('jquery'), '' ); 
    wp_register_script('fancybox', get_template_directory_uri() . '/js/fancybox.js', array('jquery'), '' ); 
    wp_register_script('lazyload', get_template_directory_uri() . '/js/jquery.lazyload.min.js', array('jquery'), '' );

    if ( !is_admin() ) {
        wp_enqueue_script( 'jquery'); 
        wp_enqueue_script( 'bootstrap',false,array(),'',true ); 
        wp_enqueue_script( 'suxingme',false,array(),'',true  );
        wp_enqueue_script( 'fastclick' ,false,array(),'',true );
        if( suxingme('suxingme_lazy') or suxingme('suxingme_timthumb_lazyload') ) {         
            wp_enqueue_script( 'lazyload' ,false,array(),'',true );
        }
    }
    if ( !is_admin() && is_home() && suxingme('suxingme_slide',true)){ 
        wp_enqueue_script( 'owl',false,array(),'',true  );
    }
    if ( !is_admin() && is_singular() ){ 
        wp_enqueue_script( 'comments',false,array(),'',true  );
    }
    if ( !is_admin() && is_single() ){ 
        wp_enqueue_script( 'baidushare',false,array(),'',true  );
    }
    if ( !is_admin() && is_singular() && suxingme('suxingme_fancybox',true) ) { 
        wp_enqueue_script( 'fancybox',false,array(),'',true  );
    }  
}  

add_action( 'wp_enqueue_scripts', 'myScripts' );


add_action( 'wp_enqueue_scripts', 'load_fontawesome_styles' );
function load_fontawesome_styles(){
    global $wp_styles;
    // Theme stylesheet.
    wp_enqueue_style( 'Grace-style', get_stylesheet_uri() );
    wp_enqueue_style( 'fontello', get_template_directory_uri() . '/includes/font-awesome/css/fontello.css' );
    wp_enqueue_style( 'animation', get_template_directory_uri() . '/includes/font-awesome/css/animation.css' );
    wp_enqueue_style( 'fontello-ie7', get_template_directory_uri() . '/includes/font-awesome/css/fontello-ie7.css' );
    $wp_styles->add_data( 'fontello-ie7', 'conditional', 'lte IE 7' );

    if( is_home()&&suxingme( 'suxingme_slide', true ) ){
        wp_enqueue_style( 'carousel', get_template_directory_uri() . '/includes/css/owl.carousel.css' );
        wp_enqueue_style( 'carousel-theme', get_template_directory_uri() . '/includes/css/owl.theme.css' );
    }
    wp_enqueue_script( 'Grace-html5', get_template_directory_uri() . '/js/html5shiv.js', array(), '3.25.0' );
    wp_enqueue_script( 'Grace-respond', get_template_directory_uri() . '/js/respond.min.js', array(), '3.25.0' );
    wp_script_add_data( 'Grace-html5', 'conditional', 'lt IE 9' );
    wp_script_add_data( 'Grace-respond', 'conditional', 'lt IE 9' );
}

function remove_script_version( $src ){
  return remove_query_arg( 'ver', $src );
}
add_filter( 'script_loader_src', 'remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'remove_script_version', 15, 1 );

add_action('wp_head', 'suxing_wp_head');
function suxing_wp_head() { 
    if( suxingme('headcode') ) echo "<!--ADD_CODE_HEADER_START-->\n".suxingme('headcode')."\n<!--ADD_CODE_HEADER_END-->\n";
}

add_action('wp_footer', 'suxing_wp_footer');
function suxing_wp_footer() { 
    if( suxingme('footcode') ) echo "<!--ADD_CODE_FOOTER_START-->\n".suxingme('footcode')."\n<!--ADD_CODE_FOOTER_END-->\n";
    if ( is_singular() && suxingme('suxingme_fancybox',true) ) {
    echo'<script type="text/javascript">jQuery(document).ready(function($) {$(".fancybox").fancybox()});</script>';
    }
}

// 屏蔽WordPress默认小工具
add_action( 'widgets_init', 'my_unregister_widgets' );   
function my_unregister_widgets() {   
 
    unregister_widget( 'WP_Widget_Archives' );   
    unregister_widget( 'WP_Widget_Calendar' );   
    unregister_widget( 'WP_Widget_Categories' );   
    unregister_widget( 'WP_Widget_Links' );   
    unregister_widget( 'WP_Widget_Meta' );   
    unregister_widget( 'WP_Widget_Pages' );   
    unregister_widget( 'WP_Widget_Recent_Comments' );   
    unregister_widget( 'WP_Widget_Recent_Posts' );   
    unregister_widget( 'WP_Widget_RSS' );   
    unregister_widget( 'WP_Widget_Search' );   
    unregister_widget( 'WP_Widget_Tag_Cloud' );   
    unregister_widget( 'WP_Nav_Menu_Widget' );   
	
}

//自动修改Wordpress文章、评论、缩略图片的IMG属性
function add_image_placeholders( $content ) {
    // Don't lazyload for feeds, previews, mobile
    if( is_feed() || is_preview() || ( function_exists( 'is_mobile' ) && is_mobile() ) )
        return $content;
    // Don't lazy-load if the content has already been run through previously
    if ( false !== strpos( $content, 'data-original' ) )
        return $content;
    // In case you want to change the placeholder image
    $placeholder_image = apply_filters( 'lazyload_images_placeholder_image', get_template_directory_uri() . '/img/lazy.png' );
    // This is a pretty simple regex, but it works
    $content = preg_replace( '#<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>#', sprintf( '<img${1}src="%s" data-original="${2}"${3}><noscript><img${1}src="${2}"${3}></noscript>', $placeholder_image ), $content );
    return $content;
}

/** 修改网站标题连接符 **/
function page_sign(){
    if(suxingme('page_sign')){
        $sign .= ' ';
        $sign .=  suxingme('page_sign');
        $sign .= ' ';
    }else{
       $sign =  ' - ';
    }
    return $sign;
}

/* 评论作者链接新窗口打开 */
function specs_comment_author_link() {
    $url    = get_comment_author_url();
    $author = get_comment_author();
    if ( empty( $url ) || 'http://' == $url )
        return $author;
    else
        return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
}
add_filter('get_comment_author_link', 'specs_comment_author_link');


/**
 * 禁用：移除 WordPress 4.2 中前台自动加载的 emoji 脚本
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
 
/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}


//自定义登录页面风格（图片轮换背景）
function uazoh_custom_login_page_imgbackground() {
echo '  <script type="text/javascript" src="/wp-includes/js/jquery/jquery.js?ver=1.11.1"></script>
            <script src="'.get_bloginfo('template_directory').'/js/jquery.backstretch.min.js"></script>
<script>
jQuery(function(){
var imgsrc = "'.get_bloginfo('template_directory').'/img/login_page_bg";
var listArr = [imgsrc+"/1.jpg",imgsrc+"/2.jpg",imgsrc+"/3.jpg",imgsrc+"/4.jpg"];
jQuery(\'.login\').backstretch(listArr, {fade: 1000,duration: 5000});});</script>';
}
add_action('login_head', 'uazoh_custom_login_page_imgbackground');

//自定义登录页面风格
function uazoh_custom_login_page() {
echo'<style type="text/css">
body { background: none; }
#login {width: 320px;margin: auto;background: #FFF;margin-top: 8%;padding: 20px;border-radius: 3px;box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.2);}
.login form {margin-top: 0;margin-left: 0;padding:6px 24px 10px;-webkit-box-shadow:none;box-shadow:none;}
.login form .forgetmenot{float:none}
.login .button-primary{float:none;background-color: #494949;font-weight: bold;color: #fff;width: 100%;height: 40px;border-width: 0;border-color:none}
#login form p.submit{padding: 20px 0 0;}
.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover{background:#1F1F1F}
.wp-core-ui .button.button-large{height:40px;line-height:38px;font-size:16px;}
input{outline:none!important}
</style>';
}
add_action('login_head', 'uazoh_custom_login_page');

//修复 WordPress 找回密码提示“抱歉，该key似乎无效”

function reset_password_message( $message, $key ) {
 if ( strpos($_POST['user_login'], '@') ) {
 $user_data = get_user_by('email', trim($_POST['user_login']));
 } else {
 $login = trim($_POST['user_login']);
 $user_data = get_user_by('login', $login);
 }
 $user_login = $user_data->user_login;
 $msg = __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
 $msg .= network_site_url() . "\r\n\r\n";
 $msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
 $msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
 $msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
 $msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
 return $msg;
}
add_filter('retrieve_password_message', 'reset_password_message', null, 2);

/**
 * Display tags width hot tag.
 *WordPress 标签云 – 带热门标签
 * @since Pure 1.0
 */
function get_hot_tag_list( $num = null , $hot = null , $offset = null){
    $num = $num ? $num : 14;
    $hot = $hot ? $hot : 5;
    $offset = $offset ? $offset : 0;
    
    $output = '<div class="tag-items">';
    $tags = get_tags(array("number" => $num,
        "order" => "DESC",
        "offset"=>$offset,
    ));
    foreach($tags as $tag){
        $count = intval( $tag->count );
        $name = apply_filters( 'the_title', $tag->name );
        $class = ( $count > $hot ) ? 'tag-item hot' : 'tag-item';
        $output .= '<a href="'. esc_attr( get_tag_link( $tag->term_id ) ) .'" class="'. $class .'" title="浏览和' . $name . '有关的文章"><span>' . $name . '</span></a>';

    }
    $output .= '</div>';
    return $output;

}

//留言墙
function readers_wall( $outer='1', $timer='100', $limit='200' ){
    global $wpdb;
    $items = $wpdb->get_results("select count(comment_author) as cnt, comment_author, comment_author_url, comment_author_email from (select * from $wpdb->comments left outer join $wpdb->posts on ($wpdb->posts.id=$wpdb->comments.comment_post_id) where comment_date > date_sub( now(), interval $timer month ) and user_id='0' and comment_author != '".$outer."' and post_password='' and comment_approved='1' and comment_type='') as tempcmt group by comment_author order by cnt desc limit $limit");
    $htmls = '';
    foreach ($items as $item) {
        $c_url = $item->comment_author_url;
        if (!$c_url) $c_url = 'javascript:;';
        // print_r($item);
        $htmls .= '<a target="_blank" href="'. $c_url . '" title="'.$item->comment_author.' 评论'. $item->cnt . '次">'.suxing_avatar('', $item->comment_author_email).'</a>';
    }
    echo $htmls;
}

//友情链接
function get_the_link_items($id = null){
    $bookmarks = get_bookmarks('orderby=date&category=' .$id );
    $output = '';
    if ( !empty($bookmarks) ) {
        $output .= '<ul class="link-items fontSmooth">';
        foreach ($bookmarks as $bookmark) 
        {
            $output .=  '<li class="link-item"><a class="link-item-inner effect-apollo" href="' . $bookmark->link_url . '" title="' . $bookmark->link_description . '" target="_blank" rel="' . $bookmark->link_rel . '" >';
            
            if(($bookmark->link_notes)){
                $output .= get_avatar($bookmark->link_notes,64);
            }else if($bookmark->link_image){
                
                $output .= '<img alt="' . $bookmark->link_description . '" src="'. $bookmark->link_image .'" title="' . $bookmark->link_description . '">';
                
            }
            else{
                
                $output .= '<img alt="' . $bookmark->link_description . '" src="'.get_bloginfo('template_url').'/img/avatar.png" title="' . $bookmark->link_description . '">';
                
            }
            
            $output .= '<span class="sitename">'. $bookmark->link_name .'</span></a></li>';
        }
        $output .= '</ul><div class="clearfix"></div>';
    }
    return $output;
}

function get_link_items(){
    $linkcats = get_terms( 'link_category' );
    if ( !empty($linkcats) ) {
        foreach( $linkcats as $linkcat){ 
                if( $linkcat->description ) $linkdes .= '- <span class="link-description">' . $linkcat->description . '</span>';           
            $result .=  '<div class="link-title"><span>'.$linkcat->name.'</span>'.$linkdes.'</div>';
           
            $result .=  get_the_link_items($linkcat->term_id);
        }
    } else {
        $result = get_the_link_items();
    }
    return $result;
}

function shortcode_link(){
    return get_link_items();
}
add_shortcode('bigfalink', 'shortcode_link');

function links_banner_pic(){
    if(suxingme('links_banner_pic')){
        $links_banner_pic = suxingme('links_banner_pic');
    }else{
        $links_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $links_banner_pic;   
}

function pagenav_banner_pic(){
    if(suxingme('pagenav_banner_pic')){
        $pagenav_banner_pic = suxingme('pagenav_banner_pic');
    }else{
        $pagenav_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $pagenav_banner_pic;   
}


function tags_banner_pic(){
    if(suxingme('tags_banner_pic')){
        $tags_banner_pic = suxingme('tags_banner_pic');
    }else{

        $tags_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $tags_banner_pic;   
}

function readers_banner_pic(){
    if(suxingme('readers_banner_pic')){
        $readers_banner_pic = suxingme('readers_banner_pic');
    }else{

        $readers_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $readers_banner_pic;   
}

function archives_banner_pic(){
    if(suxingme('archives_banner_pic')){
        $archives_banner_pic = suxingme('archives_banner_pic');
    }else{

        $archives_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $archives_banner_pic;   
}

function like_banner_pic(){
    if(suxingme('like_banner_pic')){
        $like_banner_pic = suxingme('like_banner_pic');
    }else{

        $like_banner_pic = get_template_directory_uri().'/img/page_bg.jpg';
    }
    return $like_banner_pic;   
}

function single_pc_ad_pic(){
	$ad_content_pc = suxingme('suxing_ad_content_pc_url');
    if( suxingme('suxing_ad_content_pc',true)){ 
    	$single_ad_pc='<div class="posts-cjtz content-cjtz clearfix">'.$ad_content_pc.'</div>';
    }else{ 	
    	$single_ad_pc='';	
    }
    return $single_ad_pc; 
}
function single_mini_ad_pic(){
    $ad_content_pc = suxingme('suxing_ad_content_mini_url');
    if( suxingme('suxing_ad_content_mini',true)){ 
        $single_ad_pc='<div class="posts-cjtz content-cjtz-mini clearfix">'.$ad_content_pc.'</div>';
    }else{  
        $single_ad_pc='';   
    }
    return $single_ad_pc; 
}
				
//自动给修改网站登陆页面logo
function customize_login_logo(){      
    if( suxingme('suxingme_login_logo') ) {
        echo '<style type="text/css">
       .login h1 a { background-image:url('.suxingme('suxingme_login_logo') .');background-size: 120px;width: 120px;height: 120px;margin: 20px auto 15px; }
        </style>';      
    }else{
    echo '<style type="text/css">
        .login h1 a { background-image:url('.get_template_directory_uri() .'/img/logo.png); width: 280px; max-height: 100px;margin: 20px auto 15px; background-size: contain;background-repeat: no-repeat;background-position: center center;}
        </style>';   
    }    
}      
add_action('login_head', 'customize_login_logo');   
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));

add_action('optionsframework_after','show_category', 100);
function show_category() {
    global $wpdb;
    $request = "SELECT $wpdb->terms.term_id, name FROM $wpdb->terms ";
    $request .= " LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id ";
    $request .= " WHERE $wpdb->term_taxonomy.taxonomy = 'category' ";
    $request .= " ORDER BY term_id asc";
    $categorys = $wpdb->get_results($request);
    echo '<div class="uk-panel uk-panel-box" style="margin-bottom: 20px;"><h3 style="margin-top: 0; margin-bottom: 15px; font-size: 18px; line-height: 24px; font-weight: 400; text-transform: none; color: #666;">可能会用到的分类ID</h3>';
    echo "<ul>";
    foreach ($categorys as $category) { 
        echo  '<li style="margin-right: 10px;float:left;">'.$category->name."（<code>".$category->term_id.'</code>）</li>';
    }
    echo "</ul></div>";
}

function suxingme_get_thumbnail() {  
    global $post;
    $html = '';

    $content = $post->post_content;  
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);  
    $images = $strResult[1];

    $counter = count($strResult[1]);

    if( !$counter ){
        return '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>
                <li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>
                <li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>';
    }
    $full_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    $ts_thum = $full_image_url[0];
    if($ts_thum){
        $num = 2;
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.$ts_thum.'&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>';
    }
    else{
        $num = 3;
    }

    $i = 0;
    foreach($images as $key=>$src){
        $i++;
        $src2 = wp_get_attachment_image_src(suxingme_get_attachment_id_from_src($src), 'full');
        $src2 = $src2[0];
        if( !$src2 && true ){
            $src = $src;
        }else{
            $src = $src2;
        }
        $item = '<img src="'.get_template_directory_uri().'/timthumb.php?src='.$src.'&h=160&w=250&zc=1" alt="'.get_the_title().'">';
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            '.$item.'
                        </a>
                    </div>
                </li>';
        if( $counter >= $num && $i >= $num )
        {
            break; 
        }
    }

    if(count($images) < 3 && $ts_thum ){
        $j = 3 - count($images) - 1;
        for ($k=0; $k < $j ; $k++) { 
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.get_template_directory_uri().'/img/default_thumb.png&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
             </li>';
        }
    }
    if(count($images) < 3 && !$ts_thum ){
        $j = 3 - count($images);
         for ($k=0; $k < $j ; $k++) { 
        $html .= '<li>
                    <div class="image-item">
                        <a href="'.get_permalink(get_the_ID()).'">
                            <div class="overlay"></div>
                            <img src="'.get_template_directory_uri().'/timthumb.php?src='.get_template_directory_uri().'/img/default_thumb.png&h=160&w=250&zc=1" alt="'.get_the_title().'">
                        </a>
                    </div>
                </li>';
        }
    }

    

    return $html;
}
function suxingme_get_attachment_id_from_src ($link) {
    global $wpdb;
    $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);
    return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE guid='$link'");
}
