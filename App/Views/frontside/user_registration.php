<style>
    .btn_disabled{
        pointer-events: none;
        background-color: #c3bdbd;
        opacity: 15.9;
    }
</style>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">REGISTRATION<span class="title-under"></span></h1>
        <p class="page-description">
            Himachal Pradesh Human Rights Commission , Pines Grove Building Shimla 171002
        </p>
    </div>
</div>
<div class="main-container fadeIn animated">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <!-- content -->
            <div class="col-md-8 col-sm-12 col-form"> 
                <!--<h2 class="title-style-2">Registration FORM <span class="title-under"></span></h2>-->
                <?php
                $attributes = ['class' => 'contact-form', 'id' => 'student_register', 'name' => 'adduser', 'enctype' => 'multipart/form-data'];
                echo form_open(CUSTOMER_REGISTER_LINK, $attributes);
                ?>                                       
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_first_name">First Name:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="customer_first_name" id="customer_first_name" placeholder="Enter First Name " required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_middle_name">Middle Name:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="customer_middle_name" id="customer_middle_name" placeholder="Enter Middle Name " required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_last_name">Last Name: </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="customer_last_name" id="customer_last_name" placeholder="Enter Last Name " required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_father_name">Father Name: </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="customer_father_name" id="customer_father_name" placeholder="Enter Father Name " required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_mobile_no">Mobile Number: </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control mobileno" name="customer_mobile_no" id="customer_mobile_no" maxlength="10" minlength="10" placeholder="Enter Mobile Number " required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_email_id">Email: </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="email" class="form-control" name="customer_email_id" id="customer_email_id" placeholder="Enter Email " required="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_email_password">New Password:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="password" class="form-control" name="customer_email_password" id="customer_email_password" placeholder="Enter New Password" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="user_confirm_password">Confirm Password: </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="password" class="form-control" name="user_confirm_password" id="user_confirm_password" placeholder="Enter Confirm Password" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_dob">Date of Birth:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="date" class="form-control dob" name="customer_dob">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_gender">Gender:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="radio" checked name="customer_gender" value="M">&nbsp;<span>Male</span>
                            <input type="radio" name="customer_gender" value="F">&nbsp;<span>Female</span>
                            <input type="radio" name="customer_gender" value="O">&nbsp;<span>Other</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_photo_path">Customer Photo
                        </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="file" id="customer_photo_path" name="customer_photo_path" required="required">
                        </div> 
                    </div>
                </div>                                        
                <div class="form-group">
                    <div class="row">
                        <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <script nonce='S51U26wMQz' type="text/javascript">function enableRegister() {
                                $("#btnRegister").removeClass('btn_disabled');
                                document.getElementById("btnRegister").disabled = false;
                            }</script>
                        <label class="control-label col-sm-4 col-xs-12" for="ptsp"></label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="g-recaptcha" style="" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableRegister"></div>
                        </div>
                    </div>
                </div>            
                <div class="form-group">
                    <div class="m-auto text-center">    
                        <button type="submit" class="btn warning_btn btn_disabled"  disabled="true" id="btnRegister">Register</button>
                    </div>
                </div>
                <?php echo form_close(); ?>  
            </div>
        </div> <!-- /.row -->       
    </div>
</div>