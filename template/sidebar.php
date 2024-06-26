<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="../sources/images/faces/face1.jpg" alt="profile">
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2"><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></span>
                    <span class="text-secondary text-small"><?php echo htmlspecialchars($roleLabel); ?></span>
                </div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo htmlspecialchars($dashboardLink); ?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile.php">
                <span class="menu-title">Profile</span>
                <i class="mdi mdi-account-box menu-icon"></i>
            </a>
        </li>
        <?php if ($user['role_id'] == 1) : // System Administrator 
        ?>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <span class="menu-title">User Management</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-account-multiple menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="manageadmin.php">Manage Administrators</a></li>
                        <li class="nav-item"> <a class="nav-link" href="managestaff.php">Manage Vaccinator</a></li>
                        <li class="nav-item"> <a class="nav-link" href="manageusers.php">Manage Vaccinee</a></li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if ($user['role_id'] == 2): // Staff ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="staff_specific_page.php">
                        <span class="menu-title">Staff Page</span>
                        <i class="mdi mdi-account-box menu-icon"></i>
                    </a>
                </li>
                Add more staff-specific menu items here -->
            <?php endif; ?>

            <?php if ($user['role_id'] == 3): // User ?>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="user_specific_page.php">
                        <span class="menu-title">User Page</span>
                        <i class="mdi mdi-account menu-icon"></i>
                    </a>
                </li>
                Add more user-specific menu items here -->
            <?php endif; ?>
        <!-- <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
                <span class="menu-title">Icons</span>
                <i class="mdi mdi-contacts menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <span class="menu-title">Forms</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <span class="menu-title">Charts</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
                <span class="menu-title">Sample Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-medical-bag menu-icon"></i>
            </a>
            <div class="collapse" id="general-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                </ul>
            </div>
        </li> -->

    </ul>
</nav>