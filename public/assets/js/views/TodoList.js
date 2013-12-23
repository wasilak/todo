var TodoListView = Backbone.View.extend({
  tagName: 'ul',
  initialize: function()
  {
    this.collection.on('add', this.addOne, this);
    this.collection.on('reset', this.render, this);
  },
  render: function()
  {
    this.addAll();
  },
  addOne: function(todoItem)
  {
    var todoView = new TodoView({model: todoItem});
    todoView.render();
    this.$el.append(todoView.el);
  },
  addAll: function() {
    this.collection.forEach(this.addOne, this);
  }
});
