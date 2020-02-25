<!-- Register -->
<?php
$conn = new PDO('sqlite:../dbs/f2019.db');

include('../timecodes.php');
if (getGameState()== 0) {
  header("Location: https://gamejam.cse.taylor.edu");
}

if ($_POST) {
  // $_SESSION["snackbar"] = "We're not taking teams at this point, check back next semester!";

  if ($_POST["regCode"] == "nerds4christ") {
    $teamName = $_POST['tname'];
    $teamName = filter_input(INPUT_POST, 'tname', FILTER_SANITIZE_STRING);
    $leaderName = $_POST['lname'];
    $leaderName = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    if ($teamName && $leaderName && $_POST['email']) {
      $secret = mt_rand();
      $sql = $conn->prepare("INSERT INTO teams (name, the_secret) VALUES (:name, :the_secret)");
      $sql->bindParam(':name', $teamName);
      $sql->bindParam(':the_secret', $secret);
      $sql->execute();
      $team_id = $conn->lastInsertId();

      // $smtp = Mail::factory('smtp', array(
      //   'host' => 'tls://smtp.taylor.edu',
      //   'port' => '587',
      //   'auth' => true,
      //   'username' => 'johndoe@gmail.com',
      //   'password' => getPassword()
      // ));

      $sql = $conn->prepare("INSERT INTO people (person_name, email, team_id) VALUES (:person_name, :email, :team_id)");
      $sql->bindParam(':person_name', $leaderName);
      $sql->bindParam(':email', $_POST['email']);
      
      $msg = "You just joined team: ".$teamName."! click this link! https://cse.taylor.edu/~gamejamdev/login.php?team=".$team_id."&secret=".$secret;
      $msg = wordwrap($msg,70);
      mail($_POST['email'],"GAME JAM",$msg);
      
      $sql->bindParam(':team_id', $team_id);
      // $sql->execute();
      if ($sql->execute()) {
        $_SESSION["snackbar"] = "Team Registered! Check your email for login link";
      } 

      //success toast please
    } else {
      // print "<script>alert('Missing Required Information.');</script>";
      $_SESSION["snackbar"] = "Missing Required Information";

    }
    // print "<script>alert('team registered. Check your email!');document.location='/~gamejamdev'</script>";
  } else {
    // print "<script>alert('Registration Code is incorrect!');</script>";
    $_SESSION["snackbar"] = "Registration Code is incorrect!";

  }
}

?>

<html>
<head>
<title>Game Jam</title>
      <link rel="stylesheet" type="text/css" href="../index.css" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
<body>
<?php 
  include("../nav.php");
  include("../snackbar.php");
?>
<div class="header flex_col">
  <div class="heading"><strong>REGISTER TEAM</strong></div>
</div>
<div class="flex_col">
<form method="post" id="teamForm" class="teamregistration flex_col">
<div class="formheader flex_col">Create a team</div>
<table class="regform rightalign">
  <tr>
    <td><label for="regCode">Code:</label></td>
    <td><input type="password" id="regCode" name="regCode" oninput="handleInput()"></td>
  </tr>
  <tr>
    <td><label for="tname">Team Name:</label></td>
    <td><input type="text" id="tname" name="tname" oninput="handleInput()" maxlength="100">
    </td>
  </tr>
  <tr>
    <td><label for="lname">Leader Name:</label></td>
    <td><input type="text" id="lname" name="lname" oninput="handleInput()" maxlength="100"></td>
  </tr>
  <tr>
    <td><label for="email">Leader Taylor Email:</label></td>
    <td><input type="text" id="email" name="email" oninput="timeoutHandle()" maxlength="100"></td>
  </tr>
</table>
<div id="formMsg"></div>
<div><input type="submit" id="submitBtn" class="submitbtn" disabled="true" maxlength="100"></div>
</form>
</div>

<script>
  var teamForm = document.getElementById("teamForm");
  var regCode = document.getElementById("regCode");
  var tname = document.getElementById("tname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var submitBtn = document.getElementById("submitBtn");
  var formMsg = document.getElementById("formMsg");
  // var emailRE = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  var emailRE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var checkTimeout;

  function timeoutHandle() {
    clearTimeout(checkTimeout);
    checkTimeout = setTimeout(handleInput, 500);
  }

  function handleInput() {
    if (checkForm()) {
      submitBtn.disabled = false;
    } else {
      submitBtn.disabled = true;
    }
  }

  function checkForm() {
    if (!regCode.value) return false;
    if (!tname.value) return false;
    if (!lname.value) return false;
    if (!email.value) return false;
    if (!emailRE.test(email.value.toLowerCase())) {
      formMsg.innerHTML = "Email is Invalid!";
      return false;
    }
    formMsg.innerHTML = "";
    return true;
  }
</script>
</body>
</html>
