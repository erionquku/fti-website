<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $this->book->title; ?></h1>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-md-4 align-self-center">
                    <img src="<?php resource('img/book_placeholder.png'); ?>" >
                </div>
                <!-- /.col -->


                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            <ul class="list-group list-group-unbordered mb-3">
                                <?php
                                $fields = array("title", "description", "author", "page_no");
                                $userURL = str_replace(":id", $this->book->uploader->id, route('profile_id'));
                                $courseURL = str_replace(":course_id", $this->book->course_id, route('course_id'));

                                foreach ($this->book as $key => $value) {
                                    if (in_array($key, $fields))
                                        echo "<li class='list-group-item'>
                                                    <b>" . $key . "</b><i class='float-right' id='data_$key'>$value</i>
                                                </li>";
                                }

                                echo "<li class='list-group-item'> <b>Uploaded by</b><i class='float-right' id='data_uploaded_by'>
                                <a href='$userURL'>"
                                . ($this->book->uploader->first_name ?? "-") . " " . ($this->book->uploader->last_name ?? "-") ."</a></i></li>";

                                echo "<li class='list-group-item'> <b>Uploaded at</b><i class='float-right' id='data_uploaded_at'>".
                                        time_elapsed_string($this->book->created_at)
                                    ."</i></li>";

                                echo "<li class='list-group-item'><b>Course</b><i class='float-right' id='data_course'>
                                    <a href='$courseURL'>".
                                        $this->book->course->name
                                    ."</a></i></li>";


                                ?>
                            </ul>

                            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal"
                               data-target="#editModalCenter">
                                <b>
                                    Edit
                                </b>
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal"
                               data-target="#editModalCenter">
                                <b>
                                    Download
                                </b>
                            </a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>

        </div>

    </section>
</div>