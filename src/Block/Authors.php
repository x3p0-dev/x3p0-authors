<?php
/**
 * Block registration class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022, Justin Tadlock
 * @link      https://github.com/x3p0-dev/x3p0-list-authors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace X3P0\Authors\Block;

use WP_User_Query;

class Authors
{
	/**
	 * Sets up object state.
	 */
	public function __construct(protected array $attributes)
	{}

	/**
	 * Renders the block on the front end.
	 */
	public function render(): string
	{
		$this->attributes = wp_parse_args($this->attributes, [
			'showFeed'      => false,
			'showPostCount' => true,
			'hideEmpty'     => false,
			'number'        => 10,
			'order'         => 'asc',
			'orderby'       => 'name'
		]);

		$query_args = [
			'number'  => $this->attributes['number'],
			'order'   => $this->attributes['order'],
			'orderby' => $this->attributes['orderby']
		];

		//$counts = $this->getPostCounts();

		if ( $this->attributes['hideEmpty'] ) {
			$query_args['has_published_posts'] = [
				'post'
			];
		}

		// `wp_list_authors()` is a hot mess on output, making it hard
		// for themers to style it, so we're just rolling our own thing.
		$users = new WP_User_Query( $query_args );

		// Bail early if there are no results.
		if ( ! $users->results ) {
			return '';
		}

		$html = '';

		foreach ( $users->results as $user ) {
			$author = sprintf(
				'<a href="%s" class="wp-block-x3p0-list-authors__link">%s</a>',
				get_author_posts_url( $user->ID ),
				esc_html( $user->display_name )
			);

			if ( $this->attributes['showFeed'] ) {
				$author .= sprintf(
					' <span class="wp-block-x3p0-list-authors__feed">(<a href="%s">%s</a>)</span>',
					get_author_feed_link( $user->ID ),
					__( 'Feed', 'x3p0-list-authors' )
				);
			}

			if ( $this->attributes['showPostCount'] ) {
				$author .= sprintf(
					' <span class="wp-block-x3p0-list-authors__count">(%s)</span>',
					esc_html(count_user_posts($user->ID, 'post', true))
				);
			}

			$html .= sprintf(
				'<li class="wp-block-x3p0-list-authors__item"><div class="wp-block-x3p0-list-authors__content">%s</div></li>',
				$author
			);
		}

		// Return the formatted block output.
		return sprintf(
			'<ul %s>%s</ul>',
			get_block_wrapper_attributes(),
			$html
		);
	}
}
