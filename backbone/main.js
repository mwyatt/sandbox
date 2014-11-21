(function($) {
	var item = 



	var ListView = Backbone.View.extend({
		el: $('body'),
		events: {
			'click .button-add': 'addItem'
		},
		initialize: function() {
			_.bindAll(this, 'render', 'addItem');
			this.counter = 0;
			this.render();
		},
		render: function() {
			$(this.el).append('<span class="button-add">Add</span>');
			$(this.el).append('<ul class="fill-me"></ul>');
		},
		addItem: function() {
			this.counter ++;
			$('.fill-me', this.el).append('<li>hello world ' + this.counter + '</li>');
		}
	});
	var listView = new ListView();
})(jQuery);
