/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    // config.height = '500px';
    config.language = 'vi';
    config.entities = false;
    config.basicEntities = false;
    config.extraPlugins = 'glyphicons,fontawesome';
    config.allowedContent = true;
    config.height = '450';
    config.autoGrow_minHeight = 250;
    config.autoGrow_maxHeight = 400;
    
    config.stylesSet = 'mystyles:'+CKEDITOR.getUrl('styles/mystyles/styles.js');
    config.contentsCss = [
        CKEDITOR.getUrl('../../../../default/css/bootstrap.min.css'),
        CKEDITOR.getUrl('../../../../default/css/font-awesome.min.css'),
        CKEDITOR.getUrl('styles/mystyles/contents.css')
    ];
    
    config.filebrowserBrowseUrl        = CKEDITOR.getUrl('../kcfinder/browse.php?opener=ckeditor&type=files');
    config.filebrowserImageBrowseUrl   = CKEDITOR.getUrl('../kcfinder/browse.php?opener=ckeditor&type=images');
    config.filebrowserFlashBrowseUrl   = CKEDITOR.getUrl('../kcfinder/browse.php?opener=ckeditor&type=flash');
    config.filebrowserUploadUrl        = CKEDITOR.getUrl('../kcfinder/upload.php?opener=ckeditor&type=files');
    config.filebrowserImageUploadUrl   = CKEDITOR.getUrl('../kcfinder/upload.php?opener=ckeditor&type=images');
    config.filebrowserFlashUploadUrl   = CKEDITOR.getUrl('../kcfinder/upload.php?opener=ckeditor&type=flash');
};

CKEDITOR.on( 'dialogDefinition', function( ev ) {
	var dialogName = ev.data.name;
	var dialogDefinition = ev.data.definition;
	if ( dialogName == 'image' ) {
		var advTab = dialogDefinition.getContents( 'advanced' );
		var classField = advTab.get( 'txtGenClass' );
		classField['default'] = 'img-responsive center-block lazy';
	}
    if (dialogName == 'table' || dialogName == 'tableProperties') {

    var info = dialogDefinition.getContents('info');

    // Remove fields
    var cellSpacing = info.remove('txtCellSpace');
    var cellPadding = info.remove('txtCellPad');
    var border = info.remove('txtBorder');
    var width = info.remove('txtWidth');
    var height = info.remove('txtHeight');
    var align = info.remove('cmbAlign');

    dialogDefinition.removeContents('advanced');
    
    dialogDefinition.addContents( {
        id: 'advanced',
        label: 'Advanced',
        accessKey: 'A',
        elements: [
            {
                type: 'select',
                id: 'selClass',
                label: 'Select the table class',
                items: [ [ 'table' ], [ 'table table-striped'], [ 'table table-bordered'], [ 'table table-hover'], [ 'table table-condensed'] ],
                'default': 'table',
                setup: function(a) {
                    this.setValue(a.getAttribute("class") ||
                    "")
                },
                commit: function(a, d) {
                    this.getValue() ? d.setAttribute("class", this.getValue()) : d.removeAttribute("class")
                }
            }
        ]
    });
  }
});
CKEDITOR.dtd.$removeEmpty['span'] = false;