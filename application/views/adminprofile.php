<section id="main_content">

<div class="container">

<ol class="breadcrumb">
  <li><a href="index.html">Home</a></li>
  <li class="active">Active page</li>
</ol>
      <div class="row">
         <div class="col-md-12">
     
     				<!--  Tabs -->   
                    <ul class="nav nav-tabs" id="mytabs">
                        <li class="active"><a href="#blog" data-toggle="tab">Blog</a></li>
                        <li><a href="#faq" data-toggle="tab">FAQs</a></li>
                        <li><a href="#subscription" data-toggle="tab">Subscription</a></li>
                        <li><a href="#course" data-toggle="tab">Course</a></li>
                        <li><a href="#courseschedule" data-toggle="tab">Course Schedule</a></li>
                        <li><a href="#dayplan" data-toggle="tab">Day Plan</a></li>
                    </ul>
                    
                    <div class="tab-content">
                      
                        <div class="tab-pane fade in active" id="blog">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="row">
                         
                          <form method="post" action="<?php echo base_url("adminprofile/saveblogdata");?>">
                            <div class="col-md-12">
                            <div class="form-group">
                              <div class="styled-select">
                                <select class="form-control" name="course" id="course_apply">
                                  <option value="">Select your a course</option>
                                  <?php 
                                    foreach($allCourses as $course)
                                    {
                                  ?>
                                      <option value="<?php echo $course->id;?>"><?php echo $course->course_name;?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                              <input type="text" name="title" class="form-control">
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                              <textarea name="content" style="height:300px;" id="area1" class="form-control"></textarea>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group">
                              <button class="btn btn-primary" type="submit">Post Blog</button>
                            </div>
                            </div>
                          </form>
                        	</div>
                          </div>
                          </div>
                        </div><!-- End tab-pane --> 
                       
                        <div class="tab-pane fade" id="faq">
                          <div class="row">
                          <div class="col-md-6">
                            <form action="<?php echo base_url("adminprofile/savefaqdata");?>" method="post">
                              <div class="form-group">
                                <div class="styled-select">
                                  <select class="form-control" name="course" id="course_apply">
                                    <option value="">Select your a course</option>
                                    <?php 
                                      foreach($allCourses as $course)
                                      {
                                    ?>
                                        <option value="<?php echo $course->id;?>"><?php echo $course->course_name;?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <textarea style="height:150px;" name="question" class="form-control" placeholder="Question"></textarea>
                              </div>
                              <div class="form-group">
                                <textarea style="height:300px;" name="answer" class="form-control" placeholder="Answer"></textarea>
                              </div>
                              <div class="form-group">
                                <button class="btn btn-primary">Create FAQ</button>
                              </div>
                            </form>
                          </div>   
                          </div>                          
                        </div><!-- End tab-pane --> 
                        
                        <div class="tab-pane fade" id="subscription">        
                          <div class="row">
                            <div class="col-md-12">
                            <table id="datatable">
                             <thead>
                               <tr>
                               <th>Name</th>
                               <th>Email</th>
                               <th>Phone</th>
                               <th>Course</th>
                               <th>Group ID</th>
                               <th>Transaction ID</th>
                               <th>Transaction Date</th>
                               <th>Status</th>
                               </tr>
                             <thead>
                          <?php 
                            foreach($allSubscribers as $subscriber)
                            {
                          ?>    
                             <tbody>
                               <tr>
                               <td><?php echo $subscriber->first_name ." ". $subscriber->last_name;?></td>
                               <td><?php echo $subscriber->email;?></td>
                               <td><?php echo $subscriber->phone;?></td>
                               <td><?php echo $subscriber->course_name."-".$subscriber->course_location."-".$subscriber->start_date;?></td>
                               <td><?php echo $subscriber->group_id;?></td>
                               <td><?php echo $subscriber->trans_id;?></td>
                               <td><?php echo date("d-M-Y H:i:s",$subscriber->start_time)." to ".date("d-M-Y H:i:s",$subscriber->end_time);?></td>
                               <td><?php echo $subscriber->status;?></td>
                               </tr>
                             </tbody>
                            <?php } ?>
                            </table>
                          </div>
                          </div>
                       	</div><!-- End tab-pane --> 
     		
                    </div><!-- End col-md-8--> 
      </div>  
    </div><!-- End row-->   
</div><!-- End container -->
</section><!-- End main_content-->