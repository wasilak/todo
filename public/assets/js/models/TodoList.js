var TodoList = Backbone.Collection.extend({
      model: TodoModel,
      url: 'todos',
      comparator: function(todo)
      {
        var dateCreated = new Date(todo.get('createdAt'));

        if (todo.get('dueDate')) {
          var date = new Date(todo.get('dueDate'));
          return -date.getTime();
          // return [-dateCreated.getTime(), -date.getTime()];
        }
        // else {
        //   return -dateCreated.getTime();
        // }
        return false;
      }
    });
