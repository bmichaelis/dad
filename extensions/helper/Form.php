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
}

?>