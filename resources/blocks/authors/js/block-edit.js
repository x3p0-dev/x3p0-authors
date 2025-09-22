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

import QuerySettingsPanel from './panel-query-settings';
import DisplaySettingsPanel from './panel-display-settings';

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
	const { users, isResolving } = useSelect((select) => {
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
			{ __('Feed', 'x3p0-authors') }
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

		const authorFeed = showFeed && (
			<> <span className="wp-block-x3p0-authors__feed">({ feedLink })</span></>
		);

		const authorPostCount = showPostCount && (
			<> <span className="wp-block-x3p0-authors__count">({ user.x3p0_authors_post_count })</span></>
		);

		return (
			<li
				key={ `wp-block-x3p0-authors-${user.id}` }
				className="wp-block-x3p0-authors__author"
			>
				<div className="wp-block-x3p0-authors__content">
					{ authorLink }
					{ authorFeed }
					{ authorPostCount }
				</div>
			</li>
		);
	});

	return (
		<>
			<InspectorControls group="settings">
				<QuerySettingsPanel
					attributes={ attributes }
					setAttributes={ setAttributes }
				/>
				<DisplaySettingsPanel
					attributes={ attributes }
					setAttributes={ setAttributes }
				/>
			</InspectorControls>
			{ isResolving && (
				<Placeholder icon={ pin } label={ __('Authors', 'x3p0-authors') }>
					<Spinner />
				</Placeholder>
			) }
			{ ! isResolving && (
				<ul { ...blockProps }>
					{ userListItems }
				</ul>
			) }
		</>
	);
}
