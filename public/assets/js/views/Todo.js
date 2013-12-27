var TodoView = Backbone.View.extend({
  tagName: 'a',
  className: 'list-group-item',
  events: {
    'click button.removeTodoLink': 'removeTodo',
    'click input.checkTodo': 'checkTodo'
  },
  editable : false,
  initialize: function()
  {
    this.model.on('change', this.render, this);
    this.model.on('destroy', this.remove, this);
    this.model.on('remove', this.remove, this);
  },
  render: function()
  {
    var checked = '';
    if (1 == this.model.get('completed')) {
      checked = 'checked="checked"';
      $(this.el).addClass(' completed');
    } else {
      $(this.el).removeClass(' completed');
    }

    var date = moment(this.model.get('createdAt').date);

    var html = '<input type="checkbox" class="checkTodo" ' + checked + ' />'+
                '<span class="editTodoLink">' + this.model.get('name') + '</span> '+
                '<button type="button" class="btn btn-danger btn-xs pull-right removeTodoLink">delete</button>'+
                '<span class="todoDate pull-right">' + date.calendar() + '</span> ';
    $(this.el).html(html);

    this.editTodo(this.model, checked);
    // this.initICheck();
  },
  initICheck: function()
  {
    var $this = this;
    $(this.el).find('input.checkTodo').iCheck({
      checkboxClass: 'icheckbox_square-aero',
      radioClass: 'iradio_square-aero'
    }).on('ifChecked', function(event){
      $this.checkOn();
    }).on('ifUnchecked', function(event){
      $this.checkOff();
    });
  },
  removeTodo: function()
  {
    var conf = confirm('Deleting "' + this.model.get('name') + '", are you sure?');
    if (true === conf) {
      this.model.destroy();
    }
  },
  remove: function()
  {
    this.$el.fadeOut("fast", function()
      {
        this.remove();
      });
  },
  editTodo: function(model, checked)
  {
    var disabled = false;
    if ('' !== checked) {
      disabled = true;
    }
    this.editable = $(this.el).find('span.editTodoLink').editable({
        type: 'text',
        title: 'update',
        disabled: disabled,
        success: function(response, newValue) {
            model.set('name', newValue);
            model.save();
        }
    });
  },
  checkTodo: function()
  {
    var checkbox = $(this.el).find('input.checkTodo');
    if (checkbox.is(':checked')) {
      this.checkOn();
    } else {
      this.checkOff();
    }
  },
  checkOn: function()
  {
    this.model.set('completed', 1);
    $(this.el).addClass('completed');
    this.editable.editable('disable');
    this.model.save();
  },
  checkOff: function()
  {
    this.model.set('completed', 0);
    $(this.el).removeClass('completed');
    this.editable.editable('enable');
    this.model.save();
  }
});
