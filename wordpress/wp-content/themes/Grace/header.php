<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('includes/modules/seo.php'); ?>
<?php if( suxingme( 'suxingme_favicon', '' ) ) { ?>
	<link rel="shortcut icon" href="<?php echo suxingme( 'suxingme_favicon', '' ); ?>" type="image/x-icon" >
	<?php }else{ ?>
	<link rel="Shortcut Icon" href="<?php bloginfo('template_url');?>/img/favicon.ico" type="image/x-icon" />
<?php }?>
<?php if( is_single() || is_page() ) {
    if( function_exists('get_query_var') ) {
        $cpage = intval(get_query_var('cpage'));
        $commentPage = intval(get_query_var('comment-page'));
    }
    if( !empty($cpage) || !empty($commentPage) ) {
        echo '<meta name="robots" content="noindex, nofollow" />';
        echo "\n";
    }
}
?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, minimal-ui">
<meta http-equiv="X-UA-Compatible"content="IE=9; IE=8; IE=7; IE=EDGE;chrome=1">
<?php wp_head(); ?>
</head>
<body <?php body_class( suxingme_bodyclass() ); ?>>
<div id="header">
	<div class="container">
		<h1 class="logo">
			<a  href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"/>
			<?php if( suxingme('suxingme_logo') ) { ?>
				<img src="<?php echo suxingme('suxingme_logo'); ?>" alt="<?php bloginfo('name'); ?>">
			<?php }else{ ?>
				<img src="<?php bloginfo('template_url');?>/img/logo.png" alt="<?php bloginfo('name'); ?>">
			<?php }?></a>
			
		</h1>
		<div role="navigation"  class="site-nav  primary-menu">
			<div class="menu-fix-box">
				 <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('top-nav') ) { 
					wp_nav_menu(
								array(	
										'theme_location'   => 'top-nav',
										'sort_column'	   => 'menu_order',
										'depth'           => 2,
										'fallback_cb' => 'cmp_nav_fallback',
									
										'container' => false, 
										'menu_id' =>'menu-navigation',
										'menu_class' =>'menu',
									) 
							); 
				?>
				 <?php } else { ?>
					<ul id="menu-navigation" class="menu">
					<li>请到[后台->外观->菜单]中设置菜单。</li>
					</ul><!-- topnav end -->
				<?php } ?>
			</div>
		</div>
		<div class="search-box">
            <form action="<?php bloginfo('wpurl'); ?>">
                <input class="form-search" type="text" name="s" placeholder="Search...">
                <button><i class="icon-search"></i></button>
            </form>            
        </div>
		
		<span class="icon-search m-search"></span>
		<div class="mobile_menu">
            <span class="menu-top"></span>
            <span class="menu-bottom"></span>
        </div>
        <ul class="mobile_nav">
             <?php if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('mobile-nav') ) { 
					wp_nav_menu(
								array(	
										'theme_location'   => 'mobile-nav',
										'depth'           => 2,
										'fallback_cb' => 'cmp_nav_fallback',		
										'container' => false, 
										'items_wrap' => '%3$s',
										'menu_class' =>'menu',
									) 
							); 
			?>
			<?php } else { ?>
				<li><a href="#">请到[后台->外观->菜单]中设置菜单。</a></li>
			<?php } ?>
        </ul>
	</div>	
</div>
<div id="menu-mobile" style="display: none;">
    <div class="inner">
        <a href="#" class="menu-mobile-close"><i class="fa fa-times"></i></a>

			<?php	wp_nav_menu(
								array(	
										'theme_location'   => 'top-nav',
										'sort_column'	   => 'menu_order',
										'depth'           => 2,
										'fallback_cb' => 'cmp_nav_fallback',
									
										'container' => false, 
										'menu_id' =>'mobile-menu',
										'menu_class' =>'menu',
										/*
* 该主题由Xiao伟破解完成。
* Xiao伟博客交流群欢迎您：11931589
* 出售域名授权系统：
* 一口价3680，不还价。
* QQ：403641198
*/
									) 
							); 
				?>		
    </div>
</div>

