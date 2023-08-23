<?php
if (post_password_required()) {
//    return;
}
?>
<style>
    .comment-list .children{
        margin-left: 75px;
    }
</style>

<div class="divider-small text-center py-3"></div>
<div class="comments">


    <?php

    if (have_comments()) : ?>
        <h3>
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                echo "<i class='bi bi-reply-fill'></i>".lang('one_replay_to') . ' "' . get_the_title() .'"';
            } else {
                printf(
                    _nx(
                        '(%1$s) %3$s &ldquo;%2$s&rdquo;',
                        '(%1$s) %3$s &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'twentyseventeen'
                    ),
                    number_format_i18n($comments_number),
                    get_the_title(),
                    lang('replay_to')
                );
            }
            ?>
        </h3>


        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'type' => 'comment', //Don't output pingbacks & trackbacks
                'reverse_top_level' => true, //Newest first
                'max_depth' => 20, //Maximum comments depth
                'callback' => 'comment_list_render_callback',
            ));
            ?>
        </ol>
        <?php the_comments_pagination(array(
            'prev_text' => '<span class="screen-reader-text">Previous</span>',
            'next_text' => '<span class="screen-reader-text">Next</span>',
        ));
    endif; // Check for have_comments().
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?= lang('comment_closed') ?></p>
    <?php
    endif;

?>
            <?php

            $commenter = wp_get_current_commenter();
            $req = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            $fields =  array(
                'author' => '<p class="comment-form-author">' . '<label for="author">' . lang( 'name' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',

                'email'  => '<p class="comment-form-email"><label for="email">' . lang( 'email' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .
                    '<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
            );
            $comments_args = array(
                'fields' =>  $fields,
                'title_reply'=>lang('send_a_comment'),
                'title_reply_to' =>lang('replay_to') . " %s",
                'label_submit' => lang('submit_comment'),
                'comment_notes_before' =>lang('your_email_address_will_not_be_published'),
                'cancel_reply_link' =>lang('cancel_reply'),
                'logged_in_as' =>'',
            );
            comment_form($comments_args);
            ?>
    <?php
    ?>
</div><!-- #comments -->
