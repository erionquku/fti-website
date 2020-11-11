<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../resources/css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>FTI - Register</title>
</head>


<body class="text-center center-body">
<form class="form-signup">
    <img class="mb-4" src="../resources/img/logo.png" alt="" width="214" height="121">
    <h1 class="h3 mb-3 font-weight-normal">Ju lutem plotesoni te dhenat meposhte</h1>

    <div class="container">
        <div class="form-row">
            <div class="col">
                <input type="text" id="inputFirstName" class="form-control" placeholder="Emri" required autofocus>
            </div>
            <div class="col">
                <input type="text" id="inputLastName" class="form-control" placeholder="Mbiemri" required >
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <input type="text" id="inputFirstName" class="form-control" placeholder="Fakulteti" value="FTI" disabled >
            </div>
            <div class="col">
                <select type="text" id="inputLastName" class="form-control" placeholder="Viti" required >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
        </div>

        <input type="email" id="inputEmail" class="form-control" placeholder="Adresa" required >
        <input type="password" id="inputPassword" class="form-control" placeholder="Fjalekalimi" required>

        <button class="btn btn-lg btn-success btn-block" type="submit">Regjistrohu</button>
    </div>

    <p class="mt-5 mb-3 text-muted">© 2020-2021</p>
</form>


</body>

</html>