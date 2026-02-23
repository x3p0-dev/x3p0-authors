<?php

/**
 * Block registration class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2026, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-authors
 */

declare(strict_types=1);

namespace X3P0\Authors\Block;

/**
 * Registers the `x3p0/authors` block type with WordPress.
 */
class BlockRegistrar
{
	/**
	 * Filename of the blocks manifest.
	 */
	private const MANIFEST_FILENAME = 'manifest.php';

	/**
	 * Sets the path where the built blocks are stored.
	 */
	public function __construct(protected readonly string $path)
	{}

	/**
	 * Boots the component, running its actions/filters.
	 */
	public function boot(): void
	{
		add_action('init', $this->register(...));
		add_action('rest_api_init', $this->registerRestFields(...));
	}

	/**
	 * Registers the block with WordPress.
	 */
	private function register(): void
	{
		wp_register_block_types_from_metadata_collection(
			$this->path,
			"{$this->path}/" . self::MANIFEST_FILENAME
		);

		wp_set_script_translations(
			generate_block_asset_handle('x3p0/authors', 'editorScript'),
			'x3p0-authors'
		);
	}

	/**
	 * Registers custom REST API fields needed for the block data.
	 */
	private function registerRestFields(): void
	{
		register_rest_field('user', 'x3p0_authors_post_count', [
			'get_callback' => fn($user) => count_user_posts($user['id'], 'post', true),
			'schema' => [
				'description' => __('Number of published posts by user', 'x3p0-authors'),
				'type'	=> 'integer',
			]
		]);
	}
}
