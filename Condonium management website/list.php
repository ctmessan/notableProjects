<?php
    $servername = "localhost";
    $username = "id3907483_mandc";
    $password = "noChair6^";
    $dbname = "id3907483_solmaris";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

$sql = 'SELECT * 
		FROM CONDO_UNIT';
		
$query = mysqli_query($conn, $sql);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($conn));
}
?>
<html>

<head>
    <link rel="shortcut icon" href="fav_icon.png">
    <center><a href="https://candmcondo.000webhostapp.com/solmaris.php">Back to Main</a>

	</ul>
	<title></title>
	<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			background-color:white;
            background-image: url("main_background.jpg");
            background-size:cover;
            background-repeat:no-repeat;
            background-position: -3 , 0;
			padding: 0;b
			margin: 0;
			
		}
		
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
			background:rgba(255, 255, 255, 0.6);
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 2.5em;
			font-family: 'Open Sans', sans-serif;
            font-weight:bold;
            color:white;
            width: 50%;
		}
		
		a{
		    color:white;
		    font-size:1.5em;
		}
		
		table{
		    
		    margin-bottom:1.5em;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 17px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
			font-weight:bold;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
</head>

<body>
	<h1>REGISTERED CONDOS</h1>
	<p></p>
	<table class="data-table">
		<thead>
			<tr>
				<th>CONDO ID</th>
				<th>LOCATION NUMBER</th>
				<th>UNIT NUMBER</th>
				<th>SQUARE FEET</th>
				<th>BEDROOMS</th>
				<th>BATHS</th>
				<th>CONDO FEE</th>
				<th>OWNER_NUM</th>
				
			</tr>
		</thead>
		<tbody>
		<?php
		
		while ($row = mysqli_fetch_array($query))
		{
			
			echo '<tr>
					<td>'.$row['CONDO_ID'].'</td>
					<td>'.$row['LOCATION_NUM'].'</td>
					<td>'.$row['UNIT_NUM'].'</td>
					<td>'.$row['SQR_FT'].'</td>
					<td>'.$row['BDRMS'].'</td>
					<td>'.$row['BATHS'].'</td>
					<td>'.$row['CONDO_FEE'].'</td>
					<td>'.$row['OWNER_NUM'].'</td>
				</tr>';

		}?>
		</tbody>

	</table>
</body>
</html>