

<?php
//should have $conn already.
// if (!$conn) $conn = new PDO($dbs); //don't rely on this


$isloggedin = false;
// print_r($_COOKIE);

if(isset($_COOKIE['team'])){
  $teamId = $_COOKIE['team'];
  $secret = $_COOKIE['secret'];

  $sql = "SELECT name, team_id, the_secret FROM teams WHERE team_id = $teamId AND the_secret = $secret";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $team = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($team) {
    $isloggedin = true;

    $teamName = $team["name"];
    $teamId = $team["team_id"];
    $secret = $team["the_secret"];
  } else {
    //delete cookie values
    // setcookie('team', '', time() - 3600);
    // setcookie('secret', '', time() - 3600);
    
    
    // toast message?
  }
  
}

?>
