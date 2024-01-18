<?php

function ContentFieldGroup($prefix, $tabExpand = 1, $subtitle = 1, $buttons = 1)
{

    if (!empty($subtitle) && !empty($buttons)) {
        $fields = array_merge(getTabFields($prefix, $tabExpand, 'content', __('Content', '_SBB')), getTitleFields($prefix), getSubTitleFields($prefix), getContentFields($prefix), getButtonFields($prefix));
    } elseif (!empty($subtitle)) {
        $fields = array_merge(getTabFields($prefix, $tabExpand, 'content', __('Content', '_SBB')), getTitleFields($prefix), getSubTitleFields($prefix), getContentFields($prefix));
    } elseif (empty($subtitle) && !empty($buttons)) {
        $fields = array_merge(getTabFields($prefix, $tabExpand, 'content', __('Content', '_SBB')), getTitleFields($prefix), getContentFields($prefix), getButtonFields($prefix));
    } else {
        $fields = array_merge(getTabFields($prefix, $tabExpand, 'content', __('Content', '_SBB')), getTitleFields($prefix), getContentFields($prefix), getButtonFields($prefix));
    }

    return $fields;
}

function imageVideoFieldGroup($prefix, $tabExpand = 0)
{

    $fields = array_merge(getTabFields($prefix, $tabExpand, 'image_video', __('Afbeelding/Video', '_SBB')), getImageVideoSwitchFields($prefix), getImageFields($prefix), getVideoFields($prefix));

    return $fields;
}

function faqFieldGroup($prefix, $tabExpand = 0)
{

    $fields = array_merge(getTabFields($prefix, $tabExpand, 'faq', __('FAQ', '_SBB')), getFaqFields($prefix));

    return $fields;
}
