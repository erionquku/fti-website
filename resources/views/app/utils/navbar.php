<?php
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>-->
<!--        </li>-->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo route('home_page') ?>" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo route('profile_page') ?>" class="nav-link">Profile</a>
        </li>
    </ul>

    <div class="navbar-nav ml-auto">

        <li class="nav-item d-sm-inline-block mr-md-2 ml-md-2 <?php echo $_SESSION['lang'] == 'it' ? "text-primary" : "" ?>" id="langIT" data-toggle="tooltip" title="Italiano">
            <?php echo $_SESSION['lang'] == 'it' ? "<b>IT</b>" : "IT" ?>
        </li>
|
        <li class="nav-item d-sm-inline-block mr-md-2 ml-md-2 <?php echo $_SESSION['lang'] == 'en' ? "text-primary" : "" ?>" id="langEN" data-toggle="tooltip" title="English">
            <?php echo $_SESSION['lang'] == 'en' ? "<b>EN</b>" : "EN" ?>
        </li>
|
        <li class="nav-item d-sm-inline-block mr-md-2 ml-md-2 <?php echo $_SESSION['lang'] == 'sq' ? "text-primary" : "" ?>" id="langSQ" data-toggle="tooltip" title="Shqip">
            <?php echo $_SESSION['lang'] == 'sq' ? "<b>SQ</b>" : "SQ" ?>
        </li>


        <!-- SEARCH FORM -->
<!--        <form class="form-inline ml-3">-->
<!--            <div class="input-group input-group-sm">-->
<!--                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">-->
<!--                <div class="input-group-append">-->
<!--                    <button class="btn btn-navbar" type="submit">-->
<!--                        <i class="fas fa-search"></i>-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
    </div>

</nav>
<!-- /.navbar -->

<script type="text/javascript">

    $("[id^=lang]")
        .css("cursor", "pointer")
        .click(function() {
            let lang = $(this)[0].innerText

            let url = "<?php echo route('api.language.change') ?>";
            url = url.substr(0, url.lastIndexOf(':')) + lang + '/';

            $.ajax({
                type: "POST",
                url: url,
                success: function () {
                    location.reload();
                }
            })

        });

</script>