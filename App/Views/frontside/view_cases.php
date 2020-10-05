<style>
    .formgroup-background{
        background: #efefef !important;
        padding: 10px;
    }    
</style>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">CASE DETAILS<span class="title-under"></span></h1>
        <p class="page-description">
            Himachal Pradesh Human Rights Commission , Pines Grove Building Shimla 171002
        </p>
    </div>
</div>
<div class="main-container fadeIn animated">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="well profile">
                    <div class="col-sm-12 col-md-4">
                        <div class="col-xs-12">
                            <h2>#<?php echo $caseDetails['cases_id'] . ': ' . $caseDetails['cases_title']; ?></h2>
                            <p><strong>Priority: </strong> <span class="tags"><i class="fa fa-flag-o"> </i> <?php echo $caseDetails['cases_priority']; ?></span> </p>
                            <p><strong>Status: </strong> <span class="tags"><i class="fa fa-line-chart"> </i> <?php echo $caseDetails['cases_status']; ?></span> </p>  
                            <p><strong>Assigned To: </strong> <span class="tags"><i class="fa fa-user"> </i> <?php echo $caseDetails['user_firstname'] . ' ' . $caseDetails['user_lastname']; ?></span> </p>  
                            <p><strong>Created Date: </strong>
                                <span><i class="fa fa-calendar"> </i> <?php echo date("d-M-Y h:i:sa", strtotime($caseDetails['cases_dt_created'])); ?></span>                         
                            </p>
                            <p><strong>Involved Employee: </strong>
                                <span> 
                                    <?php
                                    if (!empty($involved_peopel)) {
                                        foreach ($involved_peopel as $row) {
                                            echo $row['user_firstname'] . ' ' . $row['user_lastname'] . ',';
                                            ?></span>                                                   
                                        <?php
                                    }
                                }
                                ?>

                                </span>                         
                            </p>                    
                        </div>                

                    </div>

                    <div class="col-sm-12 col-md-8">
                        <br><br>
                        <strong>File details and description</strong>
<?php if (!empty($fileDetails)) {
    ?>
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                                      <!--<table id="example" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">-->
                                <thead>
                                    <tr>                                                
                                        <th>File</th>
                                        <th>Title</th>
                                        <th>Description</th>                                                                                            
                                        <th>View</th> 
                                        <th>Download</th>  
                                    </tr>
                                </thead>
                                <tbody>
    <?php
    foreach ($fileDetails as $fdrow) {
        ?>                                
                                        <tr>
                                            <td><?php echo $fdrow['case_files_name'] ?></td>
                                            <td><?php echo $fdrow['case_files_title'] ?></td>
                                            <td><?php echo $fdrow['case_files_desc'] ?></td>
                                            <td><a href="<?php echo UPLOAD_FOLDER . 'doc/' . $fdrow['refCases_id'] . '/' . $fdrow['case_files_unique_name']; ?>" target="_blank">View</a></td>                                                
                                            <td><a href="<?php echo UPLOAD_FOLDER . 'doc/' . $fdrow['refCases_id'] . '/' . $fdrow['case_files_unique_name']; ?>" download>Download</a></td>                                                
                                        </tr>                                        
        <?php
    }
    ?>
                                </tbody>
                            </table>
    <?php }
?>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-12">
                            <hr>
                            <strong>Description: </strong>                         
<?php echo $caseDetails['cases_message']; ?>                                   
                        </div>
                    </div>             
                    <!--            <div class="col-xs-12 divider text-center">
                                    <div class="col-xs-12 col-sm-4 emphasis">
                                        <h2><strong> 20,7K </strong></h2>                    
                                        <p><small>Followers</small></p>
                                        <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Follow </button>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 emphasis">
                                        <h2><strong>245</strong></h2>                    
                                        <p><small>Following</small></p>
                                        <button class="btn btn-info btn-block"><span class="fa fa-user"></span> View Profile </button>
                                    </div>
                                    <div class="col-xs-12 col-sm-4 emphasis">
                                        <h2><strong>43</strong></h2>                    
                                        <p><small>Snippets</small></p>
                                        <div class="dropup btn-block text-center">
                                          <button type="button" class="btn btn-primary"><span class="fa fa-gear"></span> Options </button>
                                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu text-left" role="menu">
                                            <li><a href="#"><span class="fa fa-envelope pull-right"></span> Send an email </a></li>
                                            <li><a href="#"><span class="fa fa-list pull-right"></span> Add or remove from a list  </a></li>
                                            <li class="divider"></li>
                                            <li><a href="#"><span class="fa fa-warning pull-right"></span>Report this user for spam</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" class="btn disabled" role="button"> Unfollow </a></li>
                                          </ul>
                                        </div>
                                    </div>
                                </div>-->
                </div>                 
            </div>
        </div>
        <div class="row" id="comments">
            <div class="col-sm-1">  </div>
            <div class="col-sm-10">                                                             
                <!-- COMMENT 1 - START -->
<?php echo $comments; ?>
            </div>            
        </div>
        
        <?php if($caseDetails['cases_status']=='closed' || $caseDetails['is_block_user']==1){}
        else{
            ?>
        <div class="row">                            
            <form class="formgroup-background" id="add_comment" enctype="multipart/form-data">                                                                                                                                 
                <input type="hidden" name="cases_id" value="<?php echo $caseDetails['cases_id']; ?>">
                <input type="hidden" name="customer_id" value="<?php echo $caseDetails['refCustomer_id']; ?>">
                <input type="hidden" name="employee_id" value="<?php echo $caseDetails['cases_assign_to']; ?>">
                    <hr>
                    <div class="form-group">
                        <div class="row">                       
                            <div class="col-sm-12 col-xs-12">
                                <textarea id="summernote" name="cases_message"></textarea>                            
                            </div> 
                        </div>
                    </div>                    
                    <div class="form-group">
                        <div class="row">                        
                            <div class="col-sm-12 col-md-4">
                                <input type="file" id="case_files_file" multiple name="case_files_file[]" accept="application/pdf,image/jpg,image/jpeg,image/png">
                            </div> 
                            <div class="col-sm-12 col-md-4">
                                <button type="submit" class="btn btn-primary warning_btn" id="btnSubmit">Comment</button>
                            </div>
                        </div>
                    </div>                  
                </form>                             
        </div>
        <?php } ?>
    </div>
</div>