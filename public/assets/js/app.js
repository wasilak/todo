var app = {
  todoList: null,
  todoListView: null,
  router: null,
  init: function() {
    this.initRouter();

    this.todoList = new TodoList();

    this.initList();

    this.setUpdate();

    this.initEvents();
  },
  initRouter: function() {
    this.router = new Router();
    Backbone.history.start();
  },
  setUpdate: function(){
    var $this = this;
    setInterval(function()
        {
          $this.todoList.fetch();
        }, 3000
    );
  },
  addTodo: function() {
    var inputField = $('#todoName');
    var dateField = $('#todoDueDate');

    var name = inputField.val().trim();
    var date = dateField.val().trim();

    if ('' !== name) {
        var todoDetails = {
            name: name,
            dueDate: date
        };

        var todo = new TodoModel();
        var $this = this;
        todo.save(todoDetails, {
            success: function(model, xhr, options)
            {
                $this.todoList.add(model);
                inputField.val('');
                dateField.val('');
            },
            error: function(model, xhr, options)
            {
                // TODO: error handling
            }
        });
    } else {
        // TODO: add better info about empty Todo name
        inputField.val('');
        alert('Todo name cannot be empty :/');
    }
  },
  initList: function() {
      this.todoListView = new TodoListView({collection: this.todoList, el: $('#todoList div.list-group')});
      this.todoList.fetch({
          reset: true,
          success: function()
          {
              $('#todoList .loader').fadeOut('fast', function()
                  {
                      $('#todoList .list-group').fadeIn();
                  }
              );
          }
      });
  },
  initEvents: function() {
    var $this = this;
    $('#todoName, #todoDueDate').on('keypress', function(e) {
        if (e.which == 13) {
            $this.addTodo();
        }
    });

    $('#addTodo').on('click', function()
    {
        $this.addTodo();
    });
  }
};
