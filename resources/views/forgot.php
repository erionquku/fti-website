
<body class="text-center center-body">
<div class="form-signin">
    <a href="<?php echo route('home') ?>">
        <img class="mb-4" src="<?php resource("img/logo.png"); ?>">
    </a>
    <h1 class="h3 mb-3 font-weight-normal"><?php __('enter_email') ?></h1>
    <div id="alerts"></div>
    <input id="forgot_email" type="email" name="email" class="form-control mb-md-3" placeholder="<?php __("email"); ?>" required autofocus>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="reset_button"><?php __('reset_password') ?></button>
    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</div>

<!-- Modal -->
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotModalTitle">Forgot Password</h5>
                <button id="xButtonModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="alerts"></div>
                    <div id="forgotModalBody" class="text-left text-break"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalButton" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>
</body>

<script type="text/javascript">

    $('#reset_button').click(function () {
        $.ajax({
            url: "<?php echo route('api.forgot_get_token') ?>",
            method: "POST",
            data: {
                "email": $("#forgot_email").val()
            },
            success: function (data) {
                msg = jQuery.parseJSON(data);
                console.log(msg.status);
                if (!msg.success)
                    $('#alerts').empty().prepend(showAlert('danger', msg.message, 'Error!'));
                else {
                    // $('#alerts').empty().prepend(showAlert('success', msg.message, 'Success!'));
                    $("#forgotModalTitle").html(msg.title);
                    $("#forgotModalBody").html(msg.body);
                    $('#forgotModal').modal();
                }
                $("#alerts").last().hide().fadeIn(200);
            }
        });
    });

</script>