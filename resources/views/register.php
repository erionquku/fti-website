<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/resources/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="/resources/js/helpers.js"> </script>
    <title>FTI - Register</title>
</head>


<body class="text-center center-body">
<div class="form-signup" >
    <img class="mb-4" src="/resources/img/logo.png" alt="">
    <h1 class="h3 mb-3 font-weight-normal"><?php __("enter_text_below") ?></h1>

    <div id="alerts"></div>

    <div class="container">
        <div class="form-row">
            <div class="col">
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Emri" required autofocus>
            </div>
            <div class="col">
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Mbiemri" required >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <select name="faculty" class="form-control" required >
                    <option disabled selected>Fakulteti</option>
                    <option value="fti">FTI</option>
                </select>
            </div>
            <div class="col">
                <select name="year" class="form-control" required >
                    <option value="1">Viti 1</option>
                    <option value="2">Viti 2</option>
                    <option value="3">Viti 3</option>
                </select>
            </div>
        </div>

        <input type="email" name="email" id="email" class="form-control" placeholder="Adresa" required >
        <input type="password" name="password" id="password" class="form-control" placeholder="Fjalekalimi" required>

        <button class="btn btn-lg btn-success btn-block" type="submit" id="submitBtn" onclick="register()"><?php __("signup") ?></button>
    </div>

    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</div>
</body>

<script type="text/javascript">


    function register() {

        $.ajax({
            method: "POST",
            url: "/users/create",
            data: {
                first_name : $("#first_name").val(),
                last_name : $("#last_name").val(),
                email : $("#email").val(),
                password : $("#password").val()
            }
        })
        .done(function( msg ) {
            console.log("message returned: " + msg);

            msg = msg.substring(msg.indexOf("{"));
            console.log("new message: " + msg);
            const response = jQuery.parseJSON(msg);

            if (response["status"] === "fail")
                $('#alerts').empty().append( showAlert('danger', response["message"], 'Error!') );
            else
                $('#alerts').empty().append( showAlert('success', response["message"], 'Success!') );

        });

    }
</script>

</html>