/**
 * Block edit.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2022-2025, Justin Tadlock
 * @link      https://github.com/x3p0-dev/x3p0-authors
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// WordPress dependencies.
import { Placeholder, Spinner } from '@wordpress/components';

import { pin } from '@wordpress/icons';

import {
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';

import { store }     from '@wordpress/core-data';
import { useSelect } from '@wordpress/data';
import { __ }        from '@wordpress/i18n';

import { SVG, Path } from '@wordpress/primitives';

import QuerySettingsPanel from './panel-query-settings';
import DisplaySettingsPanel from './panel-display-settings';

const feedIcon = (
	<SVG xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px">
		<Path d="M200-120q-33 0-56.5-23.5T120-200q0-33 23.5-56.5T200-280q33 0 56.5 23.5T280-200q0 33-23.5 56.5T200-120Zm480 0q0-117-44-218.5T516-516q-76-76-177.5-120T120-680v-120q142 0 265 53t216 146q93 93 146 216t53 265H680Zm-240 0q0-67-25-124.5T346-346q-44-44-101.5-69T120-440v-120q92 0 171.5 34.5T431-431q60 60 94.5 139.5T560-120H440Z"/>
	</SVG>
);

/**
 * Exports the block edit function.
 */
export default function Edit({attributes, setAttributes}) {
	const {
		number,
		order,
		orderby,
		hasPublishedPosts,
		showFeed,
		showPostCount
	} = attributes;

	// Get users based on the attributes.
	const {users, isResolving} = useSelect((select) => {
		const queryArgs = {
			per_page: number,
			context:  'view',
			order:    order,
			orderby:  orderby
		};

		if (true === hasPublishedPosts) {
			queryArgs.has_published_posts = [ 'post' ];
		}

		return {
			users: select(store).getUsers(queryArgs),
			isResolving: select(store).isResolving('getUsers', [queryArgs])
		};
	}, [
		number,
		order,
		orderby,
		hasPublishedPosts,
	]);

	const blockProps = useBlockProps();

	const feedLink = (
		<a href="#author-feed-pseudo-link" onClick={ (e) => e.preventDefault() }>
			{ feedIcon }
		</a>
	);

	const userListItems = users && users.map((user) => {
		const authorLink = (
			<a
				className="wp-block-x3p0-authors__link"
				href={ user.link }
				onClick={ (e) => e.preventDefault() }
			>
				{ user.name }
			</a>
		);

		const authorMeta = (showFeed || showPostCount) && (
			<span className="wp-block-x3p0-authors__meta">
				{showFeed && (
					<span className="wp-block-x3p0-authors__feed">{feedLink}</span>
				)}
				{showPostCount && (
					<span className="wp-block-x3p0-authors__count">({user.x3p0_authors_post_count})</span>
				)}
			</span>
		);

		return (
			<li
				key={`wp-block-x3p0-authors-${user.id}`}
				className="wp-block-x3p0-authors__author"
			>
				<div className="wp-block-x3p0-authors__content">
					{authorLink}
					{authorMeta}
				</div>
			</li>
		);
	});

	return (
		<>
			<InspectorControls group="settings">
				<QuerySettingsPanel
					attributes={attributes}
					setAttributes={setAttributes}
				/>
				<DisplaySettingsPanel
					attributes={attributes}
					setAttributes={setAttributes}
				/>
			</InspectorControls>
			{isResolving && (
				<Placeholder icon={pin} label={__('Authors', 'x3p0-authors')}>
					<Spinner/>
				</Placeholder>
			)}
			{! isResolving && (
				<ul {...blockProps}>
					{userListItems}
				</ul>
			)}
		</>
	);
}
