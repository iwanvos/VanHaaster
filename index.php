<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="css.css" />
	<title>My Form</title>
</head>

<body>
	<form method="post">
		<label for="total">Totaal (Bakken)</label>
		<input type="number" id="total" name="total" required value="<?php echo isset($_POST['total']) ? $_POST['total'] : ''; ?>"> <br>

		<label for="pallets">Aantal Stapels Per Pallet</label>
		<input type="number" id="pallets" name="pallets" required value="<?php echo isset($_POST['pallets']) ? $_POST['pallets'] : 1; ?>"><br>

		<label for="max_height">Max Hoogte</label>
		<input type="number" id="max_height" name="max_height" required value="<?php echo isset($_POST['max_height']) ? $_POST['max_height'] : 13; ?>"><br>

		<input type="submit" name="submit" value="Submit">
	</form>
	<?php


	if (isset($_POST['submit'])) {
		$total = $_POST['total'];
		$row_per_pallet = $_POST['pallets'];
		$max_height = $_POST['max_height'];
		$max_height_cal = $max_height * $row_per_pallet;

		$num_pallets = ceil($total / $max_height_cal); 
	
		$pallets = array_fill(0, $num_pallets, 0); 
	
		for ($i = 0; $i < $total; $i++) {
			$min_pallet_height = min($pallets); 
			$pallets[array_search($min_pallet_height, $pallets)] += 1; 
		}

		$heights = array_count_values($pallets);


		if ($row_per_pallet == 1) {
			foreach ($heights as $height => $count) {
				echo "<div>" . $count . " pallet(s) van "  . $height . " hoog <br>" . "</div>";
			}
		} else {

			foreach ($heights as $height => $count) {
		
				echo "<div>" . $count . " pallet(s) van " . $height/$row_per_pallet . " hoog per stapel <br>" . "per pallet totaal " . $height . " bakken" . "</div>";
			}
		}
	}

	?>
</body>

</html>