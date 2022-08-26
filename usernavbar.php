
<nav style="font-family: 'Segoe UI';">
    <div class="nav-menu">
        <label class="Logo">E-Book Store</label>
        <a class="nav-menu-btn" href="UserHome.php">Home</a>
        <a class="nav-menu-btn" href="CategoryResult.php?recentid=2&name=Free">Free</a>
    </div>
    <form action="CategoryResult.php" method="GET">
        <input class="searchbox" type="search" name="query" placeholder="Search e-books">
        <input class="searchbtn" type="submit" value="Search">
    </form>
    <div class="nav-actions">
        <a class="primarybtn" href="cart.php">Cart</a>
        <a class="primarybtn" href="UserProfile.php"><?php echo $_SESSION['username'];?></a>
        <a class="primarybtn" href="logout.php?id=1">LOG OUT</a>
    </div>
</nav>