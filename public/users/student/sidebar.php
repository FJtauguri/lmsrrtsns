<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>
            <img src="../../../image/local_image/OIP.jpg" class="img-fluid" />
            <span>RRTSNS</span>
        </h3>
    </div>
    <ul class="list-unstyled components">
        <li class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
            <a href="index.php" class="dashboard"><i class="material-icons">dashboard</i>
                <span>Explore</span></a>
        </li>
        <li class="<?php echo ($current_page == 'borrowed.php') ? 'active' : ''; ?>">
            <a href="borrowed.php" class="dashboard"><i class="material-icons">dashboard</i>
                <span>Borrow</span></a>
        </li>
        <li class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
            <a href="profile.php" class="dashboard"><i class="material-icons">dashboard</i>
                <span>Profile</span></a>
        </li>
    </ul>
</nav>