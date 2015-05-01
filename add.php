<?php
	require_once('include/login/auth.php');
	require_once('include/mysql_connect.php');
	require_once('include/debug.php');
	
	// Get some personal data. ID, currency, measurement unit
	$owner 	= 	$_SESSION['SESS_MEMBER_ID'];
	$GetPersonal = mysql_query("SELECT currency, measurement FROM members WHERE member_id = ".$owner."");
	$personal = mysql_fetch_assoc($GetPersonal);
?>
<!DOCTYPE HTML> 
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Add a component to your database."/>
		<meta name="keywords" content="electronics, components, database, project, inventory"/> 
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Add component - ecDB</title>
		
		<script type="text/javascript" src="include/autocomplete/jquery.js"></script>
		<script type="text/javascript" src="include/autocomplete/jquery.autocomplete.js"></script>
		<link rel="stylesheet" type="text/css" href="include/autocomplete/jquery.autocomplete.css" />

		<script type="text/javascript">
			$().ready(function() {
				$("#name").autocomplete("include/autocomplete/autocomplete_name.php", {
					width: 150,
					matchContains: true,
					minChars: 2,
					selectFirst: false
				});
			});
		</script>
		<!--<script type="text/javascript">
			$().ready(function() {
				$("#package").autocomplete("include/autocomplete/autocomplete_package.php", {
					width: 150,
					matchContains: true,
					minChars: 2,
					selectFirst: false
				});
			});
		</script>
		-->
		<script type="text/javascript">
			$().ready(function() {
				$("#manufacturer").autocomplete("include/autocomplete/autocomplete_manufacturer.php", {
					width: 150,
					matchContains: true,
					minChars: 2,
					selectFirst: false
				});
			});
		</script>
		<?php include_once("include/analytics.php") ?>

		</head>
	<body  onLoad="document.forms.add.name.focus()">
		<div id="wrapper">
			
			<!-- Header -->
				<?php include 'include/header.php'; ?>
			<!-- END -->
			
			<!-- Main menu -->
				<?php include 'include/menu.php'; ?>
			<!-- END -->
			
			<!-- Main content -->
			<div id="content">
				
				
				<?php
					include('include/include.php');
					$Add = new ShowComponents;
					$Add->Add();
				?>
				
				
				<form class="globalForms noPadding" action="" method="post" id="add">
					<table class="globalTables leftAlign noHover" cellpadding="0" cellspacing="0">
						<tbody>
							<tr>
								<td class="boldText">
									Name
								</td>
								<td>
									<input name="name" id="name" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['name']; } ?>" autofocus tabindex="0"/>
								</td>
								<td class="boldText">
									Location
								</td>
								<td>
									<select name="category">
										<?php
											// Include the category selector menu.
											include('include/include_component_add_category_menu.php');
											$MenuCat = new AddMenuCat;
											$MenuCat->MenuCat();
										?>
									</select>
								</td>
								<td class="boldText">
									Quantity
								</td>
								<td>
									<input name="quantity" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['quantity']; } ?>" />
								</td>
							</tr>
							<tr>
								<td class="boldText">
									Manufacturer
								</td>
								<td>
									<input name="manufacturer" id="manufacturer" class="medium" type="text" value="<?php if(isset($_POST['submit'])) { echo $_POST['manufacturer']; } ?>" />
								</td>
								<td class="boldText">
									CAS Number
								</td>
								<td>
								(Dashes will be added automatically)
								</td>
								<td colspan="2">
                                                                        <input name="cas_number" id="cas_number" class="middle" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo mb_substr($_POST['cas_number'],0,-3)."-".mb_substr($_POST['cas_number'],-3,-1)."-".mb_substr($_POST['cas_number'],-1,1); } ?>" />
                                                                </td>
							</tr>
							<tr>
								<td class="boldText">
                                                                        Item Number
                                                                </td>
                                                                <td>
                                                                        <input name="item_number" id="item_number" class="medium" type="text" value="<?php if(isset($_POST['submit'])) { echo $_POST['item_number']; } ?>" />
                                                                </td>
								<td class="boldText">
                                                                        Bar Code
                                                                </td>
                                                                <td>
                                                                        <input name="barcode" id="location" class="medium" type="text" value="<?php if(isset($_POST['submit'])) { echo $_POST['barcode']; } ?>" />
                                                                </td>
								<td class="boldText">
                                                                        To order
                                                                </td>
                                                                <td>
                                                                        <input name="order_quantity" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['order_quantity']; } ?>" />
                                                                </td>
							</tr>
                                                        <tr>
								<td class="boldText">
									Amount
								</td>
								<td>
									<input name="amount" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['amount']; } ?>" /> <?php echo 'g'; ?>
                                                                </td>
								<td class="boldText">
                                                                        Volume
                                                                </td>
                                                                <td>
                                                                        <input name="volume" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['volume']; } ?>" /> <?php echo 'mL'; ?>
                                                                </td>
								<td class="boldText">
									Price
								</td>
								<td>
									<input name="price" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['price']; } ?>" /> <?php echo $personal['currency']; ?>
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
									<input name="weight" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['weight']; } ?>" /> <?php if($personal['measurement'] == 1){echo '%';} else {echo '%'; } ?>
								</td>
								<td class="boldText">
									Width
								</td>
								<td>
									<input name="width" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['width']; } ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="boldText">
									Molecular Weight
								</td>
								<td>
									<input name="mw" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['mw']; } ?>" /> <?php if($personal['measurement'] == 1){echo 'g/mol';} else {echo 'in'; } ?>
								</td>
								<td class="boldText">
									Depth
								</td>
								<td>
									<input name="depth" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['depth']; } ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
								</td>
								<td><img class="packageImage" border="0" src="img/boxSize.png"/></td>
								<td></td>
							</tr>
							<tr>
								<td class="boldText">
									MSDS URL
								</td>
								<td>
									<input name="datasheet" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['datasheet']; } ?>" /> 
								</td>
								<td class="boldText">
									Height
								</td>
								<td>
									<input name="height" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['height']; } ?>" /> <?php if($personal['measurement'] == 1){echo 'mm';} else {echo 'in'; } ?>
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
                                                                        <input name="datea" type="text" class="middle" value="<?php if(isset($_POST['submit'])) { echo $_POST['datea']; } else {echo date("m/d/y"); }?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Date Opened
                                                                </td>
                                                                <td>
                                                                        <input name="dateo" type="text" class="middle" value="<?php if(isset($_POST['submit'])) { echo $_POST['dateo']; } ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Date Expired
                                                                </td>
                                                                <td>
                                                                        <input name="datex" type="text" class="middle" value="<?php if(isset($_POST['submit'])) { echo $_POST['datex']; } ?>" />
                                                                </td>
                                                        </tr>
                                                        <tr>

								<td class="boldText">
									Bar Code 2
								</td>
								<td>
									<input name="barcode2" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['barcode2']; } ?>" />
								</td>
								<td class="boldText">
									Bar Code 3
								</td>
								<td>
									<input name="barcode3" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['barcode3']; } ?>"  />
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
									<input name="barcode4" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['barcode4']; } ?>" />
								</td>
								<td class="boldText">
									Bar Code 5
								</td>
								<td>
									<input name="barcode5" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['barcode5']; } ?>" />
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
                                                                        <input name="barcode6" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['barcode6']; } ?>" />
                                                                </td>
                                                                <td class="boldText">
                                                                        Bar Code 7
                                                                </td>
                                                                <td>
                                                                        <input name="barcode7" type="text" class="medium" value="<?php if(isset($_POST['submit'])) { echo $_POST['barcode7']; } ?>" />
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
									<input name="projquant" type="text" class="small" value="<?php if(isset($_POST['submit'])) { echo $_POST['projquant']; } ?>" />
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
                                                        <textarea name="comment" rows="4"><?php if(isset($_POST['submit'])) { echo $_POST['comment']; } ?></textarea>
                                                </div>
                                        </div>

					<div class="buttons">
						<div class="input">
							<button class="button green" name="submit" type="submit"><span class="icon medium save"></span> Save</button>
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
