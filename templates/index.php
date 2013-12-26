
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
		<div class="header">
	        <ul class="nav nav-pills pull-right">
	        	<li class="active"><a href="#">Home</a></li>
	        	<li><a href="#">About</a></li>
	        	<li><a href="#">Contact</a></li>
	        </ul>
	        <h3 class="text-muted">Your todos</h3>
	    </div>

		<div class="row">
			<div class="col-lg-12">
				<p>
				    <div class="row">
				    	<div class="col-lg-10">
			    			<input type="text" name="todoName" id="todoName" class="form-control" placeholder="new todo...">
				    	</div>
				    	<div class="col-lg-2">
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

	    <div class="footer">
			Todo by &copy; <a href="http://wasil.org">wasilak</a> <?php echo date("Y"); ?>
	    </div>

    </div> <!-- /container -->


    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

	<script src="<?php echo URI; ?>/assets/js/underscore-min.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo URI; ?>/assets/js/backbone.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo URI; ?>/assets/iCheck/icheck.min.js" type="text/javascript" charset="utf-8"></script>

	<script src="<?php echo URI; ?>/assets/js/models/Todo.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo URI; ?>/assets/js/models/TodoList.js" type="text/javascript" charset="utf-8"></script>

	<script src="<?php echo URI; ?>/assets/js/views/Todo.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo URI; ?>/assets/js/views/TodoList.js" type="text/javascript" charset="utf-8"></script>


	<script type="text/javascript" charset="utf-8">

		$(document).ready(function()
		{
			$.fn.editable.defaults.mode = 'inline';

			var todoList = new TodoList();

			function initList()
			{
				var todoListView = new TodoListView({collection: todoList, el: $("#todoList div.list-group")});
				todoList.fetch({
					success: function()
					{
						$('#todoList .loader').fadeOut('fast', function()
							{
								$('#todoList .list-group').fadeIn();
							}
						);
					}
				});
			}

			initList();

			$('#addTodo').click(function()
			{
				var inputField = $('#todoName');

				var todoDetails = {name: inputField.val()};

				var todo = new TodoModel();

				todo.save(todoDetails, {
			        success: function (todo)
			        {
			    		todoList.add(todo);
			    		inputField.val('');
			        },
			        error: function(todo)
			        {
			        }
			    });
			});
		});
	</script>
  </body>
</html>
