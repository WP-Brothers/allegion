<?php
defined('ABSPATH') || exit;
if (class_exists('acf_field')) {
    class acf_field_material_icons extends acf_field
    {
        public function initialize()
        {
            $this->name     = 'GOOGLE_MATERIAL_ICON';
            $this->label    = __('Google Material Icon', '_SBB');
            $this->category = 'choice';
            $this->defaults = [
                'choices'       => $this->get_options(),
                'placeholder'   => __('Choose icon', '_SBB'),
                'return_format' => 'value',
            ];
        }

        public function input_admin_enqueue_scripts()
        {
            $version = '';
            $style   = 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200';
            wp_enqueue_style('material-icons', $style, '', $version);
        }

        public function render_field($field)
        {
            $field['type']       = 'select';
            $field['ui']         = 1;
            $field['ajax']       = 1;
            $field['multiple']   = 0;
            $field['allow_null'] = 0;
            $field['choices']    = acf_get_array($this->get_options());
            $field['value']      = acf_get_array($field['value']);

            echo "<div class='acf-field acf-field-select'
                       data-name='{$field['label']}'
                       data-type='select'
                       data-key='{$field['key']}'>";

            acf_render_field($field);

            echo '</div>';
        }

        public function get_options()
        {
            $json    = file_exists(__DIR__ . '/data.json') ? file_get_contents(__DIR__ . '/data.json') : false;
            $options = [];

            if (empty($json)) {
                return $options;
            }

            $json = json_decode($json);

            foreach ($json->icons as $icon) {
                $options[$icon->name] = '<span style="vertical-align: middle;" class="material-symbols-outlined">' . $icon->name . '</span> ' . $icon->name;
            }

            return $options;
        }
    }
}

add_action('acf/init', function () {
    acf_register_field_type('acf_field_material_icons');
});
