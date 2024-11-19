<?php

namespace gearguard\phpmvc;

use gearguard\phpmvc\db\DbModel;

/**
 * @author Sandhavi Wanigasooriya
 * @package gearguard/phpmvc
 */

abstract class UserModel extends DbModel
{
	abstract public function getDisplayName(): string;
}
