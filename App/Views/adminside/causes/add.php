<!-- page content -->
<div class="right_col">
    <div class="">      
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add File</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        
                        <?php
                        $attributes = ['class'=>'form-horizontal form-label-left','id' => 'add_causes','name'=>'addcauses','enctype'=>'multipart/form-data'];
                        echo form_open(ADMIN_ADD_FILES_LINK,$attributes);
                       ?>                                                
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_file_title">Title
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="upload_file_title"  placeholder="Enter file title" required="required" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                                </div>                                
                            </div>                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_file_desc">Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="field form-control col-md-7 col-xs-12" rows="5" placeholder="Enter file description" name="upload_file_desc" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_file_ref_no">Reference File No
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="upload_file_ref_no"  placeholder="Enter ref file number" required="required" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                                </div>                                
                            </div>
                            <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_file_type">File Type
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" id="upload_file_type" name="upload_file_type" required="">                                              
                                            <option class="" value="" selected="" disabled=""i>Select File Type</option>       
                                            <?php if($file_type){
                                                foreach ($file_type as $row){                                                
                                                    ?>
                                            <option class="" value="<?php echo $row['category_code']; ?>"><?php echo $row['category_title']; ?></option>   
                                            <?php
                                                }
                                            } ?>                                           
                                        </select>
                                    </div>
                            </div> 
                            <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_file_sub_type">File Sub Type
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="upload_file_sub_type" required="" id="upload_file_sub_type">                                              
                                            <option class="" value="" selected="" disabled=""i>Select File Sub Type</option>                                                                                             
                                        </select>
                                    </div>
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="upload_file_original_name">Select File
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" id="upload_file_original_name" name="upload_file_original_name" required="required" class="form-control col-md-7 col-xs-12" accept="application/pdf,image/jpg,image/jpeg,image/png">
                                </div>                                  
                            </div>                                                                                                                                        
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success"  id="btnLogin">Submit</button>
                                </div>
                            </div>                            
                       <?php echo form_close();?>  
                    </div>
                </div>
            </div>
        </div>                       
    </div>
</div>