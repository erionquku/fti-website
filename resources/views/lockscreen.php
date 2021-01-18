<body class="hold-transition lockscreen">

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">

    <div class="lockscreen-logo">
        <a href="<?php echo route('home') ?>">
            <img class="mb-4" src="<?php resource("img/logo.png"); ?>">
        </a>
    </div>

    <div id="alerts"></div>

    <!-- User name -->
    <div class="lockscreen-name"><?php echo $this->user->first_name . " ". $this->user->last_name; ?></div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="<?php storage('profilepics/thumbnail/default.png') ?>" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->


        <!-- lockscreen credentials (contains the form) -->
        <div class="lockscreen-credentials">
            <div class="input-group">
                <input type="password" class="form-control" placeholder="password" id="password" autofocus>

                <div class="input-group-append">
                    <button type="button" class="btn" id="loginButton">
                        <i class="fa fa-arrow-right text-muted"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        You have been logged in for more than 3 hours.<br>
        For security reasons, please re-enter your password!
    </div>
    <div class="text-center">
        Or <a href="<?php echo route('logout') ?>"> sign in as a different user</a>
    </div>

</div>

<script type="text/javascript">

    $("#loginButton").click(function () {
        login("<?php echo route('api.login'); ?>");
    });

    $(document).keypress(function(e) {
        if(e.which === 13) {
            login("<?php echo route('api.login'); ?>");
        }
    });

</script>