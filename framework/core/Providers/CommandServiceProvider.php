<?php
/**
 * Console Commands Service Provider
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.10.0
 */

declare(strict_types=1);

namespace Frameworks\Providers;

use Frameworks\Commands;

use WPEmerge\ServiceProviders\ServiceProviderInterface;

class CommandServiceProvider implements ServiceProviderInterface
{
	public function register( $container )
	{
		$container[ FRAMEWORKS_CONSOLE_COMMANDS_KEY ] = new Commands();
	}

	public function bootstrap( $container )
	{
	}
}
