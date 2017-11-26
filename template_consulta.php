$qstr = "SELECT * FROM x";
$query = $con->prepare( $qstr );
$query->execute();
$row = $query->fetch();
while ($row) {
	
	$row = $query->fetch();
}