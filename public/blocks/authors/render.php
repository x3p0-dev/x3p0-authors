<?php

/**
 * Block render.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-authors
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

use X3P0\Authors\Block\Type\Authors;

/**
 * @global array    $attributes Block attributes.
 * @global string   $content    The block content.
 * @global WP_Block $block      Block instance.
 */
// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
echo (new Authors())->render(
	attributes: $attributes,
	content:    $content,
	block:      $block
);
// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped
