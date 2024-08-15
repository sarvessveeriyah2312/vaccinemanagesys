<?php
session_start();
include '../backend/sessionretriver.php';
?>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo">
  <img src="../sources/images/logo.png" alt="logo" style="width:60%; height:60%"  />
</a>
        <a class="navbar-brand brand-logo-mini"><img src="../sources/images/logo-mini.svg" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
        </div>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="nav-profile-img">
                        <img src="../sources/images/faces/face1.jpg" alt="image">
                    </div>
                    <div class="nav-profile-text">
                        <p class="mb-1 text-black"><?php echo htmlspecialchars($user['first_name']) . ' ' . htmlspecialchars($user['last_name']); ?></p>
                    </div>
                </a>
                <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
    <a class="dropdown-item" href="../system/profile.php" style="color: #333; background-color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;" onmouseover="this.style.color='#fff'; this.style.backgroundColor='#007bff';" onmouseout="this.style.color='#333'; this.style.backgroundColor='#f8f9fa';">
        <i class="mdi mdi-account"></i> Profile
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="../backend/logout.php" style="color: #333; background-color: #f8f9fa; padding: 10px 20px; text-decoration: none; display: block;" onmouseover="this.style.color='#fff'; this.style.backgroundColor='#007bff';" onmouseout="this.style.color='#333'; this.style.backgroundColor='#f8f9fa';">
        <i class="mdi mdi-logout"></i> Logout
    </a>
</div>



            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>