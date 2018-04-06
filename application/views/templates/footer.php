<footer>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h3>Subscribe to our Newsletter for latest news.</h3>
			<div id="message-newsletter"></div>
			<form method="post" name="newsletter" id="newsletter" class="form-inline">
				<input name="email_newsletter" id="email_newsletter" type="email" value="" placeholder="Your Email" class="form-control">
				<button id="sub-newsletter" type="button" class=" button_outline"> Subscribe</button>
			</form>
		</div>
	</div>
</div>

<hr>

<div class="container" id="nav-footer">
	<div class="row text-left">
		<div class="col-md-4 col-sm-4">
			<h4>Browse</h4>
			<ul>
				<li><a href="<?php echo base_url("courses");?>">Courses</a></li>
                <li><a href="<?php echo base_url("blogs");?>">Case Studies</a></li>
				<li><a href="<?php echo base_url("contact");?>">Contacts</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-4 col-sm-4">
			<h4>About Learn</h4>
			<ul>
				<li><a href="<?php echo base_url("about");?>">About Us</a></li>
				<li><a href="<?php echo base_url("subscribe");?>">Apply</a></li>
				<li><a href="#">Terms and conditions</a></li>
			</ul>
		</div><!-- End col-md-4 -->
		<div class="col-md-4 col-sm-4">
			<ul id="follow_us">
				<li><a href="https://www.facebook.com/simulysis"><i class="icon-facebook"></i></a></li>
				<li><a href="https://www.linkedin.com/company/simulysis"><i class="icon-linkedin"></i></a></li>
			</ul>
			<ul>
				<li><strong class="phone">044-65656001/43114224</strong><br><small>Mon - Sat / 9.00AM - 06.00PM</small></li>
				<li>Questions? <a href="#">info@simulysis.com</a></li>
			</ul>
		</div><!-- End col-md-4 -->
	</div><!-- End row -->
</div>
<div id="copy_right">© Udvavisk 2011-2016 | Powered By Codizz.</div>
</footer>

<div id="toTop">Back to top</div>

<!-- JQUERY -->
<script src="<?php echo base_url("design");?>/js/jquery-1.10.2.min.js"></script>
<!-- jQuery REVOLUTION Slider  -->
<script type="text/javascript" src="<?php echo base_url("design");?>/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("design");?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript">

		var revapi;

		jQuery(document).ready(function() {

			   revapi = jQuery('.tp-banner').revolution(
				{
					delay:9000,
					startwidth:1700,
					startheight:600,
					hideThumbs:true,
					navigationType:"none",
					fullWidth:"on",
					forceFullWidth:"on"
				});

		});	//ready

	</script>

<!-- OTHER JS --> 
<script src="<?php echo base_url("design");?>/js/superfish.js"></script>
<script src="<?php echo base_url("design");?>/js/bootstrap.min.js"></script>
<script src="<?php echo base_url("design");?>/js/retina.min.js"></script>
<script src="<?php echo base_url("design");?>/assets/validate.js"></script>
<script src="<?php echo base_url("design");?>/js/jquery.placeholder.js"></script>
<script src="<?php echo base_url("design");?>/js/functions.js"></script>
<script src="<?php echo base_url("design");?>/js/classie.js"></script>
<script src="<?php echo base_url("design");?>/js/uisearch.js"></script>
<script src="<?php echo base_url();?>design/js/datatables/jquery.dataTables.js"></script>
<script>new UISearch( document.getElementById( 'sb-search' ) );</script>
    <script type="text/javascript" src="<?php echo base_url();?>design/js/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url();?>design/js/fullcalendar.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>design/js/jstz.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>design/js/app.js"></script>
 <script type="text/javascript">
       var disqus_shortname = 'bootstrapcalendar'; // required: replace example with your forum shortname
		(function() {
			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		})();          
    </script>
