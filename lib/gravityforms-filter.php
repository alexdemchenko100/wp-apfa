<?php
/**
 * Gravity Forms plugin filter for simple select forms
 */

if( !function_exists( 'select_gf' ) ) {
	function select_gf($field) {

		if (class_exists('GFAPI')) {

			$field['choices'] = array();
			$forms = GFAPI::get_forms();

			foreach ($forms as $form) {

				$label = $form['title'];
				$value = $form['id'];

				$field['choices'][$value] = $label;
			}
		}

		return $field;
	}

	add_filter('acf/load_field/name=choices', 'select_gf');
}
