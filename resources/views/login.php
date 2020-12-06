<body class="text-center center-body">
<div class="form-signin" method="POST">
    <img class="mb-4" src="<?php resource("img/logo.png"); ?>">
    <div id="alerts" ></div>
    <h1 class="h3 mb-3 font-weight-normal">Ju lutem logohuni</h1>
    <input type="email" name="email" id="email" class="form-control" placeholder="<?php __("email"); ?>" required
           autofocus>
    <input type="password" name="password" id="password" class="form-control" placeholder="<?php __("password") ?>"
           required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> <?php __("remember_me") ?>
        </label> <br>
        <a href="/forgot">Keni harruar fjalekalimin?</a>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="loginButton">Hyr</button>
    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</div>
</body>

<script type="text/javascript">


    $("#loginButton").click(function (){

        $.ajax({
            url: "<?php echo route('api.login'); ?>",
            method: "POST",
            data: {
                "email": $("#email").val(),
                "password": $("#password").val()
            },
            success: function (msg) {
                console.log("msg: " + msg);
                const response = JSON.parse(msg);
                if (!response.success) {
                    $('#alerts').empty().prepend(showAlert('danger', response.message , 'Error!'));
                } else if (response.success) {
                    console.log("redirecting to home");
                    window.location.replace("/home/");
                }
                $("#alerts").last().hide().fadeIn(200);
            }
        });

    });


</script>