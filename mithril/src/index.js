var m = require('mithril')
var UserList = require('./view/UserList')
var UserForm = require('./view/UserForm')

m.route(document.body, '/list', {
  '/list': UserList,
  '/edit/:id': UserForm,
})
