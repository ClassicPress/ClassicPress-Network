<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if(!function_exists('dfd_comment')) {
	/**
	 * Generates comments html
	 *
	 * @param $comment
	 * @param $args
	 * @param $depth
	 *
	 * @return string
	 */
	function dfd_comment($comment, $args, $depth) {
		global $dfd_native;
		$GLOBALS['comment'] = $comment;
		$read_more_style = '';
		?>

	<li <?php comment_class(); ?>>
		<div class="clearfix">

			<figure class="avatar-box">
				<?php echo get_avatar($comment, $size = '80'); ?>
			</figure>
			
			<section class="comment-content">
				<header class="comment-author vcard">
					<div class="author dfd-content-title-big"><?php echo get_comment_author_link(); ?></div>
					<div class="reply">
						<?php if (is_user_logged_in()) : ?>
							<?php edit_comment_link('<i class="dfd-socicon-icon-compose"></i><span>'.esc_html__('Edit', 'dfd-native').'</span>', '', ''); ?>
						<?php endif; ?>
						<?php echo comment_reply_link(array(
							'depth' => $depth,
							'max_depth' => $args['max_depth'], 
							'reply_text'=>'<i class="dfd-socicon-icon-reply-all"></i><span>'.esc_html__('Leave reply','dfd-native').'</span>'
						)); ?>
					</div>
					<div class="entry-meta"><i class="dfd-socicon-clock"></i><?php printf(esc_html__('%1$s', 'dfd-native'), get_comment_date().', '); printf(esc_html__('%1$s', 'dfd-native'), get_comment_time());?></div>
				</header>

				<div class="ovh">

					<?php if ($comment->comment_approved == '0') : ?>
						<div class="alert-box">
							<?php esc_html_e('Your comment is awaiting moderation.', 'dfd-native'); ?>
						</div>
					<?php endif; ?>

					<?php comment_text(); ?>

				</div>
				<div class="clear"></div>
				<footer></footer>
			</section>
		</div>

	<?php }
}
 ?>
<?php if (post_password_required()) : ?>
    <section id="comments">
        <div class="alert-box alert">
            <?php esc_html_e('This post is password protected. Enter the password to view comments.', 'dfd-native'); ?>
        </div>
    </section>
<?php else : ?>


	<?php if (have_comments()) : ?>
		<section id="comments">
			<div class="dfd-form-heading text-center">
				<?php printf(_n('There is 1 comment', 'There are %1$s comments', (int) get_comments_number(), 'dfd-native'), number_format_i18n(get_comments_number())); ?>
			</div>

			<ol class="commentlist">
				<?php wp_list_comments(array('callback' => 'dfd_comment')); ?>
			</ol>

			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>

			<nav class="page-nav">
				<span class="older"><?php previous_comments_link(esc_html__('Older', 'dfd-native')); ?></span>
				<span class="newer"><?php next_comments_link(esc_html__('Newer', 'dfd-native')); ?></span>
			</nav>

			<?php endif; // check for comment navigation ?>

			<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
			<?php endif; ?>

		</section>

	<?php endif; ?>

	<?php
	$args = array(
		'class_form'           => 'comment-form row',
		'title_reply_before'   => '<div id="reply-title" class="dfd-form-heading text-center">',
		'title_reply_after'    => '</div>',
		'cancel_reply_before'  => '<p class="cancel-comment-reply text-center">',
		'cancel_reply_after'   => '</p>',
		'cancel_reply_link'    => esc_html__( 'Click here to cancel reply.','dfd-native' ),
		'label_submit'         => esc_html__( 'Leave reply','dfd-native' ),
	);

	comment_form($args);
	?>
	
<?php endif;