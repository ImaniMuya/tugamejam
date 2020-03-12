<?php
session_start();
include("../include.php");
// $conn = new PDO($dbs);
include("../checklogin.php");

if ($_POST) {
  foreach($_POST as $qid => $ans) {
    // haven't tested
    $ans = filter_input(INPUT_POST, $ans, FILTER_SANITIZE_STRING);
    $sql = $conn->prepare("INSERT OR REPLACE INTO 
                           subm_answers(answer, question_id, team_id)
                           VALUES(:answer, :question_id, :team_id)");
    $sql->bindParam(':question_id', $qid);
    $sql->bindParam(':answer', $ans);
    $sql->bindParam(':team_id', $teamId);
    if ($sql->execute()) {
      $_SESSION["snackbar"] = "Submission updated.";
    }
  }

  foreach($_FILES as $qid => $file) {
    if (!$file["name"]) continue;
    if ($file["size"] > 52428800) { //50MB
      $_SESSION["snackbar"] = "Submission file is too big.";
      break;
    }
    //add file
    $fileExt = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    $allowedExtensions = array("zip","png","jpg","gif");
    if (!in_array($fileExt, $allowedExtensions)) {
      die("unsupported file extension: " . $fileExt . " file: " . $file["name"]); // TODO: replace with toast
      break;
    }

// TODO: change to local uploads folder
    $target_dir = "../uploads/";
    $target_file = $target_dir .$teamId."-".basename($file["name"]);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
      // file uploaded successfully
    } else {
      // error uploading file
      $_SESSION["snackbar"] = "Problem uploading files. Try again later.";
    }
    
    //delete old file
    $sql = $conn->prepare("SELECT answer FROM subm_answers 
                           WHERE question_id=$qid AND team_id=$teamId");
    $sql->execute();
    $oldFile = $sql->fetch(PDO::FETCH_ASSOC);
    if ($oldFile && $oldFile["answer"] != $target_file) {
      unlink($oldFile["answer"]);
    }

    //update database
    $sql = $conn->prepare("INSERT OR REPLACE INTO 
                           subm_answers(answer, question_id, team_id)
                           VALUES(:answer, :question_id, :team_id)");
    $sql->bindParam(':question_id', $qid);
    $sql->bindParam(':answer', $target_file); //TODO: maybe don't store with target_dir
    $sql->bindParam(':team_id', $teamId);
    if ($sql->execute()) {
      //files uploaded
    } else {
      $_SESSION["snackbar"] = "Problem saving files. Try again later.";
    }
  }
}

$sql = $conn->prepare("SELECT q.question_id, q.question, q.question_type, a.answer
                       FROM subm_questions q
                       LEFT JOIN (SELECT answer, question_id FROM subm_answers WHERE team_id = $teamId) a
                       USING(question_id)");
$sql->execute();
$submQuestions = $sql->fetchAll();

$sql = "SELECT *
        FROM people WHERE team_id = $teamId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$members = $stmt->fetchAll();
?>

<html>
<head>
<title>Game Jam</title>
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../index.css" />
</head>
<body>

<?php 
include("../snackbar.php");
include("../nav.php");
?>
<div class="header flex_col">
  <span class="heading"><strong>TEAM SUBMISSION</strong></span>
</div>
<div class="flex_col">
  <div class="title flex_col pt50">
    Submission for <?php print $teamName; ?>
  </div>
  <form method="POST" id="submForm" class="flex_col" enctype="multipart/form-data">
    <table>
      <?php
        foreach ($submQuestions as $question) {
          $name = $question["question"];
          $type = $question["question_type"];
          $id = $question["question_id"];
          $answer = $question["answer"];
          print "<tr>";
          print "<td>$name</td>";
          print "<td>";
          switch ($type) {
            case "text":
              print "<input type='text' name='$id' value='$answer' maxlength='500'>";
              break;
            case "file":
              $filebn = pathinfo($answer, PATHINFO_BASENAME);
              if ($filebn) {
                print "<label for='file-$id' id='file-$id-label' class='filechooser'>$filebn</label>";
                print "<input type='file' name='$id' id='file-$id' hidden onchange='updateLabel(\"file-$id-label\", this)' maxlength='500'>";
              } else {
                print "<input type='file' name='$id' id='file-$id' maxlength='500'>";
              }
              break;
            case "image":
              $filebn = pathinfo($answer, PATHINFO_BASENAME);
              if ($filebn) {
                print "<label for='file-$id' id='file-$id-label' class='filechooser'><img class='submimg' src='$answer'></img></label>";
                print "<input type='file' name='$id' id='file-$id' hidden onchange='updateLabel(\"file-$id-label\", this)' maxlength='500'>";
              } else {
                print "<input type='file' name='$id' id='file-$id' maxlength='500'>";
              }
              break;
            case "textarea":
              print "<textarea rows='4' cols='50' wrap='soft' maxlength='2000' name='$id' form='submForm' maxlength='500'>$answer</textarea>";
              break;
          }
          print "</td>";
          print "</tr>";
        }
      ?>  
    </table>
    <input type="submit">
  </form>
</div>
</body>
<script>
function updateLabel(labelId, input) {
  document.getElementById(labelId).innerHTML = "";
  input.hidden = false;
}
</script>
</html>
