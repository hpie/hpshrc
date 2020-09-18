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

<input class="ajax_csrfname" type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" /> 
<!-- app-root @e -->
<!-- JavaScript -->
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/bundle.js"></script>
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/scripts.js"></script>

<link rel="stylesheet" href="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>css/editors/summernote.css">
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/libs/editors/summernote.js"></script>
<!--<script src="<?php //echo EMPLOYEE_ASSETS_FOLDER; ?>js/editors.js"></script>-->
<?php include 'assets/employee/js/editors.php'; ?>

<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/toastr.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/charts/chart-ecommerce.js" type="text/javascript" nonce='S51U26wMQz'></script>

<!-- datatable start js  -->
<script nonce='S51U26wMQz' src="<?php echo CENTRAL_ASSETS_FOLDER; ?>datatable/jquery.dataTables.min.js" type="text/javascript"></script>
<script nonce='S51U26wMQz' src="<?php echo CENTRAL_ASSETS_FOLDER; ?>datatable/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo CENTRAL_ASSETS_FOLDER; ?>datatable/dataTables.responsive.min.js" type="text/javascript" nonce='S51U26wMQz'></script>
<script nonce='S51U26wMQz' src="<?php echo CENTRAL_ASSETS_FOLDER; ?>bootstrap/bootstrapValidator.min.js" type="text/javascript"></script>

<?php include(APPPATH . "Views/employee/common/notify.php"); ?>

<script type="text/javascript" nonce='S51U26wMQz'>
    $(document).ready(function () {
        $(".mobileno").keyup(function (e) {
            var str = $(this).val();
            for (var i = 0; i < str.length; i++) {
                var charCode = str.charAt(i).charCodeAt(0);
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

<?php if ($title == EMPLOYEE_UPDATE_PROFILE_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {
            
             $.fn.bootstrapValidator.validators.securePassword = {
        validate: function(validator, $field, options) {
            var value = $field.val();
            if (value === '') {
                return true;
            }

            // Check the password strength
            if (value.length < 8) {
                return {
                    valid: false,
                    message: 'The password must be more than 8 characters long'
                };
            }
            
            if (value.length > 20) {
                return {
                    valid: false,
                    message: 'The password must be less than 20 characters'
                };
            }

            // The password doesn't contain any uppercase character
            if (value === value.toLowerCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one upper case character'
                };
            }

            // The password doesn't contain any uppercase character
            if (value === value.toUpperCase()) {
                return {
                    valid: false,
                    message: 'The password must contain at least one lower case character'
                };
            }

            // The password doesn't contain any digit
            if (value.search(/[0-9]/) < 0) {
                return {
                    valid: false,
                    message: 'The password must contain at least one digit'
                };
            }

            return true;
        }
    };
            
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
                            identical: {
                                field: 'user_confirm_password',
                                message: 'The password and its confirm are not the same'
                            },
                            securePassword: {
                                message: 'The password is not valid'
                            },
                            notEmpty: {
                                message: 'Please supply your new password'
                            }
                        }
                    },
                    user_confirm_password: {
                        validators: {
                            securePassword: {
                                message: 'The password is not valid'
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


<?php if ($title == EMPLOYEE_LIST_CASES_TITLE) {
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
                        'url': "<?php echo BASE_URL . '/assets/DataTablesSrc-master/cases_list.php' ?>",
                        'data': {
                            employee_user_id: <?php
    if (isset($_SESSION['employee']['employee_user_id'])) {
        echo $_SESSION['employee']['employee_user_id'];
    }
    ?>
                        }
                    },
                    "columns": [
                        {"data": "index"},
                        {"data": "cases_title"},
                        {"data": "cases_priority"},
                        {"data": "employee_name"},
                        {"data": "cases_status"},
                        {"data": "cases_dt_created"},
                        {"data": "action"}
                    ]
                });
            }
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
    if (isset($_SESSION['employee']['employee_user_id'])) {
        echo $_SESSION['employee']['employee_user_id'];
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
                    'table': table,
                    'updatefield': updatefield,
                    'wherefield': wherefield,
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

                            var title = 'Click to unverify email';
                            var class_ = 'btn_approve_reject_email btn btn-xs btn-success';
                            var text = "Email Verified <em class='icon ni ni-check-thick'></em>";
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to verify email';
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
                var user_status = status;

                if (!confirm('Are you sure want to update?'))
                    return;
                self.attr('disabled', 'disabled');

                var data = {
                    'table_id': self.data('id'),
                    'user_status': user_status,
                    'table': table,
                    'updatefield': updatefield,
                    'wherefield': wherefield,
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
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to unlocke customer';
                                class_ = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                                text = "Customer Locked <em class='icon ni ni-lock-fill'></em>";
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
                    'table': table,
                    'updatefield': updatefield,
                    'wherefield': wherefield,
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
<?php if ($title == EMPLOYEE_ADD_CASES_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {                                    
            $('#add_cases').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    case_files_file: {
                        validators: {
                            file: {
                                extension: 'jpeg,png,jpg,pdf',
                                type: 'image/jpeg,image/png,image/jpg,application/pdf',                                
                                message: 'The selected file is not valid'
                            },
                            notEmpty: {
                                message: 'Please select profile image'
                            }
                        }
                    },                    
                    cases_title: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please Enter Title'
                            }
                        }
                    }
                }
            });
        });
    </script>
<?php } ?>  
    
<?php if ($title == EMPLOYEE_EDIT_CASES_TITLE) {
    ?>
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () {                                    
            $('#edit_cases').bootstrapValidator({
                // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {                                       
                    cases_title: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please Enter Title'
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
                     customer_first_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your first name'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                        }
                    },                    
                    customer_middle_name: {
                        validators: {
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                            
                        }
                    },                    
                    customer_last_name: {
                        validators: {
                             stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your last name'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                        }
                    },
                    customer_father_name: {
                        validators: {
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                            
                        }
                    },
                    customer_mobile_no: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 10
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
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                        }
                    },                    
                    customer_middle_name: {
                        validators: {
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                            
                        }
                    },                    
                    customer_last_name: {
                        validators: {
                             stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please supply your last name'
                            },
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                        }
                    },
                    customer_father_name: {
                        validators: {
                            regexp: {
                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
                                message: 'Special character not allowed'
                            }
                            
                        }
                    },
                    customer_mobile_no: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 10
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
</body>
</html>