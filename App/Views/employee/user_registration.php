                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">   
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add Complainant</h3>
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">                   
                    <div class="card">
                        <div class="card-inner">  
                            <?php
                            $attributes = ['class' => 'gy-3', 'id' => 'student_register', 'name' => 'adduser', 'enctype' => 'multipart/form-data'];
                            echo form_open(EMPLOYEE_CUSTOMER_REGISTER_LINK, $attributes);
                            ?>                             

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_first_name">First Name:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="customer_first_name" id="customer_first_name" placeholder="Enter First Name" required="" value="<?php if(isset($_SESSION['post_data'])){echo $_SESSION['post_data']['customer_first_name'];} ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_middle_name">Middle Name:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="customer_middle_name" id="customer_middle_name" placeholder="Enter Middle Name" value="<?php if(isset($_SESSION['post_data'])){echo $_SESSION['post_data']['customer_middle_name'];} ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>    
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_last_name">Last Name:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="customer_last_name" id="customer_last_name" placeholder="Enter Last Name" required="" value="<?php if(isset($_SESSION['post_data'])){echo $_SESSION['post_data']['customer_last_name'];} ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_father_name">Father Name:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="customer_father_name" id="customer_father_name" placeholder="Enter Father Name" required="" value="<?php if(isset($_SESSION['post_data'])){echo $_SESSION['post_data']['customer_father_name'];} ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_mobile_no">Mobile No:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control mobileno" name="customer_mobile_no" maxlength="10" minlength="10" id="customer_mobile_no" placeholder="Enter Mobile No" value="<?php if(isset($_SESSION['post_data'])){echo $_SESSION['post_data']['customer_mobile_no'];} ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_email_id">Email:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="email" class="form-control" name="customer_email_id" id="customer_email_id" placeholder="Enter Email" required="" value="<?php if(isset($_SESSION['post_data'])){echo $_SESSION['post_data']['customer_email_id'];} ?>" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>                              
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_dob">Date Of Birth:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control date-picker" data-date-format="yyyy-mm-dd" name="customer_dob" id="customer_dob" placeholder="Select Date" required="" autocomplete="off" value="<?php if(isset($_SESSION['post_data'])){echo $_SESSION['post_data']['customer_dob'];} ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right">Gender:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">                                                                                                                                  
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="customer_gender" class="custom-control-input" value="M" required="">
                                                <label class="custom-control-label" for="customRadio1">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="customer_gender" class="custom-control-input" value="F" required="">
                                                <label class="custom-control-label" for="customRadio2">Female</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio3" name="customer_gender" class="custom-control-input" value="O" required="">
                                                <label class="custom-control-label" for="customRadio3">Other</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                                                                                                               
                            <hr>                                
                            <div class="row g-3">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>                                          
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>  
                        </div>
                    </div><!-- card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>