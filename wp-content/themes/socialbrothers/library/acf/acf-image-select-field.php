<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ACF field image select
 */
class acf_field_image_select extends acf_field
{

    /**
     * Initialize new field type
     */
    function initialize()
    {
        $this->name     = 'image_select';
        $this->label    = __('Image select', '_SBB');
        $this->category = 'choice';
        $this->defaults = [
            'layout'            => 'vertical',
            'choices'           => [],
            'default_value'     => '',
            'other_choice'      => 0,
            'save_other_choice' => 0,
            'allow_null'        => 0,
            'return_format'     => 'value',
        ];
    }

    /**
     * Render the field
     */
    function render_field($field)
    {

        $e  = '';

        $ul = [
            'class'             => 'acf-radio-list',
            'data-allow_null'   => $field['allow_null'],
            'data-other_choice' => $field['other_choice'],
        ];

        $ul['class'] .= ' ' . ($field['layout'] == 'horizontal' ? 'acf-hl' : 'acf-bl');
        $ul['class'] .= ' ' . $field['class'];

        $value = (string) $field['value'];

        if (isset($field['choices'][$value])) {
            $checked = (string) $value;
        } elseif ($field['other_choice'] && $value !== '') {
            $checked = 'other';
        } elseif ($field['allow_null']) {
            $checked = '';
        } else {
            $checked = (string) key($field['choices']);
        }

        $other_input = false;
        if ($field['other_choice']) {

            $other_input = [
                'type'     => 'text',
                'name'     => $field['name'],
                'value'    => '',
                'disabled' => 'disabled',
                'class'    => 'acf-disabled',
            ];

            if ($checked === 'other') {
                unset($other_input['disabled']);
                $other_input['value'] = $field['value'];
            }

            if (!isset($field['choices']['other'])) {
                $field['choices']['other'] = '';
            }
        }

        if (empty($field['choices'])) {
            return;
        }

        $e .= '<div class="acf-field-radio">';
        $e .= acf_get_hidden_input(['name' => $field['name']]);

        $e .= '<ul ' . acf_esc_attr($ul) . '>';

        foreach ($field['choices'] as $value => $label) {
            $is_selected = false;

            $value = (string) $value;

            $attrs = [
                'type'  => 'radio',
                'id'    => sanitize_title($field['id'] . '-' . $value),
                'name'  => $field['name'],
                'value' => $value,
            ];

            if (esc_attr($value) === esc_attr($checked)) {
                $attrs['checked'] = 'checked';
                $is_selected      = true;
            }

            if (isset($field['disabled']) && acf_in_array($value, $field['disabled'])) {
                $attrs['disabled'] = 'disabled';
            }

            $additional_html = '';
            if ($value === 'other' && $other_input) {
                $additional_html = ' ' . acf_get_text_input($other_input);
            }

            $e .= '<li><label' . ($is_selected ? ' class="selected"' : '') . '><input ' . acf_esc_attr($attrs) . '/>' . acf_esc_html($label) . '</label>' . $additional_html . '</li>';
        }

        $e .= '</ul>';
        $e .= '</div>';

        echo $e;
    }

    function render_field_settings($field)
    {
        $field['choices'] = acf_encode_choices($field['choices']);

        acf_render_field_setting(
            $field,
            [
                'label'        => __('Choices', 'acf'),
                'instructions' => __('Enter each choice on a new line.', 'acf') . '<br />' . __('For more control, you may specify both a value and label like this:', 'acf') . '<br /><span class="acf-field-setting-example">' . __('red : Red', 'acf') . '</span>',
                'type'         => 'textarea',
                'name'         => 'choices',
            ]
        );

        acf_render_field_setting(
            $field,
            [
                'label'        => __('Default Value', 'acf'),
                'instructions' => __('Appears when creating a new post', 'acf'),
                'type'         => 'text',
                'name'         => 'default_value',
            ]
        );
    }

    /**
     * Update and decode field
     */
    function update_field($field)
    {
        $field['choices'] = acf_decode_choices($field['choices']);
        return $field;
    }

    /**
     * Update the field value
     */
    function update_value($value, $post_id, $field)
    {
        if (!$value && !is_numeric($value)) {
            return $value;
        }

        if ($field['save_other_choice']) {
            if (!isset($field['choices'][$value])) {

                $selector = $field['ID'] ? $field['ID'] : $field['key'];
                $field    = acf_get_field($selector);

                if (!$field['ID']) {
                    return $value;
                }

                $value = wp_unslash($value);
                $value = sanitize_text_field($value);
                $field['choices'][$value] = $value;
                acf_update_field($field);
            }
        }

        return $value;
    }

