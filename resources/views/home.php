<body>
<div class="user-login-5">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg" style="background-image:url('<?php resource('img/fti-background.jpg') ?>')"> </div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content">
                <h1>Fakulteti i Teknologjise se Informacionit</h1>
                <br>
                <h2>Ky website ofron:</h2>

                <ul>
                    <li>Menaxhim per notat dhe lendet</li>
                    <li>Gjenerim dhe shkarkim vertetimesh apo liste notash ne formatin PDF</li>
                    <li>Kalendar me te gjitha detyrat dhe afatet per cdo student</li>
                    <li>Mesazhe private apo publike me pedagoget ose studentet e tjere</li>
                    <li>Informacione rreth pageses apo bursave</li>
                    <li>Gjenerimi i orarit per t'u shkarkuar ose shperndare</li>
                    <li>Librari Online ku mund te kontribuoje cdokush</li>
                    <li>Perdorim nga te gjithe studentet pa kosto shtese apo reklama</li>
                </ul>
                <br>
                <div class="container text-center">
                    <div class="row">
                        <div class="col">
                            <a class="btn btn-lg btn-outline-success" style="width: 50%" href="<?php echo route('login') ?>"> <?php __("login") ?> <i class="fa fa-sign-in"></i> </a></div>
                        <div class="w-100" style="padding-bottom: 2%"></div>
                        <div class="col" style="padding-bottom: 10%">
                            <a class="btn btn-lg btn-outline-primary" style="width: 50%" href="<?php echo route('register')?>"> <?php __("signup") ?><i class="fa fa-sign-up"></i></a>
                        </div>
                    </div>
                </div>

<!--                <form action="/login_check" method="post" class="login-form">-->
<!--                    <div class="alert alert-danger display-hide">-->
<!--                        <button class="close" data-close="alert"></button>-->
<!--                        <span>Vendos username dhe password. </span>-->
<!--                    </div>-->
<!--                    <div class="row">-->
<!--                        <div class="col-xs-6">-->
<!--                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" value="" autocomplete="off" placeholder="Username" name="_username" required="required" /> </div>-->
<!--                        <div class="col-xs-6">-->
<!--                            <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" name="_password" required="required" /> </div>-->
<!--                    </div>-->
<!--                    <div class="row">-->
<!--                        <div class="col-sm-4">-->
<!--                            <div class="rem-password">-->
<!--                                <label class="rememberme mt-checkbox mt-checkbox-outline">-->
<!--                                    <input type="checkbox" id="remember_me" name="_remember_me" value="on" /> Ruaj të dhënat-->
<!--                                    <span></span>-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="col-sm-8 text-right">-->
<!--                            <input class="btn green" type="submit" id="_submit" name="_submit" value="Hyr" />-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
            </div>
        </div>
    </div>
</div>
</body>