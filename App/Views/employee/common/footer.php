<div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> <p class="text-soft">&copy; <?php echo date("Y"); ?> <?php echo APPNAME; ?> All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div>
<!-- footer @e -->
</div>
<!-- wrap @e -->
</div>
<!-- main @e -->
</div>

<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
<!-- app-root @e -->
<!-- JavaScript -->
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/bundle.js"></script>
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/scripts.js"></script>
<!--<script src="<?php //echo EMPLOYEE_ASSETS_FOLDER; ?>js/example-toastr.js"></script>-->
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/toastr.min.js" type="text/javascript"></script>
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/charts/chart-ecommerce.js"></script>
<script nonce='S51U26wMQz' src="<?php echo BASE_URL ?>/assets/front/js/bootstrapValidator.min.js" type="text/javascript"></script>

<!-- datatable start js  -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>jquery/dist/jquery.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net/js/jquery.dataTables.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-bs/js/dataTables.bootstrap.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-buttons-bs/js/buttons.bootstrap.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-buttons/js/buttons.flash.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-buttons/js/buttons.print.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-fixedheader/js/dataTables.fixedHeader.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-keytable/js/dataTables.keyTable.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-responsive-bs/js/responsive.bootstrap.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>datatables.net-scroller/js/dataTables.scroller.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/front/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL ?>/assets/front/js/dataTables.responsive.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<!-- datatable end js  -->


<?php include(APPPATH . "Views/employee/common/notify.php"); ?>
<?php if ($title == EMPLOYEE_UPDATE_PROFILE_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {            
            $('#frm_change_password').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    user_new_password: {
                        validators: {
                            stringLength: {
                                min: 8
                            },
                            identical: {
                                field: 'user_confirm_password',
                                message: 'The password and its confirm are not the same'
                            },
                            notEmpty: {
                                message: 'Please supply your new password'
                            }
                        }
                    },
                    user_confirm_password: {
                        validators: {
                            stringLength: {
                                min: 8
                            },
                            identical: {
                                field: 'user_new_password',
                                message: 'The password and its confirm are not the same'
                            },
                            notEmpty: {
                                message: 'Please supply your confirm password'
                            }
                        }
                    }
                }
            }).on('success.form.bv', function (e) {
                $('#success_message').slideDown({opacity: "show"}, "slow"); // Do something ...
                $('#frm_change_password').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    if (result['success'] == "success") {
                        location.href = "<?php echo EMPLOYEE_UPDATE_PROFILE_LINK; ?>";
                    }
                    if (result['success'] == "fail") {
                        toastr.error('Old Password not matched!');
                    }
                    $('.txt_csrfname').val(result['token']);
                }, 'json');
            });                                    
        });
    </script>
