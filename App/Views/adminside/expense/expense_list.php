<!-- page content -->
<div class="right_col">
    <div class="">       
        <div class="clearfix"></div>
        <div class="row">            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">                                                                                                
                        <h2><?php echo $year; ?> Budget</h2>
                        <a href="<?php echo ADMIN_ADD_EXPENSE_LINK; ?>"><button type="button" data-toggle="tooltip" title="Add New Expense" class="btn btn-info btn-sm" style="float: right"><i class="fa fa-plus">Add New</i></button></a>
                        <div class="form-group" style="float: right">                                   
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="budget_year" name="budget_year" required="">                                              
                                            <option class="" value="" selected="" disabled=""i>Select budget year</option>                                                   
                                            <option value="2019-2020" <?php echo set_selected($year, "2019-2020") ?>>2019-2020</option>
                                            <option value="2020-2021" <?php echo set_selected($year, "2020-2021") ?>>2020-2021</option>
                                            <option value="2021-2022" <?php echo set_selected($year, "2021-2022") ?>>2021-2022</option>
                                            <option value="2022-2023" <?php echo set_selected($year, "2022-2023") ?>>2022-2023</option>
                                            <option value="2023-2024" <?php echo set_selected($year, "2023-2024") ?>>2023-2024</option>
                                            <option value="2024-2025" <?php echo set_selected($year, "2024-2025") ?>>2024-2025</option>
                                            <option value="2025-2026" <?php echo set_selected($year, "2025-2026") ?>>2025-2026</option>
                                            <option value="2026-2027" <?php echo set_selected($year, "2026-2027") ?>>2026-2027</option>
                                            <option value="2027-2028" <?php echo set_selected($year, "2027-2028") ?>>2027-2028</option>
                                            <option value="2028-2029" <?php echo set_selected($year, "2028-2029") ?>>2028-2029</option>
                                            <option value="2029-2030" <?php echo set_selected($year, "2029-2030") ?>>2029-2030</option>                                                                                                                               
                                        </select>
                                    </div>
                            </div> 
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                    					
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap datatableEx" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Index</th>
                                    <th>SOE</th>
                                    <th>Amount</th>
                                    <th>Year</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Index</th>
                                    <th>SOE</th>
                                    <th>Amount</th>
                                    <th>Year</th>                                   
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>					
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
<!-- /page content -->

