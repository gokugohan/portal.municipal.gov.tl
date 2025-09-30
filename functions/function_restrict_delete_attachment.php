<?php

/**
 * Block media deletion for ALL users (including admins)
 */
function block_media_deletion($allcaps, $caps, $args)
{
    if (isset($args[0]) && $args[0] === 'delete_post') {
        $post_id = isset($args[2]) ? $args[2] : 0;
        $post    = get_post($post_id);

        if ($post && $post->post_type === 'attachment') {
            $allcaps[$caps[0]] = false; // deny deletion for all
        }
    }
    return $allcaps;
}
add_filter('user_has_cap', 'block_media_deletion', 10, 3);


/**
 * Hide Delete/Trash buttons in Media Library for everyone
 */
function hide_media_delete_ui_for_all()
{
    echo '<style>
        /* List view */
        .row-actions .trash,
        .row-actions .delete,
        /* Grid view */
        .media-modal-content .delete-attachment,
        .media-frame-toolbar .delete {
            display: none !important;
        }
    </style>';
}
add_action('admin_head', 'hide_media_delete_ui_for_all');
