<?php
/**
 * Gravity Wiz // Gravity Forms // Display Field IDs Next to Field Labels in the Editor
 * https://gravitywiz.com/
 */
add_filter( 'gform_field_content', function( $content, $field ) {

	if ( ! GFCommon::is_form_editor() ) {
		return $content;
	}

	static $_gw_inline_field_id_style;
	if ( ! $_gw_inline_field_id_style ) {
		$content .= '
			<style>
				.gw-field-indicator {
					margin: 0 0 0 0.6875rem;
					background-color: #ecedf8;
					border: 1px solid #d5d7e9;
					border-radius: 40px;
					font-size: 0.6875rem;
					font-weight: 600;
					padding: 0.1125rem 0.4625rem;
					vertical-align: text-top;
					position: relative;
					top: 3px;
				}
			</style>';
		$_gw_inline_field_id_style = true;
	}

	$search  = '<\/label>|<\/legend>';
	$replace = sprintf( '<span class="gw-field-indicator gw-inline-field-id">ID: %d</span>\0', $field->id );
	$content = preg_replace( "/$search/", $replace, $content, 1 );

	return $content;
}, 20, 2 );
