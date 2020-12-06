<?php
include_once ("utils/sidebar.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $this->user->first_name ?? ":("; ?></h1>
                </div>
            </div>
        </div>
    </div>
