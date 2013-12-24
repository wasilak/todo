var TodoView = Backbone.View.extend({
  tagName: 'a',
  className: 'list-group-item',
  events: {
    'click button.removeTodoLink': 'removeTodo'
  },
  initialize: function()
  {
    this.model.on('change', this.render, this);
    this.model.on('destroy', this.remove, this);
  },
  render: function()
  {
    var html = '<span class="editTodoLink">' + this.model.get('name') + '</span> '+
                '<!--<span class="badge">14</span>-->'+
                '<button type="button" class="btn btn-danger btn-xs pull-right removeTodoLink">delete</button>';
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
