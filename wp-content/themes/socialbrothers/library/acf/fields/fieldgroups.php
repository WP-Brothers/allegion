<?php 

function ContentFieldGroup ($prefix, $tabExpand = 1) {

  

    $fields = array_merge(getTabFields($prefix, $tabExpand, 'content', __('Content', '_SBB')), getTitleFields($prefix), getSubTitleFields($prefix), getContentFields($prefix));

    return $fields;
}

function imageVideoFieldGroup ($prefix, $tabExpand = 0) {

    $fields = array_merge(getTabFields($prefix, $tabExpand, 'image_video', __('Afbeelding/Video', '_SBB')), getImageVideoSwitchFields($prefix), getImageFields($prefix), getVideoFields($prefix));

    return $fields;
}

function faqFieldGroup ($prefix, $tabExpand = 0) {

    $fields = array_merge(getTabFields($prefix, $tabExpand, 'faq', __('FAQ', '_SBB')), getFaqFields($prefix));

    return $fields;
}

