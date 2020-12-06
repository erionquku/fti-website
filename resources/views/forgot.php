
<body class="text-center center-body">
<div class="form-signin">
    <img class="mb-4" src="/resources/img/logo.png">
    <h1 class="h3 mb-3 font-weight-normal"><?php __('enter_email') ?></h1>
    <div id="alerts"></div>
    <input id="forgot_email" type="email" name="email" class="form-control" placeholder="<?php __("email"); ?>" required autofocus>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="reset_button"><? __('reset_top') ?></button>
    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</div>
</body>

<script type="text/javascript">

    $('#reset_button').click(function () {
        $.ajax({
            url: "http://fti.upt.al/api/forgot",
            method: "POST",
            data: {
                "email": $("#forgot_email").val()
            },
            success: function (data) {
                msg = jQuery.parseJSON(data);
                console.log(msg.status);
                if (msg.status === "fail")
                    $('#alerts').empty().prepend(showAlert('danger', msg.message, 'Error!'));
                else if (msg.status === "success")
                    $('#alerts').empty().prepend(showAlert('success', msg.message, 'Success!'));
                $("#alerts").last().hide().fadeIn(200);
            }
        });
    });

</script>