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
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/bundle.js"></script>
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/scripts.js"></script>

<link rel="stylesheet" href="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>css/editors/summernote.css">
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/libs/editors/summernote.js"></script>
<script type="text/javascript" nonce='S51U26wMQz' src="<?php echo EMPLOYEE_ASSETS_FOLDER; ?>js/apps/messages.js"></script>
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
//                    $('.txt_csrfname').val(result['token']);
                }, 'json');
            });
        });
    </script>
<?php } ?>

<?php if ($title == EMPLOYEE_VIEW_CASES_TITLE) {
    ?> 
    <script nonce='S51U26wMQz' type="text/javascript">
        $(document).ready(function () { 
            
        $('#customCheck1').change(function() {
            if(this.checked) {
                var returnVal = confirm("Are you sure you want to close?");
                $(this).prop("checked", returnVal);
            }
            $('#customCheck1').val(this.checked);        
        });      
            
            
        $("#add_comment").on('submit', function(e){                        
        var fileUpload = document.getElementById('case_files_file');
        if (parseInt(fileUpload.files.length)>3){
            toastr.error('You can only upload a maximum of 3 files.'); 
            return false;
        }        
        var comment = $(".summernote-basic-id").val();
        if (comment===''){            
            toastr.error('Plz add description in comment'); 
            return false;
        }
        var hearingdate=$("#cases_hearing_date").val();
        if(hearingdate===''){            
            if ($('#customCheck1').is(":checked")){}
            else{            
                toastr.error('Plz select hearing date'); 
                return false;
            }
        }
        
        
        for (var i = 0; i <= fileUpload.files.length - 1; i++) {
            if (fileUpload.files.item(i).size > 2097152) {
                toastr.error('Try to upload all files less than 2MB!');                
                return false;
            }
        }                               
        if(confirm("Confirm before submit")) {    
            e.preventDefault();
            var last_comment_id=$( ".lastcomment" ).first().data("value");
            var form_data = new FormData(this);
            form_data.append('last_comment_id', last_comment_id);
            $.ajax({
                type: 'POST',
                url: '<?php echo EMPLOYEE_ADD_COMMENT_LINK; ?>',
                data: form_data,
                contentType: false,
                cache: false,
                processData:false,           
                success: function(res){
                    var res = $.parseJSON(res);
    //                $('.ajax_csrfname').val(res.token);
                    if(res.message==="success"){
                        if(res.case_sts==="yes"){
                            location.reload();
                        }
                        $("#cases_hearing_date").val('');
                        $( ".lastcomment" ).first().before( res.comments );                                                
                        $('.summernote-basic-id').summernote("code",'');
                        $('.simplebar-content-wrapper').scrollTop(0); 
                    }
                }        
            });
        }
        else{
            return false;
        }
    });
            
         
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
                    searching: false,
                    paging: false,
                    bInfo: false                                                     
                });
            }
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
                    "order": [[ 1, "desc" ]],
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 10,
                    "paginationType": "full_numbers",
                    "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                    "ajax": {
                        'type': 'POST',
                        'url': "<?php echo BASE_URL . '/DataTablesSrc-master/cases_list.php' ?>",
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
                        {"data": "case_no"},
                        {"data": "cases_title"},
                        {"data": "cases_priority"},
                        {"data": "employee_name"},
                        {"data": "cases_status"},
                        {"data": "cases_dt_created"},
                        {"data": "action"}
                    ]
                });
            }
             $(document).on('click', '.btn_lock_unlock_customer', function () {
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
                    'wherefield': wherefield
//                    [csrfName]: csrfHash
                };
                $.ajax({
                    type: "POST",
                    url: "<?php echo APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);
//                        $('.ajax_csrfname').val(res.token);
                        if (res.suceess) {
                            var title = 'Click to locke Complainant';
                            var class_ = 'btn_lock_unlock_customer btn btn-xs btn-success';
                            var text = "Complainant Unlocked <em class='icon ni ni-unlock-fill'></em>";
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to unlocke Complainant';
                                class_ = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                                text = "Complainant Locked <em class='icon ni ni-lock-fill'></em>";
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
                        'url': "<?php echo BASE_URL . '/DataTablesSrc-master/customers_list.php' ?>",
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

//                var csrfName = $('.ajax_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
//                var csrfHash = $('.ajax_csrfname').val(); // CSRF hash

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
                    'wherefield': wherefield
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);
//                        $('.ajax_csrfname').val(res.token);
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

//                var csrfName = $('.ajax_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
//                var csrfHash = $('.ajax_csrfname').val(); // CSRF hash

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
                    'wherefield': wherefield
//                    [csrfName]: csrfHash
                };

                $.ajax({
                    type: "POST",
                    url: "<?php echo APPROVE_STATUS ?>",
                    data: data,
                    success: function (res) {
                        var res = $.parseJSON(res);
//                        $('.ajax_csrfname').val(res.token);
                        if (res.suceess) {

                            var title = 'Click to locke Complainant';
                            var class_ = 'btn_lock_unlock_customer btn btn-xs btn-success';
                            var text = "Complainant Unlocked <em class='icon ni ni-unlock-fill'></em>";
                            var isactive = 1;

                            if (status == 1) {
                                title = 'Click to unlocke Complainant';
                                class_ = 'btn_lock_unlock_customer btn btn-xs btn-danger';
                                text = "Complainant Locked <em class='icon ni ni-lock-fill'></em>";
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

//                var csrfName = $('.ajax_csrfname').attr('name'); // Value specified in $config['csrf_token_name']
//                var csrfHash = $('.ajax_csrfname').val(); // CSRF hash

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
                    'wherefield': wherefield
//                    [csrfName]: csrfHash
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

                            if (status === "REMOVED") {
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
            $("#case_files_file").on("change", function(){                
                $('.case_files_file_title_desc').remove();                
                var numFiles = $(this)[0].files.length;
                var i;
                var text='';
                for (i = 1; i <= numFiles; i++) {                  
				text+="<div class='row g-3 align-center case_files_file_title_desc'><div class='col-lg-4'><div class='form-group'><label class='form-label float-right' for='title_file'>Title: ["+$(this)[0].files.item(i-1).name.substr(0,30)+" ] </label></div></div><div class='col-lg-4'><div class='form-control-wrap'><input type='text' class='form-control' name='title_file[]' placeholder='Enter "+$(this)[0].files.item(i-1).name.substr(0,30)+" title' required autocomplete='off'></div></div></div></div>";
                    text+="<div class='row g-3 align-center case_files_file_title_desc'><div class='col-lg-4'><div class='form-group'><label class='form-label float-right' for='desc_file'>Description: ["+$(this)[0].files.item(i-1).name.substr(0,30)+" ] </label></div></div><div class='col-lg-4'><div class='form-group'><div class='form-control-wrap'><textarea class='form-control' rows='2' name='desc_file[]'  placeholder='Enter "+$(this)[0].files.item(i-1).name.substr(0,30)+" description'></textarea></div></div></div></div>";                    
                }
                $( ".case_files_file_div" ).after(text);
            });
                        
            $('#howtocontact').on('change', function () {
                var howtocontact = $(this).val();
                if(howtocontact=='Email'){
                    $(".howtocontact_email").removeClass("howtocontact");
                    $("#customer_email").val("");
                    $("#customer_contact").val("9999999999");
                    $(".howtocontact_mobile").addClass("howtocontact");
                }
                if(howtocontact=='Mobile'){
                    $(".howtocontact_mobile").removeClass("howtocontact");
                    $("#customer_contact").val("");
                    $("#customer_email").val("example@gmail.com");
                    $(".howtocontact_email").addClass("howtocontact");
                }
                if(howtocontact=='Both'){
                    $(".howtocontact_email").removeClass("howtocontact");
                    $(".howtocontact_mobile").removeClass("howtocontact");
                    $("#customer_email").val("");
                    $("#customer_contact").val("");
                }
            });
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
                    customer_email: {
                        validators: {                            
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            },
                            notEmpty: {
                                message: 'Please enter valid email address'
                            }
                        }
                    },
                    customer_contact: {
                        validators: {
                            stringLength: {
                                min: 10,
                                max: 10
                            },
                            notEmpty: {
                                message: 'Please enter valid mobile number'
                            }
                        }
                    },
                    cases_party_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please Enter Party Name'
                            }
                        }
                    },
                    cases_no: {
                        validators: {
                            stringLength: {
                                min: 3
                            },
                            notEmpty: {
                                message: 'Please Enter Case No'
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
                    },
                    cases_party_name: {
                        validators: {
                            stringLength: {
                                min: 2
                            },
                            notEmpty: {
                                message: 'Please Enter Party Name'
                            }
                        }
                    },
                    cases_no: {
                        validators: {
                            stringLength: {
                                min: 3
                            },
                            notEmpty: {
                                message: 'Please Enter Case No'
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
//                    customer_middle_name: {
//                        validators: {
//                            regexp: {
//                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
//                                message: 'Special character not allowed'
//                            }
//                            
//                        }
//                    },                    
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
//                    customer_middle_name: {
//                        validators: {
//                            regexp: {
//                                regexp: /^[^*|\":<>[\]{}`\\()';@&/$]+$/,
//                                message: 'Special character not allowed'
//                            }
//                            
//                        }
//                    },                    
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