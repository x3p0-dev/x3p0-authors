<?php

/**
 * Block class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-authors
 */

declare(strict_types=1);

namespace X3P0\Authors\Block\Type;

use WP_Block;
use WP_User_Query;
use X3P0\Authors\Block\Block;

/**
 * Used for handling the front-end rendering of the `x3p0/authors` block.
 */
class Authors implements Block
{
	/**
	 * Stores the feed icon.
	 */
	private const FEED_ICON = '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M200-120q-33 0-56.5-23.5T120-200q0-33 23.5-56.5T200-280q33 0 56.5 23.5T280-200q0 33-23.5 56.5T200-120Zm480 0q0-117-44-218.5T516-516q-76-76-177.5-120T120-680v-120q142 0 265 53t216 146q93 93 146 216t53 265H680Zm-240 0q0-67-25-124.5T346-346q-44-44-101.5-69T120-440v-120q92 0 171.5 34.5T431-431q60 60 94.5 139.5T560-120H440Z"/></svg>';

	/**
	 * Block render callback.
	 */
	public function render(array $attributes, string $content, WP_Block $block): string
	{
		$attributes = wp_parse_args($attributes, [
			'showFeed'          => false,
			'showPostCount'     => true,
			'hasPublishedPosts' => true,
			'number'            => 10,
			'order'             => 'asc',
			'orderby'           => 'name'
		]);

		$query = new WP_User_Query([
			'has_published_posts' => $attributes['hasPublishedPosts'] ? [ 'post' ] : null,
			'number'              => $attributes['number'],
			'order'               => $attributes['order'],
			'orderby'             => $attributes['orderby']
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

			if ($attributes['showFeed'] || $attributes['showPostCount']) {

				$author .= '<span class="wp-block-x3p0-authors__meta">';

				if ($attributes['showFeed']) {
					$author .= sprintf(
						' <a href="%s" class="wp-block-x3p0-authors__feed">%s</a>',
						esc_url(get_author_feed_link($user->ID)),
						self::FEED_ICON
					);
				}

				if ($attributes['showPostCount']) {
					$author .= sprintf(
						' <span class="wp-block-x3p0-authors__count">(%s)</span>',
						esc_html(count_user_posts($user->ID, 'post', true))
					);
				}

				$author .= '</span>';
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
