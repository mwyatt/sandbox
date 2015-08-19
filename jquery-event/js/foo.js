// module which needs to be modified

module.exports = {
  height: 100,
  setHeight: function(value) {
    this.height = value;
  },
  doSomething: function(passed) {
    return 'foo ' + passed + ' ' + this.height;
  }
};
