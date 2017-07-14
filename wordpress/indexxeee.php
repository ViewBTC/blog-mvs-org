<?php get_header();?>
<div id="page-content">
	<div class="container">
		<?php if(is_home()&&!is_paged()){ ?>
			<div class="top-content">
				<?php if( suxingme('suxingme_slide',true) ) { 
				include( 'includes/topslide.php' );}?>
				<?php if( suxingme('suxing_cat_index_on') ) { ?>	
					<div class="cat">
						<ul>
							<?php 
								$categories=explode(",",suxingme('suxing_cat_index'));
								foreach ($categories as $cat=>$catid ) { ?>
								<li>
								<div class="index-cat-box" style="background-image:url(<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($catid); ?>)">
									<a href="<?php echo get_category_link($catid);?>"></a>
									<div class="promo-overlay"><h4><span><?php $cat = get_category($catid);echo $cat->name; ?></span></h4></div>
								</div>
								</li>
							<?php }?>
						</ul>
					</div>
			
			<?php } ?>
			</div>
		<?php } ?>
		<?php if(suxingme('suxingme_new_post',true)) { ?>
			<div class="posts">	
				<div class="posts-box">
				<?php
					$args = array(
					'ignore_sticky_posts'=> 1,
					'paged' => $paged
						);
					if( suxingme('notinhome') ){
						$pool = array();
						foreach (suxingme('notinhome') as $key => $value) {
							if( $value ) $pool[] = $key;
						}
						$args['cat'] = '-'.implode($pool, ',-');
					}		
					query_posts($args);if ( have_posts() ) : ?>
						<div class="ajax-load-box posts-con">
							<?php while ( have_posts() ) : the_post(); 
								include( 'includes/excerpt.php' );endwhile; ?>
						</div>
						<div class="clearfix"></div>
						<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
							<div id="ajax-load-posts">
								<?php echo fa_load_postlist_button();?>
							</div>
							
							<?php  }else {
								the_posts_pagination( array(
									'prev_text'=>'上页',
									'next_text'=>'下页',
									'screen_reader_text' =>'',
									'mid_size' => 1,
								) ); } ?>
							<?php 	else :
							get_template_part( 'content', 'none' );

					endif;?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		<?php } ?>
	</div>
</div>
<?php get_footer(); ?>