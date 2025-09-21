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
	private ?array $post_counts = null;

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

		wp_localize_script(
			generate_block_asset_handle('x3p0/authors', 'editorScript'),
			'x3p0ListAuthors',
			[
				'count' => $this->getPostCounts()
			]
		);
        }

	/**
	 * Returns an array of user IDs (keys) with number of posts published
	 * (values). Users without posts are not returned.
	 */
	private function getPostCounts(): array
	{
		global $wpdb;

		if ( ! is_null( $this->post_counts ) ) {
			return $this->post_counts;
		}

		// @todo Cache this, bust on `save_post`.
		$this->post_counts = [];

		$results = (array) $wpdb->get_results(
			"SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE " . get_private_posts_cap_sql( 'post' ) . ' GROUP BY post_author'
		);

		foreach ($results as $row) {
			$this->post_counts[$row->post_author] = $row->count;
		}

		return $this->post_counts;
	}
}
