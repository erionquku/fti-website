<body class="text-center center-body">
<div class="form-signup">
    <img class="mb-4" src="<?php resource("img/logo.png") ?>" alt="">
    <h1 class="h3 mb-3 font-weight-normal"><?php __("enter_text_below") ?></h1>

    <div id="alerts"></div>

    <?php include_once(resource("views/fragments/register.php")); ?>

</div>
</body>

<script type="text/javascript">

    $('#submitBtn').click(function () {
        $.ajax({
            url: "<?php echo route('api.register'); ?>",
            method: "POST",
            data: {
                "first_name": $("#first_name").val(),
                "last_name": $("#last_name").val(),
                "email": $("#email").val(),
                "password": $("#password").val(),
                "faculty": $("#faculty").val(),
                "year": $("#year").val()
            },
            success: function (msg) {
                if (msg.status === "fail")
                    $('#alerts').empty().prepend(showAlert('danger', msg.message, 'Error!'));
                else if (msg.status === "success")
                    $('#alerts').empty().prepend(showAlert('success', msg.message, 'Success!'));
                $("#alerts").last().hide().fadeIn(200);
            }
        });
    });

</script>

</html>