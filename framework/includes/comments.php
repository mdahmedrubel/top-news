<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_list_comments
 * @since 1.0.0
 * @version 1.0.0
 * @author CodexCoder
 */

function top_news_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            // Display trackbacks differently than normal comments.
            ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php esc_html_e( 'Pingback:', 'top-news' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link(  esc_html__( '(Edit)', 'top-news' ), '<span class="edit-link">', '</span>' ); ?></p>
            <?php
            break;
        default :
            // Proceed with normal comments.
            global $post;
            ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment-item">
                <div class="profile-image">
                    <?php echo get_avatar( $comment, 70 ); ?>
                </div><!-- /.profile-image -->

                <div class="contents">
                    <div class="comment-meta">
                        <strong class="title"><?php echo get_comment_author_link(); ?></strong>
                        <span class="sep">|</span>
                        <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                            <time datetime="<?php echo get_comment_time( 'c' ); ?>">
                                <?php echo sprintf(  esc_html__( '%1$s at %2$s', 'top-news' ), get_comment_date(), get_comment_time() ) ?>
                            </time>
                        </a>
                    </div><!-- /.comment-meta -->

                    <div class="content">
                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'top-news' ); ?></p>
                        <?php endif; ?>

                        <?php comment_text(); ?>
                        <?php edit_comment_link(  esc_html__( 'Edit', 'top-news' ), '<p class="edit-link">', '</p>' ); ?>
                    </div><!-- /.content -->

                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' =>  esc_html__( 'Reply', 'top-news' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- /.contents -->

            </article>
            <?php
            break;
    endswitch; // end comment_type check
}

/**
 * Comment Form
 *
 * @since 1.0.0
 * @version 1.0.0
 * @author CodexCoder
 */
function top_news_comment_form() {
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
    $fields =  array(
        'author' => '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' .  esc_html__( 'Your Name *', 'top-news' ) . '"' . $aria_req . ' />',
        'email'  => '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="' .  esc_html__( 'Your Email *', 'top-news' ) . '"' . $aria_req . ' />',
        'url'    => '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" placeholder="' .  esc_html__( 'Your Website', 'top-news' ) . '"/>',
        'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
        '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'top-news' ) . '</label></p>',
    );
    $comments_args = array(
        'fields' =>  $fields,
        'title_reply'=>'Leave a comment',
        'comment_field' => '<textarea id="comment" name="comment" cols="45" rows="5" placeholder="' . esc_html__( 'Your Messages', 'top-news' ) . '" aria-required="true"></textarea>',
        'comment_notes_after' => '',
    );
    comment_form($comments_args);
}