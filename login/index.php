<?php
include("../include.php");

session_start();

$conn = new PDO($dbs);

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
  setcookie('team',$team,$expir,'/~gamejamdev/') or die('unable to create cookie');
  setcookie('secret',$secret,$expir,'/~gamejamdev/') or die('unable to create cookie');
  print_r($_COOKIE["team"]);
  print_r($_COOKIE["secret"]);
  $_SESSION["snackbar"] = "Successfully logged in!";
} else {
  die('invalid team');
}

header("Location: https://cse.taylor.edu/~gamejamdev/wip/teammembers");

?>
