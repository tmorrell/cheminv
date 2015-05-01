<?php
	require_once('include/login/auth.php');
	include('include/mysql_connect.php');
	require_once('include/debug.php');
	
	$owner 	= 	$_SESSION['SESS_MEMBER_ID'];
	$id 	= 	(int)$_GET['edit'];

	$GetDataComponent = mysql_query("SELECT * FROM data WHERE id = ".$id." AND owner = ".$owner."");
	$executesql = mysql_fetch_assoc($GetDataComponent);
	
	$GetPersonal = mysql_query("SELECT currency, measurement FROM members WHERE member_id = ".$owner."");
	$personal = mysql_fetch_assoc($GetPersonal);
	
	if ($executesql['owner'] !== $owner) {
		header("Location: error.php?id=2");
	}

	if ($executesql['category'] < 999) {
		$head_cat_id = substr($executesql['category'], -3, 1);
	}
	else {
		$head_cat_id = substr($executesql['category'], -4, 2);
	}

	$GetHeadCatName = mysql_query("SELECT * FROM category_head WHERE id = ".$head_cat_id."");
	$executesql_head_catname = mysql_fetch_assoc($GetHeadCatName);

	$sub_cat_id = $executesql['category'];
	
	$GetSubCatName = mysql_query("SELECT * FROM category_sub WHERE id = ".$sub_cat_id."");
	$executesql_sub_catname = mysql_fetch_assoc($GetSubCatName);
	
	$GetDataComponentsAll = "SELECT * FROM category_sub";
	$sql_exec = mysql_Query($GetDataComponentsAll);
	
	if(isset($_POST['delete'])) {
                $sql = "UPDATE data SET archived = '1' WHERE id = ".$id." ";
                $sql_exec = mysql_query($sql);
		$sql2 = "UPDATE data SET datearchived = now() WHERE id = ".$id." ";
                $sql2_exec = mysql_query($sql2);
                header("location: " . $_SERVER['REQUEST_URI']);
		$sql = "UPDATE data SET quantity = '0' WHERE id = ".$id." ";
                $sql_exec = mysql_query($sql);

	}
	
	if(isset($_POST['based'])) {
		header("Location: add_based.php?based=$id");
	}
	
	if (isset($_POST['quantity_increase'])) {
		$quantity_before	=	$_POST['quantity'];
		$quantity_after		= 	$quantity_before + 1;
		
		$sql = "UPDATE data SET quantity = '".$quantity_after."' WHERE id = ".$id." ";
		$sql_exec = mysql_query($sql);
		header("location: " . $_SERVER['REQUEST_URI']);
	}
	
	if (isset($_POST['quantity_decrease'])) {
		$quantity_before	=	$_POST['quantity'];
		$quantity_after 	= 	$quantity_before - 1;
		
		$sql = "UPDATE data SET quantity = '".$quantity_after."' WHERE id = ".$id." ";
		$sql_exec = mysql_query($sql);
		header("location: " . $_SERVER['REQUEST_URI']);
	}
	
	if (isset($_POST['orderquant_increase'])) {
		$quantity_before	=	$executesql['order_quantity'];
		$quantity_after		= 	$quantity_before + 1;
		
		$sql = "UPDATE data SET order_quantity = '".$quantity_after."' WHERE id = ".$id." ";
		$sql_exec = mysql_query($sql);

		$ordername        =       $executesql['name'];

                mail("order@email","New Order Requested in the Chemical Inventory System","$ordername has been requested in the inventory system.");

		header("location: " . $_SERVER['REQUEST_URI']);
	}
	
	if (isset($_POST['orderquant_decrease'])) {
		$quantity_before	=	$executesql['order_quantity'];
		$quantity_after 	= 	$quantity_before - 1;
		
		$sql = "UPDATE data SET order_quantity = '".$quantity_after."' WHERE id = ".$id." ";
		$sql_exec = mysql_query($sql);
		header("location: " . $_SERVER['REQUEST_URI']);
	}
