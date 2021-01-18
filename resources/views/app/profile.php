<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo ($this->student->first_name ?? "-") . " " . ($this->student->last_name ?? "-"); ?></h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-8">
                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Education</strong>

                            <p class="text-muted">
                                B.S. in Computer Science from the University of Tennessee at Knoxville
                            </p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">Malibu, California</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">UI Design</span>
                                <span class="tag tag-success">Coding</span>
                                <span class="tag tag-info">Javascript</span>
                                <span class="tag tag-warning">PHP</span>
                                <span class="tag tag-primary">Node.js</span>
                            </p>

                            <hr>

                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
                                fermentum enim neque.</p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="<?php storage('profilepics/thumbnail/default.png') ?>"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">
                                <?php echo ($this->student->first_name ?? "-") . " " . ($this->student->last_name ?? "-"); ?>
                            </h3>

                            <p class="text-muted text-center"><?php echo $this->student->class->branch ?? "-"?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <?php
                                foreach ($this->student->personal as $key => $value)
                                    echo "<li class='list-group-item'>
                                                <b>" . ___($key) . "</b><i class='float-right' id='data_$key'>$value</i>
                                            </li>";
                                ?>
                            </ul>
                            <?php
                            if (($this->user->id == $this->student->id && $this->user->permissions->can_edit_own_personal_info)
                                    || $this->user->permissions->can_edit_all_personal_info)
                                echo <<<BUTTON
                            <a href="#" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#editModalCenter">
                                <b>
                                    Edit
                                </b>
                            </a>
                            BUTTON;
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>


            <!-- Edit a Personal Data Modal -->
            <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="editModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalCenterTitle">Edit Personal Data</h5>
                            <button id="editXButtonModal" type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div id="alerts"></div>
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col col-md-6">
                                            <label for="firstName">Student's First Name</label>
                                            <input id="firstName" type="text" class="form-control"
                                                   placeholder="First Name" value="<?php echo $this->student->first_name ?? ""; ?>">
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="lastName">Student's Last Name</label>
                                            <input id="lastName" type="text" class="form-control"
                                                   placeholder="Last Name"  value="<?php echo $this->student->first_name ?? ""; ?>">
                                        </div>
                                    </div>

                                    <div class="row pt-md-3" id="viewAccepted">
                                        <div class="col col-md-6">
                                            <label for="gender">Gender</label>
                                            <select id="gender" type="text" class="form-control">
                                                <option disabled>Select Gender</option>
                                                <option value="M" <?php echo ($this->student->personal->gender ?? "" == "M") ? "selected" : ""?>>Male</option>
                                                <option value="F" <?php echo ($this->student->personal->gender ?? "" == "F") ? "selected" : ""?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="mobile_number">Mobile Number</label>
                                            <input id="mobile_number" type="text" class="form-control"
                                                   placeholder="Mobile Number" value="<?php echo $this->student->personal->mobile_number ?? ""; ?>">
                                        </div>
                                    </div>

                                    <div class="row pt-md-3">
                                        <div class="col">
                                            <label for="email">Email</label>
                                            <input id="email" type="text" class="form-control"
                                                   placeholder="Email" value="<?php echo $this->student->email ?? ""; ?>">
                                        </div>
                                    </div>

                                    <div class="row pt-md-3">
                                        <div class="col col-md-6">
                                            <label for="date_of_birth">Date of birth</label>
                                            <input id="date_of_birth" type="date" class="form-control"
                                                   placeholder="Date of birth" value="<?php echo $this->student->personal->date_of_birth ?? ""; ?>">
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="place_of_birth">Place of birth</label>
                                            <input id="place_of_birth" type="text" class="form-control"
                                                   placeholder="Place of birth" value="<?php echo $this->student->personal->place_of_birth ?? ""; ?>">
                                        </div>
                                    </div>

                                    <div class="row pt-md-3">
                                        <div class="col col-md-6">
                                            <label for="nationality">Nationality</label>
                                            <input id="nationality" type="text" class="form-control"
                                                   placeholder="Nationality" value="<?php echo $this->student->personal->nationality ?? ""; ?>">
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="personal_no">Personal No</label>
                                            <input id="personal_no" type="text" class="form-control"
                                                   placeholder="Personal No" value="<?php echo $this->student->personal->personal_no ?? ""; ?>">
                                        </div>
                                    </div>

                                    <div class="row pt-md-3">
                                        <div class="col">
                                            <label for="registry_no">Registry No</label>
                                            <input id="registry_no" type="text" class="form-control"
                                                   placeholder="Registry No" value="<?php echo $this->student->personal->registry_no ?? ""; ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" id="editCloseBtn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="saveBookBtn">Save</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

<script type="text/javascript">

    $("#saveBookBtn").click(function() {

        let url = "<?php echo route('api.user.personal.edit'); ?>";
        let id = <?php echo $this->student->id ?>;
        url = url.substr(0, url.lastIndexOf(':')) + id + "/";

        $.ajax({
            url: url,
            method: "POST",
            data: {
                "first_name": $("#firstName").val(),
                "last_name": $("#lastName").val(),
                "gender": $("#gender").val(),
                "mobile_number": $("#mobile_number").val(),
                "email": $("#email").val(),
                "place_of_birth": $("#place_of_birth").val(),
                "date_of_birth": $("#date_of_birth").val(),
                "personal_no": $("#personal_no").val(),
                "registry_no": $("#registry_no").val(),
                "nationality": $("#nationality").val()
            },
            success: function (msg) {
                const response = JSON.parse(msg);
                if (!response.success) {
                    $('#alerts').empty().prepend(showAlert('danger', response.message , 'Error!'));
                } else if (response.success) {
                    $('#alerts').empty().prepend(showAlert('success', response.message , 'Success!'));
                }
                $("#alerts").last().hide().fadeIn(200);
            }
        });
    })


</script>
