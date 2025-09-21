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

	public function registerRestFields(): void
	{
		register_rest_field('user', 'x3p0_authors_post_count', array(
			'get_callback' => function($user) {
				return count_user_posts($user['id'], 'post', true);
			},
			'schema' => [
				'description' => __('Number of published posts by user', 'x3p0-authors'),
				'type'        => 'integer',
			],
		));
	}
}
