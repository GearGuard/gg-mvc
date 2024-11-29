<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class TimeField extends BaseField
{
    public function renderInput(): string
    {
        return sprintf(
            '<input type="time" id="%s" name="%s" value="%s" min="09:00" max="18:00" class="form-input%s">',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : ''
        );
    }
}
