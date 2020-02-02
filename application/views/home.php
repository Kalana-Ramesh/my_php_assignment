<?php  
   
    if($_SESSION['status'] != 'Active') {
        header("location:login");
    }
?>



<?php $this->load->view("includes/header.php")?>
<?php  $this->load->view("components/navbar.php", array(
    "pge" => "login",
    "btn" => "Logout"
)); ?>

 <?php $userData = $this->session->userdata()?>

<div class="home-container">
    <div class="top-content">
        <h3>Login as <?php echo $userData['fname']?></h3>
    </div>
    <div class="display">
        
   
    
        <div>
            <h2>First Name : </h2>
            <h3 class="reg-name"><?php echo $userData['fname']?></h3>
        </div>
        <div>
            <h2>First Name : </h2>
            <h3 class="reg-name"> <?php echo $userData['lname']?> </h3>
        </div>
        <div>
            <h2>Date of Birth : </h2>
            <h3> <?php 
              $date = $userData['dob'];
              $formated_Date = date("d-m-Y",strtotime($date));
              echo $formated_Date;
                ?> </h3>
        </div>
        <div>
            <h2>Email : </h2>
            <h3> <?php echo $userData['email']?> </h3>
        </div>
    </div>
</div>

<?php include("includes/footer.php") ?>