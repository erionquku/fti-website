
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo route('home_page') ?>" class="brand-link">
        <img src="<?php resource("img/logo-white.png") ?>" alt="FTI Logo" class="brand-image">
        <span class="brand-text font-weight-light"><?php __('sidebar.home') ?></span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item">
                    <a href="<?php echo route('home_page') ?>" class="nav-link <?php echo $this->page === 'home' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            <?php __('sidebar.home'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('profile_page') ?>" class="nav-link <?php echo $this->page === 'profile' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            <?php __('sidebar.my_profile'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('courses_page') ?>" class="nav-link <?php echo $this->page === 'courses' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-file"></i>
                        <p>
                            <?php __('sidebar.my_courses'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('attendance_page') ?>" class="nav-link <?php echo $this->page === 'attendance' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-check-square-o"></i>
                        <p>
                            <?php __('sidebar.attendance'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('documents_page') ?>" class="nav-link <?php echo $this->page === 'documents' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-copy"></i>
                        <p>
                            <?php __('sidebar.my_documents'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('books_page') ?>" class="nav-link <?php echo $this->page === 'books' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            <?php __('sidebar.library'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('finance_page') ?>" class="nav-link <?php echo $this->page === 'finance' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-usd"></i>
                        <p>
                            <?php __('sidebar.finance'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('links_page') ?>" class="nav-link <?php echo $this->page === 'links' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-link"></i>
                        <p>
                            <?php __('sidebar.links'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('faq_page') ?>" class="nav-link <?php echo $this->page === 'faq' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-question-circle"></i>
                        <p>
                            <?php __('sidebar.faq'); ?>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>
