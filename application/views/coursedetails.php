<section id="sub-header_pattern_1">
  	<div class="container">
    
    	<div class="row">
        	<div class="col-md-12 text-center">
            	<h1><?php echo $coursedetails->course_name;?></h1><span><?php echo "({$coursedetails->course_display_id})";?></span>
            </div>
        </div><!-- End row -->
        
        <div class="row" id="sub-header-features">
        	<div class="col-md-6">
            	<h2>A brief summary</h2>
                <p><?php echo $coursedetails->course_description;?></p>
				<div class="col-md-6 pull-left"><p><a href="<?php echo base_url("coursedetails/downloadpdf")."/".$coursedetails->course_name;?>" class="btn btn-info">Download Course Outline</a></p></div>
				
                
            </div>
            
            <div class="col-md-6">
            	<h2>What you will learn?</h2>
                <p>The following things you will learn during the course period</p>
                <ul class="list_ok">
                  <?php 
                    $whatULearn = explode("|", $coursedetails->what_u_learn);
                    foreach($whatULearn as $learn)
                    {
                  ?>
                    <li><?php echo $learn;?></li>
                    <?php } ?>
                </ul>
            </div>
        	
        </div><!-- End row -->
        <div class="row">
          <div class="col-md-6">
            <h4>Venue: <span class="text-danger"><?php echo $coursedetails->course_location . "," . $coursedetails->course_venue;?></span></h4>
            <h4>Start Date: <span class="text-danger"><?php echo $coursedetails->start_date;?></span></h4>
            <h4>Schedule: <span class="text-danger">Every <?php echo $coursedetails->days;?> from (<?php echo $coursedetails->timing;?>)</span></h4>
          </div>
          
          <div class="col-md-6">
            <h4>Duration: <?php echo $coursedetails->duration;?> </h4>
            <h4>Course Fee: <span class="text-danger"><?php echo $coursedetails->course_price;?> </span> <br/> <span class="text-danger"><?php echo $coursedetails->discount;?></span></h4>
          </div>
        </div>
        
        
    </div><!-- End container -->
    <div class="divider_top"></div>
  </section>
  
  <section id="strips-course" class="shadow">
  <div class="container">
  
      <ol class="breadcrumb">
      <li><a href="index.html">Home</a></li>
      <li class="active">Active page</li>
    </ol>
    
  <div class="row">
  	<div class="col-md-6">
        <h4>Targeted Audience</h4>
        <p class="lead add_bottom_45"><?php echo $coursedetails->target_audiance;?></p>
        <h4>Prerequisite</h4>
        <p class="lead add_bottom_45"><?php echo $coursedetails->prerequisite;?></p>
    </div>
    <div class="col-md-6">
      <h4>FAQs</h4> 
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <?php 
        $faqTabCounter = 1;
        foreach($faqs as $faq)
        {
      ?>
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="heading<?php echo $faqTabCounter;?>">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $faqTabCounter;?>" aria-expanded="false" aria-controls="collapse<?php echo $faqTabCounter;?>">
                <?php echo $faq->question;?>
              </a>
            </h4>
          </div>
          <div id="collapse<?php echo $faqTabCounter;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $faqTabCounter;?>">
            <div class="panel-body">
              <?php echo $faq->answer;?>
            </div>
          </div>
        </div>
        <?php 
          $faqTabCounter++;
        } ?>
      </div>
    </div>
  </div>
  </div>
  	
    <?php 
    $imagecounter = 1;
      foreach($topicdetails as $topic)
      {
        if(empty($topic->date))
        {
          $date = date("d-M-Y", strtotime($coursedetails->start_date)+(($topic->sequence-1)*24*3600));
        }
    ?>
    <article>
    <div class="container">
    
  	<div class="row">
    	<div class="col-md-3 col-sm-3 hidden-xs text-center"><img src="<?php echo base_url("design");?>/img/number_<?php echo $imagecounter;?>_small.png" alt="" ></div>
        <div class="col-md-9 col-sm-9">
        <h3><?php echo $topic->topic_name;?></h3>
        <p><?php echo $topic->objective;?></p>
                
        <ul class="data-lessons">
        	  <li class="po-markup">
              		<a class="po-link" href="javascript:void(0)" ><i class="icon-calendar"></i> <?php echo $date;?></a>
                </li>
              <li class="po-markup">
                    <a class="po-link" href="javascript:void(0)" ><i class="icon-clock"></i>Duration: <?php echo $topic->duration;?> hours</a>
                    <div class="po-content hidden">
          				<div class="po-title"><strong>Duration: 6 hours</strong></div> <!-- ./po-title -->
                        <div class="po-body">
                        	<ul class="list_po_body">
                          <?php
                          foreach($sessiondetails[$topic->id] as $session)
                          {
                          ?>
                          <li><i class="icon-clock"></i> <?php echo $session->start_time . " - " .$session->end_time;?></li>
                          <?php } ?>
                          </ul>
                        </div><!-- ./po-body -->
                    </div><!-- ./po-content -->
                    </li>
          </ul>
        </div>
        
    </div><!-- End row  -->
    </div><!-- End container  -->
    </article><!-- End strip-program  -->
      <?php 
      $imagecounter++;
      } 
      ?>   
    <div class="container">
        <hr>
            
            <div class="row">
            <h3>Case Studies</h3>
                <?php 
            foreach($course_blogs as $blog)
            {
              $blogContent = strlen($blog->blog_content) > 200 ? substr(strip_tags($blog->blog_content),0,200)."..." : strip_tags($blog->blog_content);
          ?>
          	<div class="col-md-4 well" style="height:300px; overflow:hidden;text-align:justify">
                <h3><?php echo $blog->title;?></h3> 
                <p><?php echo $blogContent;?></p> <br/>
                <a href="<?php echo base_url("blog/index/{$blog->id}");?>" target="_blank" class="btn btn-info">Read More</a>
            </div>
            <?php } ?>                  
            </div><!-- end row -->
    </div>
    
  </section>

<section id="join">
   <div class="container">
 	<div class="row">
    	<div class="col-md-8 col-md-offset-2 text-center">
        <div class="row">
        <div class="col-md-2 hidden-sm hidden-xs"><img src="<?php echo base_url("design");?>/img/arrow_hand_1.png" alt="Arrow" > </div>
        <div class="col-md-8"><a href="<?php echo base_url("subscribe/populatecourse")."/{$coursedetails->cross_id}";?>" class="button_big">Enrol at 1000/- INR</a> </div>
        </div>
         </div>
 </div>
  </div>
 </section>