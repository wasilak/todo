var TodoView = Backbone.View.extend({
  tagName: 'li',
  initialize: function()
  {
    this.model.on('change', this.render, this);
  },
  render: function()
  {
    var html = this.model.get('name');
    $(this.el).html(html);
  }
});
