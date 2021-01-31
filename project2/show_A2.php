<html>
<head>
    <?php $title = "Hello World" ?>
    <title><?php print "$title"; ?></title>
</head>
<body bgcolor="white">
<h1><?php print "$title"; ?></h1>

<?php
$db = new mysqli('localhost', 'cs143', '', 'cs143');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}
$query = "SELECT * FROM Actor";
$rs = $db->query($query);

while ($row = $rs->fetch_assoc()) {
    $first = $row['first'];
    $last = $row['last'];
    print "$first, $last<br>";
}

$param = $_GET["param"];
if ($param) {
    print "Thanks for the lovely param='$param' binding.";
}
?>

</body>
</html>