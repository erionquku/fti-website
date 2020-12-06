<?php
include_once("utils/sidebar.php");

?>
<!-- Content Wrapper. Contains page content -->
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
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>69</h3>

                            <p>Kredite</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo route('profile_page') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>100<sup style="font-size: 20px">%</sup></h3>

                            <p>Provime te marra</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?php echo route('courses_page') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>Informatike</h3>

                            <p>Dega</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?php echo route('profile_page') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Test</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="<?php echo route('profile_page') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <?php __('home.notifications_title'); ?> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap" id="notifications_table">
                                <tbody>
                                <?php
                                    foreach ($this->notifications as $notification) {
                                        echo "<tr>";
                                        echo "<td>$notification->id</td>";
                                        echo "<td>$notification->title</td>";
                                        echo "<td>". ($notification->uploader->first_name ?? '-') . " ";
                                        echo  ($notification->uploader->last_name ?? '-') . "</td>";
                                        echo "<td>$notification->created_at</td>";
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
                <div class="col-md-6">
                    TEST SECOND
                </div>

            </div>
        </div>
    </section>



</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    $('#notifications_table tr').click(function () {

        let url = "<?php echo route('api.notification'); ?>";
        url = url.substr(0, url.lastIndexOf(":"));
        url += $(this).find("td").first().text();

        $.ajax({
            url: url,
            method: "GET",
            success: function (msg) {
                console.log("msg: " + msg);
                const response = JSON.parse(msg);
                $("#exampleModalLabel").html(response.title);
                $("#modalBody").html(response.body);
                $('#exampleModal').modal();
            }
        });
    });

</script>