<?php

/**
 * Plugin Name:       X3P0: Authors
 * Plugin URI:        https://github.com/x3p0-dev/x3p0-authors
 * Description:       Adds a block for listing post authors.
 * Version:           1.0.0-alpha
 * Requires at least: 6.8
 * Requires PHP:      8.0
 * Author:            Justin Tadlock
 * Author URI:        https://justintadlock.com
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       x3p0-authors
 */

declare(strict_types=1);

namespace X3P0\Authors;

# Prevent direct access.
defined('ABSPATH') || exit;

# Load classes and files.
require_once 'src/Block/Register.php';
require_once 'src/Block/Authors.php';

# Bootstrap the plugin.
add_action(
	'plugins_loaded',
	fn() => (new Block\Register(__DIR__ . '/public/blocks'))->boot(),
	PHP_INT_MIN
);
