<div id="comments-area">
<?php if ( have_comments() ) : ?>

	<h2 class="comments-title">
		<?php printf( 'Thoughts on &ldquo;%1$s&rdquo;', get_the_title() );?>
	</h2>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-top" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text">Comment Navigation</h1>
			<div class="nav-previous"><?php previous_comments_link('&larr; Older Comments'); ?></div>
			<div class="nav-next"><?php next_comments_link('Newer Comments &rarr;'); ?></div>
		</nav>
	<?php endif; ?>

	<ol class="comment-list">
		<?php wp_list_comments( array(
			'style'		=> 'ol',
			'callback'	=> 'trichotomy_comment_callback'
		) ); ?>
	</ol>

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<nav id="comment-nav-bottom" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text">Comment navigation</h1>
			<div class="nav-previous"><?php previous_comments_link('&larr; Older Comments'); ?></div>
			<div class="nav-next"><?php next_comments_link('Newer Comments &rarr;'); ?></div>
		</nav>
	<?php endif; ?>

	<?php if ( ! comments_open() ) : ?>
		<p class="no-comments">Comments are closed.</p>
	<?php endif; ?>

<?php endif; ?>

<?php comment_form( array(
	'title_reply' => 'Chime in:',
	'title_reply_to' => 'Reply to %s:',
	'cancel_reply_link' => ' ',
	'logged_in_as' => '<p class="logged-in-as">' . sprintf( 'Logged in as <a href="%1$s">%2$s</a>', admin_url( 'profile.php' ), $user_identity ) . '.</p>',
	'comment_field' => '<label class="screen-reader-text" for="comment">Comment</label><textarea id="comment" name="comment" aria-required="true" placeholder="Blah blah blah..."></textarea>',
	'comment_notes_after' => ''
) ); ?>
</div>