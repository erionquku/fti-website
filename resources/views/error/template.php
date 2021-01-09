<body class="hold-transition sidebar-closed sidebar-collapse">
<div class="wrapper">

    <!-- Main content -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"> </div>
        </section>
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-danger"><?php echo $this->error_title ?? 'Error!' ?></h2>

                <div class="error-content">
                    <h3>
                        <i class="fas fa-exclamation-triangle text-danger"></i> <?php echo $this->error_desc ?? 'Something went wrong.' ?>
                    </h3>

                    <p>
                        <?php echo $this->error_desc2 ?? 'We will work on fixing that right away.' ?>
                        You may <a href="<?php echo route('homepage') ?>">return to homepage</a>.
                    </p>

                </div>
            </div>

        </section>
    </div>
</div>
</body>