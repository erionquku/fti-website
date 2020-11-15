<body class="text-center center-body">
<div class="form-signup">
    <img class="mb-4" src="<?php resource("img/logo.png") ?>" alt="">
    <h1 class="h3 mb-3 font-weight-normal"><?php __("enter_text_below") ?></h1>

    <div id="alerts"></div>

    <div class="container">
        <form id="registration_form">
            <div class="form-row">
                <div class="col">
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Emri"
                           required
                           autofocus>
                </div>
                <div class="col">
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Mbiemri"
                           required>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <select name="faculty" class="form-control" required>
                        <option disabled selected>Fakulteti</option>
                        <option value="fti">FTI</option>
                    </select>
                </div>
                <div class="col">
                    <select name="year" class="form-control" required>
                        <option value="1">Viti 1</option>
                        <option value="2">Viti 2</option>
                        <option value="3">Viti 3</option>
                    </select>
                </div>
            </div>

            <input type="email" name="email" id="email" class="form-control" placeholder="Adresa" required>
            <input type="password" name="password" id="password" class="form-control" placeholder="Fjalekalimi"
                   required>

            <button class="btn btn-lg btn-success btn-block" type="submit" id="submitBtn"><?php __("signup") ?></button>
        </form>
    </div>

    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</div>
</body>

<script type="text/javascript">

    $("#submitBtn").click(function () {
        $.ajax({
            url: "<?php echo route("register.post"); ?>",
            method: "POST",
            data: $("#registration_form").serializeArray(),
            success: function (data) {
                msg = JSON.parse(data);
                if (msg.status === "fail")
                    $('#alerts').empty().append(showAlert('danger', msg.message, 'Error!'));
                else if (msg.status === "success")
                    $('#alerts').empty().append(showAlert('success', msg.message, 'Success!'));
            }
        });
    });

</script>

</html>