<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav id="sidebar">
    <div class="sidebar-header">
        <h3>
            <img src="../../image/local_image/OIP.jpg" class="img-fluid" />
            <span>RRTSNS</span>
        </h3>
    </div>
    <ul class="list-unstyled components">
        <li class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
            <a href="index.php" class="dashboard"><i class="material-icons">dashboard</i>
                <span>Dashboard</span></a>
        </li>
        <li class="dropdown <?php echo (in_array($current_page, ['book_lists.php', 'book_borrowed.php', 'book_returned.php'])) ? 'active' : ''; ?>">
            <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">aspect_ratio</i>Books
            </a>
            <ul class="collapse list-unstyled menu <?php echo ($current_page == 'book_lists.php' || $current_page == 'book_borrowed.php' || $current_page == 'book_returned.php') ? 'show' : ''; ?>" id="homeSubmenu1">
                <li><a class="<?php echo ($current_page == 'book_lists.php') ? 'active' : ''; ?>" href="book_lists.php">Book Lists</a></li>
                <li><a class="<?php echo ($current_page == 'book_borrowed.php') || ($current_page == 'book_borrowed_BORROWED.php') || ($current_page == 'book_borrowed_RETURNED.php') || ($current_page == 'book_borrowed_REQUEST.php') ? 'active' : ''; ?>" href="book_borrowed.php">Borrowed Books</a></li>
                <li><a class="<?php echo ($current_page == 'book_returned.php') ? 'active' : ''; ?>" href="book_returned.php">Returned</a></li>
            </ul>
        </li>
        <li class="dropdown <?php echo (in_array($current_page, ['admin.php', 'students.php', 'book_returned.php'])) ? 'active show' : ''; ?>">
            <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="material-icons">aspect_ratio</i>Users
            </a>
            <ul class="collapse list-unstyled menu <?php echo ($current_page == 'admin.php' || $current_page == 'students.php' || $current_page == 'book_returned.php') ? 'show' : ''; ?>" id="users">
                <li><a class="<?php echo ($current_page == 'admin.php') ? 'active' : ''; ?>" href="admin.php">Admin</a></li>
                <li><a class="<?php echo ($current_page == 'students.php') ? 'active' : ''; ?>" href="students.php">Students</a></li>
                <li><a class="<?php echo ($current_page == 'book_returned.php') ? 'active' : ''; ?>" href="book_returned.php">Returned</a></li>
            </ul>
        </li>
        <li class="<?php echo ($current_page == 'backuprestore.php') ? 'active' : ''; ?>">
            <a href="backuprestore.php" class="dashboard"><i class="material-icons">dashboard</i>
                <span>Recover</span></a>
        </li>
        <li class="<?php echo ($current_page == 'profile.php') ? 'active' : ''; ?>">
            <a href="profile.php" class="dashboard"><i class="material-icons">dashboard</i>
                <span>Profile</span></a>
        </li>
    </ul>
</nav>
