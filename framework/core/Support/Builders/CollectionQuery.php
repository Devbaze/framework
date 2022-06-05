<?php
/**
 * Collection query
 *
 * @package Frameworks
 * @subpackage Devbaze
 * @since 1.4.2
 */

declare(strict_types=1);

namespace Frameworks\Support\Builders;

trait CollectionQuery
{
	/**
	 * Retrieve posts
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function collect()
	{
		$this->collection = collect( $this->getPosts() );
		return $this->collection;
	}
}

