/**
 * Entry point.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @link      https://github.com/x3p0-dev/x3p0-authors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// Import styles.
import './scss/style.scss';

// Import dependencies.
import { registerBlockType } from '@wordpress/blocks';
import metadata              from './block.json';
import icon                  from './js/block-icon';
import edit                  from './js/block-edit';

// Register block type.
registerBlockType(metadata, { icon, edit });
