<!-- page content -->
<div class="right_col">
    <div class="">      
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Category</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br/>
                        
                        <?php
                            $attributes = ['class'=>'form-horizontal form-label-left','id' => 'edit_categories','name'=>'editcategory'];
                            echo form_open(ADMIN_EDIT_CATEGORIES_LINK.$category_code,$attributes);
                        ?>                                               
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_code">Category Code
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="category_code" value="<?php echo $category['category_code']; ?>"  placeholder="Enter Category Code" required="required" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                                </div>                                
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_title">Category Title
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="category_title" value="<?php echo $category['category_title']; ?>"  placeholder="Enter Category Title" required="required" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_description">Description
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="field form-control col-md-7 col-xs-12" rows="5" placeholder="Enter description" name="category_description"><?php echo $category['category_description']; ?></textarea>
                                </div>
                            </div>                                                                                  
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-8 col-sm-6 col-xs-12 col-md-offset-3">                                   
                                    <button type="submit" class="btn btn-success" id="btnSubmit">Update</button>                                  
                                </div>
                            </div>                            
                        <?php echo form_close();?> 
                    </div>
                </div>
            </div>
        </div>                       
    </div>
</div>