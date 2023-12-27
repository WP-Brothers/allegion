<?php

declare(strict_types=1);

defined('ABSPATH') || exit('Forbidden');

/**
 *  Custom toolbar options for acf wysiysg.
 *      0 index does not exist
 *      1 index is the standard visable bar.
 *
 * @param array<string,array<int,array<int,string>>> $toolbars
 *
 * @return array<string,array<int,array<int,string>>>
 */
function wpb_custom_acf_toolbars(array $toolbars): array
{
    $toolbars['bold']          = [1 => ['bold']];
    $toolbars['italic']        = [1 => ['italic']];
    $toolbars['simple']        = [1 => ['bold', 'italic', 'underline', 'link']];
    $toolbars['content']       = [1 => ['formatselect', 'bold', 'italic', 'underline', 'link', 'bullist', 'numlist']];
    $toolbars['contentcenter'] = [1 => ['formatselect', 'bold', 'italic', 'underline', 'link', 'bullist', 'numlist', 'aligncenter']];
    $toolbars['styleselect']   = [1 => ['styleselect']];
    $toolbars['link']          = [1 => ['link']];

    return $toolbars;
}

add_filter('acf/fields/wysiwyg/toolbars', 'wpb_custom_acf_toolbars', 10, 1);
