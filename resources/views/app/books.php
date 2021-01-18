<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php __('books.title') ?> </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"> <?php __('books.table_title'); ?> </h3>
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

                                        $bookUrl = str_replace(":id", $book->id, route('book_id'));
                                        echo "<tr><td>$book->id</td>
                                                <td><a href='$bookUrl'>$book->title</a></td>
                                                <td>$book->description</td>
                                                <td>$book->author</td>
                                                <td>$book->page_no</td>
                                                <td>" . ($book->uploader->first_name ?? '-') . " " . ($book->uploader->last_name ?? '-') .  "</td>
                                                <td><i class='fa fa-2x fa-minus-circle' id='delete-$book->id'></i></td>
                                                <td><i class='fa fa-2x fa-download' id='download-$book->id'></i></td></tr>";
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
                <div class="col text-center">
                    <div class="form-group">
                        <button type="button" data-toggle="modal" data-target="#uploadModalCenter"
                                class="btn-primary btn">
                            <i class="fa fa-upload"></i> Upload a book!
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="uploadModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="uploadModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="uploadModalCenterTitle">Upload a book</h5>
                            <button id="xButtonModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div id="alerts"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input id="bookTitle" type="text" class="form-control" placeholder="Title">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input id="bookAuthor" type="text" class="form-control" placeholder="Author">
                                        </div>
                                        <div class="col">
                                            <input id="bookPages" type="number" class="form-control" placeholder="Number of pages">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <select id="bookCourse" class="form-control">
                                                <option value="1" selected disabled>Select Course</option>
                                                <?php foreach ($this->courses as $course) {
                                                    echo '<option value="' . $course->id . '">' . $course->name . '</option>';
                                                } ?>
                                                <option value="all">All Courses</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                        <textarea id="bookDescription" class="form-control"
                                                  placeholder="Enter a short description here..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="bookFile">
                                                <label class="custom-file-label" for="bookFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="closeModalButton" >Close</button>
                            <button type="button" class="btn btn-success" id="uploadBookBtn">Upload</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>


<!-- Delete a book Modal -->
<div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog"
     aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalCenterTitle">Delete</h5>
                <button id="deleteXButtonModal" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="viewAlerts"></div>
                    Are you sure you want to delete this book ?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="deleteCloseBtn">Close</button>
                <button type="button" class="btn btn-danger" id="deleteBookBtn">Delete</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">

    let uploaded = false;
    let deleteID = -1;

    $("#closeModalButton").click(function () {
        $("#xButtonModal").click();
        if (uploaded) location.reload();
    })

    $("#uploadBookBtn").click(function () {
        $("#uploadBookBtn").text('Uploading...')
            .prepend('<i class="fa fa-spinner" id="uploadSpinner"></i>  ')
            .prop('disabled', true);


        let formData = new FormData();
        formData.append('path', $("#bookFile").val());
        formData.append('title', $("#bookTitle").val());
        formData.append('author', $("#bookAuthor").val());
        formData.append('page_no', $("#bookPages").val());
        formData.append('course_id', $("#bookCourse").val("Select Course"));
        formData.append('file', $('#bookFile').prop('files')[0]);
        formData.append('description', $("#bookDescription").val());
        let url = "<?php echo route('api.books.upload'); ?>";
        fetch(url, {
            method: 'POST',
            body: formData,
        }).then((response) => {
            $("#uploadBookBtn").text('Upload').prop('disabled', false);
            if (response.status !== 200) {
                $('#alerts').empty().prepend(showAlert('danger', response.message, 'Error!'));
                $("#alerts").last().hide().fadeIn(200);
                return;
            }

            response.json().then(function(data) {
                if (data.success) {
                    $("#bookTitle").val("");
                    $("#bookAuthor").val("");
                    $("#bookPages").val("");
                    $("#bookCourse").val("");
                    $("#bookDescription").val("");
                    $("#bookFile").val("");
                    $('#alerts').empty().prepend(showAlert('success', '<?php __("books.upload_success") ?>', 'Success!'));
                    $("#alerts").last().hide().fadeIn(200);
                    uploaded = true;
                } else {
                    $('#alerts').empty().prepend(showAlert('danger', data.message, 'Error!'));
                    $("#alerts").last().hide().fadeIn(200);
                }
            });
        })
    });


    $("[id^=download-]")
        .css('cursor', 'pointer')
        .click(function () {
            let id = $(this).attr('id');
            let id_val = id.substr(id.lastIndexOf('-')+1);
            let url = '<?php echo route('api.books.download') ?>';
            url = url.substr(0, url.lastIndexOf(":")) + id_val;
            window.open(url, '_blank');
        });

    $("[id^=delete-]")
        .css('cursor', 'pointer')
        .click(function (){
            $("#deleteModalCenter").modal('show');
            deleteID = $(this)[0].id.trim().substr($(this)[0].id.lastIndexOf('-')+1);
        });

    $("#deleteBookBtn").click(function() {
        let url = "<?php echo route('api.books.delete'); ?>";
        url = url.substr(0, url.lastIndexOf(":")) + deleteID + "/";

        $.ajax({
            url: url,
            method: "POST",
            success: function (msg) {
                let response = jQuery.parseJSON(msg);
                console.log(msg);
                if (!response.success) {
                    $('#viewAlerts').empty().prepend(showAlert('danger', response.message, 'Error!'));
                } else if (response.success) {
                    location.reload();
                }
                $("#viewAlerts").last().hide().fadeIn(200);
            }
        });
    });

</script>