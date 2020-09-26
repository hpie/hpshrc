<style>
    .btn_disabled{
        pointer-events: none;
        background-color: #c3bdbd;
        opacity: 15.9;
    }
    .howtocontact{
        display: none !important;
    }
</style>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">CASE REQUEST<span class="title-under"></span></h1>
        <p class="page-description">
            Himachal Pradesh Human Rights Commission , Pines Grove Building Shimla 171002
        </p>
    </div>
</div>
<div class="main-container fadeIn animated">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <!-- content -->
            <div class="col-md-8 col-sm-12 col-form"> 
                <!--<h2 class="title-style-2">Registration FORM <span class="title-under"></span></h2>-->
                <?php
                $attributes = ['class' => 'contact-form', 'id' => 'add_cases', 'name' => 'addcases', 'enctype' => 'multipart/form-data'];
                echo form_open(CASE_REQUEST_LINK, $attributes);                
                ?>                                                    
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="cases_title">Title:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control" name="cases_title" id="cases_title" placeholder="Enter Title" required="" autocomplete="off">
                        </div>
                    </div>
                </div>
                <?php if(!isset($_SESSION['customer']['customer_id'])){ ?>
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="howtocontact">How to contact:</label>
                        <div class="col-sm-8 col-xs-12">
                            <select class="form-control" id="howtocontact" name="howtocontact" required="" tabindex="-1" aria-hidden="true">
                                <option class="" value="" disabled="" selected="">------ Select ------</option>                                                
                                <option value="Email">Email</option>                                                          
                                <option value="Mobile">Mobile</option>                                                          
                                <option value="Both">Both</option>                                                          
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group howtocontact howtocontact_email">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_email">Customer Email:</label>
                        <div class="col-sm-8 col-xs-12">
                            <!--<input type="text" class="form-control" name="cases_title" id="cases_title" placeholder="Enter Title" required="" autocomplete="off">-->
                            <input type="email" class="form-control" name="customer_email" id="customer_email" placeholder="Enter customer email" autocomplete="off" value="example@gmail.com">
                        </div>
                    </div>
                </div>
                <div class="form-group howtocontact howtocontact_mobile">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="customer_contact">Customer Mobile:</label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="text" class="form-control mobileno" name="customer_contact" id="customer_contact" placeholder="Enter customer mobile number" maxlength="10" minlength="10" autocomplete="off" value="9999999999">
                        </div>
                    </div>
                </div>
                <?php } ?>                           
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="case_files_file">Files:
                        </label>
                        <div class="col-sm-8 col-xs-12">
                            <input type="file" id="case_files_file" multiple name="case_files_file[]" accept="application/pdf,image/jpg,image/jpeg,image/png">
                        </div> 
                    </div>
                </div> 
                <div class="form-group">
                    <div class="row">
                        <label class="control-label col-sm-4 col-xs-12" for="cases_message">Description:
                        </label>
                        <div class="col-sm-8 col-xs-12">
                            <textarea id="summernote" name="cases_message"></textarea>                            
                        </div> 
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <script nonce='S51U26wMQz' type="text/javascript">function enableRegister() {                                
                                document.getElementById("btnSubmit").disabled = false;
                            }</script>
                        <label class="control-label col-sm-4 col-xs-12" for="ptsp"></label>
                        <div class="col-sm-8 col-xs-12">
                            <div class="g-recaptcha" style="" data-sitekey="6LdnvCQUAAAAAGmHBukXVzjs5NupVLlaIHJdpFWo" data-callback="enableRegister"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="m-auto text-center">    
                        <button type="submit" class="btn warning_btn"  disabled="true" id="btnSubmit">Submit</button>
                    </div>
                </div>
                <!--</form>-->
                <?php 
                echo form_close(); 
                ?>  
            </div>
        </div> <!-- /.row -->       
    </div>
</div>