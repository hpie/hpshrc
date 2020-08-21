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
</body>
</html>