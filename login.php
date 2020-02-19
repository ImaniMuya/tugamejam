<?php 
$conn = new PDO('sqlite:../test.db');

$team = $_GET['team'];
$secret = $_GET['secret'];


$sql = "SELECT *
        FROM teams WHERE team_id = $team AND the_secret = $secret";
$stmt = $conn->prepare($sql);
$stmt->execute();
$validteam = $stmt->fetch(PDO::FETCH_ASSOC);

if ($validteam) {
  echo "setting cookies... ";
  $expir = time()+172800;
  setcookie('team',$team,$expir) or die('unable to create cookie');
  setcookie('secret',$secret,$expir) or die('unable to create cookie');
  // print_r($_COOKIE["team"]);
  // print_r($_COOKIE["secret"]);
}

header("Location: http://cse.taylor.edu/~gamejamdev/teammembers");

?>