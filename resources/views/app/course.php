<?php
include_once("utils/sidebar.php");
?>

<link rel="stylesheet" href=" <?php resource("plugins/ekko-lightbox/ekko-lightbox.css"); ?> ">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $this->course->name; ?> </h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> <?php __('course.grades'); ?> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped text-nowrap" id="courses_table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Grade</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <?php
                                    foreach ($this->grades as $grade) {
                                        echo "<tr><td>" . $grade->id . "</td>
                                                <td>" . $grade->grade . "</td>
                                                <td>" . $grade->description . "</td></tr>";
                                    }

                                    ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"> <?php __('course.books'); ?> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped text-nowrap" id="courses_table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Author</th>
                                    <th>Pages</th>
                                    <th>Uploaded by</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <?php
                                    foreach ($this->books as $book) {
                                        echo "<tr><td>" . $book->id . "</td>
                                                <td>" . $book->title . "</td>
                                                <td>" . $book->description . "</td>
                                                <td>" . $book->author . "</td>
                                                <td>" . $book->page_no . "</td>
                                                <td>" . $book->uploader->first_name . " " .
                                                        $book->uploader->last_name. '</td>
                                                <td><button type="button" class="btn btn-block btn-outline-primary btn-sm">Download</button></td></tr>';
                                    }

                                    ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">Tezat</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=1" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=1" class="img-fluid mb-2" alt="white sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=2" data-toggle="lightbox" data-title="sample 2 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=2" class="img-fluid mb-2" alt="black sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=3" data-toggle="lightbox" data-title="sample 3 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=3" class="img-fluid mb-2" alt="red sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=4" data-toggle="lightbox" data-title="sample 4 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=4" class="img-fluid mb-2" alt="red sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=5" data-toggle="lightbox" data-title="sample 5 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=5" class="img-fluid mb-2" alt="black sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=6" data-toggle="lightbox" data-title="sample 6 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=6" class="img-fluid mb-2" alt="white sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=7" data-toggle="lightbox" data-title="sample 7 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=7" class="img-fluid mb-2" alt="white sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=8" data-toggle="lightbox" data-title="sample 8 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=8" class="img-fluid mb-2" alt="black sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FF0000/FFFFFF.png?text=9" data-toggle="lightbox" data-title="sample 9 - red" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FF0000/FFFFFF?text=9" class="img-fluid mb-2" alt="red sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=10" data-toggle="lightbox" data-title="sample 10 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=10" class="img-fluid mb-2" alt="white sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/FFFFFF.png?text=11" data-toggle="lightbox" data-title="sample 11 - white" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/FFFFFF?text=11" class="img-fluid mb-2" alt="white sample"/>
                                    </a>
                                </div>
                                <div class="col-sm-2">
                                    <a href="https://via.placeholder.com/1200/000000.png?text=12" data-toggle="lightbox" data-title="sample 12 - black" data-gallery="gallery">
                                        <img src="https://via.placeholder.com/300/000000?text=12" class="img-fluid mb-2" alt="black sample"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>
</div>
<script src="<?php resource('plugins/ekko-lightbox/ekko-lightbox.js') ?>"></script>
<script type="text/javascript">
    $(function () {
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
                alwaysShowClose: true
            });
        });

        // $('.filter-container').filterizr({gutterPixels: 3});
        $('.btn[data-filter]').on('click', function() {
            $('.btn[data-filter]').removeClass('active');
            $(this).addClass('active');
        });
    })
</script>