<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class DropDownField extends BaseField
{
    public $options;
    public bool $readonly = false;
    public bool $disabled = false;
    public string $placeholder = '';

    public function __construct($model, $attribute, $options)
    {
        $this->options = $options;
        parent::__construct($model, $attribute);
    }

    public function required(bool $required = true): self
    {
        $this->required = $required;
        return $this;
    }

    public function disabled(bool $disabled = true) : self
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function readonly(bool $readonly = true) : self
    {
        $this->readonly = $readonly;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function renderInput(): string
    {
        $optionsHtml = '<option value="">Select ' . $this->model->getLabel($this->attribute) . '</option>';
        foreach ($this->options as $key => $value) {
            $optionsHtml .= sprintf('<option value="%s">%s</option>', $key, $value);
        }

        return sprintf(
            '<select name="%s" id="%s" placeholder="%s" class="form-input%s" %s %s %s>%s</select>',
            $this->attribute,
            $this->attribute,
            $this->placeholder == '' ? "Enter the " . $this->model->getLabel($this->attribute): $this->placeholder,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->readonly ? ' readonly' : '',
            $this->disabled ? ' disabled' : '',
            $this->required ? ' required' : '',
            $optionsHtml
        );
    }
}
