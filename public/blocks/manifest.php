<?php
// This file is generated. Do not modify it manually.
return array(
	'authors' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'x3p0/authors',
		'version' => '20250921',
		'title' => 'Authors',
		'category' => 'widgets',
		'keywords' => array(
			'authors',
			'list',
			'users'
		),
		'description' => 'Displays a list of post authors.',
		'textdomain' => 'x3p0-authors',
		'editorScript' => 'file:./index.js',
		'render' => 'file:./render.php',
		'attributes' => array(
			'showFeed' => array(
				'type' => 'boolean',
				'default' => false
			),
			'showPostCount' => array(
				'type' => 'boolean',
				'default' => false
			),
			'hasPublishedPosts' => array(
				'type' => 'boolean',
				'default' => true
			),
			'number' => array(
				'type' => 'integer',
				'default' => 10
			),
			'order' => array(
				'type' => 'string',
				'default' => 'asc'
			),
			'orderby' => array(
				'type' => 'string',
				'default' => 'name'
			)
		),
		'supports' => array(
			'anchor' => true,
			'align' => true,
			'html' => false,
			'__experimentalBorder' => array(
				'radius' => true,
				'color' => true,
				'width' => true,
				'style' => true,
				'__experimentalDefaultControls' => array(
					'radius' => true,
					'color' => true,
					'width' => true,
					'style' => true
				)
			),
			'color' => array(
				'gradients' => true,
				'link' => true,
				'__experimentalDefaultControls' => array(
					'background' => true,
					'text' => true
				)
			),
			'shadow' => true,
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalTextTransform' => true
			)
		),
		'example' => array(
			
		)
	)
);
