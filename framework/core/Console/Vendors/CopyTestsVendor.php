<?php
/**
 * Copy `tests` files
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.7.8
 */

declare(strict_types=1);

namespace Frameworks\Console\Vendors;

use Frameworks\Console\SymfonyStyleTrait;

class CopyTestsVendor extends VendorCommand
{
	use SymfonyStyleTrait;

	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'vendor:tests';

	/**
	 * Directory within `stubs folder`
	 *
	 * @var string
	 */
	protected string $from = 'tests';
}
