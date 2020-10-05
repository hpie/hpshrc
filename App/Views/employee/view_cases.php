<div class="nk-content p-0">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-msg">               
                <div class="nk-msg-body bg-white profile-shown">
                    <div class="nk-msg-head">
                        <h2 class="title d-none d-lg-block">#<?php echo $caseDetails['cases_id'].': '.$caseDetails['cases_title']; ?></h2>
                        <div class="nk-msg-head-meta">
                            <div class="d-none d-lg-block col-md-6">
                                <ul class="nk-msg-tags">
                                    <li><span class="label-tag"><span>Priority: <em class="icon ni ni-more-v"></em><?php echo $caseDetails['cases_priority']; ?></span></span></li>
                                    <li><span class="label-tag"><span>Status: <em class="icon ni ni-bar-chart-fill"></em><?php echo $caseDetails['cases_status']; ?></span></span></li>
                                </ul>                                
                                <hr>
                                <span class="label-tag"><span><strong>Description: </strong></span></span>
                            <?php echo $caseDetails['cases_message']; ?>                                                                                             
                            </div>
                            <div class="d-none d-lg-block col-md-6">
                                <hr>                                
                                <span class="label-tag"><span><strong>File details and description: </strong></span></span>                                
<?php if(!empty($fileDetails)){
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
                                        foreach ($fileDetails as $fdrow){
                                            ?>                                
                                            <tr>
                                                <td><?php echo $fdrow['case_files_name'] ?></td>
                                                <td><?php echo $fdrow['case_files_title'] ?></td>
                                                <td><?php echo $fdrow['case_files_desc'] ?></td>
                                                <td><a href="<?php echo UPLOAD_FOLDER.'doc/'.$fdrow['refCases_id'].'/'.$fdrow['case_files_unique_name']; ?>" target="_blank">View</a></td>                                                
                                                <td><a href="<?php echo UPLOAD_FOLDER.'doc/'.$fdrow['refCases_id'].'/'.$fdrow['case_files_unique_name']; ?>" download>Download</a></td>                                                
                                            </tr>                                        
                                <?php
                                        }
                                        ?>
                                            </tbody>
                                    </table>
                                            <?php
                                } ?>                            
                            </div>
                        </div>
