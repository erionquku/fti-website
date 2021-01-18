<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php __('title.home') ?></h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row ">
                <div class="col-md-8 border border-secondary">
                    NOTAT LMAO
                </div>
                <div class="col-md-4">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>9.999</h3>
                            <p><?php __('average')?> </p>
                        </div>
                        <a href="<?php echo route('profile_page') ?>" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>


                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>100</h3>
                            <p><?php __('credits') ?></p>
                        </div>
                        <a href="<?php echo route('courses_page') ?>" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>


                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo count($this->user->borrowed_books) ?></h3>
                            <p><?php __('borrowed_books') ?></p>
                        </div>
                        <a href="<?php echo route('books_page') ?>" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Not Verified</h3>
                            <p><?php __('payment') ?></p>
                        </div>
                        <a href="<?php echo route('finance_page') ?>" class="small-box-footer">More info <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i
                                            class="fa fa-bullhorn"></i> <?php __('home.announcements_title'); ?> </h3>

                                <?php
                                if ($this->user->role_type_id != 1)
                                    echo '<div class="card-tools">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal"
                                                data-target="#addAnnouncementModal">
                                             ' . ___("home.announcement_add") . '
                                        </button>
                                    </div>';
                                ?>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap" id="announcements_table">
                                    <tbody>
                                    <?php
                                    foreach ($this->announcements as $announcement) {
                                        echo "<tr>";
                                        echo "<td>$announcement->id</td>";
                                        echo "<td><b>$announcement->title</b></td>";
                                        echo "<td>" . ($announcement->uploader->first_name ?? '-') . " ";
                                        echo ($announcement->uploader->last_name ?? '-') . "</td>";
                                        echo "<td>$announcement->created_at</td>";
                                        echo "</tr>";
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-7">
                        TEST SECOND
                    </div>

                </div>
            </div>
    </section>


</div>

<!-- View Announcement Modal -->
<div class="modal fade" id="viewAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="viewModalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Announcement Modal -->
<div class="modal fade" id="addAnnouncementModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel"><?php __('home.add_announcement') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="addModalBody">
                <div id="alertsAddAnnModal"></div>
                <input type="text" class="form-control mb-3" placeholder="Title" id="newAnnTitle">
                <textarea type="text" class="form-control mb-1" placeholder="Body" id="newAnnBody"></textarea>
                <p><b>Note:</b> You can also use HTML in announcement body!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeModalBtn">Close</button>
                <button type="button" class="btn btn-primary" id="announceBtn">Announce!</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $('#announcements_table tr').click(function () {

        let url = "<?php echo route('api.announcement.get'); ?>";
        url = url.substr(0, url.lastIndexOf(":"));
        url += $(this).find("td").first().text();

        $.ajax({
            url: url,
            method: "GET",
            success: function (msg) {
                console.log("msg: " + msg);
                const response = JSON.parse(msg);
                $("#viewModalLabel").html(response.title);
                $("#viewModalBody").html(response.body);
                $('#viewAnnouncementModal').modal();
            }
        });

    });

    $('#announceBtn').click(function () {

        $.ajax({
            url: "<?php echo route('api.announcement.post'); ?>",
            method: "POST",
            data: {
                "title": $("#newAnnTitle").val(),
                "body": $("#newAnnBody").val()
            },
            success: function (msg) {
                console.log("msg: " + msg);
                const response = JSON.parse(msg);
                if (response['status'] === 'success') {
                    $("#closeModalBtn").click();
                    location.reload();
                } else {
                    $('#alertsAddAnnModal').empty().prepend(showAlert('danger', response.message, 'Error!'));
                    $("#alertsAddAnnModal").last().hide().fadeIn(200);
                }

            }
        });

    });

</script>