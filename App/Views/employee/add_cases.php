                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      <div class="nk-content">
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
                                            <input type="text" class="form-control" name="cases_title" id="cases_title" placeholder="Enter Title" required="" value="<?php if (isset($_SESSION['post_data'])) {
                                echo $_SESSION['post_data']['cases_title'];
                            } ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                                                                                   
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right" for="case_files_file">Files:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" name="case_files_file" class="custom-file-input form-control" id="case_files_file" required="" accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
                                            <label class="custom-file-label" for="case_files_file">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-label float-right" for="refUser_id ">Assign to:</label>                                            
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <select class="form-control" id="refUser_id " name="refUser_id " required="" tabindex="-1" aria-hidden="true">
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
                                <div class="col-lg-4">
                                    <div class="form-control-wrap">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <textarea class="summernote-basic-id" name="abc"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="about">
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
                            <div class="row g-3 align-center">
                                <div class="col-lg-4">
                                    <div class="form-group">                                            
                                        <label class="form-label float-right">reCaptcha:</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-control-wrap">
                                    <?php echo echoCaptcha(); ?>
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