<a href="#" class="nk-msg-profile-toggle profile-toggle active"><em class="icon ni ni-arrow-left"></em></a>
                    </div><!-- .nk-msg-head -->
                    <div class="nk-msg-reply nk-reply" data-simplebar>                        
                        <?php echo $comments; ?>
                    </div><!-- .nk-reply -->                    
                    <div class="nk-msg-profile visible" data-simplebar>
                        <div class="card">
                            <div class="card-inner-group">
                                <div class="card-inner">
                                    <div class="user-card user-card-s2 mb-2">
                                        <div class="user-avatar md bg-primary">
                                            <span><?php echo strtoupper(substr($caseDetails['user_firstname'],0,1).substr($caseDetails['user_lastname'],0,1)); ?></span>
                                        </div>
                                        <div class="user-info">
                                            <h5><?php echo $caseDetails['user_firstname'].' '.$caseDetails['user_lastname']; ?></h5>
                                            <span class="sub-text">Assigned To</span>
                                        </div>
                                        <div class="user-card-menu dropdown">
                                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Profile</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-na"></em><span>Ban From System</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-repeat"></em><span>View Orders</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <div class="aside-wg">
                                        <h6 class="overline-title-alt mb-2">Customer Information</h6>
                                        <ul class="user-contacts">
                                            <li>
                                               <em class="icon ni ni-user-fill"></em><span><?php if($caseDetails['customer_first_name']==''){echo 'Not Avail';}else{echo $caseDetails['customer_first_name'].' '.$caseDetails['customer_last_name'];} ?></span>
                                            </li>
                                            <li>
                                                <em class="icon ni ni-mail"></em><span><?php if($caseDetails['customer_email_id']==''){echo 'Not Avail';}else{echo $caseDetails['customer_email_id'];} ?></span>
                                            </li>
                                            <li>
                                                <em class="icon ni ni-call"></em><span><?php if($caseDetails['customer_mobile_no']==0){echo 'Not Avail';}else{echo $caseDetails['customer_mobile_no'];} ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="aside-wg">
                                        <h6 class="overline-title-alt mb-2">Additional</h6>
                                        <div class="row gx-1 gy-3">
                                            <div class="col-12">
                                                <span class="sub-text">Created Date: </span>
                                                <span><?php echo date("d-M-Y h:i:sa", strtotime($caseDetails['cases_dt_created'])); ?></span>
                                            </div>
                                            <div class="col-12">
                                                <span class="sub-text">Created By:</span>
                                                <span><?php echo $caseDetails['createdby_user_type'].': '; if($caseDetails['createdby_user_type']=='customer'){ if($caseDetails['customer_first_name']=='') echo $caseDetails['customer_first_name'].' '.$caseDetails['customer_last_name'];}if($caseDetails['createdby_user_type']=='employee'){ echo $caseDetails['user_firstname'].' '.$caseDetails['user_lastname'];} ?></span>
                                            </div>
                                            <div class="col-12">
                                                <span class="sub-text">Status:</span>
                                                <?php 
                                                $text='text-primary';
                                                if($caseDetails['cases_status']=='open'){
                                                    $text='text-success';
                                                }
                                                if($caseDetails['cases_status']=='closed'){
                                                    $text='text-danger';
                                                }
                                                ?>
                                                <span class="lead-text <?php echo $text; ?>"><?php echo ucfirst($caseDetails['cases_status']); ?></span>
                                            </div>                                            
                                        </div>
                                    </div>
                                    <div class="aside-wg">
                                        <h6 class="overline-title-alt mb-2">Involved Employee</h6>
                                        <ul class="align-center g-2">
                                            <?php if(!empty($involved_peopel)){
                                                foreach ($involved_peopel as $row){
                                                    ?>
                                                <li>
                                                   <div class="user-avatar bg-purple">
                                                       <span><?php echo strtoupper(substr($row['user_firstname'],0,1).substr($row['user_lastname'],0,1)); ?></span>
                                                   </div>
                                                </li>
                                            <?php
                                                }
                                            } ?>
                                                                                     
                                        </ul>
                                    </div>
                                </div><!-- .card-inner -->
                            </div>
                        </div>
                    </div><!-- .nk-msg-profile -->
                </div><!-- .nk-msg-body -->
            </div><!-- .nk-msg -->
            <?php if($caseDetails['cases_status']!='closed'){ ?>
          <div class="col-xs-12">
                        <form class="gy-3" id="add_comment" enctype="multipart/form-data">
                        <input type="hidden" name="cases_id" value="<?php echo $caseDetails['cases_id']; ?>">
                        <input type="hidden" name="customer_id" value="<?php echo $caseDetails['refCustomer_id']; ?>">
                        <div class="nk-reply-form">                            
                                <div class="g-3 align-center">                              
                                <div class="col-sm-12">
                                    <div class="form-control-wrap">
                                        <div class="card card-bordered">
                                            <div class="card-inner">
                                                <textarea class="summernote-basic-id" name="cases_message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="tab-content">
                                <div class="tab-pane active" id="reply-form">
                                    <div class="nk-reply-form-editor">                                       
                                        <div class="nk-reply-form-tools">
                                            <ul class="nk-reply-form-actions g-1">
                                                <li>
                                                    <input type="file" name="case_files_file[]" multiple class="tn btn-icon btn-sm" id="case_files_file" accept="application/pdf,image/jpg,image/jpeg,image/png">                                                   
                                                </li>
                                                <li class="mr-2"><input type="submit" class="btn btn-primary" name="submit" id="submit" value="Reply"></li>                                                                                              
                                            </ul>
                                        </div><!-- .nk-reply-form-tools -->
                                    </div><!-- .nk-reply-form-editor -->
                                </div>                                
                            </div>
                        </div><!-- .nk-reply-form -->                        
                        </form>
                    </div>
            <?php } ?>
        </div>
    </div>
</div>