<li class="nav-header">ADMINISTRATION</li>

<li class="nav-item">
    <a href="<?php echo route('adm_students_page') ?>" class="nav-link <?php echo $this->page === 'adm_students_page' ? 'active' : '' ?>">
        <i class="nav-icon fa fa-user"></i>
        <p>
            <?php __('sidebar.adm_students'); ?>
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="<?php echo route('adm_books_page') ?>" class="nav-link <?php echo $this->page === 'adm_books_page' ? 'active' : '' ?>">
        <i class="nav-icon fa fa-user"></i>
        <p>
            <?php __('sidebar.adm_books'); ?>
        </p>
    </a>
</li>

