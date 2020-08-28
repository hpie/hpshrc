<?php if(!isset($_SESSION['message'])){$_SESSION['message']='';} ?>
<script type="text/javascript" nonce='S51U26wMQz'>
    $(document).ready(function () {
        
        toastr.clear();
        toastr.options = { 
                closeButton: true,
                hideDuration: "3000",
                extendedTimeOut : 500000,
                tapToDismiss : true,
                debug : false,
                fadeOut: 10,
                positionClass : "toast-top-right",
                showMethod: "fadeIn",
                hideMethod: "fadeOut"
            };           
    if (<?php if (isset($_SESSION['error'])) { echo $_SESSION['error'];}else{echo 0; } ?> === 1)
    {                            
        toastr.error('<?php echo $_SESSION['message']; ?>');
        <?php  $_SESSION['error'] = 0; ?>
    }
    if (<?php if (isset($_SESSION['success'])) { echo $_SESSION['success'];}else{echo 0; } ?> === 1)
    {            
        toastr.success('<?php echo $_SESSION['message']; ?>');
        <?php  $_SESSION['success'] = 0; ?>
    }    
    if (<?php if (isset($_SESSION['registration'])) { echo $_SESSION['registration'];} else {echo 0;} ?> === 1)
    {         
        toastr.success('Registration success. Your account will be activated by the admin.'); 
        toastr.error('Failed to deliver email. Please contact your school and share your email id.'); 
    }
    if (<?php if (isset($_SESSION['registration'])) {echo $_SESSION['registration'];} else {echo 0;} ?> === 2) {            
        toastr.success('Registration success. A verification email and login details have been sent.');                    
    }
    if (<?php if(isset($_SESSION['registration'])){ echo $_SESSION['registration'];} else {echo 0;} ?> === 3) { 
        
        toastr.error('Email allready exist');             
        <?php $_SESSION['registration'] = 0; ?>
    }
});
</script>
