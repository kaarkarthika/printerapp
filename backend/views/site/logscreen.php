
<?php


$session = Yii::$app->session;
$username=  $session['user_name'];

?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">


	</head>
	<body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box">
				
				<div class="panel-body">
					<form method="post" action="<?php echo Yii::$app->homeUrl; ?>?r=site/logscreen" role="form" class="text-center">
						<div class="user-thumb">
							<img src="ubold/images/shop-cart.jpg" class="img-responsive img-circle img-thumbnail" alt="thumbnail">
						</div>
						<div class="form-group">
							<h3><?php echo $username;?>
								
								
								
							</h3>
							<p class="text-muted">
								Enter your password to access the admin.
							</p>
							<div class="input-group m-t-30">
								<input type="password" class="form-control" placeholder="Password" required="">
								<span class="input-group-btn">
									<button type="submit" class="btn btn-pink w-sm waves-effect waves-light">
										Log In
									</button> 
								</span>
							</div>
						</div>
						
					</form>
       

				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-12 text-center">
					<p>
						Not Chadengle?<a href="page-login.html" class="text-primary m-l-5"><b>Sign In</b></a>
					</p>
				</div>
			</div>

		</div>

		

	</body>
</html>


<script>
	
	$(document).ready(function(){
		
});

</script>