<body class="hold-transition lockscreen">

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">

    <div class="lockscreen-logo">
        <a href="<?php echo route('home') ?>">
            <img class="mb-4" src="<?php resource("img/logo.png"); ?>">
        </a>
    </div>

    <h1 class="h4 mb-3 font-weight-normal">Hi <?php echo "$this->first_name $this->last_name";?>,<br>
        Please enter new password below:</h1>

    <div id="alerts"></div>

    <div class="form-row">
        <div class="col pb-md-1">
            <input type="password" id="password" class="form-control" placeholder="Password"
                   required
                   autofocus>
        </div>
    </div>
    <div class="form-row">
        <div class="col pb-md-2">
            <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password"
                   required>
        </div>
    </div>
    <button class="btn btn-lg btn-success btn-block" id="resetButton" type="button"><?php __("reset") ?></button>

    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>

</div>

<script type="text/javascript">

    $("#resetButton").click(function () {

        if ($("#password").val() === $("#confirm_password").val())
        {
            $.ajax({
                url: "<?php echo route('api.reset_password'); ?>",
                method: "POST",
                data: {
                    "password": $("#password").val(),
                    "token": "<?php echo $this->token->token; ?>"
                },
                success: function (data) {
                    let msg = JSON.parse(data);
                    if (!msg.success)
                        $('#alerts').empty().prepend(showAlert('danger', msg.message, 'Error!'));
                    else
                        window.location.replace("/home/");
                    $("#alerts").last().hide().fadeIn(200);
                }
            });
        } else {
            $("#alerts").empty().prepend(showAlert('danger', "Passwords do not match!", 'Error!'));
            $("#alerts").last().hide().fadeIn(200);
            $("#password").val("");
            $("#confirm_password").val("");
        }


    });

</script>
