/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) { 
	var path = 'http://localhost/appsglobe/asset/tools';
	config.filebrowserBrowseUrl = path+'/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = path+'/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = path+'/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = path+'/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = path+'/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = path+'/kcfinder/upload.php?type=flash';
	
	config.toolbar = [
		{ name: 'document', items : [ 'Source'] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		{ name: 'insert', items : [ 'Youtube','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
				 ,'Iframe' ] },
				'/',
		{ name: 'styles', items : [ 'Styles','Format' ] },
		{ name: 'colors',      items : [ 'TextColor','BGColor' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock', '-', 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'tools', items : [ 'Maximize', 'ShowBlocks' ,'-','About' ] }
	];
};