<?php } ?>
    
     <?php if ($title == EMPLOYEE_CUSTOMER_LIST_TITLE) {
    ?> 
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {
            fill_datatable1();
            function fill_datatable1()
            {
                $('#example').DataTable({
                    responsive: {
                        details: {
                            type: 'column',
                            target: 'tr'
                        }
                    },
                                       
                    columnDefs: [{
                            className: 'control',
                            orderable: false,
                            targets: 0
                        }],
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 10,
                    "paginationType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                    "ajax": {
                        'type': 'POST',
                        'url': "<?php echo BASE_URL . '/assets/DataTablesSrc-master/customers_list.php' ?>",
                        'data': {
                            employee_user_id: <?php
                            if (isset($_SESSION['user_id'])) {
                                echo $_SESSION['user_id'];
                            }
                            ?>
                        }
                    },
                    "columns": [
                        {"data": "index"},
                        {"data": "customer_first_name"},
                        {"data": "customer_middle_name"},
                        {"data": "customer_last_name"},
                        {"data": "customer_father_name"},
                        {"data": "customer_gender"},
                        {"data": "customer_dob"},                                           
                        {"data": "customer_mobile_no"},
                        {"data": "customer_email_id"},                       
                        {"data": "action"}
                    ]
                });
            }
            $(document).on('click', '.btn_approve_reject_email', function () {

                var csrfName = $('.ajax_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.ajax_csrfname').val(); // CSRF hash
        
                var self = $(this);

                var table = self.attr('data-table');
                var updatefield = self.attr('data-updatefield');
                var wherefield = self.attr('data-wherefield');
                
                var status = self.attr('data-status');
                var user_status = 1;
                if (status == 1)
                    user_status = 0;

                if (!confirm('Are you sure want to update?'))
                    return;
                self.attr('disabled', 'disabled');

                var data = {
                    'table_id': self.data('id'),
                    'user_status': user_status,
                    'table':table,
                    'updatefield':updatefield,
                    'wherefield':wherefield,
                    [csrfName]: csrfHash
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);                                                
                        $('.ajax_csrfname').val(res.token);                        
                        if (res.suceess) {

                            var title = 'Click to verify email';
                            var class_ = 'btn_approve_reject_email btn btn-xs btn-success';
                            var text = "Email Verified <em class='icon ni ni-check-thick'></em>";
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to unverify email';
                                class_ = 'btn_approve_reject_email btn btn-xs btn-danger';
                                text = "Verify Email <em class='icon ni ni-edit-fill'></em>";
                                isactive = 0;
                            }
                            self.removeClass().addClass(class_);
                            self.attr({
                                'data-status': isactive,
                                'title': title
                            });
                            self.removeAttr('disabled');
                            self.html(text);

                        }
                    }
                });
            }); 
            $(document).on('click', '.btn_lock_unlock_customer', function () {

                var csrfName = $('.ajax_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.ajax_csrfname').val(); // CSRF hash
        
                var self = $(this);

                var table = self.attr('data-table');
                var updatefield = self.attr('data-updatefield');
                var wherefield = self.attr('data-wherefield');
                
                var status = self.attr('data-status');
                var user_status = 1;
                if (status == 1)
                    user_status = 0;

                if (!confirm('Are you sure want to update?'))
                    return;
                self.attr('disabled', 'disabled');

                var data = {
                    'table_id': self.data('id'),
                    'user_status': user_status,
                    'table':table,
                    'updatefield':updatefield,
                    'wherefield':wherefield,
                    [csrfName]: csrfHash
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);                                                
                        $('.ajax_csrfname').val(res.token);                        
                        if (res.suceess) {

                            var title = 'Click to locke customer';
                            var class_ = 'btn_lock_unlock_customer btn btn-xs btn-success';
                            var text = "Customer Unlocked <em class='icon ni ni-unlock-fill'></em>";
                            var isactive = 0;

                            if (status == 0) {
                                title = 'Click to unlocke customer';
                                class_ = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                                text = "Customer Locked <em class='icon ni ni-lock-fill'></em>";
                                isactive = 1;
                            }
                            self.removeClass().addClass(class_);
                            self.attr({
                                'data-status': isactive,
                                'title': title
                            });
                            self.removeAttr('disabled');
                            self.html(text);

                        }
                    }
                });
            }); 
            $(document).on('click', '.btn_active_inactive_customer', function () {

                var csrfName = $('.ajax_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.ajax_csrfname').val(); // CSRF hash
        
                var self = $(this);

                var table = self.attr('data-table');
                var updatefield = self.attr('data-updatefield');
                var wherefield = self.attr('data-wherefield');
                
                var status = self.attr('data-status');
                var user_status = "ACTIVE";
                if (status == "REMOVED")
                    user_status = "REMOVED";

                if (!confirm('Are you sure want to update?'))
                    return;
                self.attr('disabled', 'disabled');

                var data = {
                    'table_id': self.data('id'),
                    'user_status': user_status,
                    'table':table,
                    'updatefield':updatefield,
                    'wherefield':wherefield,
                    [csrfName]: csrfHash
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);                                                
                        $('.ajax_csrfname').val(res.token);                        
                        if (res.suceess) {

                            var title = 'Click to inactive customer';
                            var class_ = 'btn_active_inactive_customer btn btn-xs btn-success';
                            var text = "Customer Activated <em class='icon ni ni-user-check-fill'></em>";
                            var isactive = "REMOVED";

                            if (status == "REMOVED") {
                                title = 'Click to active customer';
                                class_ = 'btn_active_inactive_customer btn btn-xs btn-danger';
                                text = "Customer Inactivated <em class='icon ni ni-user-cross-fill'></em>";
                                isactive = "ACTIVE";
                            }
                            self.removeClass().addClass(class_);
                            self.attr({
                                'data-status': isactive,
                                'title': title
                            });
                            self.removeAttr('disabled');
                            self.html(text);

                        }
                    }
                });
            }); 
        });
    </script>
<?php } ?> 
</body>
</html>