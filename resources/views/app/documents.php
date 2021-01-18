<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php __('title.documents') ?></h1>
                </div>
            </div>
        </div>
    </div>

    <?php
        $userURL = str_replace(":id", $this->user->id, route('generate_document'));
        $vertetimURL = str_replace(":type", 'vertetim', $userURL);
        $listenotashURL = str_replace(":type", 'listenotash', $userURL);
    ?>

    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center pt-md-5">

                <div class="col-md-4 align-self-center">
                    <div class="card card-primary mr-2">
                        <div class="card-header">
                            <h3 class="text-center">Vertetim Studenti</h3>
                        </div>
                        <div class="card-body">

                            Shërbimi elektronik "Vërtetim Studenti" ju mundëson të shikoni dhe verifikoni të dhënat personale, dhe të gjeneroni dokumentin personal me vulë elektronike. <br><br>
                            <b>Kosto:</b><br> Pa pagese <br><br>
                            <b>Koha e marrjes se sherbimit:</b><br> Menjehere <br>

                            <a href="<?php echo $vertetimURL; ?>" class="btn btn-outline-primary btn-block mt-md-4">
                                <i class="fa fa-download"></i>
                                Gjenero dhe Shkarko
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->

                <div class="col-md-4 align-self-center">
                    <div class="card card-primary mr-2">
                        <div class="card-header">
                            <h3 class="text-center">Listë Notash</h3>
                        </div>
                        <div class="card-body">

                            Shërbimi elektronik "Listë Notash" ju mundëson të shikoni dhe verifikoni të notat e marra ne çdo lëndë, dhe të gjeneroni dokumentin me vulë elektronike. <br><br>
                            <b>Kosto:</b><br> Pa pagese <br><br>
                            <b>Koha e marrjes se sherbimit:</b><br> Menjehere <br>

                            <a href="<?php echo $listenotashURL; ?>" class="btn btn-outline-primary btn-block mt-md-4">
                                <i class="fa fa-download"></i>
                                Gjenero dhe Shkarko
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->

            </div>

        </div>
    </section>
</div>