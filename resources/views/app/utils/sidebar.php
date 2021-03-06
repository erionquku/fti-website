<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?php echo route('home_page') ?>" class="brand-link">
        <img src="<?php resource("img/logo-white.png") ?>" alt="FTI Logo" class="brand-image">
        <span class="brand-text font-weight-light"><?php __('sidebar.home') ?></span>
    </a>

    <div class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php storage('profilepics/thumbnail/default.png'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo route('profile_page') ?>"
                   class="d-block"><?php echo $this->user->first_name . " " . $this->user->last_name ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item">
                    <a href="<?php echo route('home_page') ?>"
                       class="nav-link <?php echo $this->page === 'home' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            <?php __('sidebar.home'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('profile_page') ?>"
                       class="nav-link <?php echo $this->page === 'profile' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            <?php __('sidebar.my_profile'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('courses_page') ?>"
                       class="nav-link <?php echo $this->page === 'courses' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-file"></i>
                        <p>
                            <?php __('sidebar.my_courses'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('documents_page') ?>"
                       class="nav-link <?php echo $this->page === 'documents' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-copy"></i>
                        <p>
                            <?php __('sidebar.my_documents'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('books_page') ?>"
                       class="nav-link <?php echo $this->page === 'books' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            <?php __('sidebar.library'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('finance_page') ?>"
                       class="nav-link <?php echo $this->page === 'finance' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-usd"></i>
                        <p>
                            <?php __('sidebar.finance'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('links_page') ?>"
                       class="nav-link <?php echo $this->page === 'links' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-link"></i>
                        <p>
                            <?php __('sidebar.links'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('faq_page') ?>"
                       class="nav-link <?php echo $this->page === 'faq' ? 'active' : '' ?>">
                        <i class="nav-icon fa fa-question-circle"></i>
                        <p>
                            <?php __('sidebar.faq'); ?>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo route('logout') ?>" class="nav-link">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>
                            <?php __('sidebar.log_out'); ?>
                        </p>
                    </a>
                </li>

                <?php
                $admStudentsTxt = ___('sidebar.adm_students');
                $admStudentsLnk = route('adm_students_page');
                $admStudentsActive = ($this->page ?? '') === 'adm_students_page' ? 'active' : '';

                if ($this->user->permissions->adm_students_view)
                    echo <<<ADMSTUDENTS

                <li class="nav-header">ADMINISTRATION</li>

                <li class="nav-item">
                    <a href="$admStudentsLnk" class="nav-link $admStudentsActive">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            $admStudentsTxt
                        </p>
                    </a>
                </li>
                ADMSTUDENTS;

                $admBooksTxt = ___('sidebar.adm_books');
                $admBooksLnk = route('adm_books_page');
                $admBooksActive = ($this->page ?? '') === 'adm_books_page' ? 'active' : '';

                if ($this->user->permissions->adm_books_view)
                    echo <<<ADMBOOKS
                <li class="nav-item">
                    <a href="$admBooksLnk" class="nav-link $admBooksActive">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            $admBooksTxt
                        </p>
                    </a>
                </li>
                ADMBOOKS;


                $admPermissionsTxt = ___('sidebar.permissions');
                $admPermissionsLnk = route('adm_permissions_page');
                $admPermissionsActive = ($this->page ?? '') === 'adm_permissions_page' ? 'active' : '';

                if ($this->user->permissions->adm_permissions_view)
                    echo <<<ADMPERMISSIONS
                <li class="nav-item">
                    <a href="$admPermissionsLnk" class="nav-link $admPermissionsActive">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>
                            $admPermissionsTxt
                        </p>
                    </a>
                </li>
                ADMPERMISSIONS;
                ?>

            </ul>
        </nav>

    </div>

</aside>
