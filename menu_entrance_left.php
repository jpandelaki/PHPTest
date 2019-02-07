<!DOCTYPE html>
<html>
  <head>
    <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

    <title>Menu Display - Current Selections</title>
    <meta charset="utf-8">

    <style>
	body {
		margin: 40px;
		background-color: #c7c7c7;
		font-family: 'Roboto', sans-serif;
	}
	.wrapper {
		display: grid;
		grid-gap: 10px;
		grid-template-columns: 580px;
		background-color: #c7c7c7;
		color: #444;
	}

	.box {
		background-color: #912F46;
		color: #fff;
		border-radius: 5px;
		padding: 20px;
		font-size: 186%;
		line-height: 1.5em;
	}

	.meal {
		background-color: #F2CD00;
		color: #000;
		border-radius: 5px;
		padding: 20px;
		font-size: 240%;
		font-family: 'Roboto Bold', sans-serif;
	}
   </style>
</head>

 <body>
<!-- 03-Soup

05-Entree
06-Starch
07-Vegetables

08-Salad
10-Bread

11-Dessert

22-Specialty Bar 


WHEN '03 - SOUPS' THEN 0
	WHEN '08 - SALADS' THEN 1
	WHEN  '10 - BREADS' THEN 2
	WHEN '05 - ENTREES' THEN 3
	WHEN '06- STARCHES' THEN 4
	WHEN '07 - VEGETABLES' THEN 5
	WHEN  '11 - DESSERTS' THEN 6
	WHEN '22 - SPECIALTY BAR' THEN 7
	WHEN  '13 - PARSTOCKS' THEN 8
    ELSE 9 
-->


 <?php
$servername = "localhost";
$username = "laraveldatauser";
$password = "propertyofnmh";
$dbname = "alumni_hall";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currenttime = date('H:i', time());
echo "THIS IS THE TIMESTAMP:::: " . $currenttime;

//sql to check if we have brunch today
$sqlCHECKBRUNCH = "SELECT Meal FROM alumni_hall.ahmenudisplay  where str_to_date(LabelDate, '%m/%d/%Y') = current_date() and Meal = 'BRUNCH'";
$resultCHECKBRUNCH = $conn->query($sqlCHECKBRUNCH);

if ($resultCHECKBRUNCH->num_rows > 0 and ($currenttime > 10 or $currenttime <= 13)){
    $meal = 'BRUNCH';
} 
  ELSEIF ($currenttime <= 10) {
	$meal = 'BREAKFAST';
} ELSEIF ($currenttime > 10 and $currenttime <= 15) {
	$meal = 'LUNCH';
} ELSE
{
	$meal = 'DINNER';
} 
echo "THE Meal is : " . $meal;



//$sql = "SELECT FormalName FROM ahmenudisplay";
$sqlSection1 = "SELECT DisplayOrder, FormalName FROM alumni_hall.ahmenudisplay  where str_to_date(LabelDate, '%m/%d/%Y') = current_date() and DisplayOrder < 3 and Meal = '" . $meal . "' order by DisplayOrder, formalname";
$resultSection1 = $conn->query($sqlSection1);

$sqlSection2 = "SELECT DisplayOrder, FormalName FROM alumni_hall.ahmenudisplay  where str_to_date(LabelDate, '%m/%d/%Y') = current_date() and (DisplayOrder >= 3 and DisplayOrder <= 5) and Meal = '" . $meal . "' order by DisplayOrder, formalname";
$resultSection2 = $conn->query($sqlSection2);

$sqlSection3 = "SELECT DisplayOrder, FormalName FROM alumni_hall.ahmenudisplay  where str_to_date(LabelDate, '%m/%d/%Y') = current_date() and DisplayOrder = 6 and Meal = '" . $meal . "' order by DisplayOrder, formalname";
$resultSection3 = $conn->query($sqlSection3);

$sqlSection4 = "SELECT DisplayOrder, FormalName FROM alumni_hall.ahmenudisplay  where str_to_date(LabelDate, '%m/%d/%Y') = current_date() and DisplayOrder = 7 and Meal = '" . $meal . "' order by DisplayOrder, formalname";
$resultSection4 = $conn->query($sqlSection4);

//if ($result->num_rows > 0) {
?>

	 <div class="wrapper">
		<div class="meal">
			<?php echo "Today's " . ucwords(strtolower($meal)); ?>
		</div>
	 
		<?php
		if ($resultSection1->num_rows > 0) {
			echo "<div class='box a'>";
			// output data of each row
			while($row = $resultSection1->fetch_assoc()) {
				echo $row["FormalName"]. "<br>";
			}
			echo "</div>";
		}

		if ($resultSection2->num_rows > 0) {
			echo "<div class='box b'>";
			// output data of each row
			while($row = $resultSection2->fetch_assoc()) {
				echo $row["FormalName"]. "<br>";
			}
			echo "</div>";
		}
		
		if ($resultSection3->num_rows > 0) {
			echo "<div class='box c'>";
			// output data of each row
			while($row = $resultSection3->fetch_assoc()) {
				echo $row["FormalName"]. "<br>";
			}
			echo "</div>";
		}
		

		if ($resultSection4->num_rows > 0) {
			echo "<div class='box d'>";
			// output data of each row
			while($row = $resultSection4->fetch_assoc()) {
				echo $row["FormalName"]. "<br>";
			}
			echo "</div>";
		}
			
		?>
		</div>
		
	</div>
<?php


$conn->close();
?>
	
	</body>
</html>

