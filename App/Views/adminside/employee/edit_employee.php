<!-- page content -->
<div class="right_col">
    <div class="">      
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Employee</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?php
                        $attributes = ['class' => 'form-horizontal form-label-left', 'id' => 'edit_employee', 'name' => 'edituser'];
                        echo form_open(ADMIN_EMPLOYEE_EDIT_LINK.$employee_id, $attributes);
                        ?>                                                                         
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_firstname">First Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="user_firstname" value="<?php echo $single_employee['user_firstname']; ?>" id="user_firstname"  placeholder="Enter First Name" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                            </div>                                
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_lastname">Last Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="user_lastname" value="<?php echo $single_employee['user_lastname']; ?>" id="user_lastname"  placeholder="Enter Last Name" class="form-control col-md-7 col-xs-12" autocomplete="off">
                            </div>                                
                        </div>                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_email_id">Email
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="email" name="user_email_id" value="<?php echo $single_employee['user_email_id']; ?>" id="user_email_id"  placeholder="Enter Email" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                            </div>                                
                        </div>                                            
                        <div class="form-group">
                            <label for="employee_roll" class="control-label col-md-3 col-sm-3 col-xs-12">Employee Roll</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="employee_roll[]" value="executive" <?php foreach($employee_roll as $errow){ echo set_checked("executive",$errow['roll_title']); } ?>> Executive &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="lead" <?php foreach($employee_roll as $errow){echo set_checked("lead",$errow['roll_title']);} ?>> Lead &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="manager" <?php foreach($employee_roll as $errow){echo set_checked("manager",$errow['roll_title']);} ?>> Manager &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="director" <?php foreach($employee_roll as $errow){echo set_checked("director",$errow['roll_title']);} ?>> Director &nbsp;&nbsp;
                                <input type="checkbox" name="employee_roll[]" value="chairman" <?php foreach($employee_roll as $errow){echo set_checked("chairman",$errow['roll_title']);} ?>> Chairman
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