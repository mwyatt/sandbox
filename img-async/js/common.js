$ = require('jquery');
require('foo/bar');

var $image = $('img');
var $imageNew = $('<img>');
$imageNew.on('load', function(event) {
  $image.attr('src', $(this).attr('src'));
});
$imageNew.attr('src', 'http://cdn.lightgalleries.net/4bd5ec0f44d0a/images/stock_photography163-2.jpg');