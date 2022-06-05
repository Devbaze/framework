<?php
/**
 * Trait to use SymfonyStyle in an input/output
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.7.4
 */


declare(strict_types=1);

namespace Frameworks\Console;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

trait SymfonyStyleTrait
{
	/**
	 * Symfony Style
	 *
	 * @var SymfonyStyle
	 */
	protected SymfonyStyle $io;

	protected function initialize( InputInterface $input, OutputInterface $output)
    {
		$this->io = new SymfonyStyle( $input, $output );
    }
}
