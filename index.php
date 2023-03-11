<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css.css"/>
	<title>My Form</title>
</head>
<body>
	<form method="post">
		<label for="total">Totaal (Bakken)</label>
		<input type="number" id="total" name="total" required><br>
		
        <label for="pallets">Aantal Stapels Per Pallet</label>
		<input type="number" id="pallets" name="pallets" value="1" required><br>
        
        <label for="max_height">Max Hoogte</label>
		<input type="number" id="max_height" name="max_height" required><br>
		
		<input type="submit" name="submit" value="Submit">
	</form>
<?php




if (isset($_POST['submit'])) {
    $total = $_POST['total'];
    $row_per_pallet = $_POST['pallets'];
    $max_height = $_POST['max_height'];
    $max_height_cal =  $max_height  *  $row_per_pallet;
    
    $num_pallets = ceil($total / $max_height_cal); // Calculate the total number of pallets needed
    
    $pallets = array_fill(0, $num_pallets, 0); // Initialize an array to hold the number of boxes on each pallet
    
    for ($i = 0; $i < $total; $i++) {
        $min_pallet_height = min($pallets); // Find the pallet with the smallest height
        $pallets[array_search($min_pallet_height, $pallets)] += 1; // Add the box to that pallet
    }
    
    // Print the pallet distribution
    $heights = array_count_values($pallets);
    
    // Print the pallet distribution
    if ($row_per_pallet == 1){
       foreach ($heights as $height => $count) {
            echo "<div>". $count . " pallet(s) hoogte " . $height . "<br>" . "</div>";
        }
    }else{
        foreach ($heights as $height => $count) {
            $num_full_rows = floor($height/$row_per_pallet);
            $num_boxes_on_last_row = $height % $row_per_pallet;
            $total_boxes_on_pallet = $num_full_rows * $row_per_pallet + $num_boxes_on_last_row;
            echo "<div>". $count . " pallet(s) hoogte " . $max_height . "<br>" . "per pallet totaal ". $total_boxes_on_pallet ." bakken". "</div>";
        }
    }
}




		// if (isset($_POST['submit'])) {
		
		// 	$total = $_POST['total'];
		// 	$per_pallet = $_POST['pallets'];
		// 	$max_height = $_POST['max_height'];
		
		// 	$num_pallets = $total/$max_height;
			
		// 	if($num_pallets > 1 ){
		// 		if (is_float($num_pallets)) {

		// 			$num_pallets_floor = floor($total/$max_height);

		// 			$rest = $total -($num_pallets_floor * $max_height) ;

		// 			$away = $max_height-$rest;

		// 			// $fraction = $num_pallets - $num_pallets_floor;

					

		// 			echo $away;
					


		// 		}
		// 		else{
		// 			echo $num_pallets . ' van ' . $max_height . ' hoog';
		// 		}

		// 	}
		// 	else{
		// 		echo 'Stupid?';
		// 	}



		// 	// Calculate the total number of pallets needed
		// 	// $num_pallets = ceil($total / $per_pallet);

		// 	// Check if the pallets will fit within the max height
		
		// 		// if (is_float($num_pallets)) {
		// 		// 	echo "You will need ". floor($num_pallets) ." pallets and ". ($num_pallets-floor($num_pallets))*$per_pallet ." boxes on an additional pallet.";
		// 		// } else {
		// 		// 	echo "You will need $num_pallets pallets.";
		// 		// }
		// 	}
			
	?>
</body>
</html>