var TodoView = Backbone.View.extend({
  template: _.template($('#todoTemplate').html()),
  tagName: 'a',
  className: 'list-group-item',
  events: {
    'click button.removeTodoLink': 'removeTodo',
    'click input.checkTodo': 'checkTodo'
  },
  editable : false,
  initialize: function()
  {
    this.listenTo(this.model, 'change', this.render);
    this.listenTo(this.model, 'remove', this.remove);
  },
  render: function()
  {
    if (1 == this.model.get('completed')) {
      this.checked = 'checked="checked"';
      $(this.el).addClass(' completed');
    } else {
      this.checked = '';
      $(this.el).removeClass(' completed');
    }

    var dueDate = this.model.get('dueDate');
    var date = '';
    var dateCombo = '';

    $(this.el).html(this.template({
      name: this.model.get('name'),
      checked: this.checked,
      dueDate: dueDate
    }));

    this.editTodo(this.model);
    // this.initICheck();
    this.initDateCombo(this.model);
  },
  initDateCombo: function(model)
  {
    var disabled = false;
    if ('' !== this.checked) {
      disabled = true;
    }
    $(this.el).find('a.dateCombo').editable({
        // mode: 'popup',
        format: 'YYYY-MM-DD',
        viewformat: 'DD.MM.YYYY',
        template: 'D MMMM YYYY',
        disabled: disabled,
        combodate: {
                minYear: 2000,
                maxYear: 2015,
                minuteStep: 1
           },
        success: function(response, newValue)
        {
            model.set('dueDate', newValue.format("YYYY-MM-DD"));
            model.save();
        }
    });
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
  editTodo: function(model)
  {
    var disabled = false;
    if ('' !== this.checked) {
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
