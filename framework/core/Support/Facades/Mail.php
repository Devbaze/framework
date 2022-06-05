<?php
/**
 * \Frameworks\Mail\Mailer facade
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.7.0
 */

declare(strict_types=1);

namespace Frameworks\Support\Facades;

/**
 * @method static $this to( string|array $mailTo )
 * @method static $this subject( string $subject )
 * @method static $this message( string $message )
 * @method static $this template( string|array $template, array $ctx = [] )
 * @method static $this headers( $headers = '' )
 * @method static $this attachments( $attachments = [] )
 * @method static $this mailable( $mailer )
 * @method static $this send()
 *
 * @see \Frameworks\Mail\Mailer
 */
class Mail extends AbstractFacade
{
	protected static function accessor()
	{
		return FRAMEWORKS_MAIL_FACTORY_KEY;
	}
}
