<section id="login_bg">
<div  class="container">
<div class="row">
	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
		<div id="login">
			<p class="text-center">
				<img src="img/login_logo.png" alt="">
			</p>
			<hr>
			<form action="<?php echo base_url("signin/login");?>" method="post">
            <div class="row">
            <div class="col-md-6 col-sm-6 login_social">
				<a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
			</div>
			<div class="col-md-6 col-sm-6 login_social">
				<a href="#" class="btn btn-info btn-block "><i class="icon-twitter"></i>Twitter</a>
			</div>
			</div> <!-- end row -->
			<div class="login-or"><hr class="hr-or"><span class="span-or">or</span></div>
       
				<div class="form-group">
					<input type="text" class=" form-control " placeholder="Username" name="username">
					<span class="input-icon"><i class=" icon-user"></i></span>
				</div>
				<div class="form-group" style="margin-bottom:5px;">
					<input type="password" class=" form-control" placeholder="Password" style="margin-bottom:5px;" name="password">
					<span class="input-icon"><i class="icon-lock"></i></span>
				</div>
        <?php
          if(isset($error))
          {
        ?>
        <p><?php echo $error;?></p>
          <?php } ?>
				<button class="btn btn-success" type="submit">Log in</button>
			</form>
		</div>
	</div>
</div>
</div>
</section>