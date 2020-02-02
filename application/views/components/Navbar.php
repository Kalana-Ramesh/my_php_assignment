

<nav class="navbar">
        <div class="nav-header">
            <div class= "nav-left">
            <img class="nav-icon" src="<?php echo base_url('assets/icons/user.png'); ?>" alt="user"/>
            User Management
            </div>
                <?php echo form_open('navigation','',array(
                        "action"=>$btn,
                        "page" => $pge
                       
                )) ?>
                <button class="nav-button"><?php echo $btn ?></button>
                <?php echo form_close() ?> 
        </div>  
</nav>