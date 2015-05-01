<div id="menu">
	<ul>
		<li><a href="." class="<?php if ($_SERVER["REQUEST_URI"] == '/' or $_SERVER["REQUEST_URI"] == '/index.php'or isset($_GET['view']) or isset($_GET['cat'])or isset($_GET['subcat']) or isset($_GET['edit']) or isset($_GET['based'])){echo 'selected';}?>"><span class="icon medium inbox"></span> Chemicals</a></li>
		<li><a href="add.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/add.php'){echo 'selected';}?>"><span class="icon medium sqPlus"></span> Add Chemicals</a></li>
		<li><a href="shoplist.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/shoplist.php'){echo 'selected';}?>"><span class="icon medium shopCart"></span> Shopping list</a></li>
		<li><a href="proj_list.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/proj_list.php' or isset($_GET['proj_id'])){echo 'selected';}?>"><span class="icon medium cube"></span> Projects</a></li>
		<li><a href="export_excel_csv.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/export_excel_csv.php' or isset($_GET['proj_id'])){echo 'selected';}?>"><span class="icon medium shre"></span> Export</a></li>
<li><a href="archived.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/archived.php' or isset($_GET['proj_id'])){echo 'selected';}?>"><span class="icon medium shre"></span> Archived Chemicals</a></li>
		<li><a href="my.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/my.php'){echo 'selected';}?>"><span class="icon medium user"></span> My account</a></li>
		<!--<li class=pub><a href="public.php" class="<?php if ($_SERVER["REQUEST_URI"] == '/public.php'){echo 'selected';}?>"><span class="icon medium shre"></span> Public Chemicals</a></li>
		-->
	</ul>
</div>
