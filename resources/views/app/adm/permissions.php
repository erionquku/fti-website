<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php __('permissions.title') ?> </h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->

            <form method="post" action="<?php echo route('api.permission.update') ?>">

            <div class="row">
                <div class="col-12">

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover table-sm text-center" id="courses_table">
                            <thead>
                            <tr>
                                <th class="text-left">Permission</th>
                                <?php
                                foreach ($this->permissions as $p) {
                                    $p->bootRelations();
                                    echo "<th data-toggle='tooltip' title='". $p->role->description ."'>" . $p->role->name . "</th>";
                                }
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                                <?php
                                $i=0;
                                foreach (\App\Controllers\PermissionsController::getPermissions() as $p) {
                                    $i++;
                                    echo "<tr>";
                                    echo "<td class='text-left'> $i. " . ___('permissions.' . $p) . "</td>";
                                    foreach ($this->permissions as $userPermissions)
                                        echo "<td>
                                                      <input type='checkbox'  
                                                            name='" . $userPermissions->role_id . "_" . $p . "' " .
                                            ($userPermissions->$p ? 'checked' : '') .
                                            ($userPermissions->role->name == 'admin' ? ' disabled' : '') . ">
                                                    </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        <?php
            if ($this->user->permissions->adm_permissions_edit)
                echo <<<BUTTON
            <div class="row">
                <div class="col-12 text-center">
                    <input class="btn btn-outline-primary mb-5 mt-4" id="savePermissions" type="submit" value="Save">
                </div>
            </div>
BUTTON;

        ?>


        </form>

        </div>
    </section>
</div>
