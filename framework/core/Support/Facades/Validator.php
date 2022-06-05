<?php
/**
 * Validator facade
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.5.0
 */

declare(strict_types=1);

namespace Frameworks\Support\Facades;

class Validator extends AbstractFacade
{
	protected static function accessor()
	{
		return FRAMEWORKS_VALIDATOR_FACTORY_KEY;
	}
}
