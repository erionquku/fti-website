<body class="hold-transition lockscreen">

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">

    <div class="lockscreen-logo">
        <a href="<?php echo route('home') ?>">
            <img class="mb-4" src="<?php resource("img/logo.png"); ?>">
        </a>
    </div>

    <div id="alerts"></div>

    <?php
        $now = new DateTime();
        if (((array)$now)['date'] < $this->token->expires_at) {
            echo ___("signup.confirm_register");
            include_once __DIR__ . "/fragments/Fregister.php";
        }
        else
            echo "<h4>This token has expired!<br> 
            Please <a href=". route('register') .">click here</a> to get a new one!</h4>"; ?>

    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>

</div>

<script type="text/javascript">

    $("#registerButton").click(function () {
        $.ajax({
            url: "<?php echo route('api.register_with_token'); ?>",
            method: "POST",
            data: {
                "first_name": $("#first_name").val(),
                "last_name": $("#last_name").val(),
                "email": "<?php echo $this->token->email; ?>",
                "password": $("#password").val(),
                "faculty": $("#faculty").val(),
                "year": $("#year").val(),
                "token": "<?php echo $this->token->token; ?>"
            },
            success: function (msg) {
                if (!msg.success)
                    $('#alerts').empty().prepend(showAlert('danger', msg.message, 'Error!'));
                else
                    window.location.replace("/home/");
                $("#alerts").last().hide().fadeIn(200);
            }
        });

    });

</script>
