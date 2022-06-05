<?php
/**
 * Set and get app instance
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.0.0
 */

declare(strict_types=1);

namespace Frameworks\Support\Traits;

trait HasAppTrait
{

	private static $app = null;

	public static function getAppInstance()
	{
		return self::$app;
	}

	public static function setAppInstance( $app )
	{
		self::$app = $app;
	}
}
