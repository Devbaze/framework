<?php
/**
 * Copy files and directories
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.7.8
 */

declare(strict_types=1);

namespace Frameworks\Console\Vendors;

use Frameworks\Support\Facades\File;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VendorCommand extends Command
{

	/**
	 * Stubs directory
	 *
	 * @var string
	 */
	protected string $stubs = FRAMEWORKS_FRAMEWORK_PATH . '/stubs/';

	/**
	 * Where files should be put
	 *
	 * @var string
	 */
	protected string $to = FRAMEWORKS_APP_PATH;

	/**
	 * Allow execution in production mode or not
	 *
	 * @return boolean
	 */
	public function notAllowedInProduction() : bool
	{
		return true;
	}

	/**
	 * @inheritDoc
	 */
	protected function execute( InputInterface $input, OutputInterface $output )
	{
		File::copyDirectory( $this->stubs . $this->from, $this->to );

		$this->io->success( 'Vendor files published' );
		return Command::SUCCESS;
	}
}
