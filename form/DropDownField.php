<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class DropDownField extends BaseField
{
    public $options;

    public function __construct($model, $attribute, $options)
    {
        $this->options = $options;
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        $optionsHtml = '<option value="">Select ' . $this->model->getLabel($this->attribute) . '</option>';
        foreach ($this->options as $key => $value) {
            $optionsHtml .= sprintf('<option value="%s">%s</option>', $key, $value);
        }

        return sprintf(
            '<select name="%s" id="%s" class="form-input%s">%s</select>',
            $this->attribute,
            $this->attribute,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $optionsHtml
        );
    }
}
