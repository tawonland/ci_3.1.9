<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function formx_input($data = '', $value = '', $c_edit = true, $extra = '')
{
    
    $class = _form_class() .' '.$data['class'];

	$data['class'] = $class;


	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	return form_input($data, $value , $extra);	
}

function formx_inputdate($data = '', $value = '', $c_edit = true, $extra = '')
{
    
	$class = _form_class() .' '.$data['class'];

	$data['class'] = $class;

	if(empty($extra)){
		$extra .= 'autocomplete = "off" ';
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	if(!$c_edit){
		$value = tgl_indo($value);
	}

	if(!$c_edit){
		return form_input($data, $value , $extra);
	}

	$form = '<div class="input-group">';
	$form .= form_input($data, $value , $extra);
	$form .= '<span class="input-group-btn">
                <button class="btn default" type="button">
                    <i class="fa fa-calendar"></i>
                </button>
            </span>';
	$form .= '</div>';

	return 	$form;
}

if ( ! function_exists('form_email'))
{
	/**
	 * Text Input Field
	 *
	 * @param	mixed
	 * @param	string
	 * @param	mixed
	 * @return	string
	 */
	function form_email($data = '', $value = '', $extra = '')
	{
		
	}
}

function formx_email($data = '', $value = '', $c_edit = TRUE, $extra = '')
{
    
	$class = _form_class() .' '.$data['class'];

	$data['class'] = $class;


	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	$defaults = array(
			'type' => 'email',
			'name' => is_array($data) ? '' : $data,
			'value' => $value
	);

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";	
}

function formx_number($data = '', $value = '', $c_edit = TRUE, $extra = '')
{
    
	if(empty($extra)){
		$extra = 'class="'._form_class().'"';
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	$defaults = array(
		'type' => 'number',
		'name' => is_array($data) ? '' : $data,
		'value' => $value
	);

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}


function formx_hidden($data = '', $value = '', $extra = '')
{
	$defaults = array(
		'type' => 'hidden',
		'name' => is_array($data) ? '' : $data,
		'value' => $value
	);

	return '<input '._parse_form_attributes($data, $defaults)._attributes_to_string($extra)." />\n";
}

function formx_dropdown($data = '', $options = array(), $selected = array(), $c_edit = TRUE, $extra = '')
{

	if(empty($extra)){
		$extra = 'class="'._form_class().'"';
	}

	if($c_edit === FALSE){
		$extra .= ' disabled';
	}

	return form_dropdown($data, $options, $selected, $extra);
}

function formx_checkbox($data = '', $value = '', $checked = FALSE, $c_edit = TRUE, $extra = '')
{
	$class = 'minimal '.$data['class'];

	$data['class'] = $class;

	return form_checkbox($data, $value, $checked, $extra);
}

function _form_class()
{
	return 'form-control';
}

function formx_error()
{
	return array(
			'required'      => 'Input %s tidak boleh kosong',
			'alpha_numeric' => 'Input %s harus berupa huruf dan/atau angka',
			'alpha_numeric_spaces' => 'Input %s harus berupa huruf, angka dan/atau spasi',
			'min_length'    => 'Panjang %s harus lebih dari sama dengan %s karakter',
			'valid_email'   => 'Input %s harus berupa email yang valid',
			'decimal'   => 'Input %s harus berupa bilangan desimal',
		);
}