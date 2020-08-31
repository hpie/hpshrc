<!-- footer content -->
<footer>
    <div class="pull-right">
        <h4>Designed by <a href="http://hpie.in" target="_blank">H.P.I.E</a></h4>
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>
<div id="ApprovedstatusModal" class="modal main_popup fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close press_no" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
                <h4 class="modal-title" id="myModalLabel" style="">Confirmation!</h4>
            </div>
            <div class="modal-body">
                <p style="">Are you sure you want to <strong id="modelboxstatus">Approved?</strong></p>
            </div>
            <div class="modal-footer"> <button type="button" class="btn btn-default press_no" data-dismiss="modal">No</button> <button type="button" class="btn btn-primary press_yes" data-id="0" data-value="none">Yes</button> </div>
        </div>
    </div>
</div>
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
<!-- jQuery -->

<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>jquery/dist/jquery.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>bootstrap/dist/js/bootstrap.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>icheck/icheck.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<!-- FastClick -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>fastclick/lib/fastclick.js" type="text/javascript" nonce='S51U26wMQz'></script>
<!-- NProgress -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>nprogress/nprogress.js" type="text/javascript" nonce='S51U26wMQz'></script>

<!-- DateJS -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>moment/min/moment.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<!-- PNotify -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>bootstrap-daterangepicker/daterangepicker.js" type="text/javascript" nonce='S51U26wMQz'></script>
<!--<script src="<?php //echo ADMIN_ASSETS_FOLDER;  ?>pnotify/dist/pnotifyadmin.js" type="text/javascript" nonce='S51U26wMQz'></script>-->
<!-- bootstrap-wysiwyg -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>editor/jquery.hotkeys.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>editor/prettify.js" type="text/javascript" nonce='S51U26wMQz'></script>
<!-- Datatables -->
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
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" nonce='S51U26wMQz'></script>
<link href="<?php echo ADMIN_ASSETS_FOLDER; ?>bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
<script nonce='S51U26wMQz' src="<?php echo BASE_URL; ?>/assets/front/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL ?>/assets/front/js/dataTables.responsive.min.js" type="text/javascript" nonce='S51U26wMQz'></script>

<script nonce='S51U26wMQz' src="<?php echo BASE_URL ?>/assets/front/js/bootstrapValidator.min.js" type="text/javascript"></script>
<!--Slider--> 
<!-- ECharts -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>echarts/dist/echarts.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>echarts/map/js/world.js" type="text/javascript" nonce='S51U26wMQz'></script>
<!-- Custom Theme Scripts -->
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>build/js/custom.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo ADMIN_ASSETS_FOLDER; ?>moment/moment.min.js" type="text/javascript" nonce='S51U26wMQz'></script>

<?php include(APPPATH . "Views/adminside/common/notify.php"); ?>
<script nonce='S51U26wMQz' type="text/javascript" src="https://www.google.com/recaptcha/api.js" async defer></script>
<script type="text/javascript" nonce='S51U26wMQz'>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }
</script>
<script type="text/javascript" nonce='S51U26wMQz'>
     $(document).ready(function () {   
    $(".mobileno").keyup(function (e) {
            var str=$(this).val();
            for (var i = 0; i < str.length; i++) {
                var charCode=str.charAt(i).charCodeAt(0);                  
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                {                                    
                    $(this).val('');
                    return false;
                }                                       
            }               
            return true;
        });
    });
</script>

<script type="text/javascript" nonce='S51U26wMQz'>
    $(document).ready(function () {
        $('#dp4').datepicker({
            format: 'yyyy',
            viewMode: 'years',
            minViewMode: 'years',
            autoclose: true
        });
        $('#dp5').datepicker({
            dateFormat: 'MM yy',
            format: 'mm-yyyy',
            viewMode: 'months',
            minViewMode: 'months',
            autoclose: true
        });
    });
