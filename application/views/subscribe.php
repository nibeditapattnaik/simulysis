<section id="sub-header">
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<h1>Enrol</h1>
			<p class="lead boxed">Register for course here.</p>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
<div class="divider_top"></div>
</section><!-- End sub-header -->
  
<section id="main_content" >
<div class="container">
<div class="row">
	<div class="col-md-4">
            <h4>Terms and Conditions</h4>
                <ul>
                    <li>The fees include the registration/ enrolment charges.</li>
                    <li>The registration fees is not refundable.</li> 
                    <li>The request to alter the course or schedule can only be accommodated based on availability of capacity.</li>
                    <li>You need to pay the balance fees before the course commencement.</li> 
                    <li>If for any  any unavoidable circumstance the course is getting cancelled, the registration fees will be duly refunded.</li>
                </ul>
     
      <hr>
      <a href="<?php echo base_url("courses");?>" class="button_medium_outline">Browse Courses</a>
        
	</div>
    
	<div class="col-md-8">
		<div class=" box_style_2">
			<span class="tape"></span>
			<div class="row">
				<div class="col-md-12">
					<h3>Your personal info</h3>
				</div>
			</div>
			<div id="message-apply"></div>
			<form method="post" action="" id="contactform_apply1">
				<div class="row">
          <p id="fnameError" style="display:none" class="error text-danger">Please Enter Your First Name.</p>
					<div class="col-md-6 col-sm-6">
            
						<div class="form-group">
							<input type="text" class="form-control style_2" id="name_apply" name="firstname" placeholder="Name">
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" class="form-control style_2" id="lastname_apply" name="lname" placeholder="Last Name">
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
				</div>
				<div class="row">        
            <p id="emailError" style="display:none" class="error text-danger">Please Enter Email.</p>
            <p id="phoneError" style="display:none" class="error text-danger">Please Enter Phone Number.</p>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="email" id="email_apply" name="email" class="form-control style_2" placeholder="Enter Email">
                            <span class="input-icon"><i class="icon-email"></i></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" id="phone_apply" name="phone" class="form-control style_2" placeholder="Enter Phone number">
                            <span class="input-icon"><i class="icon-phone"></i></span>
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<div class="styled-select">
								<select class="form-control" name="city" id="country_apply">
									<option value="" selected>Select your city</option>
									<option value="Bangalore">Bangalore</option>
									<option value="Chennai">Chennai</option>
									<option value="Hyderabad">Hyderabad</option>
									<option value="Pune">Pune</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
                        <div class="styled-select">
								<select class="form-control" name="gender" id="gender_apply">
									<option value="" selected>Select your gender</option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
						</div>
					</div>
				</div>
                
                <div class="row">
                <div class="col-md-6 col-sm-6">
                		<div class="form-group">
						<div class="styled-select">
								<select class="form-control" name="education" id="education_apply">
									<option value="" selected>Select your education level</option>
									<option value="BE/B-Tech">BE/B-Tech</option>
									<option value="M-Tech">M-Tech</option>
                  <option value="Other">Other</option>
								</select>
							</div>
                            </div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<input type="text" name="age" id="age_apply"  class="form-control" placeholder="Age">
                            <span class="input-icon"><i class="icon-user"></i></span>
						</div>
					</div>
				</div>
        <div class="row">
                <div class="col-md-6 col-sm-6">
                		<div class="form-group">
						    <div class="styled-select">
								<select class="form-control" name="branch" id="branch_apply">
									<option value="" selected>Select your branch</option>
									<option value="Mechanical">Mechanical</option>
									<option value="Civil">Civil</option>
                  <option value="Aero">Aero</option>
									<option value="Automobile">Automobile</option>
                  <option value="Other">Other</option>
								</select>
							</div>
            </div>
					</div>
          <div class="col-md-6 col-sm-6">
          <div class="form-group">
							<input type="text" name="group_id" id=""  class="form-control" placeholder="group Id">
              <span class="input-icon"><i class="icon-key"></i></span>
						</div>
        </div>
				</div>
                
                <hr>
                <h3>Your preferences</h3>
                <p>Which course are you interested? <a href="<?php echo base_url("courses");?>">Browse course</a>.</p>
                
                <div class="row">
					<div class="col-md-6 col-sm-6">
            <p id="courseError" style="display:none" class="error text-danger">Please Select a course.</p>
                    <div class="form-group">
                    <div class="styled-select">
								<select class="form-control" name="course" id="course_apply">
									<option value="">Select your a course</option>
                  <?php 
                  foreach($allCourses as $course)
                  {
                    $selected = isset($selectedcourse) && ($selectedcourse == $course->id) ? "selected" : "";
                  ?>
									<option value="<?php echo $course->id;?>" <?php echo $selected;?>><?php echo $course->course_name ." - ".$course->course_location."-".$course->start_date ."({$course->course_display_id})";?></option>
									<?php } ?>
								</select>
							</div>
                           </div>
				</div>
        <div class="col-md-6 col-sm-6">
          <div class="form-group">
							<input type="text" name="course_id" disabled id=""  class="form-control" placeholder="Course Id">
                            <span class="input-icon"><i class="icon-key"></i></span>
						</div>
        </div>
                </div>
                
              <div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<textarea rows="5" id="message_apply_2" name="message" class="form-control" placeholder="Additional message" style="height:150px;"></textarea>
						</div>
					</div>
				</div>
                
                <div class="row">
					<div class="col-md-6">
						
				</div>
                <div class="col-md-6">
						<div class="form-group pull-right">
							<input type="button" value="Enrol At 1000/- INR Only" class=" button_subscribe_green" id="buy"/>              
              <img id="gifLoader" style="display:none;" src="<?php echo base_url("design/img/preload.gif");?>">
					</div>
				</div>
                </div>
			</form>
			<form action="" method="post" id="payment_form">
			  <input type="hidden" name="encRequest">
			  <input type="hidden" name="access_code">
			</form>
		</div>
	</div>
</div>
</div>
</section>