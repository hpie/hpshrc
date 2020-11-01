<style>
    .howtocontact{
        display: none !important;
    }
</style>
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">   
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Add Case</h3>
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block nk-block-lg">                   
                    <div class="card">
                        <div class="card-inner">  
                            <?php
                            $attributes = ['class' => 'gy-3', 'id' => 'add_cases', 'name' => 'addcases', 'enctype' => 'multipart/form-data'];
                            echo form_open(EMPLOYEE_ADD_CASES_LINK, $attributes);
                            ?>                             
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_title">Title:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="cases_title" id="cases_title" placeholder="Enter Title" required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label float-right" for="howtocontact">How to contact:</label>                                            
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="howtocontact" name="howtocontact" required="" tabindex="-1" aria-hidden="true">
                                                <option class="" value="" disabled="" selected="">------ Select ------</option>                                                
                                                <option value="Email">Email</option>                                                          
                                                <option value="Mobile">Mobile</option>                                                          
                                                <option value="Both">Both</option>                                                          
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="row g-3 align-center howtocontact howtocontact_email">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_email">Customer Email:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="Enter customer email" autocomplete="off" value="example@gmail.com">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center howtocontact howtocontact_mobile">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="customer_contact">Customer Mobile:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control mobileno" name="customer_contact" id="customer_contact" placeholder="Enter customer mobile number" maxlength="10" minlength="10" autocomplete="off" value="9999999999">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_party_name">Party Name:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="cases_party_name" id="cases_party_name" placeholder="Enter Party Name" required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_party_address">Party Address:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <textarea class="form-control form-control-sm" name="cases_party_address" id="cf-default-textarea" placeholder="Enter Party Address"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_party_number">Party Contact Number:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control mobileno" name="cases_party_number" id="cases_party_number" placeholder="Enter Party Mobile Number" maxlength="10" minlength="10" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="row g-3 align-center case_files_file_div">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="case_files_file">Files:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" name="case_files_file[]" multiple class="custom-file-input form-control" id="case_files_file" required="" accept="application/pdf,image/jpg,image/jpeg,image/png">
                                            <label class="custom-file-label" for="case_files_file">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label float-right" for="cases_assign_to">Assign to:</label>                                            
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="cases_assign_to" name="cases_assign_to" required="" tabindex="-1" aria-hidden="true">
                                                <option class="" value="" disabled="" selected="">------ Select Employee ------</option>
                                                <?php
                                                if (!empty($res_employee)) {
                                                    foreach ($res_employee as $row) {
                                                        ?>
                                                        <option value="<?= $row['employee_user_id']; ?>"><?= $row['user_firstname'] . ' ' . $row['user_lastname']; ?></option>    
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="cases_message">Description:</label>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="form-control-wrap">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <textarea class="summernote-basic-id" name="cases_message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="case_no">Case No:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" name="case_no" id="case_no" placeholder="Enter Case No" required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right">Priority:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">                                                                                                                                  
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio1" name="cases_priority" class="custom-control-input" value="Low" required="">
                                                <label class="custom-control-label" for="customRadio1">Low</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="cases_priority" class="custom-control-input" value="Medium" required="">
                                                <label class="custom-control-label" for="customRadio2">Medium</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio3" name="cases_priority" class="custom-control-input" value="High" required="">
                                                <label class="custom-control-label" for="customRadio3">High</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                                                              
                            <hr>                                
                            <div class="row g-3">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="form-group mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary" id="btnSubmit">Submit</button>                                          
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