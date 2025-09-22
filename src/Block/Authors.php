<?php
/**
 * Block class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @link      https://github.com/x3p0-dev/x3p0-list-authors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace X3P0\Authors\Block;

use WP_User_Query;

/**
 * Used for handling the front-end rendering of the `x3p0/authors` block.
 */
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
			'showFeed'          => false,
			'showPostCount'     => true,
			'hasPublishedPosts' => true,
			'number'            => 10,
			'order'             => 'asc',
			'orderby'           => 'name'
		]);

		$query = new WP_User_Query([
			'has_published_posts' => $this->attributes['hasPublishedPosts'] ? [ 'post' ] : null,
			'number'              => $this->attributes['number'],
			'order'               => $this->attributes['order'],
			'orderby'             => $this->attributes['orderby']
		]);

		// Bail early if there are no results.
		if (! $users = $query->get_results()) {
			return '';
		}

		$html = '';

		foreach ($users as $user) {
			$author = sprintf(
				'<a href="%s" class="wp-block-x3p0-authors__link">%s</a>',
				esc_url(get_author_posts_url($user->ID)),
				esc_html($user->display_name)
			);

			if ($this->attributes['showFeed']) {
				$author .= sprintf(
					' <span class="wp-block-x3p0-authors__feed">(<a href="%s">%s</a>)</span>',
					esc_url(get_author_feed_link($user->ID)),
					esc_html__('Feed', 'x3p0-list-authors')
				);
			}

			if ($this->attributes['showPostCount']) {
				$author .= sprintf(
					' <span class="wp-block-x3p0-authors__count">(%s)</span>',
					esc_html(count_user_posts($user->ID, 'post', true))
				);
			}

			$html .= sprintf(
				'<li class="wp-block-x3p0-authors__author"><div class="wp-block-x3p0-authors__content">%s</div></li>',
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
