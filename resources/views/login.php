<body class="text-center center-body">
<form class="form-signin" method="POST">
    <img class="mb-4" src="<?php resource("img/logo.png"); ?>">
    <h1 class="h3 mb-3 font-weight-normal">Ju lutem logohuni</h1>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="<?php __("email"); ?>" required
           autofocus>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="<?php __("password") ?>"
           required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> <?php __("remember_me") ?>
        </label> <br>
        <a href="/forgot">Keni harruar fjalekalimin?</a>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Hyr</button>
    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</form>

</body>

</html>