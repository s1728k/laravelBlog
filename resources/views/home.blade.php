<!DOCTYPE html>
<html>
<head>
	<title>welcome</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<form>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					  <label for="country">country:</label>
					  <select class="form-control" id="country" name="country_id" onchange="submit_form()">
					  	@foreach($countries as $country)
					  	@if(isset($_GET['country_id']))
					  	<option value="{{$country->id}}" @if($country->id ==  $_GET['country_id'] ) selected @endif>{{$country->name}}</option>
					  	@else
					  	<option value="{{$country->id}}">{{$country->name}}</option>
					  	@endif
					  	@endforeach
					  </select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label for="state">state:</label>
					  <select class="form-control" id="state" name="state_id" onchange="submit_form()">
					  	@foreach($states as $state)
					  	@if(isset($_GET['state_id']))
					  	<option value="{{$state->id}}" @if($state->id == $_GET['state_id']) selected @endif>{{$state->name}}</option>
					  	@else
					  	<option value="{{$state->id}}">{{$state->name}}</option>
					  	@endif
					  	@endforeach
					  </select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
					  <label for="city">city:</label>
					  <select class="form-control" id="city">
					  	@foreach($cities as $city)
					  	<option value="{{$city->id}}">{{$city->name}}</option>
					  	@endforeach
					  </select>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script>
		function submit_form(){
			$("form").submit();
		}
	</script>
</body>
</html>