<script>
  $(document).ready(function(){
    
    $("#sub-newsletter").click(function(){
      var email = $("#email_newsletter").val();
      $.post("<?php echo base_url("subscribe/newsletter")?>", {email:email}, function(result){
        alert(result.message);
      });
    });
    
    $("input[name=group_id]").blur(function(){
      var groupId = $(this).val();
      if(groupId != '')
      {
      $.post("<?php echo base_url("subscribe/checkgroupid");?>", {groupid:groupId},function(result){
        if(result.error)
        {
          $("input[name=group_id]").val("");
          alert(result.error);
        }          
        else
        {
          $("input[name=group_id]").css("background-color", "green");
          $("input[name=group_id]").css("opacity", ".6");
        }          
      });
        
      }
    });
    
    $("select[name=course]").change(function(){
      var courseCrossId = $(this).val();
      $.post("<?php echo base_url("subscribe/crosstocourseandviceversa");?>", {crossid:courseCrossId}, function(result){
        $("input[name=course_id]").val(result.uniqueCourseId);
      });
    });
    
    $("#buy").click(function(){
      $(".error").hide();
      var fname= $("input[name=firstname]").val();
      var lname= $("input[name=lname]").val();
      var email= $("input[name=email]").val();
      var phone= $("input[name=phone]").val();
      var education= $("select[name=education]").val();
      var branch= $("select[name=branch]").val();
      var age= $("input[name=age]").val();
      var message= $("input[name=message]").val();
      var gender= $("select[name=gender]").val();
      var course= $("select[name=course]").val();
      var group = $("input[name=group_id]").val();
      var error = false;
      if(fname == "")
      {
        $("#fnameError").show();
        error = true;
      }
      if(email == "")
      {
        $("#emailError").show();
        error = true;
      }
      if(phone == "")
      {
        $("#phoneError").show();
        error = true;
      }
      
      if(course == "")
      {
        $("#courseError").show();
        error = true;
      }
      if(error)
        return false;
      var params = {"fname":fname, "lname":lname, "email":email, "phone":phone, "edu":education, "age":age, "message":message, "gender":gender, "course":course, "branch":branch, "groupId":group};
      //$(this).attr("disabled", "disabled");
      $("#gifLoader").show();
      $.post("<?php echo base_url("courses/populateccavenueparams");?>", params, function(result){
        $("input[name=encRequest]").val(result.merchant_data);
        $("input[name=access_code]").val(result.access_code);      
        $("#payment_form").attr("action", result.url);
        
        $("#payment_form").submit();
      });
    });
  });
</script>
<?php 
if(isset($page) && $page == 'home')
{
?>
<script src="<?php echo base_url("design/js/owl.carousel.js");?>"></script>
<script src="<?php echo base_url("design/prettyphoto/js/prettyphoto.js");?>"></script>
<script>
 $(document).ready(function () {
     $("a[rel^='prettyPhoto']").prettyPhoto();

     $(".owl-slider").owlCarousel({

         autoplay: true,
         singleItem: false,
         nav : true,
         autoplayHoverPause: true,
         items: 4,
         slideBy:4,
         loop:true,
         dots:false,
         
         responsiveClass:true,
         responsive:{
           0:{
            items:1,
            nav:true
           },
           1199:{
            items:4,
            nav:true,
            loop:true
           },
           979:{
            items:3,
            nav:true,
            loop:true
           },
           768:{
            items:2,
            nav:true,
            loop:true
           },
           479:{
            items:1,
            nav:true,
            loop:true
           }
         },

         autoplayTimeout:3000,
     });
 });
</script>

<?php } ?>

<?php 
if(isset($page) && $page == 'adminprofile')
{
?>
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { new nicEditor().panelInstance("area1") });
  //]]>
  </script>
<script type="text/javascript">
		$(document).ready( function() {         
        <?php
          if(!empty($tab))
          {
            echo "$('ul#mytabs li a[href=$tab]').click();";
          }
        ?>         
         
    });
  </script>
<?php } ?>

<?php 
if(isset($page) && $page == 'contact')
{
?>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
google.maps.event.addDomListener(window, 'load', initialize);
function initialize() {
    var mapCanvas = document.getElementById('map');
    var mapOptions = {
      center: new google.maps.LatLng(12.98155234,80.22071649),
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    
    var map = new google.maps.Map(mapCanvas, mapOptions);
    var marker = new google.maps.Marker({
    position: new google.maps.LatLng(12.98155234,80.22071649),
    map: map,
    title: 'Simulysis'
  });
    
  }
  $(document).ready(function(){
    $("#contact").click(function(){
      $(".error").hide();
      var name= $("#name_contact").val();
      var lname= $("#lastname_contact").val();
      var mail= $("#email_contact").val();
      var phone= $("#phone_contact").val();
      var message= $("#message_contact").val();
      var error = false;
      
      if(name == "")
      {
        $("#nameError").show();
        error = true;
      }
      if(mail == "")
      {
        $("#mailError").show();
        error = true;
      }
      
      if(message == "")
      {
        $("#msgError").show();
        error = true;
      }
      if(error)
        return false;
      $(this).attr("disabled", "disabled");
      $("#gifLoader").show();
      $.post("<?php echo base_url("contact/sendcontactmail");?>", {name:name, lname:lname, mail:mail, phone:phone, message:message}, function(result){
        if(result == 'true')
        {
          $("#sendMailMessage").html("We have received your mail. We will contact you soon.");
          $("#name_contact").val("");
          $("#lastname_contact").val("");
          $("#email_contact").val("");
          $("#phone_contat").val("");
          $("#message_contact").val("");
          $("#gifLoader").hide();
          $("#contact").removeAttr("disabled");
          $("#message-contact").show();
        }
      });
    });
  });
</script>
<?php } ?>
<?php 
if(isset($page) && $page == 'adminprofile')
{
?>
<script>
  $(document).ready(function(){
    $("#datatable").DataTable();
  });
</script>
<?php } ?>
  </body>
</html>