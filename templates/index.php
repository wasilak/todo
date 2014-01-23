<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Todo</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

    <!-- Custom styles for this template -->
    <link href="<?php echo URI; ?>/assets/bootstrap/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>

    <link href="<?php echo URI; ?>/assets/iCheck/skins/square/aero.css" rel="stylesheet">

    <link href="<?php echo URI; ?>/assets/css/style.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
        <!-- <div class="row">
            <div class="col-lg-4 col-sm-3 hidden-xs">
                <a href="#" class="title"><h3 class="text-muted">Your todos</h3></a>
            </div>
            <div class="col-lg-8 col-sm-9 col-xs-12">
                <ul class="nav nav-pills pull-right mainNavigation">
                    <li class="active" id="homeNav"><a href="#list">Home</a></li>
                    <li id="aboutNav"><a href="#about">About</a></li>
                    <li id="contactNav"><a href="#contact">Contact</a></li>
                </ul>
            </div>
        </div> -->

        <!-- <div class="tab-content"> -->
          <div class="tab-pane active" id="list">
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        <div class="row">
                            <div class="col-lg-8 col-sm-8 col-xs-12">
                                <input type="text" name="todoName" id="todoName" class="form-control" placeholder="new todo...">
                            </div>
                            <div class="col-lg-2 col-sm-2 col-xs-6">
                                <input type="text" name="todoDueDate" id="todoDueDate" class="form-control datepicker" placeholder="due...">
                            </div>
                            <div class="col-lg-2 col-sm-2 col-xs-6">
                                <button type="button" id="addTodo" class="btn btn-success btn-sm btn-block pull-right">Add</button>
                            </div>

                        </div>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div id="todoList">
                        <div class="loader">
                            <img src="assets/ajax-loader.gif" alt="">
                        </div>
                        <div class="list-group"></div>
                    </div>
                </div>
            </div>
          </div>
          <!-- <div class="tab-pane" id="about">
              About :)
          </div>
          <div class="tab-pane" id="contact">
              Contact :)
          </div>
        </div> -->

        <div class="footer">
            Todo by &copy; <a href="http://wasil.org">wasilak</a> <?php echo date("Y"); ?>
        </div>

    </div> <!-- /container -->

    <script id="todoTemplate" type="text/template">
    	<input type="checkbox" class="checkTodo" <%= checked %> />
        <span class="editTodoLink"><%= name %></span>
        <button type="button" class="btn btn-danger btn-xs pull-right removeTodoLink">delete</button>
        <% if (dueDate) {
          date = moment(dueDate).calendar(); %>
          <span class="dueContainer"><span class="due"> due </span><a href="#" class="dateCombo todoDate" data-type="combodate" data-value="<%= dueDate %>" data-title="Select date"><%= date %></a></span>
        <% } else { %>
          <span class="dueContainer addDue"><span class="due"> add </span><a href="#" class="dateCombo todoDate" data-type="combodate" data-value="<%= moment() %>" data-title="Select date">due date</a></span>
        <% } %>
    </script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script src="<?php echo URI; ?>/assets/js/underscore-min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo URI; ?>/assets/js/backbone.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo URI; ?>/assets/js/bootstrap-datepicker.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo URI; ?>/assets/js/moment-with-langs.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo URI; ?>/assets/iCheck/icheck.min.js" type="text/javascript" charset="utf-8"></script>

    <script src="<?php echo URI; ?>/assets/js/models/Todo.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo URI; ?>/assets/js/models/TodoList.js" type="text/javascript" charset="utf-8"></script>

    <script src="<?php echo URI; ?>/assets/js/views/Todo.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?php echo URI; ?>/assets/js/views/TodoList.js" type="text/javascript" charset="utf-8"></script>

    <script src="<?php echo URI; ?>/assets/js/router.js" type="text/javascript" charset="utf-8"></script>

    <script src="<?php echo URI; ?>/assets/js/app.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript" charset="utf-8">
        $(document).ready(function()
        {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                weekStart: 1,
                autoclose: true,
                todayHighlight: true
            });

            moment.lang('en', {
                calendar: {
                    lastDay: '[Yesterday ]',
                    sameDay: '[Today ]',
                    nextDay: '[Tomorrow ]',
                    lastWeek: '[last] dddd []',
                    nextWeek: 'dddd []',
                    sameElse: 'L'
                }
            });

            $.fn.editable.defaults.mode = 'inline';

            $.fn.editableform.buttons =
                        '<button type="button" class="btn btn-default btn-sm editable-cancel"><i class="glyphicon glyphicon-remove"></i></button> ' +
                        '<button type="submit" class="btn btn-success btn-sm editable-submit"><i class="glyphicon glyphicon-ok"></i></button>';

            app.init();
        });
    </script>
  </body>
</html>
