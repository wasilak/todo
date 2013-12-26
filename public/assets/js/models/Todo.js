var TodoModel = Backbone.Model.extend({
      urlRoot: 'todos',
      defaults: {
          completed: 0
      }
  });
