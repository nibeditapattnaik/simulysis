<section id="sub-header">
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1 text-center">
			<h1>Simulysis Blog</h1>
		</div>
	</div><!-- End row -->
</div><!-- End container -->
<div class="divider_top"></div>
</section><!-- End sub-header -->

<section id="main_content">

<div class="container">

<ol class="breadcrumb">
  <li><a href="index.html">Home</a></li>
  <li class="active">Active page</li>
</ol>

	 <div class="row">
     <aside class="col-md-4">
     	<div class=" box_style_1">
				<div class="widget" style="margin-top:15px;">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
						<button class="btn btn-default" type="button" style="margin-left:0;"><i class="icon-search"></i></button>
						</span>
					</div><!-- /input-group -->
				</div><!-- End Search -->               
                
				<div class="widget">
					<h4>Recent post</h4>
                    
					<ul class="recent_post">
          <?php
            foreach($recentBlogs as $blog)
            {         
              $blogContent = strlen($blog->blog_content) > 50 ? substr(strip_tags($blog->blog_content),0,50)."..." : strip_tags($blog->blog_content);
          ?>
						<li>
						<i class="icon-calendar-empty"></i> <?php echo $blog->created_at;?>
						<div><a href="<?php echo base_url("blog/index/{$blog->id}");?>"><?php echo $blogContent?></a></div>
						</li>
            <?php } ?>
					</ul>
				</div><!-- End widget -->
                
			</div><!-- End box-sidebar -->
     </aside><!-- End aside -->
     
     <div class="col-md-8">
     		<div class="post">
					<div class="post_info clearfix">
						<div class="post-left">
							<ul>
								<li><i class="icon-calendar-empty"></i>On <span><?php echo $blogDetails->created_at;?></span></li>
								<li><i class="icon-user"></i>By <a href="#"><?php echo $blogDetails->author;?></a></li>
							</ul>
						</div>
					</div>
					<?php echo $blogDetails->blog_content;?>
				</div><!-- end post -->                
     </div><!-- End col-md-8-->   
  
	
  </div>  <!-- End row-->    
</div><!-- End container -->
</section><!-- End main_content-->