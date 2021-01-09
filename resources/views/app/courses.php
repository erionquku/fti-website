
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php __('title.courses') ?></h1>
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
                            <h3 class="card-title"> <?php __('courses.table_title') ?> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap" id="courses_table" style="cursor: pointer">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Teacher ID</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <?php
                                        $courses = \App\Controllers\CourseController::findAllByClass('1');

                                        foreach ($courses as $course) {
                                            echo "<tr><td>" . $course->id . "</td>
                                                <td>" . $course->name . "</td>
                                                <td>" . $course->description . "</td>
                                                <td>" . $course->teacher_id . "</td></tr>";
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
</div>

<script type="text/javascript">

    $('#courses_table tr').click(function () {
        window.location.replace(window.location.href + $(this).find("td").first().text());
    });

</script>