</script>
  <?php if ($title == ADMIN_CUSTOMER_LIST_TITLE) {
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
                        'url': "<?php echo BASE_URL . '/assets/DataTablesSrc-master/admin_customers_list.php' ?>",
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
                    url: "<?php echo ADMIN_APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);                                                
                        $('.ajax_csrfname').val(res.token);                        
                        if (res.suceess) {

                            var title = 'Click to unverify email';
                            var class_ = 'btn_approve_reject_email btn btn-xs btn-success';
                            var text = "Email Verified <i class='fa fa-check'></i>";
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to verify email';
                                class_ = 'btn_approve_reject_email btn btn-xs btn-danger';
                                text = "Verify Email <i class='fa fa-close'></i>";
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
                var user_status = status;               

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
                    url: "<?php echo ADMIN_APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);                                                
                        $('.ajax_csrfname').val(res.token);                        
                        if (res.suceess) {

                            var title = 'Click to locke customer';
                            var class_ = 'btn_lock_unlock_customer btn btn-xs btn-success';
                            var text = "Customer Unlocked <i class='fa fa-unlock'></i></em>";
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to unlocke customer';
                                class_ = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                                text = "Customer Locked <i class='fa fa-lock'></i></em>";
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
                    url: "<?php echo ADMIN_APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);                                                
                        $('.ajax_csrfname').val(res.token);                        
                        if (res.suceess) {

                            var title = 'Click to inactive customer';
                            var class_ = 'btn_active_inactive_customer btn btn-xs btn-success';
                            var text = "Customer Activated <i class='fa fa-check'></i>";
                            var isactive = "REMOVED";

                            if (status == "REMOVED") {
                                title = 'Click to active customer';
                                class_ = 'btn_active_inactive_customer btn btn-xs btn-danger';
                                text = "Customer Inactivated <i class='fa fa-close'></i>";
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
<?php if ($title == ADMIN_FILE_LIST_TITLE) {
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
                        'url': "<?php echo BASE_URL . '/assets/DataTablesSrc-master/file_list.php' ?>",
                        'data': {
                            admin_user_id: <?php
                            if (isset($_SESSION['user_id'])) {
                                echo $_SESSION['user_id'];
                            }
                            ?>
                        }
                    },
                    "columns": [
                        {"data": "index"},
                        {"data": "upload_file_id"},
                        {"data": "upload_file_title"},
                        {"data": "upload_file_original_name"},
                        {"data": "upload_file_desc"},
                        {"data": "upload_file_ref_no"},
                        {"data": "category_title_main"},
                        {"data": "category_title_sub"},
                        {"data": "upload_file_status"},
                        {"data": "action"}
                    ]
                });
            }
            
              $(document).on('click', '.btn_approve_reject', function () {
              
                var csrfName = $('.ajax_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.ajax_csrfname').val(); // CSRF hash
              
                var self = $(this);

                var status = self.attr('data-status');

                var upload_file_status = 'ACTIVE';

                if (status == 1) {
                    upload_file_status = 'REMOVED';
                }

                if (!confirm('Are you sure want to ' + upload_file_status.toLocaleLowerCase() + ' causes?'))
                    return;

                self.attr('disabled', 'disabled');

                var data = {
                    'upload_file_id': self.data('id'),
                    'upload_file_status': upload_file_status,
                    [csrfName]: csrfHash
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo ADMIN_FILES_ACTIVE_LINK ?>",
                    data: data,
                    success: function (res) {
                        var data = $.parseJSON(res);
                        $('.ajax_csrfname').val(data.token);
                        if (data.suceess) {
                            var title = 'Click to deactivate causes';
                            var class_ = 'btn_approve_reject btn btn-success btn-xs';
                            var text = 'Active';
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to active causes';
                                class_ = 'btn_approve_reject btn btn-danger btn-xs';
                                text = 'Removed';
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
            
        });

    </script>
<?php } ?>
<?php if ($title == ADMIN_UPDATE_PROFILE_TITLE) {
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
                        location.href = "<?php echo ADMIN_UPDATE_PROFILE_LINK; ?>";
                    }
                    if (result['success'] == "fail") {
                        PNotify.error({
                            title: 'Error!',
                            text: 'Old password not match'
                        });
                    }
                    $('.txt_csrfname').val(result['token']);
                }, 'json');
            });
        });
    </script>
