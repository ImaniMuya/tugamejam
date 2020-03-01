<!-- Team Members -->
<?php $dbs = 'sqlite:../dbs/s2020.db'?>

<?php
$conn = new PDO($dbs);

include("../checklogin.php");

if ($_POST) {
  if ($_POST["memberId"]) { //update member
    $sql = $conn->prepare("REPLACE INTO people (person_id, person_name, email, team_id)
                           VALUES (:person_id, :person_name, :email, :team_id)");
    $sql->bindParam(':person_id', $_POST["memberId"]);
    $sql->bindParam(':person_name', $_POST["memberName"]);
    // 

    $sql->bindParam(':email', $_POST["memberEmail"]);
    $sql->bindParam(':team_id', $teamId);
    // $sql->execute();
    if ($sql->execute()) {
      $_SESSION["snackbar"] = "Member Updated";
    } 
  } else { //add new member
    $sql = $conn->prepare("INSERT INTO people (person_name, email, team_id)
    VALUES (:person_name, :email, :team_id)");
    $sql->bindParam(':person_name', $_POST["memberName"]);
    $sql->bindParam(':email', $_POST["memberEmail"]);
    $sql->bindParam(':team_id', $teamId);
    // $sql->execute();
    if ($sql->execute()) {
      $_SESSION["snackbar"] = "Member Added";
    } 
    
  } 
  if ($_POST["sendMail"]) {
    $msg = "You joined team".$teamName."! click this link! https://cse.taylor.edu/~gamejamdev/login.php?team=".$teamId."&secret=".$secret;
    $msg = wordwrap($msg,70);
    mail($_POST['memberEmail'],"GAME JAM",$msg);
  }
}

$sql = "SELECT *
        FROM people WHERE team_id = $teamId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$members = $stmt->fetchAll();
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
  <span class="heading"><strong>GAME JAM: Fall 2019</strong></span>
  <span class="detailsheading">Welcome Team <?php print $teamName?></span>
</div>

<!-- <div class="right-align"><a href="/~gamejamdev/vote" class="blue">Vote</a></div> -->
<div class="right-align"><a href="/~gamejamdev/submission" class="blue">Submission</a></div>
<div class="flex_col">
  <form method="POST" id="memberForm" class="teamregistration flex_col">
    <div class="formheader flex_col">Team Members</div>
    <table class="submform">
      <?php
          foreach ($members as $member) {
            $m_name = $member["person_name"];
            $m_id = $member["person_id"];
            $email = $member["email"];
            print "<tr>";
            print "<td>$m_name</td>";
            print "<td>$email</td>";
            print "<td><span class='editbtn' onclick='editMember($m_id,\"$m_name\",\"$email\")'>Edit</span></td>";
            // print "<td><input value=\"$m_name\" name=\"$m_id-name\"/></td>";
            // print "<td><input type=\"text\" value=\"$email\" name=\"$m_id-email\"></td>";
            print "</tr>";
          }
      ?>
      <tr>
        <td><input type="text" id="memberName" name="memberName" placeholder="New Name" maxlength="100"></td>
        <td><input type="text" id="memberEmail" name="memberEmail" placeholder="New Email" maxlength="100"></td>
        <td><span class='editbtn' onclick="addMember()">Add</span></td>
      </tr>
    </table>
    <input type="text" id="memberId" name="memberId" hidden maxlength="100">
    <input type="checkbox" id="sendMail" name="sendMail" hidden maxlength="100">
  </form>
  
</div>
<div class="flex_col">
</div>
</body>
<script>
var memberName = document.getElementById("memberName");
var memberEmail = document.getElementById("memberEmail");
var memberId = document.getElementById("memberId");
var sendMail = document.getElementById("sendMail");
var memberForm = document.getElementById("memberForm");
// var emailRE = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var emailRE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function editMember(id, name, email) {
  let newName = window.prompt("Member Name", name);
  if (newName == "" || newName == null) return;
  let newEmail = window.prompt("Member Email", email);
  if (newEmail == "" || newName == null) return;
  if (!emailRE.test(newEmail.toLowerCase())) {
    alert("Email is invalid.");
    return;
  }
  if (name == newName && email == newEmail) {
    alert("No changes made.");
    return;
  }
  sendMail.checked = email != newEmail;
  memberName.value = newName;
  memberEmail.value = newEmail;
  memberName.hidden = true;
  memberEmail.hidden = true;
  memberId.value = id;
  memberForm.submit();
}

function addMember() {
  let newName = memberName.value;
  if (newName == "" || newName == null) {
    alert("Name cannot be empty.");
    return;
  }
  let newEmail = memberEmail.value;
  if (newEmail == "" || newName == null) {
    alert("Email cannot be empty.");
    return;
  }
  if (!emailRE.test(newEmail.toLowerCase())) {
    alert("Email is invalid.");
    return;
  }
  sendMail.checked = true;
  memberForm.submit();
}
</script>
</html>
