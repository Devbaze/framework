<?php
/**
 * Clear folder with all cached view files
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.2.1
 */

declare(strict_types=1);

namespace Frameworks\Console\Support;

use Frameworks\Console\SymfonyStyleTrait;
use Frameworks\Support\Facades\File;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ClearConfigCache extends Command
{
	use SymfonyStyleTrait;

	/**
	 * The name of the command
	 *
	 * @var string
	 */
	protected static $defaultName = 'config:clear';

	/**
	 * Allow execution in production mode or not
	 *
	 * @return boolean
	 */
	public function notAllowedInProduction() : bool
	{
		return false;
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output ) {

		File::delete( FRAMEWORKS_THEME_CACHED_CONFIG_FILE );

		$this->io->success( 'Configuration file was cleared' );
		return Command::SUCCESS;
	}

}
