<?php
/**
 * Terms query
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Frameworks\Support\Builders;

use Timber\Timber;

trait TermsQuery
{

	/**
	 * Get terms
	 *
	 * @param string|array|null $args
	 * @param array $maybe
	 * @return mixed
	 */
	public function terms( $args = null, array $maybe = [] ) : mixed
	{
		$args['taxonomy'] = $this->classMap::TAXONOMY;
		return Timber::get_terms( $args, $maybe, $this->classMap );
	}
}
