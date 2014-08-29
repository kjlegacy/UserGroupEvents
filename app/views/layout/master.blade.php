<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Database</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	{{ HTML::style('style.css') }}
</head>
<body>
	@if(Session::has('error'))
    	<div class="alert alert-danger" role="alert"><span class="global" style="text-align: center; font-size: 30px;"><p>{{ Session::get('error') }}</p></span></div>
    @endif
	<div class="content">
		@yield('content')
	</div>

	<script>
		$( "#show-users" ).click(function() {
		  $( ".name-toggle" ).toggle( "slow", function() {
		    // Animation complete.
		  });
		});

		$( "#show-subgroups" ).click(function() {
		  $( ".subgroup-toggle" ).toggle( "slow", function() {
		    // Animation complete.
		  });
		});

		$( "#show-groups" ).click(function() {
		  $( ".group-toggle" ).toggle( "slow", function() {
		    // Animation complete.
		  });
		});

		$( "#show-event-subgroups" ).click(function() {
		  $( ".event-sub-toggle" ).toggle( "slow", function() {
		    // Animation complete.
		  });
		});
	</script>
</body>
</html>