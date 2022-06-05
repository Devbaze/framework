<?php
/**
 * Console commands loader
 * Returns an array of all available commands
 *
 * @package Frameworks-core
 * @since 1.1.0
 */

declare(strict_types=1);

namespace Frameworks;

use Frameworks\Console\Files\MakeCommand;
use Frameworks\Console\Support\ClearViewCache;
use Frameworks\Console\Support\GenerateSalts;
use Frameworks\Console\Vendors\CopyTestsVendor;
use Frameworks\Console\Vendors\CopyDockerVendor;
use Frameworks\Console\Files\MakeMail;
use Frameworks\Console\Files\MakeHook;
use Frameworks\Console\Files\MakeRule;
use Frameworks\Console\Files\MakeRequest;
use Frameworks\Console\Files\MakeProvider;
use Frameworks\Console\Files\MakeTemplate;
use Frameworks\Console\Files\MakeController;
use Frameworks\Console\Files\MakeMiddleware;
use Frameworks\Console\Files\MakeModelTaxonomy;
use Frameworks\Console\Files\MakeModelPostType;
use Frameworks\Console\Files\MakeCustomizerPanel;
use Frameworks\Console\Files\MakeCustomizerSection;
use Frameworks\Console\Files\MakeMenu;
use Frameworks\Console\Support\CacheConfig;
use Frameworks\Console\Support\ClearConfigCache;

class Commands
{
	/**
	 * Array of available console commands
	 *
	 * @var array
	 */
	private static array $commands = [
		MakeController::class,
		MakeProvider::class,
		MakeMiddleware::class,
		MakeMail::class,
		MakeModelPostType::class,
		MakeModelTaxonomy::class,
		MakeCustomizerPanel::class,
		MakeCustomizerSection::class,
		MakeRequest::class,
		MakeRule::class,
		MakeHook::class,
		MakeTemplate::class,
		MakeMenu::class,
		MakeCommand::class,
		ClearViewCache::class,
		ClearConfigCache::class,
		CacheConfig::class,
		GenerateSalts::class,
		CopyDockerVendor::class,
		CopyTestsVendor::class,
	];

	/**
	 * Get all console commands list
	 *
	 * @return array
	 */
	public function __invoke() {
		return static::$commands;
	}
}
