# Authors List Block

![Author list shown in the WordPress content canvas.](/.wporg/banner-1544x500.png)

A WordPress block that outputs a list of post authors.

## Theme Support

### Styles (`theme.json`)

The block supports the full array of design tools available, so you can also style these just like most other Core WordPress blocks via `styles.blocks.x3p0/authors` in `theme.json`. Here's an example:

```json
{
	"styles": {
		"blocks": {
			"x3p0/authors": {
				"color": {
					"text": "var(--wp--custom--color--foreground--default)"
				},
				"typography": {
					"fontSize": "var(--wp--preset--font-size--md)",
					"lineHeight": "var(--wp--custom--line-height--md)"
				}
			}
		}
	}
}
```

### Custom Block Stylesheet

An alternative to the `theme.json` method (or in addition to), you can load a block-specific stylesheet and work with plain ol' CSS. Here's an example of loading a `themeslug/public/css/blocks/x3p0-authors.css` stylesheet:

```php
add_action('init', function() {
	wp_enqueue_block_style('x3p0/authors', [
		'handle' => 'themeslug-block-x3p0-authors',
		'src'    => get_theme_file_uri('public/css/blocks/x3p0-authors.css'),
		'path'   => get_theme_file_path('public/css/blocks/x3p0-authors.css')
	]);
});
```

And some CSS to overwrite the default custom CSS properties:

```css
.wp-block-x3p0-authors {
	/* Write some custom CSS. */
}
```

## Copyright and License

X3P0: Authors is licensed under the [GNU GPL](https://www.gnu.org/licenses/gpl-3.0.html), version 3 or later.

2022-2025 &copy; [Justin Tadlock](http://justintadlock.com).
