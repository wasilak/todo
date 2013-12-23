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
    var html = '<span class="editTodoLink">' + this.model.get('name') + '</span> <span class="removeTodoLink">remove</>';
    $(this.el).html(html);

    this.editTodo(this.model);
  },
  removeTodo: function()
  {
    var conf = confirm("Are you sure?");
    if (true === conf) {
      this.model.destroy();
    }
  },
  remove: function()
  {
    this.$el.remove();
  },
  editTodo: function(model)
  {
    $(this.el).find('span.editTodoLink').editable({
        type: 'text',
        title: 'update',
        success: function(response, newValue) {
            model.set('name', newValue);
            model.save();
        }
    });
  }
});
