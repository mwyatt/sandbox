var mediaBrowser = {
	container: false,
	file: false,
	directory: false,
	currentPath: '',
	directoryTree: ['media/'],
	attached: false,

	initialise: function(container) {
		mediaBrowser.container = $(container);
		if (! $(mediaBrowser.container).length) {
			return false;
		};
		mediaBrowser.directory = $(container).find('.directory');
		mediaBrowser.file = $(container).find('.file');
		mediaBrowser.attached = $(container).find('.attached');
		mediaBrowser.getDirectory();
	},

	getDirectory: function(directory) {
		var directoryRequest = '';
		directory = typeof directory !== 'undefined' ? directory : '';
		if (directory) {
			mediaBrowser.directoryTree.push(directory);
		};
		for (var i = 0; i < mediaBrowser.directoryTree.length; i++) {
			directoryRequest += mediaBrowser.directoryTree[i];
		};
		$.getJSON('browse.php?o[method]=getDirectory&o[action]=' + directoryRequest, function(results) {
			if (results) {
				directoryRequest += directory;
				$(mediaBrowser.file).html('');
				$(mediaBrowser.directory).html('');
				$(mediaBrowser.directory).append('<a href="#" class="back">Back</a>');
				$(mediaBrowser.container).find('.back').on('click', mediaBrowser.getPreviousDirectory);
				if ('directory' in results) {
					$.each(results['directory'], function(index, directory) {
						$(mediaBrowser.directory).append('<a data-directory="' + directory.basename + '/">' + directory.basename + '</a>');
					});
					$(mediaBrowser.directory).find('a').on('click', function() {
						mediaBrowser.getDirectory($(this).data('directory'));
					})
				};
				if ('file' in results) {
					$.each(results['file'], function(index, file) {
						$(mediaBrowser.file).append('<a data-path="' + file.path + '">' + file.basename + '</a>');
					});
					$(mediaBrowser.file).find('a').on('click', function() {
						mediaBrowser.attachFile($(this).data('path'));
					})
				};
			}
		});
	},

	getPreviousDirectory: function(directory) {
		for (var i = 0; i < mediaBrowser.directoryTree.length; i++) {
			if (i == mediaBrowser.directoryTree.length - 1) {
				mediaBrowser.directoryTree.pop();
			    mediaBrowser.getDirectory();
			};
		};
	},

	attachFile: function(path) {
		$.getJSON('browse.php?o[method]=getFile&o[action]=' + path, function(results) {
			if (results) {
				if (results['extension'] == 'png' || results['extension'] == 'jpg' || results['extension'] == 'gif') {
					$(mediaBrowser.attached).find('.image').append('<p><img src="' + results.guid + '" alt="" width="100">' + path + '</p>');
				}
				if (results['extension'] == 'pdf') {
					$(mediaBrowser.attached).find('.pdf').append('<p>' + path + '</p>');
				}
				$(mediaBrowser.attached).find('p').off().on('click', function() {
					mediaBrowser.removeFile(this);
				});
			}
		});
	},

	removeFile: function(button) {
		$(button).remove();
	}
}

$(document).ready(function() {
	less.watch();
	mediaBrowser.initialise('.media-browser');
});