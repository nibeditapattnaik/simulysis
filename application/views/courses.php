<style>
    .searchfilter {
    background-color: floralwhite;
    width: 600px;
    border: 1px solid black;
    padding: 25px;
    margin: 25px;
}
.dropbtn {
    background-color: snow;
    color: black;
    padding: 12px;
    font-size: 15px;
    width: 170px;
    border: grid;
}

.dropdown {
    position: relative;
    display: inline-block;
}


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
   
    ul{
      list-style-type: none;  
    }

 li:hover {background-color: #ddd}

.dropdown:hover .dropdown-content {
    display:block;
}

.dropdown:hover .dropbtn {
    background-color: lightblue;
}
    #searchfilterbtn{
    
    color: black;
    padding: 8px;
    font-size: 15px;
    width: 140px;
    border: grid;
    
    }
</style>
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
        <!--SEARCH FILTER LOGIC START-->
            <center>
            <div class = "searchfilter">
                <div class = "row">
            
                <div class = "col-sm-3 col-md-3 col-lg-3">
                    <div class = "dropdown">
                        <button class = "dropbtn">Courses</button>
                        <div class = "dropdown-content">
                            <ul>
                        <li><input type = "radio" name = "c1" data-col = "FEA"/>&nbsp;FEA</li>
                        <li><input type = "radio" name = "c1" data-col = "CFD"/>&nbsp;CFD</li>
                        <li><input type = "radio" name = "c1" data-col = "HVAC"/>&nbsp;HVAC</li>
                        <li><input type = "radio" name = "c1" data-col = "Scientific computing"/>&nbsp;Scientific Computing</li></ul></div>
                </div>
            </div>
                <div class = "col-sm-1 col-md-1 col-lg-1"></div>
                <div class = "col-sm-3 col-md-3 col-lg-3">
                    <div class = "dropdown">
                        <button class = "dropbtn">Type</button>
                        <div class = "dropdown-content">
                            <ul>
                        <li><input type = "radio" name = "c2" data-col = "Basic"/>&nbsp;Basic</li>
                        <li><input type = "radio" name = "c2" data-col = "Advance"/>&nbsp;Advance</li>
                       </ul></div>
                </div>
            </div>
             <div class = "col-sm-1 col-md-1 col-lg-1"></div>
                <div class = "col-sm-3 col-md-3 col-lg-3">
                    <div class = "dropdown">
                        <button class = "dropbtn">Mode</button>
                        <div class = "dropdown-content">
                            <ul>
                        <li><input type = "radio" name = "c3" data-col = "Online"/>&nbsp;Online</li>
                        <li><input type = "radio" name = "c3" data-col = "Offline"/>&nbsp;Offline</li>
                       </ul></div>
                </div>
            </div>
            </div> 
                <br/><br/>
            <center>
                <div class = "row">
                <button type = submit id = "searchfilterbtn">SEARCH</button>
                </div>
            </center>
            </div>
            </center>
        <!--SEARCH FILTER LOGIC ENDS HERE-->    
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