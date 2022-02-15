<?php 

if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group(array(
    'key' => 'group_61eaa5feb2601',
    'title' => __('RekAI Settings', 'modularity-recommend'),
    'fields' => array(
        0 => array(
            'key' => 'field_61eab56e79cf5',
            'label' => __('Enable RekAI Automatic Recommendations', 'modularity-recommend'),
            'name' => 'rekai_enable',
            'type' => 'true_false',
            'instructions' => __('You must have an account @ rekAI service in order to use this functionality. Please contact https://rek.ai/ directly with your inquiry.', 'modularity-recommend'),
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '50',
                'class' => '',
                'id' => '',
            ),
            'message' => '',
            'default_value' => 0,
            'ui' => 0,
            'ui_on_text' => '',
            'ui_off_text' => '',
        ),
        1 => array(
            'key' => 'field_61eaa6920e638',
            'label' => __('Script url', 'modularity-recommend'),
            'name' => 'rekai_script_url',
            'type' => 'url',
            'instructions' => __('Add your RekAI Script url here, eg: https://static.rekai.se/[nnnn].js', 'modularity-recommend'),
            'required' => 1,
            'conditional_logic' => array(
                0 => array(
                    0 => array(
                        'field' => 'field_61eab56e79cf5',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
        ),
    ),
    'location' => array(
        0 => array(
            0 => array(
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'modularity-recommend-settings',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));
}