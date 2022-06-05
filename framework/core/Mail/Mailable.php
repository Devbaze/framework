<?php
/**
 * Mailable abstract class
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Frameworks\Mail;

abstract class Mailable
{
	use MailableTrait;

	abstract public function build();
}
