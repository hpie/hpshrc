<div class="nk-content p-0">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-msg">               
                <div class="nk-msg-body bg-white profile-shown">
                    <div class="nk-msg-head">
                        <h2 class="title d-none d-lg-block">#<?php echo $caseDetails['cases_id'].': '.$caseDetails['cases_title']; ?></h2>
                        <div class="nk-msg-head-meta">
                            <div class="d-none d-lg-block">
                                <ul class="nk-msg-tags">
                                    <li><span class="label-tag"><span>Priority: <em class="icon ni ni-more-v"></em><?php echo $caseDetails['cases_priority']; ?></span></span></li>
                                    <li><span class="label-tag"><span>Status: <em class="icon ni ni-bar-chart-fill"></em><?php echo $caseDetails['cases_status']; ?></span></span></li>
                                </ul>
                                
                                <hr>
                                <span class="label-tag"><span><strong>Description: </strong></span></span>
                            <?php echo $caseDetails['cases_message']; ?>  
                            </div>
                            <div class="d-lg-none"><a href="#" class="btn btn-icon btn-trigger nk-msg-hide ml-n1"><em class="icon ni ni-arrow-left"></em></a></div>
                            <ul class="nk-msg-actions">
                                <li><a href="#" class="btn btn-dim btn-sm btn-outline-light"><em class="icon ni ni-check"></em><span>Mark as Closed</span></a></li>
                                <!-- <li><span class="badge badge-dim badge-success badge-sm"><em class="icon ni ni-check"></em><span>Closed</span></span></li> -->
                                <li class="d-lg-none"><a href="#" class="btn btn-icon btn-sm btn-white btn-light profile-toggle"><em class="icon ni ni-info-i"></em></a></li>
                                <li class="dropdown">
                                    <a href="#" class="btn btn-icon btn-sm btn-white btn-light dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><em class="icon ni ni-user-add"></em><span>Assign To Member</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-archive"></em><span>Move to Archive</span></a></li>
                                            <li><a href="#"><em class="icon ni ni-done"></em><span>Mark as Close</span></a></li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <a href="#" class="nk-msg-profile-toggle profile-toggle active"><em class="icon ni ni-arrow-left"></em></a>
                    </div><!-- .nk-msg-head -->
                    <div class="nk-msg-reply nk-reply" data-simplebar>
                        
                        <?php if(!empty($comments)){
                            foreach ($comments as $crow){
                                ?>
                          <div class="nk-reply-item">
                            <div class="nk-reply-header">
                                <?php if($crow['comment_from_usertype']=='employee'){
                                    ?>
                                <div class="user-card">
                                    <div class="user-avatar sm bg-blue">
                                        <span><?php echo strtoupper(substr($crow['f_user_firstname'],0,1).substr($crow['f_user_lastname'],0,1)); ?></span>
                                    </div>
                                    <div class="user-name"><?php echo $crow['f_user_firstname'].' '.$crow['f_user_lastname']; ?> (Employee)</div>
                                </div>                                
                                <?php
                                } ?> 
                                <?php if($crow['comment_from_usertype']=='customer'){
                                    ?>
                                <div class="user-card">
                                    <div class="user-avatar sm bg-blue">
                                        <span><?php echo strtoupper(substr($crow['fhc_customer_first_name'],0,1).substr($crow['fhc_customer_last_name'],0,1)); ?></span>
                                    </div>
                                    <div class="user-name"><?php if($crow['fhc_customer_first_name']==''){echo 'Guest';} else{ echo $crow['fhc_customer_first_name'].' '.$crow['fhc_customer_last_name']; } ?> (Customer)</div>
                                </div>                                
                                <?php
                                } ?>
                                <div class="date-time"><?php echo date("d-M-Y", strtotime($crow['comment_datetime'])); ?></div>
                            </div>
                            <div class="nk-reply-body">
                                <div class="nk-reply-entry entry">
                                    <?php if($crow['comment_type']=='comment'){
                                        echo $crow['comment_description'];
                                    } ?>
                                    <?php if($crow['comment_type']=='assign'){
                                        ?>
                                    <strong class="assign-title">Assign to</strong> @<?php echo $crow['t_user_firstname'].' '.$crow['t_user_lastname']; ?>
                                    <?php
                                    } ?>
                                    <?php if($crow['comment_type']=='reassign'){
                                        ?>
                                    <strong class="assign-title">Reassign to</strong> @<?php echo $crow['t_user_firstname'].' '.$crow['t_user_lastname']; ?>
                                    <?php
                                    } ?>
                                </div>
<!--                                <div class="attach-files">
                                    <ul class="attach-list">
                                        <li class="attach-item">
                                            <a class="download" href="#"><em class="icon ni ni-img"></em><span>error-show-On-order.jpg</span></a>
                                        </li>
                                        <li class="attach-item">
                                            <a class="download" href="#"><em class="icon ni ni-img"></em><span>full-page-error.jpg</span></a>
                                        </li>
                                    </ul>
                                    <div class="attach-foot">
                                        <span class="attach-info">2 files attached</span>
                                        <a class="attach-download link" href="#"><em class="icon ni ni-download"></em><span>Download All</span></a>
                                    </div>
                                </div>-->
                            </div>
                        </div><!-- .nk-reply-item -->
                         <div class="nk-reply-meta">
                            <div class="nk-reply-meta-info"><strong><?php echo date("d-M-Y h:i:sa", strtotime($crow['comment_datetime'])); ?></strong></div>
                        </div><!-- .nk-reply-meta -->  
                        <?php
                            }
                        } ?>                                                               
                        <div class="nk-reply-form">
                            <div class="nk-reply-form-header">
                                <ul class="nav nav-tabs-s2 nav-tabs nav-tabs-sm">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#reply-form">Reply</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#note-form">Private Note</a>
                                    </li>
                                </ul>
                                <div class="nk-reply-form-title">
                                    <div class="title">Reply as:</div>
                                    <div class="user-avatar xs bg-purple">
                                        <span>IH</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="reply-form">
                                    <div class="nk-reply-form-editor">
                                        <div class="nk-reply-form-field">
                                            <textarea class="form-control form-control-simple no-resize" placeholder="Hello"></textarea>
                                        </div>
                                        <div class="nk-reply-form-tools">
                                            <ul class="nk-reply-form-actions g-1">
                                                <li class="mr-2"><button class="btn btn-primary" type="submit">Reply</button></li>
                                                <li>
                                                    <div class="dropdown">
                                                        <a class="btn btn-icon btn-sm btn-tooltip" data-toggle="dropdown" title="Templates" href="#"><em class="icon ni ni-hash"></em></a>
                                                        <div class="dropdown-menu">
                                                            <ul class="link-list-opt no-bdr link-list-template">
                                                                <li class="opt-head"><span>Quick Insert</span></li>
                                                                <li><a href="#"><span>Thank you message</span></a></li>
                                                                <li><a href="#"><span>Your issues solved</span></a></li>
                                                                <li><a href="#"><span>Thank you message</span></a></li>
                                                                <li class="divider">
                                                                <li><a href="#"><em class="icon ni ni-file-plus"></em><span>Save as Template</span></a></li>
                                                                <li><a href="#"><em class="icon ni ni-notes-alt"></em><span>Manage Template</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Attachment" href="#"><em class="icon ni ni-clip-v"></em></a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Insert Emoji" href="#"><em class="icon ni ni-happy"></em></a>
                                                </li>
                                                <li>
                                                    <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Images" href="#"><em class="icon ni ni-img"></em></a>
                                                </li>
                                            </ul>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn-trigger btn btn-icon mr-n2" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Another Option</span></a></li>
                                                        <li><a href="#"><span>More Option</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-reply-form-tools -->
                                    </div><!-- .nk-reply-form-editor -->
                                </div>
                                <div class="tab-pane" id="note-form">
                                    <div class="nk-reply-form-editor">
                                        <div class="nk-reply-form-field">
                                            <textarea class="form-control form-control-simple no-resize" placeholder="Type your private note, that only visible to internal team."></textarea>
                                        </div>
                                        <div class="nk-reply-form-tools">
                                            <ul class="nk-reply-form-actions g-1">
                                                <li class="mr-2"><button class="btn btn-primary" type="submit">Add Note</button></li>
                                                <li>
                                                    <a class="btn btn-icon btn-sm" data-toggle="tooltip" data-placement="top" title="Upload Attachment" href="#"><em class="icon ni ni-clip-v"></em></a>
                                                </li>
                                            </ul>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn-trigger btn btn-icon mr-n2" data-toggle="dropdown"><em class="icon ni ni-more-v"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Another Option</span></a></li>
                                                        <li><a href="#"><span>More Option</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-reply-form-tools -->
                                    </div><!-- .nk-reply-form-editor -->
                                </div>
                            </div>
                        </div><!-- .nk-reply-form -->
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
        </div>
    </div>
</div>