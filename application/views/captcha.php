<!DOCTYPE html>
<html>
<head>
	<title>Captcha in Codeigniter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<section>
<div class="container">
<div class="card">
<div class="card-body">
<h4>Register</h4>
<hr>
<?php
if($this->session->flashdata('error')!='')
{
	echo $this->session->flashdata('error');
}
?>
	<form method="post" action="<?php echo base_url('home/registerSubmit');?>">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control">
		</div>
		<div class="form-group">
			<label>Captcha</label>
			<br>
			<?php echo $captcha_image;?>
		</div>
		<div class="form-group">
			<label>Enter Captcha Text</label>
			<input type="text" name="captcha" class="form-control" required>
		</div>
		<input type="submit" name="submit" class="btn btn-primary">
	</form>
</div>
</div>

</div>
</section>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>