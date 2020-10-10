<!-- page content -->
<div class="right_col">
    <div class="">      
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Add Expense</h2>                    
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />                        
                        <?php
                        $attributes = ['class'=>'form-horizontal form-label-left','id' => 'add_expense','name'=>'addexpense'];
                        echo form_open(ADMIN_ADD_EXPENSE_LINK,$attributes);
                       ?>                                                
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_soe">SOE
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="budget_soe"  placeholder="Enter SOE" required="required" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                                </div>                                
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_amount">Amount
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" step="any" name="budget_amount"  placeholder="Enter Amount" required="required" class="form-control col-md-7 col-xs-12" required="" autocomplete="off">
                                </div>                                
                            </div> 
                            <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="budget_year">Year
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" id="budget_year" name="budget_year" required="">                                              
                                            <option class="" value="" selected="" disabled=""i>Select budget year</option>                                                   
                                            <option value="2019-2020">2019-2020</option>
                                            <option value="2020-2021">2020-2021</option>
                                            <option value="2021-2022">2021-2022</option>
                                            <option value="2022-2023">2022-2023</option>
                                            <option value="2023-2024">2023-2024</option>
                                            <option value="2024-2025">2024-2025</option>
                                            <option value="2025-2026">2025-2026</option>
                                            <option value="2026-2027">2026-2027</option>
                                            <option value="2027-2028">2027-2028</option>
                                            <option value="2028-2029">2028-2029</option>
                                            <option value="2029-2030">2029-2030</option>                                                                                                                               
                                        </select>
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