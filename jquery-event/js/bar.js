// module which does not need to be modified can be like this
var foo = 10;

function doSomething (bar) {
  return foo + bar;
}

$(document).on('click', function() {
  console.log(foo);
});

module.exports = {
  setFoo: function(value) {
    foo = value;
  },
  getFoo: function() {
    return foo;
  }
};
