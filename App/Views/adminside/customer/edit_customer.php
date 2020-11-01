<!-- page content -->
<div class="right_col">
    <div class="">      
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Complainant</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?php
                        $attributes = ['class' => 'form-horizontal form-label-left', 'id' => 'edit_customer', 'name' => 'edituser', 'enctype' => 'multipart/form-data'];
                        echo form_open(ADMIN_CUSTOMER_EDIT_LINK.$customer_id, $attributes);
                        ?>                                                                         
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_first_name">First Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="customer_first_name" value="<?php echo $single_customer['customer_first_name']; ?>" id="customer_first_name"  placeholder="Enter First Name" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                            </div>                                
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_middle_name">Middle Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="customer_middle_name" value="<?php echo $single_customer['customer_middle_name']; ?>" id="customer_middle_name"  placeholder="Enter Middle Name" class="form-control col-md-7 col-xs-12" autocomplete="off">
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_last_name">Last Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="customer_last_name" value="<?php echo $single_customer['customer_last_name']; ?>" id="customer_last_name"  placeholder="Enter Last Name" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_father_name">Father Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="customer_father_name" value="<?php echo $single_customer['customer_father_name']; ?>" id="customer_father_name"  placeholder="Enter Father Name" class="form-control col-md-7 col-xs-12" required="">
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_mobile_no">Mobile No
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="customer_mobile_no" value="<?php echo $single_customer['customer_mobile_no']; ?>" id="customer_mobile_no" maxlength="10" minlength="10"  placeholder="Enter Mobile No" class="form-control col-md-7 col-xs-12 mobileno" autocomplete="off">
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_email_id">Email
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" name="customer_email_id" value="<?php echo $single_customer['customer_email_id']; ?>" id="customer_email_id"  placeholder="Enter Email" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_dob">Date of birth
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" name="customer_dob" value="<?php echo $single_customer['customer_dob']; ?>" id="customer_dob" data-date-format="yyyy-mm-dd"  placeholder="Select Date of birth" class="form-control col-md-7 col-xs-12" required="" autocomplete="off" >
                            </div>                                
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer_gender">Gender
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" checked name="customer_gender" required="" value="M" <?php echo set_cheked('M', $single_customer['customer_gender']) ?>> Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="customer_gender" required="" value="F" <?php echo set_cheked('F', $single_customer['customer_gender']) ?>> Female
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" class="flat" name="customer_gender" required="" value="O" <?php echo set_cheked('O', $single_customer['customer_gender']) ?>> Other
                                    </label>
                                </div>
                            </div>                                
                        </div>                                                                                                                                                          
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success"  id="btnSubmit">Submit</button>
                            </div>
                        </div>                            
                        <?php echo form_close(); ?>  
                    </div>
                </div>
            </div>
        </div>                       
    </div>
</div>