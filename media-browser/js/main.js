var mediaBrowser = {
	container: false,
	file: false,
	directory: false,
	currentPath: '',
	directoryTree: ['media/'],
	attached: false,
	fieldUpload: false,
	uploadFormData: false,

	initialise: function(container) {
		mediaBrowser.container = $(container);
		if (! $(mediaBrowser.container).length) {
			return false;
		};
		mediaBrowser.directory = $(container).find('.directory');
		mediaBrowser.file = $(container).find('.file');
		mediaBrowser.attached = $(container).find('.attached');
		mediaBrowser.getDirectory();
		mediaBrowser.fieldUpload = $('#form_images');
		if (window.FormData) {
	  		mediaBrowser.uploadFormData = new FormData();
	  		document.getElementById("btn").style.display = "none";
		}
	 	$(mediaBrowser.fieldUpload).on("change", mediaBrowser.upload);
	},

	getDirectoryPath: function() {
		var directoryPath = '';
		for (var i = 0; i < mediaBrowser.directoryTree.length; i++) {
			directoryPath += mediaBrowser.directoryTree[i];
		}
		return directoryPath;
	},

	getDirectory: function(directory) {
		$(mediaBrowser.file).html('');
		$(mediaBrowser.directory).html('Loading...');
		directory = typeof directory !== 'undefined' ? directory : '';
		if (directory) {
			mediaBrowser.directoryTree.push(directory);
		};
		var directoryPath = mediaBrowser.getDirectoryPath();
		$.getJSON('browse.php?o[method]=getDirectory&o[action]=' + directoryPath, function(results) {
			if (results) {
				$('label[for="form_images"]').html('Upload to <strong>' + mediaBrowser.getDirectoryPath() + '</strong>')
				$(mediaBrowser.file).html('');
				$(mediaBrowser.directory).html('');
				if (mediaBrowser.directoryTree.length > 1) {
					$(mediaBrowser.directory).append('<a href="#" class="back">Back</a>');
				};
				$(mediaBrowser.directory).append('<p class="bread">' + mediaBrowser.getDirectoryPath() + '</p>');
				if ('directory' in results) {
					$.each(results['directory'], function(index, directory) {
						$(mediaBrowser.directory).append('<a class="folder" data-path="' + directory.basename + '/" title="Enter folder"><span title="Remove folder" class="remove">&times;</span>' + directory.basename + '</a>');
					});
				};
				if ('file' in results) {
					$.each(results['file'], function(index, file) {
						if (file['extension'] == 'pdf') {
							$(mediaBrowser.file).append('<a class="clearfix" data-path="' + file.path + '" title="Attach file"><span class="img"></span><span title="Remove file" class="remove">&times;</span><p>' + file.basename + '</p></a>');
						} else {
							$(mediaBrowser.file).append('<a class="clearfix" data-path="' + file.path + '" title="Attach file"><img src="' + directoryPath + file.basename + '" alt="" width="100"><span title="Remove file" class="remove">&times;</span><p>' + file.basename + '</p></a>');
						}
					});
				};
				$(mediaBrowser.directory).find('a').off().on('click', function() {
					mediaBrowser.getDirectory($(this).data('path'));
				});
				$(mediaBrowser.file).find('a').on('click', function() {
					mediaBrowser.attachFile($(this).data('path'));
				});
				$(mediaBrowser.file).find('.remove').on('click', function() {
					event.stopPropagation();
					mediaBrowser.deleteFile($(this).parent().data('path'));
				});
				$(mediaBrowser.directory).find('.remove').on('click', function(event) {
					event.stopPropagation();
					mediaBrowser.deleteDirectory($(this).parent().data('path'));
				});
				$(mediaBrowser.container).find('.back').off().on('click', mediaBrowser.getPreviousDirectory);
				$(mediaBrowser.directory).append('<div class="new clearfix"><label for="form_create_folder">Create Folder</label><input id="form_create_folder" type="text"><a href="#" class="submit">Create</a></div>');
				$(mediaBrowser.directory).find('.submit').off().on('click', function() {
					mediaBrowser.createDirectory($(mediaBrowser.directory).find('input#form_create_folder').val());
				});
				$(mediaBrowser.directory).find('input').on('keyup', function(e) {
					if (e.keyCode == 13) {
						mediaBrowser.createDirectory($(mediaBrowser.directory).find('input#form_create_folder').val());
					}
				});
			}
		});
	},

	getPreviousDirectory: function() {
		if (mediaBrowser.directoryTree.length > 1) {
			mediaBrowser.directoryTree.splice(-1, 1);
		};
	    mediaBrowser.getDirectory();
	},

	attachFile: function(path) {
		$.getJSON('browse.php?o[method]=getFile&o[action]=' + path, function(result) {
			if (result) {
				if (result['extension'] == 'png' || result['extension'] == 'jpg' || result['extension'] == 'gif') {
					$(mediaBrowser.attached).find('.image').append('<a class="clearfix" href="#" title="Remove attachment"><img src="' + mediaBrowser.getDirectoryPath() + result.basename + '" alt="" width="100">' + result.basename + '</a>');
				}
				if (result['extension'] == 'pdf') {
					$(mediaBrowser.attached).find('.pdf').append('<a class="clearfix" data-path="' + result.path + '" title="Remove attachment"><span class="img"></span><p>' + result.basename + '</p></a>');
				}
			}
			$(mediaBrowser.attached).find('a').off().on('click', function() {
				mediaBrowser.removeFile(this);
			});
		});
	},

	createDirectory: function(folderName) {
		if (/\S/.test(folderName)) {
			$.getJSON('browse.php?o[method]=createDirectory&o[action]=' + mediaBrowser.getDirectoryPath() + folderName + '/', function(results) {
				if (results) {
					mediaBrowser.getDirectory();
				};
			});
		};
	},

	deleteFile: function(filePath) {
		if (confirm('Are you sure you want to remove this file? "' + filePath + '"')) {
			$.getJSON('browse.php?o[method]=deleteFile&o[action]=' + filePath, function(results) {
				if (results) {
					mediaBrowser.getDirectory();
				};
			});
		}
	},

	deleteDirectory: function(directoryPath) {
		if (confirm('Are you sure you want to remove this folder? "' + directoryPath + '". Please note, if the folder is not empty it will not be removed')) {
			$.getJSON('browse.php?o[method]=deleteDirectory&o[action]=' + mediaBrowser.getDirectoryPath() + directoryPath, function(results) {
				if (results) {
					mediaBrowser.getDirectory();
				};
			});
		}
	},

	removeFile: function(button) {
		$(button).remove();
	},

	upload: function() {
 		document.getElementById("response").innerHTML = "Uploading . . ."
 		var i = 0;
 		var len = this.files.length;
 		var img;
 		var reader;
 		var file;
	
		for ( ; i < len; i++ ) {
			file = this.files[i];
			// if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					// reader.onloadend = function (e) { 
					// 	// showUploadedItem(e.target.result, file.fileName);
					// };
					reader.readAsDataURL(file);
				}
				if (mediaBrowser.uploadFormData) {
					mediaBrowser.uploadFormData.append("images[]", file);
				}
			// }	
		}
		if (mediaBrowser.uploadFormData) {
			$.ajax({
				url: "browse.php?directory=" + mediaBrowser.getDirectoryPath(),
				type: "POST",
				data: mediaBrowser.uploadFormData,
				processData: false,
				contentType: false,
				success: function (res) {
					document.getElementById("response").innerHTML = res; 
					mediaBrowser.getDirectory();
					$(mediaBrowser.fieldUpload).remove();
					$('.upload').find('form').prepend('<input id="form_images" type="file" name="images" multiple />');
					mediaBrowser.fieldUpload = $('#form_images');
					mediaBrowser.uploadFormData = new FormData();
					$(mediaBrowser.fieldUpload).on("change", mediaBrowser.upload);
				}
			});
		}
	}
};

function formSubmit() {
	$(this).closest('form').submit();
	return false;
}

$(document).ready(function() {
	less.watch();
	mediaBrowser.initialise('.media-browser');
	$('form').find('a.submit').on('mouseup', formSubmit);
});