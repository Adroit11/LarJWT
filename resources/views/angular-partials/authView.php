<div class="col-md-4">
	<div class="well">
		
		<h3>Login</h3>

		<div class="alert alert-danger" ng-if="auth.loginError">				
			<strong> There was an error: </strong>{{ auth.loginErrorText }}
			<br>Please go back and try again
		</div>

		<form>
			
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Email" ng-model="auth.email">
			</div>

			<div class="form-group">
				
				<input type="password" class="form-control" placeholder="Password" ng-model="auth.password">

			</div>

			<button class="btn btn-primary" ng-click="auth.login()">Submit</button>

		</form>

	</div>

</div>