<?php

namespace gearguard\phpmvc;

/**
 * @author Sandhavi Wanigasooriya
 * @package gearguard/phpmvc
 */


class Session
{
	protected const FLASH_KEY = 'flash_messages';
	public function __construct()
	{
		session_start();
		$flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
		foreach ($flashMessages as $key => &$flashMessage) {
			// Mark to be removed
			$flashMessage['remove'] = true;
		}

		$_SESSION[self::FLASH_KEY] = $flashMessages;
	}
	public function setFlash($key, $message)
	{
		$_SESSION[self::FLASH_KEY][$key] = [
			'remove' => false,
			'value' => $message
		];
	}
	public function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public function get($key)
	{
		return $_SESSION[$key] ?? false;
	}
	public function remove($key)
	{
		unset($_SESSION[$key]);
	}
	public function getFlash($key)
	{
		return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
	}

	public function __destruct()
	{
		$flashMessages = $_SESSION[self::FLASH_KEY];
		foreach ($flashMessages as $key => &$flashMessage) {
			if ($flashMessage['remove']) {
				unset($flashMessages[$key]);
			}
		}
		$_SESSION[self::FLASH_KEY] = $flashMessages;
	}
}