?>
<!DOCTYPE HTML> 
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="If you wany to edit something of the component, do it here."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/> 
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Edit component - <?php echo $executesql['name']; ?> - ecDB</title>
		<?php include_once("include/analytics.php") ?>
	</head>
	
	<body>
		<div id="wrapper">
			
			<!-- Header -->
				<?php include 'include/header.php'; ?>
			<!-- END -->
			
			<!-- Main menu -->
				<?php include 'include/menu.php'; ?>
			<!-- END -->
			
			<!-- Main content -->
			<div id="content">
				<h1>
				<a href="category.php?cat=
					<?php 
						echo $executesql_head_catname['id']; 
						echo '"> ';
						echo $executesql_head_catname['name']; 
						echo '</a> / ';
						
						echo '<a href="category.php?subcat=';
						echo $executesql_sub_catname['id']; 
						echo '"> ';
						echo $executesql_sub_catname['name']; 
					?>
				</a> / <a href="component.php?view=<?php echo $executesql['id']; ?>"><?php echo $executesql['name']; ?></a></h1>
				</h1>
				
				
				<?php
					include('include/include.php');
					$Add = new ShowComponents;
					$Add->Add();
				?>
				
				<form cass="globalForms noPadding" action="" method="post" id="add">
                                        <table class="globalTables leftAlign noHover" cellpadding="0" cellspacing="0">
                                                <tbody>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Name
                                                                </td>
                                                                <td>
                                                                        <input name="name" id="name" type="text" class="medium" value="<?php echo $executesql['name'];  ?>" autofocus tabindex="0"/>
                                                                </td>
                                                                <td class="boldText">
                                                                        Location
                                                                </td>
                                                                <td>
                                                                        <select name="category">
                                                                <?php
								$HeadCategoryNameQuery = "SELECT * FROM category_head ORDER by name ASC";
								$sql_exec_headcat = mysql_Query($HeadCategoryNameQuery);

								while ($HeadCategory = mysql_fetch_array($sql_exec_headcat)) {

									echo '<option class="main_category" value="';
									echo $HeadCategory['id'];
									echo '" disabled>';
									echo $HeadCategory['name'];
									echo '</option>';

									$subcatfrom = $HeadCategory['id'] * 100;
									$subcatto = $subcatfrom + 99;

									$SubCategoryNameQuery = "SELECT * FROM category_sub WHERE id BETWEEN ".$subcatfrom." AND ".$subcatto." ORDER by name ASC";
									$sql_exec_subcat = mysql_Query($SubCategoryNameQuery);

									while ($SubCategory = mysql_fetch_array($sql_exec_subcat)) {
										echo '<option value="';
										echo $SubCategory['id'];
										echo '"';
										if ($executesql_sub_catname['id'] == $SubCategory['id']) {
											echo ' selected';
										}
										echo '>';
										echo $SubCategory['name'];
										echo '</option>';
									}}
                                                                                ?>
                                                                        </select>
                                                                </td>
                                                                <td class="boldText">
                                                                        Quantity
                                                                </td>
                                                                <td>
									<input name="quantity" type="text" class="small" value="<?php echo $executesql['quantity']; ?>" id="quantity"/>
									<button class="button white small" name="quantity_increase" type="submit"><span class="icon medium roundPlus"></span></button>
									<button class="button white small" name="quantity_decrease" type="submit"><span class="icon medium roundMinus"></span></button>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Manufacturer
                                                                </td>
                                                                <td>
                                                                        <input name="manufacturer" id="manufacturer" class="medium" type="text" value="<?php echo $executesql['manufacturer'];  ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        CAS Number
								 </td>
                                                                <td>
                                                                        <input name="cas_number" id="cas_number" class="medium" type="text" class="small" value="<?php echo $executesql['cas_number'];  ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        To order
                                                                </td>
                                                                <td>
                                                                        <input name="order_quantity" type="text" class="small" value="<?php echo $executesql['order_quantity'];  ?>" />
								<form class="globalForms inLine" method="post" action="">
                                                                                <button class="button white small" name="orderquant_increase" type="submit"><span class="icon medium roundPlus"></span></button>
                                                                                <button class="button white small" name="orderquant_decrease" type="submit"><span class="icon medium roundMinus"></span></button>
                                                                        </form>
								</td>
                                                        </tr>
                                                        <tr>

                                                                <td class="boldText">
                                                                        Item Number
                                                                </td>
                                                                <td>
                                                                        <input name="item_number" id="item_number" class="medium" type="text" value="<?php  echo $executesql['item_number'];  ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Bar Code
                                                                </td>
                                                                <td>
                                                                        <input name="barcode" id="location" class="medium" type="text" value="<?php echo $executesql['barcode'];  ?>" />
                                                                </td>

                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Amount
                                                                </td>
                                                                <td>
                                                                        <input name="amount" type="text" class="small" value="<?php echo $executesql['amount'];  ?>" /> <?php echo 'g'; ?>
                                                                </td>
                                                                <td class="boldText">
                                                                        Volume
                                                                </td>
                                                                <td>
                                                                        <input name="volume" type="text" class="small" value="<?php echo $executesql['volume'];  ?>" /> <?php echo 'mL'; ?>
                                                                </td>
                                                                <td class="boldText">
                                                                        Price
								</td>
                                                                <td>
                                                                        <input name="price" type="text" class="small" value="<?php echo $executesql['price']; ?>" /> <?php echo $personal['currency']; ?>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                        </tr>
                                                        <!-- <tr>
                                                                <td class="boldText">
                                                                        SMD
                                                                </td>
                                                                <td>
                                                                        <?php
                                                                                if(isset($_POST['submit']) && $_POST['smd'] == 'Yes'){
                                                                                        echo '<input type="radio" name="smd" value="Yes" checked="checked" /> Yes ';
                                                                                        echo '<input type="radio" name="smd" value="No" /> No';
                                                                                }
                                                                                else{
                                                                                        echo '<input type="radio" name="smd" value="Yes" /> Yes ';
                                                                                        echo '<input type="radio" name="smd" value="No" checked="checked" /> No';
                                                                                }
                                                                        ?>
                                                                </td>
                                                                <td class="boldText">
                                                                        Scrap
                                                                </td>
                                                                <td>
                                                                        <?php
                                                                                if(isset($_POST['submit']) && $_POST['scrap'] == 'Yes'){
                                                                                        echo '<input type="radio" name="scrap" value="Yes" checked="checked" /> Yes ';
                                                                                        echo '<input type="radio" name="scrap" value="No" /> No';
                                                                                }
                                                                                else{
echo '<input type="radio" name="scrap" value="Yes" /> Yes ';
                                                                                        echo '<input type="radio" name="scrap" value="No" checked="checked" /> No';
                                                                                }
                                                                        ?>
                                                                </td>
                                                                <td class="boldText">
                                                                        Public
                                                                </td>
                                                                <td>
                                                                        <?php
                                                                                if(isset($_POST['submit']) && $_POST['public'] == 'No'){
                                                                                        echo '<input type="radio" name="public" value="Yes" /> Yes ';
                                                                                        echo '<input type="radio" name="public" value="No" checked="checked"  /> No';
                                                                                }
                                                                                else{
                                                                                        echo '<input type="radio" name="public" value="Yes" checked="checked" /> Yes ';
                                                                                        echo '<input type="radio" name="public" value="No" /> No';
                                                                                }
                                                                        ?>
                                                                </td>
                                                        </tr>-->
                                                        <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Percent Full
                                                                </td>
                                                                <td>
                                                                        <input name="weight" type="text" class="small" value="<?php echo $executesql['weight']; ?>" /> <?php if($personal['measurement'] == 1){echo '%';} else {echo '%'; } ?>
                                                                </td>
                                                                <td class="boldText">
                                                                        Width
