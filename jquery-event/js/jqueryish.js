var qwery = require('qwery');
var bonzo = require('bonzo');

module.exports = function (selector) {
  return bonzo(qwery(selector));
};
