<?php
/*
* 该主题由Xiao伟破解完成。
* Xiao伟博客交流群欢迎您：11931589
* 出售域名授权系统：
* 一口价3680，不还价。
* QQ：403641198
*/
date_default_timezone_set("PRC");
define("THEME_URI", get_stylesheet_directory_uri());
define("OPTIONS_FRAMEWORK_DIRECTORY", get_template_directory_uri() . "/inc/");
require_once TEMPLATEPATH . "/inc/options-framework.php";
add_action("optionsframework_custom_scripts", "optionsframework_custom_scripts");
function optionsframework_custom_scripts()
{
	echo "<script type=\"text/javascript\">\r\njQuery(document).ready(function() {\r\n    if (jQuery('#tab_showhidden:checked').val() !== undefined) {\r\n        jQuery('#section-tabfirst').show();\r\n        jQuery('#section-tabfirsttitle').show();\r\n        jQuery('#section-tabsecond').show();\r\n        jQuery('#section-tabsecondtitle').show();\r\n        jQuery('#section-tabthird').show();\r\n        jQuery('#section-tabthirdtitle').show();\r\n    }\r\n});\r\n</script>";
}
function remove_open_sans()
{
	wp_deregister_style("open-sans");
	wp_register_style("open-sans", false);
	wp_enqueue_style("open-sans", '');
}
add_action("init", "remove_open_sans");
register_nav_menu("top-nav", __("导航菜单", "main"));
register_nav_menu("mobile-nav", __("移动端菜单", "mobile"));
add_filter("nav_menu_css_class", "my_css_attributes_filter", 100, 1);
add_filter("nav_menu_item_id", "my_css_attributes_filter", 100, 1);
add_filter("page_css_class", "my_css_attributes_filter", 100, 1);
function my_css_attributes_filter($_var_11)
{
	return is_array($_var_11) ? array_intersect($_var_11, array("current-menu-item", "current-post-ancestor", "current-menu-ancestor", "current-menu-parent", "menu-item-has-children")) : '';
}
if (function_exists("register_sidebar")) {
	register_sidebar(array("name" => "全站侧栏", "id" => "widget_right", "before_widget" => "<div class=\"widget %2\$s\"><div class=\"widget_box\">", "after_widget" => "</div></div>", "before_title" => "<h3>", "after_title" => "</h3>"));
	register_sidebar(array("name" => "首页侧栏", "id" => "widget_sidebar", "before_widget" => "<div class=\"widget %2\$s\"><div class=\"widget_box\">", "after_widget" => "</div></div>", "before_title" => "<h3>", "after_title" => "</h3>"));
	register_sidebar(array("name" => "文章页侧栏", "id" => "widget_post", "before_widget" => "<div class=\"widget %2\$s\"><div class=\"widget_box\">", "after_widget" => "</div></div>", "before_title" => "<h3>", "after_title" => "</h3>"));
	register_sidebar(array("name" => "页面侧栏", "id" => "widget_page", "before_widget" => "<div class=\"widget %2\$s\"><div class=\"widget_box\">", "after_widget" => "</div></div>", "before_title" => "<h3>", "after_title" => "</h3>"));
	register_sidebar(array("name" => "分类/标签/搜索页侧栏", "id" => "widget_other", "before_widget" => "<div class=\"widget %2\$s\"><div class=\"widget_box\">", "after_widget" => "</div></div>", "before_title" => "<h3>", "after_title" => "</h3>"));
}
include_once TEMPLATEPATH . "/includes/widgets/index.php";
include_once TEMPLATEPATH . "/inc/options-suxing.php";
include_once TEMPLATEPATH . "/functions_suxingme.php";