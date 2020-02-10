

<?php $this->load->view("includes/header.php")?>

<?php  $this->load->view("components/navbar.php", array(
    "pge" => "registration",
    "btn" => "register"
)); ?>

<div class="body-container">


    <?php echo form_open('user-login', array(
        "method" => "post",
        "class" => "form-class",
        "id" => "form-id",
        "enctype" => "multipart/form-data"
    ));?>

        <div class="success-alert">
        	<?php 
                if($this->session->flashdata("success")){
            ?>
                
                    <?php echo $this->session->flashdata("success");?>
                
            <?php
            }
        ?>
        	</div>
        <div class="login-content">
            

        <h1>Login</h1>
            <div class="input-container">
                
                <label class="label">Email</label>
                <div class="row-error">
                    <input 
                        type="text" 
                        name="txt_email"
                        value="<?php echo set_value('txt_email')?>" />
                    <?php echo form_error("txt_email","<div class=error>","</div>");
                    ?>    
                </div>
                
                <label class="label">Password</label>
                <div class="row-error">
                    <input 
                        type="password" 
                        name="txt_pw"
                        value="<?php echo set_value('txt_pw')?>"/>
                    <?php echo form_error("txt_pw","<div class=error>","</div>");?>
                </div>

                <?php 
                    if($this->session->flashdata("login_error")) {
                ?>
                    <div class="error">
                        <?php echo $this->session->flashdata("login_error");?>
                    </div>
                <?php
                }
            ?>

            </div>

           

            <div class="login-btn-container">
                    <button class="login-btn" type="submit">Login</button>
            </div> 
        </div>

    <?php echo form_close();?>
</div>

<?php include("includes/footer.php") ?>




       