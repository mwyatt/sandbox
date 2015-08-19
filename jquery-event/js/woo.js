var Woo = function () {
  this.bar = 10;
};

Woo.prototype.setBar = function(value) {
  this.bar = value;
};

Woo.prototype.getBar = function() {
  return this.bar;
};

module.exports = Woo;