    /**
     * Load the value
     */
    function load_value($value, $post_id, $field)
    {
        if (is_array($value)) {
            $value = array_pop($value);
        }

        return $value;
    }

    /**
     * Translate field
     */
    function translate_field($field)
    {
        return acf_get_field_type('select')->translate_field($field);
    }

    /**
     * Format field value
     */
    function format_value($value, $post_id, $field)
    {
        return acf_get_field_type('select')->format_value($value, $post_id, $field);
    }

    /**
     * Get the rest schema
     */
    function get_rest_schema(array $field)
    {
        $schema = parent::get_rest_schema($field);

        if (isset($field['default_value']) && '' !== $field['default_value']) {
            $schema['default'] = $field['default_value'];
        }

        // If other/custom choices are allowed, nothing else to do here.
        if (!empty($field['other_choice'])) {
            return $schema;
        }

        $radio_keys = array_diff(
            array_keys($field['choices']),
            array_values($field['choices'])
        );

        $schema['enum'] = empty($radio_keys) ? $field['choices'] : $radio_keys;
        if (!empty($field['allow_null'])) {
            $schema['enum'][] = null;
        }

        return $schema;
    }
}

acf_register_field_type('acf_field_image_select');


/**
 * ACF image select options
 * @param array $options
 * @return array;
 */
function acf_image_select_options(array $options = [])
{
    $choices = [];
    foreach ($options as $option) {
        $choices[$option['key']] = '<img src="' . $option['image'] . '"><p>' . $option['label'] . '</p>';
    }
    return $choices;
}

/**
 * Enqueue styling for the acf image selector
 */
function enqueue_acf_image_select_styles()
{
?>
    <style>
        .acf-field-image-select label input {
            display: none;
        }

        .acf-image-select label p,
        .acf-field-image-select label p {
            margin: 0;
            font-weight: bold;
            text-align: center;
        }

        .acf-image-select label img,
        .acf-field-image-select input[type="radio"]+img {
            max-width: 100%;
            border: solid 5px #ddd;
        }

        .acf-image-select label.selected img,
        .acf-field-image-select input[type="radio"]:checked+img {
            border: solid 5px #a1cbb0;
        }

        .acf-image-select li,
        .acf-field-image-select li {
            display: inline-block;
            max-width: calc(25% - 32px);
            padding: 16px;
            list-style: none;
        }

        .acf-image-select ul.acf-radio-list,
        .acf-field-image-select ul.acf-radio-list {
            margin-inline: -16px;
        }
    </style>

    <script>
        (function($, undefined) {
            var Field = acf.Field.extend({
                type: 'image_select',
                events: {
                    'click input[type="radio"]': 'onClick'
                },
                $control: function() {
                    return this.$('.acf-radio-list');
                },
                $input: function() {
                    return this.$('input:checked');
                },
                $inputText: function() {
                    return this.$('input[type="text"]');
                },
                getValue: function() {
                    var val = this.$input().val();
                    if (val === 'other' && this.get('other_choice')) {
                        val = this.$inputText().val();
                    }
                    return val;
                },
                onClick: function(e, $el) {
                    var $label = $el.parent('label');
                    var selected = $label.hasClass('selected');
                    var val = $el.val();

                    this.$('.selected').removeClass('selected');

                    $label.addClass('selected');

                    if (this.get('allow_null') && selected) {
                        $label.removeClass('selected');
                        $el.prop('checked', false).trigger('change');
                        val = false;
                    }

                    if (this.get('other_choice')) {
                        if (val === 'other') {
                            this.$inputText().prop('disabled', false);
                        } else {
                            this.$inputText().prop('disabled', true);
                        }
                    }
                }
            });
            acf.registerFieldType(Field);
            acf.registerConditionForFieldType('hasValue', 'image_select');
            acf.registerConditionForFieldType('hasNoValue', 'image_select');
            acf.registerConditionForFieldType('lessThan', 'image_select');
            acf.registerConditionForFieldType('greaterThan', 'image_select');
            acf.registerConditionForFieldType('equalTo', 'image_select');
            acf.registerConditionForFieldType('notEqualTo', 'image_select');
        })(jQuery);
    </script>
<?php
}
add_action('acf/input/admin_head', 'enqueue_acf_image_select_styles');
