<!DOCTYPE html>
<html>
<head>
	<title>ToDo</title>
</head>
<body>
<input type="text" name="todoName" id="todoName" placeholder="Enter ToDo name"><button type="button" id="addTodo">Add</button>

<div id="todoList">
	<ul>
	</ul>
</div>

<footer>
	ToDo by <a href="http://wasil.org">wasilak</a>&copy;
</footer>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo URI; ?>/assets/js/underscore-min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo URI; ?>/assets/js/backbone.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo URI; ?>/assets/js/models/Todo.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo URI; ?>/assets/js/models/TodoList.js" type="text/javascript" charset="utf-8"></script>

<script src="<?php echo URI; ?>/assets/js/views/Todo.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo URI; ?>/assets/js/views/TodoList.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">

	$(document).ready(function()
	{
		var todoList = new TodoList();

		function initList()
		{
			var todoListView = new TodoListView({collection: todoList, el: $("#todoList ul")});
			todoList.fetch();
		}

		initList();

		$('#addTodo').click(function()
		{
			var todoDetails = {name: $('#todoName').val()};

			var todo = new TodoModel();

			todo.save(todoDetails, {
		        success: function (todo) {
		    		todoList.add(todo);
		        },
		        error: function(todo) {
		        }
		    });
		});

	});
</script>
</body>
</html>