<?php } ?>

<?php if ($title == ADMIN_ADD_CAUSES_TITLE || $title == ADMIN_EDIT_CAUSES_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {
            $('#upload_file_type').on('change', function () {
                
                var csrfName = $('.txt_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
                var csrfHash = $('.txt_csrfname').val(); // CSRF hash
                
                var category_code = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo ADMIN_LOAD_SUB_CATEGORIES_LINK ?>",
                    data: {'category_code': category_code,[csrfName]: csrfHash},
                    success: function (res) {
                        var data = jQuery.parseJSON(res);
                        $('.txt_csrfname').val(data.token);
                        $("#upload_file_sub_type").empty();
                        $("#upload_file_sub_type").append(new Option('---Select---', ''));
                        $.each(data.sub_type, function (index, value) {
                            $("#upload_file_sub_type").append(new Option(value.category_title, value.category_code));
                        });                        
                    }
                });
            });
            
            
             $('#add_causes').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    upload_file_title: {
                        validators: {
                            stringLength: {
                                max: 50
                            },
                            notEmpty: {
                                message: 'Please Enter Title'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }                            
                        }
                    },
                    upload_file_desc: {
                        validators: {
                            stringLength: {
                                max: 500
                            },
                            notEmpty: {
                                message: 'Please Enter Descriptipn'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }                            
                        }
                    },
                    upload_file_ref_no: {
                        validators: {
                            stringLength: {
                                max: 50
                            },
                            notEmpty: {
                                message: 'Please Enter Ref No'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }                            
                        }
                    },
                    upload_file_type: {
                        validators: {                           
                            notEmpty: {
                                message: 'Please Select File Type'
                            }                                                       
                        }
                    },
                    upload_file_sub_type: {
                        validators: {                           
                            notEmpty: {
                                message: 'Please Select Sub File Type'
                            }                                                       
                        }
                    },
                    upload_file_original_name: {
                        validators: {                           
                            notEmpty: {
                                message: 'Please Choose File'
                            }                                                       
                        }
                    }
                }
            });
        });
    </script>
<?php } ?>
    
    <?php if ($title == CUSTOMER_REGISTRATION_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">

        $(document).ready(function () {            
            
            $('#student_register').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {                    
                    customer_photo_path: {
                        validators: {
                            file: {
                                extension: 'jpeg,jpg,png',
                                type: 'image/jpeg,image/png,image/jpg',                                
                                message: 'The selected file is not valid'
                            },
                            notEmpty: {
                                message: 'Please select profile image'
                            }
                        }
                    },                    
                    customer_first_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your first name'
                            }
                        }
                    },                    
                    customer_middle_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your last name'
                            }
                        }
                    },
                    customer_mobile_no: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max:10
                            },
                            notEmpty: {
                                message: 'Please Enter mobile number'
                            }
                        }
                    },
                    customer_email_id: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your email address'
                            },
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            }
                        }
                    },
                    customer_email_password: {
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
                                field: 'customer_email_password',
                                message: 'The password and its confirm are not the same'
                            },
                            notEmpty: {
                                message: 'Please supply your confirm password'
                            }
                        }
                    },
                    customer_dob: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your date of birth'
                            }
                        }
                    }
                }
            }); 
        });
    </script>
<?php } ?>  
    <?php if ($title == EDIT_CUSTOMER_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">

        $(document).ready(function () {            
            
            $('#edit_customer').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {                                                           
                    customer_first_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your first name'
                            }
                        }
                    },                    
                    customer_middle_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your last name'
                            }
                        }
                    },
                    customer_mobile_no: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max:10
                            },
                            notEmpty: {
                                message: 'Please Enter mobile number'
                            }
                        }
                    },
                    customer_email_id: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your email address'
                            },
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            }
                        }
                    },            
                    customer_dob: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your date of birth'
                            }
                        }
                    }
                }
            }); 
        });
    </script>
<?php } ?>  
    
<?php
if (isset($_SESSION['data'])) {
    unset($_SESSION['data']); 
}
?>
</body>
</html>