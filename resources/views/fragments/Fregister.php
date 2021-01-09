<div class="container">
    <div id="registration_form">
        <div class="form-row">
            <div class="col pb-md-1">
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Emri"
                       value="<?php echo $this->first_name ?? '-' ?>"
                       required
                       autofocus>
            </div>
            <div class="col pb-md-1">
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Mbiemri"
                       value="<?php echo $this->last_name ?? '-' ?>"
                       required>
            </div>
        </div>
        <div class="form-row">
            <div class="col pb-md-1">
                <select name="faculty" id="faculty" class="form-control" required>
                    <option disabled >Fakulteti</option>
                    <option selected value="fti">FTI</option>
                </select>
            </div>
            <div class="col pb-md-1">
                <select name="year" id="year" class="form-control" required>
                    <option value="1">Viti 1</option>
                    <option value="2">Viti 2</option>
                    <option value="3">Viti 3</option>
                </select>
            </div>
        </div>

        <input type="email" name="email" id="email" class="form-control" placeholder="Adresa"
               value="<?php echo $this->token->email ?? '' ?>"
               required
               disabled>
        <input type="password" name="password" id="password" class="form-control" placeholder="Fjalekalimi"
               required>

        <button class="btn btn-lg btn-success btn-block" id="registerButton" type="button"><?php __("signup") ?></button>
    </div>
</div>


