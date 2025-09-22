<?php

/**
 * Block registration class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-authors
 */

declare(strict_types=1);

namespace X3P0\Authors\Block;

/**
 * Registers the `x3p0/authors` block type with WordPress.
 */
class Register
{
	/**
	 * Sets up object state.
	 */
	public function __construct(protected string $path)
	{}

	/**
	 * Boots the component, running its actions/filters.
	 */
	public function boot(): void
	{
		add_action('init', [$this, 'register']);
		add_action('rest_api_init', [$this, 'registerRestFields']);
	}

	/**
	 * Registers the block with WordPress.
	 */
	public function register(): void
	{
		wp_register_block_types_from_metadata_collection(
			$this->path,
			"{$this->path}/manifest.php"
		);

		wp_set_script_translations(
			generate_block_asset_handle('x3p0/authors', 'editorScript'),
			'x3p0-authors'
		);
	}

	/**
	 * Registers custom REST API fields needed for the block data.
	 */
	public function registerRestFields(): void
	{
		register_rest_field('user', 'x3p0_authors_post_count', [
			'get_callback' => function($user) {
				return count_user_posts($user['id'], 'post', true);
			},
			'schema' => [
				'description' => __('Number of published posts by user', 'x3p0-authors'),
				'type'	=> 'integer',
			]
		]);
	}
}
