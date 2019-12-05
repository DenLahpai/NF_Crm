<nav id="nav">
	<!-- menuSwitch -->
	<div id="menuSwitch" onclick="openMenu()">
		<div class="hamburger"></div>
		<div class="hamburger"></div>
		<div class="hamburger"></div>		
	</div>
	<!-- end of menuSwitch -->
	<!-- menu -->
	<div id="menu">
		<a href="home.php">
			<button type="button" class="button menu">Home</button></a>
		<a href="admin.php">
			<button type="button" class="button menu">Admin</button></a>
		<a href="reports.php">
			<button type="button" class="button menu">Reports</button></a>
		<a href="#"><button type="button" class="button menu" name="button" onclick="closeMenu();">Close</button></a>
	</div>
	<!-- end of menu -->
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
