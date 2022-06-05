<?php
/**
 * Hook interface
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.8.7
 */

declare(strict_types=1);

namespace Frameworks\Hooks;

interface Hookable
{
	public function init();
}
