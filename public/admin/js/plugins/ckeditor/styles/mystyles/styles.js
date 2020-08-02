/**
 * Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// This file contains style definitions that can be used by CKEditor plugins.
//
// The most common use for it is the "stylescombo" plugin, which shows a combo
// in the editor toolbar, containing all styles. Other plugins instead, like
// the div plugin, use a subset of the styles on their feature.
//
// If you don't have plugins that depend on this file, you can simply ignore it.
// Otherwise it is strongly recommended to customize this file to match your
// website requirements and design properly.

CKEDITOR.stylesSet.add( 'mystyles', [
	/* Block Styles */

	// These styles are already available in the "Format" combo ("format" plugin),
	// so they are not needed here by default. You may enable them to avoid
	// placing the "Format" combo in the toolbar, maintaining the same features.
	/*
	{ name: 'Paragraph',		element: 'p' },
	{ name: 'Heading 1',		element: 'h1' },
	{ name: 'Heading 2',		element: 'h2' },
	{ name: 'Heading 3',		element: 'h3' },
	{ name: 'Heading 4',		element: 'h4' },
	{ name: 'Heading 5',		element: 'h5' },
	{ name: 'Heading 6',		element: 'h6' },
	{ name: 'Preformatted Text',element: 'pre' },
	{ name: 'Address',			element: 'address' },
	*/

	{
		name: 'Block primary',
		element: 'div',
        attributes: {
			'class': 'bg-primary'
		},
		styles: {
			'padding': '10px;',
			'margin-bottom': '10px'
		}
	},
    {
		name: 'Block info',
		element: 'div',
        attributes: {
			'class': 'bg-info'
		},
		styles: {
			'padding': '10px',
			'margin-bottom': '10px'
		}
	},
    {
		name: 'Block success',
		element: 'div',
        attributes: {
			'class': 'bg-success'
		},
		styles: {
			'padding': '10px',
			'margin-bottom': '10px'
		}
	},
    {
		name: 'Block warning',
		element: 'div',
        attributes: {
			'class': 'bg-warning'
		},
		styles: {
			'padding': '10px',
			'margin-bottom': '10px'
		}
	},
    {
		name: 'Block danger',
		element: 'div',
        attributes: {
			'class': 'bg-danger'
		},
		styles: {
			'padding': '10px',
			'margin-bottom': '10px'
		}
	},

	/* Inline Styles */

	// These are core styles available as toolbar buttons. You may opt enabling
	// some of them in the Styles combo, removing them from the toolbar.
	// (This requires the "stylescombo" plugin)
	/*
	{ name: 'Strong',			element: 'strong', overrides: 'b' },
	{ name: 'Emphasis',			element: 'em'	, overrides: 'i' },
	{ name: 'Underline',		element: 'u' },
	{ name: 'Strikethrough',	element: 'strike' },
	{ name: 'Subscript',		element: 'sub' },
	{ name: 'Superscript',		element: 'sup' },
	*/

	{ name: 'Big',				element: 'big' },
	{ name: 'Small',			element: 'small' },
	{ name: 'Typewriter',		element: 'tt' },

	{ name: 'Computer Code',	element: 'code' },
	{ name: 'Keyboard Phrase',	element: 'kbd' },
	{ name: 'Sample Text',		element: 'samp' },
	{ name: 'Variable',			element: 'var' },

	{ name: 'Deleted Text',		element: 'del' },
	{ name: 'Inserted Text',	element: 'ins' },

	{ name: 'Cited Work',		element: 'cite' },
	{ name: 'Inline Quotation',	element: 'q' },

	{ name: 'Language: RTL',	element: 'span', attributes: { 'dir': 'rtl' } },
	{ name: 'Language: LTR',	element: 'span', attributes: { 'dir': 'ltr' } },

	/* Object Styles */

	{
		name: 'Responsive image',
		element: 'img',
		attributes: { 'class': 'img-responsive center-block' }
	},

	{
		name: 'Thumbnail image',
		element: 'img',
		attributes: { 'class': 'thumbnail center-block' }
	},
    
    {
		name: 'Thumbnail responsive image',
		element: 'img',
		attributes: { 'class': 'img-responsive thumbnail center-block' }
	},
    
    {
		name: 'Large primary button',
		element: 'a',
		attributes: { 'class': 'btn btn-lg btn-primary' }
	},
    
    {
		name: 'Large info button',
		element: 'a',
		attributes: { 'class': 'btn btn-lg btn-info' }
	},
    
    {
		name: 'Large success button',
		element: 'a',
		attributes: { 'class': 'btn btn-lg btn-success' }
	},
    
    {
		name: 'Large warning button',
		element: 'a',
		attributes: { 'class': 'btn btn-lg btn-warning' }
	},
    
    {
		name: 'Large danger button',
		element: 'a',
		attributes: { 'class': 'btn btn-lg btn-danger' }
	},
    
    {
		name: 'Middle primary button',
		element: 'a',
		attributes: { 'class': 'btn btn-md btn-primary' }
	},
    
    {
		name: 'Middle info button',
		element: 'a',
		attributes: { 'class': 'btn btn-md btn-info' }
	},
    
    {
		name: 'Middle success button',
		element: 'a',
		attributes: { 'class': 'btn btn-md btn-success' }
	},
    
    {
		name: 'Middle warning button',
		element: 'a',
		attributes: { 'class': 'btn btn-md btn-warning' }
	},
    
    {
		name: 'Middle danger button',
		element: 'a',
		attributes: { 'class': 'btn btn-md btn-danger' }
	},
    
    {
		name: 'Small primary button',
		element: 'a',
		attributes: { 'class': 'btn btn-sm btn-primary' }
	},
    
    {
		name: 'Small info button',
		element: 'a',
		attributes: { 'class': 'btn btn-sm btn-info' }
	},
    
    {
		name: 'Small success button',
		element: 'a',
		attributes: { 'class': 'btn btn-sm btn-success' }
	},
    
    {
		name: 'Small warning button',
		element: 'a',
		attributes: { 'class': 'btn btn-sm btn-warning' }
	},
    
    {
		name: 'Small danger button',
		element: 'a',
		attributes: { 'class': 'btn btn-sm btn-danger' }
	},

	{
		name: 'Bordered table',
		element: 'table',
		attributes: {
			'class': 'table table-bordered'
		}
	},
    {
		name: 'Borderless table',
		element: 'table',
		attributes: {
			'class': 'table'
		}
	},

	{
		name: 'Hover row table',
		element: 'table',
		attributes: {
			'class': 'table table-bordered table-hover'
		}
	},
	{ name: 'Square Bulleted List',	element: 'ul',		styles: { 'list-style-type': 'square' } }
] );

