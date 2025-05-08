<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Processing System</title>
    
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Ticket Processing Log</h1>
	<!--Ticket Range Form-->
	<form method="post" action="">
		<label for="start"> Start Code:</label>
		<input type="number" name="start" id="start" value="<?php echo isset($_POST['start']) ? $_POST['start'] : 1; ?>" min="1" max="50" required>

		<label for="end">End Code:</label>
		<input type="number" name="end" id="end" value="<?php echo isset($_POST['end']) ? $_POST['end'] : 50; ?>" min="1" max="50" required>

		<input type="submit" value="Process Tickets">
	</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$start = (int) $_POST["start"];
	$end = (int) $_POST["end"];

	if ($start > $end || $start < 1 || $end > 50) {
		echo "<div class'log special'>Invalid range. Start must <= End, and between 1 to 50.</div>";
	} else {
		for ($code = 1; $code <= 50; $code++) {
			// Special check to terminate the loop early if the code is exactly 50
			if ($code ==50) {
				echo "Processing special termination code: $code<br>";
				break;
			}
			
			// Check if code is for VVIP (divisible by 15)
			if ($code % 15 == 0) {
				echo "Processing VVIP event ticket: $code<br/>";
				continue;
			}
			
			// Skip processing codes not divisible by 3 or 5
			if ($code % 3 !=0 && $code % 5  !=0) {
				echo "General inquiry for code: $code, skipping...<br/>";
				continue;
			}
			
			// Processing regular event tickets (divisible by 3)
			if ($code % 3 == 0) {
				echo "Processing regular event ticket: $code<br/>";
			}
			
			// Process VIP event tickets (divisible by 5)
			if ($code % 5 == 0) {
				echo "Processing VIP event ticket: $code<br>";
			}
			
			end_of_loop:
			echo "End of processing for code: $code<br><br>";
		}
	}
}
?>
</body>
</html>
