<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class DateField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<input type="date" id="%s" name="%s" value="%s" class="form-input%s">',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : ''
        );
    }
}
