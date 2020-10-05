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
            <div class="col-sm-12">
                <div class="col-xs-12">
                    <h2>#<?php echo $caseDetails['cases_id'].': '.$caseDetails['cases_title']; ?></h2>
                    <p><strong>Priority: </strong> <span class="tags"><i class="fa fa-flag-o"> </i> <?php echo $caseDetails['cases_priority']; ?></span> </p>
                    <p><strong>Status: </strong> <span class="tags"><i class="fa fa-line-chart"> </i> <?php echo $caseDetails['cases_status']; ?></span> </p>  
                    <p><strong>Assigned To: </strong> <span class="tags"><i class="fa fa-user"> </i> <?php echo $caseDetails['user_firstname'].' '.$caseDetails['user_lastname']; ?></span> </p>  
                    <p><strong>Created Date: </strong>
                        <span><i class="fa fa-calendar"> </i> <?php echo date("d-M-Y h:i:sa", strtotime($caseDetails['cases_dt_created'])); ?></span>                         
                    </p>
                    <p><strong>Involved Employee: </strong>
                        <span> 
                                            <?php if(!empty($involved_peopel)){
                                                foreach ($involved_peopel as $row){
                                                    echo $row['user_firstname'].' '.$row['user_lastname'].','; ?></span>                                                   
                                            <?php
                                                }
                                            } ?>
                                                                                     
                                        </span>                         
                    </p>                    
                </div>                
                <div class="col-xs-12">
                    <hr>
                    <strong>Description: </strong>                         
                        <?php echo $caseDetails['cases_message']; ?>                                   
                </div> 
            </div>            
            <div class="col-xs-12 divider text-center">
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
            </div>
    	 </div>                 
		</div>
        </div>
        <div class="row" id="comments">
            <div class="col-sm-1">  </div>
            <div class="col-sm-10">                                                             
                <!-- COMMENT 1 - START -->
                 <?php if(!empty($comments)){
                            foreach ($comments as $crow){
                                ?>
                
                <div class="media">
                     <?php if($crow['comment_from_usertype']=='employee'){
                         ?>
                     <a class="pull-left" href="#"><img class="media-object" src="<?php echo UPLOAD_FOLDER.'original/default2.png'; ?>" alt=""></a>
                    <?php
                     }?>
                    <?php if($crow['comment_from_usertype']=='customer'){
                         ?>
                     <a class="pull-left" href="#"><img class="media-object" src="<?php echo UPLOAD_FOLDER.'original/default.png'; ?>" alt=""></a>
                    <?php
                     }?>                   
                    <div class="media-body">                        
                        <?php if($crow['comment_from_usertype']=='employee'){
                                    ?>                        
                        <h4 class="media-heading"><?php echo $crow['f_user_firstname'].' '.$crow['f_user_lastname']; ?> (Employee)</h4>
                        <?php } ?>
                        <?php if($crow['comment_from_usertype']=='customer'){
                                    ?>                        
                        <h4 class="media-heading"><?php if($crow['fhc_customer_first_name']==''){echo 'Guest';} else{ echo $crow['fhc_customer_first_name'].' '.$crow['fhc_customer_last_name']; } ?> (Customer)</h4>
                        <?php } ?>
                        
                         <?php if($crow['comment_type']=='comment'){
                                        echo $crow['comment_description'];
                                    } ?>
                                    <?php if($crow['comment_type']=='assign'){
                                        ?>
                        <p><strong class="assign-title">Assign to</strong> @<?php echo $crow['t_user_firstname'].' '.$crow['t_user_lastname']; ?></p>
                                    <?php
                                    } ?>
                                    <?php if($crow['comment_type']=='reassign'){
                                        ?>
                        <p> <strong class="assign-title">Reassign to</strong> @<?php echo $crow['t_user_firstname'].' '.$crow['t_user_lastname']; ?></p>
                                    <?php
                                    } ?>
                        
                                                
                        <ul class="list-unstyled list-inline media-detail pull-left">
                            <li><i class="fa fa-calendar"></i><?php echo date("d-M-Y h:i:sa", strtotime($crow['comment_datetime'])); ?></li>
<!--                            <li><i class="fa fa-thumbs-up"></i>13</li>-->
                        </ul>
<!--                        <ul class="list-unstyled list-inline media-detail pull-right">
                            <li class=""><a href="">Like</a></li>
                            <li class=""><a href="">Reply</a></li>
                        </ul>-->
                    </div>
                </div>
                <!-- COMMENT 1 - END -->
                <?php
                    }                 
                }
                ?>
            </div>
        </div>     
    </div>
</div>