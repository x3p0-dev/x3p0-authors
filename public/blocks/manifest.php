<?php
// This file is generated. Do not modify it manually.
return array(
	'authors' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 2,
		'name' => 'x3p0/authors',
		'version' => '20250921',
		'title' => 'Authors',
		'category' => 'widgets',
		'keywords' => array(
			'authors',
			'list',
			'users'
		),
		'icon' => 'comments',
		'description' => 'Displays a list of post authors.',
		'attributes' => array(
			'showFeed' => array(
				'type' => 'boolean',
				'default' => false
			),
			'showPostCount' => array(
				'type' => 'boolean',
				'default' => true
			),
			'hideEmpty' => array(
				'type' => 'boolean',
				'default' => false
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
			'anchor' => false,
			'align' => true,
			'html' => false,
			'__experimentalBorder' => array(
				'radius' => true,
				'color' => true,
				'width' => true,
				'style' => true,
				'__experimentalDefaultControls' => array(
					'width' => true,
					'color' => true
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
			'spacing' => array(
				'margin' => true,
				'padding' => true,
				'__experimentalDefaultControls' => array(
					'padding' => true
				)
			),
			'typography' => array(
				'fontSize' => true,
				'lineHeight' => true,
				'__experimentalFontStyle' => true,
				'__experimentalFontWeight' => true,
				'__experimentalFontFamily' => true,
				'__experimentalTextTransform' => true,
				'__experimentalDefaultControls' => array(
					'fontSize' => true,
					'__experimentalFontFamily' => true,
					'__experimentalFontStyle' => true,
					'__experimentalFontWeight' => true
				)
			)
		),
		'textdomain' => 'x3p0-list-authors',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'example' => array(
			
		)
	)
);
