var TodoView = Backbone.View.extend({
  tagName: 'li',
  events: {
    'click span.removeTodoLink': 'removeTodo'
  },
  initialize: function()
  {
    this.model.on('change', this.render, this);
    this.model.on('destroy', this.remove, this);
  },
  render: function()
  {
    var html = this.model.get('name') + ' <span class="removeTodoLink">remove</>';
    $(this.el).html(html);
  },
  removeTodo: function()
  {
    var conf = confirm("Are you sure?");
    if (true === conf) {
      this.model.destroy();
    }
  },
  remove: function(){
    this.$el.remove();
  }
});
