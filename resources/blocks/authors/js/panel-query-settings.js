/**
 * Query settings panel.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-authors
 */

import {
	RangeControl,
	SelectControl,
	ToggleControl,
	__experimentalToolsPanel as ToolsPanel,
	__experimentalToolsPanelItem as ToolsPanelItem,
} from '@wordpress/components';

import { __ } from '@wordpress/i18n';

const ORDERBY_OPTIONS = [
	{ value: "name",            label: __('Name',            'x3p0-authors') },
	{ value: "slug",            label: __('Slug',            'x3p0-authors') },
	{ value: "email",           label: __('Email',           'x3p0-authors') },
	{ value: "id",              label: __('ID',              'x3p0-authors') },
	{ value: "registered_date", label: __('Registered Date', 'x3p0-authors') }
];

const ORDER_OPTIONS = [
	{ value: "asc",  label: __('Ascending',  'x3p0-authors') },
	{ value: "desc", label: __('Descending', 'x3p0-authors') }
];

export default ({
	attributes: {
		number,
		order,
		orderby,
		hasPublishedPosts
	},
	setAttributes
}) => (
	<ToolsPanel
		label={ __('Settings', 'x3p0-authors') }
		className="wp-block-x3p0-authors-panel__query-settings"
		resetAll={ () => setAttributes({
			number:            10,
			orderby:           'name',
			order:             'asc',
			hasPublishedPosts: true
		}) }
	>
		<ToolsPanelItem
			label={ __('Number', 'x3p0-authors') }
			isShownByDefault
			hasValue={ () => 10 !== number }
			onDeselect={ () => setAttributes({ number: 10 }) }
		>
			<RangeControl
				label={ __('Number', 'x3p0-authors') }
				value={ number }
				onChange={ (value) => setAttributes({ number: value }) }
				min="1"
				max="100"
				allowReset={ true }
				initialPosition={ 10 }
				resetFallbackValue={ 10 }
				__next40pxDefaultSize={ true }
				__nextHasNoMarginBottom={ true }
			/>
		</ToolsPanelItem>
		<ToolsPanelItem
			label={ __('Order By', 'x3p0-authors') }
			isShownByDefault
			hasValue={ () => 'name' !== orderby }
			onDeselect={ () => setAttributes({ orderby: 'name' }) }
		>
			<SelectControl
				label={ __('Order By', 'x3p0-authors') }
				selected={ orderby }
				onChange={ (value) => setAttributes({ orderby: value }) }
				options={ ORDERBY_OPTIONS }
				__next40pxDefaultSize={ true }
				__nextHasNoMarginBottom={ true }
			/>
		</ToolsPanelItem>
		<ToolsPanelItem
			label={ __('Order', 'x3p0-authors') }
			isShownByDefault
			hasValue={ () => 'asc' !== order }
			onDeselect={ () => setAttributes({ order: 'asc' }) }
		>
			<SelectControl
				label={ __('Order', 'x3p0-authors') }
				selected={ order }
				onChange={ (value) => setAttributes({ order: value }) }
				options={ ORDER_OPTIONS }
				__next40pxDefaultSize={ true }
				__nextHasNoMarginBottom={ true }
			/>
		</ToolsPanelItem>
		<ToolsPanelItem
			label={ __('Has published posts', 'x3p0-authors') }
			isShownByDefault
			hasValue={ () => ! hasPublishedPosts }
			onDeselect={ () => setAttributes({ hasPublishedPosts: true }) }
		>
			<ToggleControl
				label={ __('Has published posts', 'x3po-authors') }
				checked={ hasPublishedPosts }
				onChange={ (value) => setAttributes({ hasPublishedPosts: value }) }
				__nextHasNoMarginBottom={ true }
			/>
		</ToolsPanelItem>
	</ToolsPanel>
);
