<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class DropDownField extends BaseField
{
    public array $options;

    public function __construct(Model $model, string $attribute, array $options)
    {
        $this->options = $options;
        parent::__construct($model, $attribute);
    }

    public function renderInput(): string
    {
        $optionsHtml = '';
        foreach ($this->options as $value => $label) {
            $selected = $this->model->{$this->attribute} == $value ? 'selected' : '';
            $optionsHtml .= sprintf('<option value="%s" %s>%s</option>', $value, $selected, $label);
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
