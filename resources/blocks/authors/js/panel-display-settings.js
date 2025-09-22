/**
 * Display settings panel.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-authors
 */

import {
	ToggleControl,
	__experimentalToolsPanel as ToolsPanel,
	__experimentalToolsPanelItem as ToolsPanelItem,
} from '@wordpress/components';

import { __ } from '@wordpress/i18n';

export default ({
	attributes: {
		showFeed,
		showPostCount
	},
	setAttributes
}) => (
	<ToolsPanel
		label={ __('Display settings', 'x3p0-authors') }
		className="wp-block-x3p0-authors-panel__display-settings"
		resetAll={ () => setAttributes({
			showFeed: false,
			showPostCount: false
		}) }
	>
		<ToolsPanelItem
			label={ __('Show feed', 'x3p0-authors') }
			isShownByDefault
			hasValue={ () => !! showFeed }
			onDeselect={ () => setAttributes({ showFeed: false }) }
		>
			<ToggleControl
				label={ __('Show feed link', 'x3po-list-users') }
				checked={ showFeed }
				onChange={ (value) => setAttributes({
					showFeed: value
				}) }
				__nextHasNoMarginBottom={ true }
			/>
		</ToolsPanelItem>
		<ToolsPanelItem
			label={ __('Show post count', 'x3p0-authors') }
			isShownByDefault
			hasValue={ () => !! showPostCount }
			onDeselect={ () => setAttributes({ showPostCount: false }) }
		>
			<ToggleControl
				label={ __('Show post count', 'x3po-list-users') }
				checked={ showPostCount }
				onChange={ (value) => setAttributes({
					showPostCount: value
				}) }
				__nextHasNoMarginBottom={ true }
			/>
		</ToolsPanelItem>
	</ToolsPanel>
);
