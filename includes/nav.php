<nav id="nav">
	<!-- menuSwitch -->
	<div id="menuSwitch" onclick="openMenu()">
		<div class="hamburger" id="hamburger"></div>
		<div class="hamburger" id="hamburger"></div>
		<div class="hamburger" id="hamburger"></div>		
	</div>
	<!-- end of menuSwitch -->
	<!-- menu -->
	<div id="menu">
		<button type="button" class="button menu" onclick="window.location.href='home.php'"><a href="home.php">Home</a></button>
		<button type="button" class="button menu"><a href="reports.php">Reports</a></button>
        <button type="button" class="button menu"><a href="admin.php">Admin</a></button>
        <button type="button" class="button menu"><a href="logout.php">Logout</a></button>
		<button type="button" class="button menu" name="button" onclick="closeMenu();">Close</button>
	</div>
	<!-- end of menu -->
    <!-- username -->
    <div class="username">
        <a href="<? echo "update_user.php?UsersId=".$_SESSION['UsersId']; ?>" title="Edit"><? echo $_SESSION['Name']; ?></a>
    </div>  
<!-- end of username -->		
</nav>

<script type="text/javascript">
    //get menu
    var menu = document.getElementById('menu');

    //get menuSwitch
    var menuSwitch = document.getElementById('menuSwitch');

    //get nav
    var nav = document.getElementById('nav');

    window.addEventListener('click', outsideClick);

    //function to expand the menu
    function openMenu() {
        menu.style.display = 'block';
    }

    //function to close the menu
    function closeMenu() {
        menu.style.display = 'none';
    }

    //function to close menu
    function outsideClick(e) {
        if (e.target == menu) {
            menu.style.display = 'none';
        }
    }
</script>
