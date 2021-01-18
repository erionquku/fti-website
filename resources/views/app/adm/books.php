<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-auto mr-auto">
                    <h1 class="m-0"><?php __('books.title') ?> </h1>
                </div>
                <div class="col-auto">
                    <a class="btn btn-outline-success"
                            href="<?php echo str_replace(":returned", 'Y', route('adm_books_page_filter')) ?>">
                        <i class="fa fa-check-circle-o"></i> Returned Books
                    </a>
                    <a class="btn btn-outline-danger"
                            href="<?php echo str_replace(":returned", 'N', route('adm_books_page_filter')) ?>">
                        <i class="fa fa-exclamation-circle"></i> Not Returned Books
                    </a>
                    <?php
                    if ($this->user->permissions->adm_books_edit)
                        echo <<<BTN
                    <button type="button" data-toggle="modal" data-target="#lendModalCenter" class="btn-primary btn">
                        <i class="fa fa-plus"></i> Lend a book!
                    </button>
BTN;
                    ?>

                </div><!-- /.col -->
            </div><!-- /.row -->
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
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Borrowed by</th>
                                    <th>When</th>
                                    <th>Lent by</th>
                                    <th>Returns at:</th>
                                    <th class="text-center">Returned</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <?php
                                    foreach ($this->book_borrow as $bb) {
                                        $bb->bootRelations();

                                        $bookUrl = str_replace(":id", $bb->book->id, route('book_id'));
                                        $borrowerUrl = str_replace(":id", $bb->user->id, route('profile_id'));
                                        $lenderUrl = str_replace(":id", $bb->lent_user->id, route('profile_id'));

                                        echo "<tr><td>$bb->id </td>
                                                <td><a href='$bookUrl'>" . $bb->book->title . "</a></td>
                                                <td>" . $bb->book->author . "</td>
                                                <td><a href='$borrowerUrl'>" . $bb->user->first_name . " " . $bb->user->last_name . "</a></td>
                                                <td><p data-toggle='tooltip' title='$bb->borrowed_date'>" . time_elapsed_string($bb->borrowed_date) . "</p></td>
                                                <td><a href='$lenderUrl'>" . $bb->lent_user->first_name . " " . $bb->lent_user->last_name . "</a></td>
                                                <td>$bb->to_return_date</td>
                                                <td class='text-center'><span class='lead'><span class='badge badge-" . ($bb->returned == 'Y' ? "success" : "danger") . "'>" . fullYN($bb->returned) . "</span></span></td>" .
                                            ($this->user->permissions->adm_books_edit ? "<td><span id='editButton-$bb->id' class='fa fa-2x fa-edit'></span> </td>
                                                <td><span id='delButton-$bb->id' class='fa fa-2x fa-minus-circle'></span> </td>" : "" );
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


            <!-- Lend a Book Modal -->
            <div class="modal fade" id="lendModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="lendModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="lendModalCenterTitle">Lend a book</h5>
                            <button id="xButtonModal" type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div id="alerts"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="firstName">Student's First Name</label>
                                            <input id="firstName" type="text" class="form-control"
                                                   placeholder="First Name">
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col">
                                            <label for="lastName">Student's Last Name</label>
                                            <input id="lastName" type="text" class="form-control"
                                                   placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col">
                                            <label for="bookTitle">Book Title</label>
                                            <select id="bookTitle" type="text" class="form-control">
                                                <?php
                                                foreach($this->books as $book)
                                                    echo "<option value=$book->id>$book->title</option>";
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col">
                                            <label for="returnDate">Return Date</label>
                                            <input id="returnDate" type="date" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col">
                                            <label for="comment">Comment</label>
                                            <textarea id="comment" type="text" class="form-control"
                                                      placeholder="Optional comment..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" id="closeBtn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="lendBookBtn">Lend</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Edit a lent book Modal -->
            <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog"
                 aria-labelledby="editModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalCenterTitle">Lend a book</h5>
                            <button id="editXButtonModal" type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div id="viewAlerts"></div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col col-md-6">
                                            <label for="viewFirstName">Student's First Name</label>
                                            <input id="viewFirstName" type="text" class="form-control"
                                                   placeholder="First Name" disabled>
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="viewLastName">Student's Last Name</label>
                                            <input id="viewLastName" type="text" class="form-control"
                                                   placeholder="Last Name" disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col">
                                            <label for="viewBookTitle">Book Title</label>
                                            <input id="viewBookTitle" type="text" class="form-control"
                                                   placeholder="Book Title" disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col col-md-6">
                                            <label for="viewLentUser">Lent by</label>
                                            <input id="viewLentUser" type="text" class="form-control"
                                                   placeholder="Lent by"
                                                   disabled>
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="viewLentDate">Lent at</label>
                                            <input id="viewLentDate" type="text" class="form-control"
                                                   placeholder="Lent at"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-md-2" id="viewAccepted">
                                        <div class="col col-md-6">
                                            <label for="viewAcceptedUser">Accepted by</label>
                                            <input id="viewAcceptedUser" type="text" class="form-control"
                                                   placeholder="Lent by"
                                                   disabled>
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="viewAcceptedDate">Accepted at</label>
                                            <input id="viewAcceptedDate" type="text" class="form-control"
                                                   placeholder="Lent at"
                                                   disabled>
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col col-md-6">
                                            <label for="viewReturnDate">Return Date</label>
                                            <input id="viewReturnDate" type="date" class="form-control">
                                        </div>
                                        <div class="col col-md-6">
                                            <label for="viewReturned">Returned</label>
                                            <select id="viewReturned" type="text" class="form-control">
                                                <option id="Y" value="Y">Yes</option>
                                                <option id="N" value="N">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row pt-md-2">
                                        <div class="col">
                                            <label for="viewComment">Comment</label>
                                            <textarea id="viewComment" type="text" class="form-control"
                                                      placeholder="Optional comment..."></textarea>
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


            <!-- Delete a book borrowing Modal -->
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
                                Are you sure you want to delete this record ?
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" id="deleteCloseBtn" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger" id="deleteBookBtn">Delete</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
</div>

<script type="text/javascript">

    let lent = false;
    let saved = false;
    let clickedBB = -1;
    let deleteClickedBB = -1;

    $("#lendBookBtn").click(function () {
        $("#lendBookBtn").text('Loading...')
            .prepend('<i class="fa fa-spinner" id="uploadSpinner"></i>  ')
            .prop('disabled', true);

        $.ajax({
            url: "<?php echo route('api.books.lend') ?>",
            method: "POST",
            data: {
                "firstName": $("#firstName").val(),
                "lastName": $("#lastName").val(),
                "bookId": $("#bookTitle").val(),
                "returnDate": $("#returnDate").val(),
                "comment": $("#comment").val()
            },
            success: function (msg) {
                $("#lendBookBtn").text('Lend')
                    .prop('disabled', false);

                const response = JSON.parse(msg);
                if (!response.success) {
                    $('#alerts').empty().prepend(showAlert('danger', response.message, 'Error!'));
                } else if (response.success) {
                    $('#alerts').empty().prepend(showAlert('success', response.message, 'Success!'));
                    lent = true;
                }
                $("#alerts").last().hide().fadeIn(200);
            }
        });

    });


    $("[id^=editButton-]").css('cursor', 'pointer');
    $("[id^=delButton-]").css('cursor', 'pointer');

    $("[id^=editButton-]").click(function () {
        $("#editModalCenter").modal('show');

        let url = "<?php echo route('api.books.lend_id'); ?>";
        let id = $(this)[0].id.substr($(this)[0].id.lastIndexOf('-')+1);
        url = url.substr(0, url.lastIndexOf(":")) + id.trim() + "/";

        clickedBB = id;

        $.ajax({
            url: url,
            method: "GET",
            success: function (msg) {
                let response = jQuery.parseJSON(msg);

                $("#viewFirstName").val(response.borrowing_user.first_name);
                $("#viewLastName").val(response.borrowing_user.last_name);
                $("#viewBookTitle").val(response.book_title);
                $("#viewLentUser").val(response.lent_user.first_name + " " + response.lent_user.last_name);
                $("#viewLentDate").val(response.lent_date);
                $("#viewReturnDate").val(response.to_return_date);
                $("#viewReturned").val(response.returned);
                $("#comment").val(response.comment);

                if (response.returned === "N")
                    $("#viewAccepted").hide();
                else {
                    $("#viewAccepted").show();
                    $("#viewAcceptedUser").val(response.return_user.first_name + " " + response.return_user.last_name);
                    $("#viewAcceptedDate").val(response.returned_date);
                }
            }
        });

    });

    $("#saveBookBtn").click(function () {
        let url = "<?php echo route('api.books.edit_lend_id'); ?>";
        url = url.substr(0, url.lastIndexOf(":")) + clickedBB.trim() + "/";

        $.ajax({
            url: url,
            method: "POST",
            data: {
                "returned": $("#viewReturned").val(),
                "return_date": $("#viewReturnDate").val(),
                "comment": $("#viewComment").val()
            },
            success: function (msg) {
                let response = jQuery.parseJSON(msg);
                console.log(msg);
                if (!response.success) {
                    $('#viewAlerts').empty().prepend(showAlert('danger', response.message, 'Error!'));
                } else if (response.success) {
                    $('#viewAlerts').empty().prepend(showAlert('success', response.message, 'Success!'));
                    location.reload();
                }
                $("#viewAlerts").last().hide().fadeIn(200);
            }
        });
    });

    $("[id^=delButton-]").click(function () {
        $("#deleteModalCenter").modal('show');
        deleteClickedBB = $(this)[0].id.substr($(this)[0].id.lastIndexOf('-')+1);
    });

    $("#deleteBookBtn").click(function () {
        let url = "<?php echo route('api.books.delete_borrowed'); ?>";
        url = url.substr(0, url.lastIndexOf(":")) + deleteClickedBB.trim() + "/";

        $.ajax({
            url: url,
            method: "POST",
            success: function (msg) {
                let response = jQuery.parseJSON(msg);
                console.log(msg);
                if (!response.success) {
                    $('#viewAlerts').empty().prepend(showAlert('danger', response.message, 'Error!'));
                } else if (response.success) {
                    $('#viewAlerts').empty().prepend(showAlert('success', response.message, 'Success!'));
                    location.reload();
                }
                $("#viewAlerts").last().hide().fadeIn(200);
            }
        });
    });



</script>