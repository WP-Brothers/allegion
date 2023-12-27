<?php

function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep)
{
    return '<span class="material-symbols-rounded">
    chevron_right
    </span>';
}

// add the filter
add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);
