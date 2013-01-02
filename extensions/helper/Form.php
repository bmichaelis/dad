<?php

namespace dad\extensions\helper;

class Form extends \lithium\template\helper\Form {

		protected $_strings = [
		'button'         => '<button{:options}>{:title}</button>',
		'checkbox'       => '<input type="checkbox" name="{:name}"{:options} />',
		'checkbox-multi' => '<input type="checkbox" name="{:name}[]"{:options} />',
		'checkbox-multi-group' => '{:raw}',
		'error'          => '<div{:options}>{:content}</div>',
		'errors'         => '{:raw}',
		'input'          => '<input type="{:type}" name="{:name}"{:options} />',
		'file'           => '<input type="file" name="{:name}"{:options} />',
		'form'           => '<form action="{:url}"{:options}>{:append}',
		'form-end'       => '</form>',
		'hidden'         => '<input type="hidden" name="{:name}"{:options} />',
		'field'          => '<div{:wrap}>{:label}{:input}{:error}</div>',
		'field-checkbox' => '<div{:wrap}>{:input}{:label}{:error}</div>',
		'field-radio'    => '<div{:wrap}>{:input}{:label}{:error}</div>',
		'label'          => '<label for="{:id}"{:options}>{:title}</label>',
		'legend'         => '<legend>{:content}</legend>',
		'option-group'   => '<optgroup label="{:label}"{:options}>{:raw}</optgroup>',
		'password'       => '<input type="password" name="{:name}"{:options} />',
		'radio'          => '<input type="radio" name="{:name}"{:options} />',
		'select'         => '<select name="{:name}"{:options}>{:raw}</select>',
		'select-empty'   => '<option value=""{:options}>&nbsp;</option>',
		'select-multi'   => '<select name="{:name}[]"{:options}>{:raw}</select>',
		'select-option'  => '<option value="{:value}"{:options}>{:title}</option>',
		'submit'         => '<div{:wrap}><input type="submit" value="{:title}"{:options} /></div>',
		'submit-image'   => '<input type="image" src="{:url}"{:options} />',
		'text'           => '<input type="text" name="{:name}"{:options} />',
		'textarea'       => '<textarea name="{:name}"{:options}>{:value}</textarea>',
		'fieldset'       => '<fieldset{:options}><legend>{:content}</legend>{:raw}</fieldset>'
	];

	public function __construct(array $config = []) {
		parent::__construct($config);
	}

	protected function _init() {
		parent::_init();
	}

	public function submit($title = null, array $options = []) {
		list($name, $options, $template) = $this->_defaults(__FUNCTION__, null, $options);
		$wrap = ['class' => 'form-actions'];
		return $this->_render(__METHOD__, $template, compact('title', 'options', 'wrap'));
	}

	/**
	 * Generates an HTML `<input type="checkbox" />` object.
	 *
	 * @param string $name The name of the field.
	 * @param array $options Options to be used when generating the checkbox `<input />` element:
	 *              - `'checked'` _boolean_: Whether or not the field should be checked by default.
	 *              - `'value'` _mixed_: if specified, it will be used as the 'value' html
	 *                attribute and no hidden input field will be added.
	 *              - Any other options specified are rendered as HTML attributes of the element.
	 * @return string Returns a `<input />` tag with the given name and HTML attributes.
	 */
	public function checkbox($name, array $options = array()) {
		$defaults = array('value' => '1', 'hidden' => true);
		$options += $defaults;
		$default = $options['value'];
		$key = $name;
		$out = '';

		list($name, $options, $template) = $this->_defaults(__FUNCTION__, $name, $options);
		list($scope, $options) = $this->_options($defaults, $options);

		if (!isset($options['checked'])) {
			$options['checked'] = ($this->binding($key)->data == $default);
		}
		if ($scope['hidden']) {
			$out = $this->hidden($name, array('value' => '', 'id' => false));
		}
		$options['value'] = $scope['value'];
		return $out . $this->_render(__METHOD__, $template, compact('name', 'options'));
	}

	/**
	 * Generates an HTML `<input type="radio" />` object.
	 *
	 * @param string $name The name of the field
	 * @param array $options All options to be used when generating the radio `<input />` element:
	 *              - `'checked'` _boolean_: Whether or not the field should be selected by default.
	 *              - `'value'` _mixed_: if specified, it will be used as the 'value' html
	 *                attribute. Defaults to `1`
	 *              - Any other options specified are rendered as HTML attributes of the element.
	 * @return string Returns a `<input />` tag with the given name and attributes
	 */
	public function radio($name, array $options = array()) {
		$defaults = array('value' => '1');
		$options += $defaults;
		$default = $options['value'];

		list($name, $options, $template) = $this->_defaults(__FUNCTION__, $name, $options);
		list($scope, $options) = $this->_options($defaults, $options);

		if (!isset($options['checked'])) {
			$options['checked'] = ($this->binding($name)->data == $default);
		}

		$options['value'] = $scope['value'];
		return $this->_render(__METHOD__, $template, compact('name', 'options'));
	}
}

?>