var TodoList = Backbone.Collection.extend({
      model: TodoModel,
      url: 'todos',
      comparator: function (model1, model2) {
        var date1 = new Date(model1.get('dueDate'));
        var date2 = new Date(model2.get('dueDate'));
        var completed1 = model1.get('completed');
        var completed2 = model2.get('completed');

        return ((date1 >= date2 && completed1 <= completed2) || (date1 < date2 && completed1 < completed2)) ? -1 : 1;
      }
    });
