<style type="text/css">
    body{
        background-color: aquamarine;
        /*background-image: url("<?php echo base_url("design")?>/img/login_logo.png")*/
    }
</style>
<div class="container">
    <div class="row">
        <div class=" col-sm-3 "></div>
	<div class=" col-sm-6 ">
        <center>
        <h2>Register here</h2>
        <form method="POST" action="<?php echo base_url('/register/registration') ?>" >
          
            <div class="form-group">
            <input type="text" class="form-control" id="user_name" placeholder="User Name" name="user_name">
            </div>
            
            <div class="form-group">
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
             <div class="form-group">   
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
            </div>
             <?php 
    
                $data=array('user_role_id'=>'2');
            ?>
            <?php echo form_hidden($data); ?>
            <div class="form-group">
            <input type='text' class="form-control" id="mobile" placeholder="Mobile Number" name="mobile">    
            </div>
            
            <?php 
                $data1 = array('admin_permission'=>'no');
            ?>
            <?php echo form_hidden($data1); ?>
            <button type="submit" class="btn btn-default" name="submit">Register</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="reset" class="btn btn-default" name="reset">Reset</button><br/><br/>
        
        </form>
            </center>
        </div>
        </div>
</div>
  
  