<?php get_header(); ?>
<div id="page-content">
	<div class="container">
		<div class="post-box">
			<div class="post">
				<?php if(have_posts()): while(have_posts()):the_post();  ?>
				<div class="post-title">
					<?php the_tags('<div class="post-entry-categories">','','</div>'); ?>
					<h1 class="title"><?php the_title(); ?></h1>
					<div class="post_icon"> 
						<span  class="postcat"><i class=" icon-list-1"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></span>
						<span class="postclock"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></span>
						<span class="posteye"><i class=" icon-eye-3"></i> <?php post_views('',''); ?></span>
						<span class="postcomment"><i class="icon-comment-1"></i> <a href="<?php the_permalink(); ?>" title="评论"><?php comments_popup_link( __( '0' ) , __( '1'), __( '%') ); ?></a></span>
						<?php edit_post_link('[编辑]'); ?>
					</div>
				</div>
				<div class="post-content">
					<?php if(has_excerpt()): ?>
						<p class="post-abstract"><span class="abstract-tit">摘要：</span><?php echo get_the_excerpt(); ?></p>
					<?php endif;?>
					<?php the_content(); suxing_link_pages('before=<div class="page-links">&after=&next_or_number=next&previouspagelink=上一页&nextpagelink=');  suxing_link_pages('before=&after='); suxing_link_pages('before=&after=</div>&next_or_number=next&previouspagelink=&nextpagelink=下一页'); ?>
				</div>
				<div class="shareBox  clearfix">
					<?php if(suxingme('suxingme_post_like',true)) { ?>
					<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" id="Addlike" class="action sharebtn like<?php if(isset($_COOKIE['suxing_ding_'.$post->ID])) echo ' current';?>" title="喜欢">
						<span class="icon s-like"><i class="icon-heart"></i><i class="icon-heart-filled"></i> 喜欢 </span>
						(<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>)
					</a>
					<?php } ?>
					<a href="javascript:;" class="sharebtn J_showAllShareBtn"><i class="icon-forward"></i> 分享</a>
					<div class="action-share bdsharebuttonbox"><?php echo suxing_get_share() ?></div>
				</div>
				<?php echo single_pc_ad_pic(); echo single_mini_ad_pic(); ?>
				<?php if(suxingme('nextprevposts',true)) { ?>
					<div class="next-prev-posts clearfix">
						<div class="prev-post"> 
							<?php 	
								$prev_post = get_previous_post(true,'');//与当前文章同分类的上一篇文章 
								if ( !empty( $prev_post ) ) : ?>
									<a href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo $prev_post->post_title; ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?> class="next has-background" style="height: 158px; background-image: url(<?php echo get_post_thumbnail_url($prev_post->ID); ?>)" alt="<?php echo $prev_post->post_title; ?>">	
										<span>上一篇</span><h4><?php echo $prev_post->post_title; ?></h4>
									</a> 
								<?php  else:?> 
									<a href="javascript:;" class="prev has-background" style="height:158px; cursor:not-allowed; background-image:url();" >	
										<h4>没有啦!</h4>
									</a> 
							<?php endif;?>
						</div> 
						<div class="next-post">
						<?php 	
							$next_post = get_next_post(true,'');
							if(!empty( $next_post )): ?>
								<a href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo $next_post->post_title; ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?> class="next has-background" style="height: 158px; background-image: url(<?php echo get_post_thumbnail_url($next_post->ID); ?>)" alt="<?php echo $next_post->post_title; ?>">	
									<span>下一篇</span><h4><?php echo $next_post->post_title; ?></h4>
								</a> 
							<?php  else:?>
								<a href="javascript:;" class="next has-background" style="height: 158px;cursor:not-allowed;  background-image: url();" >	
									<h4>没有啦</h4>
								</a> 
							<?php endif;?>
						</div> 
					</div>
				<?php } ?>	 
			</div>
			
			<?php if(suxingme('related-post',true)) { ?>
			<div class="related-post sx-box">
				<h3 class="subtitle"><span>猜你喜欢</span></h3>
				<ul><?php include get_template_directory() . '/includes/relatepost.php';?></ul>
			</div>
			<?php }?>

			<div class="clear"></div>
			<?php if (comments_open()) comments_template( '', true ); endwhile;  endif; ?>	
		</div>	
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>
