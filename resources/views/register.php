<body class="text-center center-body">
<div class="form-signup">
    <img class="mb-4" src="<?php resource("img/logo.png") ?>" alt="">
    <h1 class="h3 mb-3 font-weight-normal"><?php __("enter_email") ?></h1>


    <div id="alerts"></div>

    <div class="container">

        <div class="input-group mb-2">
            <input type="text" class="form-control" id="email" placeholder="email">
            <div class="input-group-append">
                <div class="input-group-text">@fti.edu.al</div>
            </div>
        </div>

        <button class="btn btn-lg btn-success btn-block" id="getLinkBtn" type="button"><?php __("get_link") ?></button>
        <a href="<?php echo route('manual_register') ?>" class="btn btn-lg btn-success btn-block" id="manualRegisterBtn"
           type="button"><?php __("manual_register") ?></a>
    </div>
</div>

<p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog"
     aria-labelledby="uploadModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalTitle">Register</h5>
                <button id="xButtonModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div id="alerts"></div>
                    <div id="registerModalBody" class="text-left text-break"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalButton" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-success" id="uploadBookBtn" data-dismiss="modal">Continue </button>
            </div>
        </div>
    </div>
</div>

</body>

<script type="text/javascript">

    $('#getLinkBtn').click(function () {

        // $('#registerModal').modal('show');

        console.log("email is: " + $("#email").val());

        $.ajax({
            url: "<?php echo route('api.register_get_token'); ?>",
            method: "POST",
            data: {
                "email": $("#email").val()
            },
            success: function (response) {
                console.log(response);
                let msg = JSON.parse(response);

                if (msg.success) {
                    $("#registerModalTitle").html(msg.title);
                    $("#registerModalBody").html(msg.body);
                    $('#registerModal').modal();
                    // $('#alerts').empty().prepend(showAlert('success', msg.message, 'Success!'));
                }
                else {
                    $('#alerts').empty().prepend(showAlert('danger', msg.message, 'Error!'));
                }
                $("#alerts").last().hide().fadeIn(200);
            }
        });
    });

</script>

</html>