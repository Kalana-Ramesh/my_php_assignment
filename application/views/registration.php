<?php $this->load->view("includes/header.php")?>

<?php  $this->load->view("components/navbar.php", array(
    "pge" => "login",
    "btn" => "Login"
)); ?>

<!--For datepicker -->
 <script type="text/javascript">
            $(function() {
                $("#datepicker").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
               
            });
</script>




  <?php echo form_open('user-register', array(
        "method" => "post",
        "class" => "form-class",
        "id" => "form-id",
        "enctype" => "multipart/form-data"
    ))?>
    <div class="login-content">
         <?php 
                if($this->session->flashdata("error")){
                    ?>
                    <div class="success-alert">
                        <?php echo $this->session->flashdata("error");?>
                    </div>
                    <?php
                }
            ?>
            <h1>Register</h1>
            <div class="input-container">

                <div class="row-error">
                    <input
                        class='reg-name' 
                        type="text" 
                        placeholder="First Name" 
                        name="txt_fname"
                        value="<?php echo set_value('txt_fname');?>"
                    />
                    <?php echo form_error("txt_fname","<div class=error>","</div>");?>
                </div>

                <div class="row-error">
                    <input
                        class='reg-name' 
                        type="text" 
                        placeholder="Last Name" 
                        name="txt_lname"
                        value="<?php echo set_value('txt_lname')?>"/>
                     <?php echo form_error("txt_lname","<div class=error>","</div>");?>
                </div>
              
                <div class="row-error">
                    <input
                        readonly 
                        type="text" 
                        id="datepicker" 
                        placeholder="Date of Birth" 
                        name="txt_dob" 
                        value="<?php echo set_value('txt_dob')?>"/>
                     <?php echo form_error("txt_dob","<div class=error>","</div>");?>
                </div>
                
                <div class="row-error">
                    <input 
                        type="email" 
                        placeholder="Email" 
                        name="txt_email"
                        value="<?php echo set_value('txt_email')?>"/>
                     <?php echo form_error("txt_email","<div class=error>","</div>");?>
                </div>

                <div class="row-error">
                    <input 
                        type="password" 
                        placeholder="Password" 
                        name="txt_pw"
                        value="<?php echo set_value('txt_pw')?>"/>
                    <?php echo form_error("txt_pw","<div class=error>","</div>");?>
                </div>

                <div class="row-error">
                    <input 
                        type="password" 
                        placeholder="Confirm Password" 
                        name="txt_cpw"
                        value= "<?php echo set_value('txt_cpw')?>"/>
                    <?php echo form_error("txt_cpw","<div class=error>","</div>");?>
                </div>

            </div>

            <div class="login-btn-container">
                <button type="submit" class="login-btn" >Register</button>
            </div>
        </div>
    <?php echo form_close();?>

<?php include("includes/footer.php") ?>