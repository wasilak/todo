var TodoListView = Backbone.View.extend({
  tagName: 'ul',
  initialize: function()
  {
    this.collection.on('add', this.changed, this);
    this.collection.on('reset', this.render, this);
    this.collection.on('change:dueDate', this.changed, this);
    this.collection.on('change:completed', this.changed, this);
  },
  render: function()
  {
    this.addAll();
  },
  addOne: function(todoItem)
  {
    var todoView = new TodoView({model: todoItem});
    todoView.render();
    var html = $(todoView.el);
    this.$el.append(html);
    html.fadeIn('fast').css("display","block");
  },
  addAll: function() {
    this.collection.forEach(this.addOne, this);
  },
  changed: function()
  {
    this.collection.sort();
    $(this.$el).empty();
    this.render();
  }
});
