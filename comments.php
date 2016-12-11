<?php $comments = get_comments('post_id=' . $post->ID); ?>

<?php if ($comments > 0) { ?>
	<article id="comments">
		<div class="container">

			<h3>Comments (<?php echo get_comments_number(); ?>)</h3>

			<?php foreach($comments as $comment) { ?>
			<section id="comment-<?php echo $comment->comment_ID; ?>">
				<h4><?php echo $comment->comment_author; ?>:</h4>
				<?php echo wpautop( $comment->comment_content ); ?>
				<?php echo date(get_option( 'date_format'), strtotime($comment->comment_date) ); ?>
			</section>
			<?php } ?>
			
		</div>
	</article>
<?php } ?>

<?php if (comments_open()) { ?>

	<?php get_comment_form(); ?>

<?php } ?>