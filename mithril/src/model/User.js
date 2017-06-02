var m = require('mithril')
var User = {}

User.list = []
User.current = {}

User.loadList = function() {
  return m.request({
    url: "https://rem-rest-api.herokuapp.com/api/users",
    withCredentials: true,
  })
  .then(function(result) {
    User.list = result.data
  })
}

User.load = function(id) {
  return m.request({
    method: "GET",
    url: "https://rem-rest-api.herokuapp.com/api/users/:id",
    data: {id: id},
    withCredentials: true,
  })
  .then(function(result) {
    User.current = result
  })
}

User.save = function() {
  return m.request({
    method: 'put',
    url: "https://rem-rest-api.herokuapp.com/api/users/:id",
    data: User.current,
    withCredentials: true,
  })
}

module.exports = User
