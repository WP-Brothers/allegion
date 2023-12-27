<?php

// Gravity Forms

if (class_exists('GFCommon')) {
    add_filter('gform_submit_button', function ($button, $form) {
        return "<button class='btn btn--icon-right btn--solid' id='gform_submit_button_{$form['id']}'><div class='h-6 w-6 flex justify-center items-center'>
        <span class='material-symbols-rounded'>arrow_forward</span>
    </div>" . do_shortcode($form['button']['text']) . '</button>';
    }, 10, 2);

    add_filter('gform_next_button', function ($button, $form) {
        $data = str_replace('<input type=\'button\' ', '', $button);
        $data = str_replace(' />', '', $data);
        $data = str_replace('class=\'', 'class="btn btn--icon-right btn--solid ', $data);

        $step_1 = explode('value=\'', $button);
        $step_2 = explode('\'  onclick=', $step_1[1]);

        return "<button {$data} ><div class='h-6 w-6 flex justify-center items-center'>
        <span class='material-symbols-rounded'>arrow_forward</span>
    </div>{$step_2[0]}</button>";
    }, 10, 2);

    add_filter('gform_previous_button', function ($button, $form) {
        $data = str_replace('<input type=\'button\' ', '', $button);
        $data = str_replace(' />', '', $data);
        $data = str_replace('class=\'', 'class="btn btn--solid ', $data);

        $step_1 = explode('value=\'', $button);
        $step_2 = explode('\'  onclick=', $step_1[1]);

        return "<button {$data} ><div class='h-6 w-6 flex justify-center items-center'>
        <span class='material-symbols-rounded'>arrow_back</span>
    </div>{$step_2[0]}</button>";
    }, 10, 2);
}
