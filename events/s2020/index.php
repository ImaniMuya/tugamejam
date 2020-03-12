<?php 
$db = 'sqlite:../../dbs/s2020.db';
$css = '../../index.css';
$nav = '../../nav.php';

$upload_dir = "./uploads/";

$conn = new PDO($db);
// include("../checklogin.php");

$sql = "SELECT team_id, name
        FROM teams";
$stmt = $conn->prepare($sql);
$stmt->execute();
$teams = $stmt->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_GROUP);

$sql = "SELECT team_id, answer, question_id, question, question_type
FROM subm_answers INNER JOIN subm_questions USING(question_id)
ORDER BY question_id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_GROUP);

$sql = "SELECT team_id, person_id, person_name
FROM people ORDER BY team_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$members = $stmt->fetchAll(PDO::FETCH_GROUP);

function getSubmissionCard($teamId, $teamQuestions) {
  global $teams, $members, $upload_dir;
  $output = "";
  $tname = $teams[$teamId][0];
  $imgsrc = "";
  foreach ($teamQuestions as $i => $question) { //for finding the first image
    $type = $question["question_type"];
    if ($type == "image") {
      $imgsrc = $upload_dir . $question["answer"];
      unset($teamQuestions[$i]);
      break;
    }
  }

  $output .= "<div class='teamcard flex_center'>";
  if ($imgsrc) $output.="<div><img src='$imgsrc' class='submimg'></div>";
  else $output.="<img src='tempsquare.jpg'>";
  $output .= "
      <div class='teaminfo'>
        <span class='title'>$tname</span>
        <table>
  ";
  
  foreach ($teamQuestions as $question) {
    $qname = $question["question"];
    $type = $question["question_type"];
    $id = $question["question_id"];
    $answer = $question["answer"];
    if ($answer) {
      if ($type == "file") {
        $answer = "<a href='$answer' download>Download me</a>";
      } else if ($type == "image") {
        // maybe put in carousel
        // $answer = "<img src='$answer' />";

        // put in link for now
        $imgsrc = $upload_dir . $answer;
        $answer = "<a href='$imgsrc' target='_blank'>link</a>";
      } 
      //otherwise "normal" text
      else if ($qname == "Game URL") {
          $answer = "<a href='$answer' target='_blank'>link</a>";
      } else {
        $answer = htmlspecialchars($answer);
      }
      
      $answer = str_replace("\n", "<br>", $answer);
      $output .= "
        <tr>
          <td valign='top'>$qname</td>
          <td class='wordwrap'>$answer</td>
        </tr>
      ";
    }
  }
  
  $output .= "<td>Members:</td>";
  $output .= "<td>";
  $teamMembers = $members[$teamId];
  $firstMember = true;
  foreach ($teamMembers as $teamMember) {
    $memberName = $teamMember["person_name"];
    if ($firstMember) {
      $output .= $memberName;
      $firstMember = false;
    } else {
      $output .= ", $memberName";
    }
  }
  $output .= "</td>";


  $output .= "
      </table>
    </div>
  </div>
  ";

  return $output;
}
?>

<html>
  <head>
    <title>Game Jam</title>
    <link rel = "stylesheet" type = "text/css" href = "../../index.css" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include($nav); ?>
    <div class="header flex_col">
      <span class="heading"><strong>GAME&nbsp;JAM: SPRING&nbsp;2020</strong></span>
      <span class="detailsheading">MAR 12 - 14</span>
    </div>
    <div class="section flex_col">
      <span class="title"><strong>Teams!</strong></span>
      <span class="fontsize20 ml">The list below shows each team along with its members and the name, summary, and a screenshot of their game.
      </span>
      <?php 
        foreach ($teams as $tid => $team) {
          $teamQuestions = $result[$tid];
          if ($teamQuestions) {
            print(getSubmissionCard($tid, $teamQuestions));
          }
        }
      ?>
    </div>
  </body>
</html>

<script>
 function togglenav() {                          
   document.getElementById('navcol').classList.toggle('tucked');
   document.getElementById('navicon').classList.toggle('tucked');                      
}

  function scaleWidth() {
    let cont = document.getElementsByClassName("section flex_col");

  }
</script>
