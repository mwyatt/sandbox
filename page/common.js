var page = require('page');

var user = {
    single: function(ctx) {
        console.log(ctx.params.id);
    }
};
page.base('/sandbox/page');
page('/', index);
page('/about/', okfoo);
page('/user/:id', user.single);
function index () {
    console.log('index');
}
function okfoo () {
    console.log('okfoo');
}
page();
