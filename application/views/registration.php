<?php $this->load->view("includes/header.php")?>

<?php  $this->load->view("components/navbar.php", array(
    "pge" => "login",
    "btn" => "Login"
)); ?>

<!--For birthdayPicker -->
 <script type="text/javascript">
          $(function () {
                for (i = new Date().getFullYear() ; i > 1900; i--) {
                    $('#years').append($('<option />').val(i).html(i));
                }

                for (i = 1; i < 13; i++) {
                    $('#months').append($('<option />').val(i).html(i));
                }
                updateNumberOfDays();

                $('#years, #months').change(function () {
                    updateNumberOfDays();
                });

            });

            function updateNumberOfDays() {
                $('#days').html('');
                month = $('#months').val();
                year = $('#years').val();
                days = daysInMonth(month, year);

                for (i = 1; i < days + 1 ; i++) {
                    $('#days').append($('<option />').val(i).html(i));
                }

            }

            function daysInMonth(month, year) {
                return new Date(year, month, 0).getDate();
            }
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
                
                <label class="label">First Name</label>
                <div class="row-error">
                    <input
                        class='reg-name' 
                        type="text" 
                        name="txt_fname"
                        value="<?php echo set_value('txt_fname');?>"
                    />
                    <?php echo form_error("txt_fname","<div class=error>","</div>");?>
                </div>

                <label class="label">Last Name</label>
                <div class="row-error">
                    <input
                        class='reg-name' 
                        type="text"  
                        name="txt_lname"
                        value="<?php echo set_value('txt_lname')?>"/>
                     <?php echo form_error("txt_lname","<div class=error>","</div>");?>
                </div>

                <label class="label">Date Of Birth (Y/M/D)</label>
                <div class="row-error">
                    <select 
                        id="years" 
                        name="txt_year" 
                        value="<?php echo set_value('txt_year')?>">
                    </select>
					<select 
                        id="months" 
                        name="txt_month" 
                        value="<?php echo set_value('txt_month')?>">
                    </select>
					<select 
                        id="days" 
                        name="txt_day"
                        value="<?php echo set_value('txt_day')?>">
                    </select>
						
                     <?php echo form_error("txt_day","<div class=error>","</div>");?>
                </div>
                
                <label class="label">Email</label>
                <div class="row-error">
                    <input 
                        type="text"  
                        name="txt_email"
                        value="<?php echo set_value('txt_email')?>"/>
                     <?php echo form_error("txt_email","<div class=error>","</div>");?>
                </div>

                <label class="label">Password</label>
                <div class="row-error">
                    <input 
                        type="password"  
                        name="txt_pw"
                        value="<?php echo set_value('txt_pw')?>"/>
                    <?php echo form_error("txt_pw","<div class=error>","</div>");?>
                </div>

                <label class="label">Confirm Password</label>
                <div class="row-error">
                    <input 
                        type="password"  
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