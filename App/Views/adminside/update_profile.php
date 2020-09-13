<!-- page content -->
<div class="right_col">
    <div class="">      
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Update Profile</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <!--<form method="post" id="frm_change_password" class="form-horizontal form-label-left" action="<?php echo ADMIN_UPDATE_PROFILE_LINK ?>">-->  
                            
                             <?php
                                $attributes = ['id' => 'frm_change_password','class'=>'form-horizontal form-label-left'];
                                echo form_open(ADMIN_UPDATE_PROFILE_LINK,$attributes);
                               ?> 
                            
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_current_password">Current Password:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" class="form-control col-md-7 col-xs-12" name="user_current_password" id="user_current_password" placeholder="Enter Current Password" required="" autocomplete="off"> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_new_password">New Password:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" class="form-control col-md-7 col-xs-12" name="user_new_password" id="user_new_password" placeholder="Enter New Password" required="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_confirm_password">Confirm Password: </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" class="form-control col-md-7 col-xs-12" name="user_confirm_password" id="user_confirm_password" placeholder="Enter Confirm Password" required autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">reCaptcha
                                </label>                                
                                    <?php echo echoCaptcha(); ?>                                                           
                            </div>                                                                                    
                            <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" id="btnSubmit" disabled=""  class="btn btn-success">Update</button>
                                </div>
                            </div>
                         <?php echo form_close();?> 
                    </div>
                </div>
            </div>
        </div>                       
    </div>
</div>