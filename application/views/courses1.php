<section id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1>Courses</h1>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
    <div class="divider_top"></div>
    </section><!-- End sub-header -->
    
    
    <section id="main_content">
    	<div class="container">
        
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">About</li>
        </ol>
<input type="text" id="mySubmit" placeholder="Search Here">

<button onclick="myFunction()">Search</button>
<p id="demo"></p>
<script>
function myFunction() {
    var x = document.getElementById("mySubmit").value;
    //<a href="<?php echo base_url("courses/".x);?>" id="active">All Courses</a>
    document.getElementById("demo").innerHTML = x;
}
</script>
            
             <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4">
            <div class="box_style_1">
                <div class="dropdown active megamenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><h4>Categories</h4></a>
            	
            <ul class="dropdown-menu"><li>
										<div class="yamm-content">
											<div class="row-fluid"> 
												<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
													<ul class="box">
                <li><a href="<?php echo base_url("courses/index");?>" id="active">All Courses</a></li>
                <li><a href="<?php echo base_url("courses/feacourses");?>">FEA</a></li>
                <li><a href="<?php echo base_url("courses/cfdcourses");?>">CFD</a></li>
                <li><a href="<?php echo base_url("courses/chennaicourses");?>">Chennai</a></li>
                                                    </ul></div></div></div></li></ul></div></div></div></div>
            <ul>
							<li class="dropdown active megamenu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Ctegories</b></a>
								<ul class="dropdown-menu">
									<li>
										<div class="yamm-content">
											<div class="row-fluid"> 
												<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
													<ul class="box">
										                <li><a href="<?php echo base_url("courses/index");?>" id="active">All Courses</a></li>
                <li><a href="<?php echo base_url("courses/feacourses");?>">FEA</a></li>
                <li><a href="<?php echo base_url("courses/cfdcourses");?>">CFD</a></li>
                <li><a href="<?php echo base_url("courses/chennaicourses");?>">Chennai</a></li>
													</ul>
												</div>
											</div>
										</div>
									</li>
								</ul>
                 </li></ul>
                                
              <section class="background littlebottom">
			<div class="container">
				<div class="relative">
					<div class="section-container">
						<form class="row search_form">
							<!--<div class="col-md-3 col-sm-6">
							    <input type="text" class="form-control" placeholder="Search Words">
							</div>-->
							<div class="col-md-3 col-sm-6">
								<!--<select class="selectpicker form-control" data-style="btn-inverse" data-live-search="true">
						  			<option>Category</option>
						  			<option>CFD</option>
									<option>FEA</option>
							        <option>Soft Computing</option>
							        <option>HVAC</option>
								</select>-->
							</div>
							<div class="col-md-3 col-sm-6">
								<select class="selectpicker form-control" data-style="btn-inverse">
                                    <a href="<?php echo base_url("courses/index");?>">All Courses</a>
                                    <option id="mySubmit">CFD</option>
                                    <option id="mySubmit">HVAC</option>
							        <option id="mySubmit">Soft Coputing</option>
								</select>
							</div>
							<div class="col-md-1 col-sm-6">
								<button type="submit" class="btn btn-default btn-block" >Search</button>
							</div>

						</form>
					</div><!-- end row -->
				</div><!-- end relative -->
			</div><!-- end container -->
		</section><!-- end section-white -->
            <br/>
        <div class="row">
        <aside class="col-lg-3 col-md-4 col-sm-4">
            <div class="box_style_1">
            	<h4>Categories</h4>
            <ul class="submenu-col">
                <li><a href="<?php echo base_url("courses/index");?>" id="active">All Courses</a></li>
                <li><a href="<?php echo base_url("courses/feacourses");?>">FEA</a></li>
                <li><a href="<?php echo base_url("courses/cfdcourses");?>">CFD</a></li>
                <li><a href="<?php echo base_url("courses/chennaicourses");?>">Chennai</a></li>
            </ul>
            
            <hr>
            
            <h5>Course Objective</h5>
            <p>The objective of learning CAE techniques needs to be learning the problem solving approach rather than any particular software. Someone with good idea of the basics of methods, can always adapt any software quickly, as irrespective of how the user interface looks in different software, the core remains same.</p>
            <p>Our courses are designed with the following objectives.</p>
            <ul>
              <li>Help engineering graduates to acquire more practical knowledge of Design and Analysis.</li>
              <li>Provide In depth knowledge in FEM/FEA/CFD practices.</li>
              <li>To spread R&D activities at academic institutes.</li>
            </ul>
            </div>
        </aside>
        
        <div class="col-lg-9 col-md-8 col-sm-8">
        	<div class="row">
        		<?php 
            foreach($allCourses["result"] as $course)
            {
              
          ?>
        <?php 
                $courseDetailsUrl = "Mechanical-course-".$course->course_name."-".$course->course_location;
        ?>
        			<div class="col-lg-4 col-md-6" style="height:581px;">
                            <div class="col-item">
                                <div class="photo">
                                    <a href="<?php echo base_url("coursedetails/index")."/{$course->id}/{$courseDetailsUrl}";?>"><img src="<?php echo base_url("design");?>/courses/<?php echo $course->image;?>" alt="" /></a>
									<div style="position:absolute; top:27%; left:7%; color:white; font-size:10px;"><?php echo $course->days." ({$course->timing})";?></div>
                                    <div class="cat_row"><a href="#"><?php echo $course->course_location;?></a><span class="pull-right"><i class=" icon-clock"></i><?php echo $course->duration;?> Weeks</span></div>
                                </div>
                                <div class="info">
                                    <div class="row">
                                        <div class="course_info col-md-12 col-sm-12">
                                            <h4><?php echo $course->course_name."({$course->course_display_id})";?></h4>
                                            <?php 
                                              $courseSubDesc = strlen($course->course_description) > 200 ? substr($course->course_description,0,200)."..." : $course->course_description;
                                            ?>
                                            <p > <?php echo $courseSubDesc;?> </p>
                                            <div class="rating">
                                            <p><?php echo $course->start_date;?></p>
                                        	</div>
                                            <div class="price pull-right"><?php echo $course->course_price;?> INR</div>
                                        </div>
                                    </div>
                                    <div class="separator clearfix">
                                        <p class="btn-add"> <a href="<?php echo base_url("subscribe/populatecourse")."/{$course->id}";?>"><i class="icon-export-4"></i> Enrol</a></p>
                                        
                                        <p class="btn-details"> <a href="<?php echo base_url("coursedetails/index")."/{$course->id}/{$courseDetailsUrl}";?>"><i class=" icon-list"></i> Details</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php }?>
       		</div><!-- End row -->
        </div><!-- End col-lg-9-->
        
        			
                        
        </div><!-- End row -->
        
        <hr>
        <div class="row">
        	<div class="col-md-12 text-center">
            	<?php echo $allCourses["pagination"];?>
            </div>
        </div>
            	
        </div><!-- End container -->
    </section><!-- End main_content -->