</td>
                                                                <td>
                                                                        <input name="width" type="text" class="small" value="<?php echo $executesql['width'];  ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Molecular Weight
                                                                </td>
                                                                <td>
                                                                        <input name="mw" type="text" class="small" value="<?php echo $executesql['mw']; ?>" /> <?php if($personal['measurement'] == 1){echo 'g/mol';} else {echo 'in'; } ?>
                                                                </td>
                                                                <td class="boldText">
                                                                        Depth
                                                                </td>
                                                                <td>
                                                                        <input name="depth" type="text" class="small" value="<?php echo $executesql['depth'];  ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
                                                                </td>
                                                                <td><img class="packageImage" border="0" src="img/boxSize.png"/></td>
                                                                <td></td>
                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        MSDS URL
                                                                </td>
                                                                <td>
                                                                        <input name="datasheet" type="text" class="medium" value="<?php echo $executesql['datasheet'];  ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Height
                                                                </td>
                                                                <td>
                                                                        <input name="height" type="text" class="small" value="<?php echo $executesql['height'];  ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                        </tr>
 							<tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Date Arrived
                                                                </td>
                                                                <td>
                                                                        <input name="datea" type="text" class="small" value="<?php echo $executesql['datea']; ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Date Opened
                                                                </td>
                                                                <td>
                                                                        <input name="dateo" type="text" class="small" value="<?php echo $executesql['dateo']; ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Date Expired
                                                                </td>
                                                                <td>
                                                                        <input name="datex" type="text" class="small" value="<?php echo $executesql['datex']; ?>" />
                                                                </td>
                                                        </tr>
                                                        <tr>

                                                                <td class="boldText">
                                                                        Bar Code 2
                                                                </td>
                                                                <td>
                                                                        <input name="barcode2" type="text" class="medium" value="<?php echo $executesql['barcode2']; ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Bar Code 3
 								</td>
                                                                <td>
                                                                        <input name="barcode3" type="text" class="medium" value="<?php echo $executesql['barcode3']; ?>"  />
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Bar Code 4
                                                                </td>
                                                                <td>
                                                                        <input name="barcode4" type="text" class="medium" value="<?php echo $executesql['barcode4'];  ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Bar Code 5
                                                                </td>
                                                                <td>
                                                                        <input name="barcode5" type="text" class="medium" value="<?php echo $executesql['barcode5'];  ?>" />
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td class="boldText">
                                                                        Bar Code 6
                                                                </td>
                                                                <td>
                                                                        <input name="barcode6" type="text" class="medium" value="<?php echo $executesql['barcode6']; ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Bar Code 7
                                                                </td>
                                                                <td>
                                                                        <input name="barcode7" type="text" class="medium" value="<?php echo $executesql['barcode7'];  ?>" />
                                                                </td>
                                                                <td>
                                                                </td>
                                                                <td>
                                                                </td>
 							</tr>
                                                        <tr>
                                                                <td></td>
                                                                <td  class="boldText">
                                                                        Add chemical to project
                                                                </td>
                                                                <td  class="boldText">
                                                                        Quantity
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                        </tr>
                                                        <tr>
                                                                <td></td>
                                                                <td>
                                                                        <select name="project">
                                                                                <?php
                                                                                        include('include/include_component_add_project.php');
                                                                                        $MenuProj = new AddMenuProj;
                                                                                        $MenuProj->MenuProj();
                                                                                ?>
                                                                        </select>
                                                                </td>
                                                                <td>
                                                                        <input name="projquant" type="text" class="small" value="<?php echo $executesql['projquant'];  ?>" />
                                                                </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                        </tr>
                                                </tbody>
                                        </table>
                                        <div class="textBoxInput">
                                                <label class="keyWord boldText">Comment</label>
                                                <div class="text">
                                                        <textarea name="comment" rows="4"><?php echo $executesql['comment'];  ?></textarea>
                                                </div>
                                        </div>

					<div class="buttons">
						<div class="input">
							<button class="button green" name="update" type="submit"><span class="icon medium save"></span> Update</button>
							<button class="button" name="based" type="submit"><span class="icon medium sqPlus"></span> New based on this</button>
							<button class="button red" name="delete" type="submit"><span class="icon medium trash"></span> Delete</button>
						</div>
					</div>
				</form>
			</div>
			<!-- END -->

			<!-- Text outside the main content -->
				<?php include 'include/footer.php'; ?>
			<!-- END -->
		</div>
	</body>
</html>
