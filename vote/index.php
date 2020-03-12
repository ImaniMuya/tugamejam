<!-- Vote -->
<?php 
// $conn = new PDO('sqlite:../../test.db');
include("../include.php");
include("../checklogin.php");

include('../timecodes.php');
session_start();
if (getGameState()!= 2) {
  $_SESSION["snackbar"] = "Theme voting has not begun. Voting starts at $tsVote.";
  header("Location: /~gamejamdev/wip");
}

if ($_POST) {
  $sql = $conn->prepare("INSERT OR REPLACE INTO 
    votes(team_id, theme1_id, theme2_id, theme3_id, theme4_id, theme5_id)
    VALUES(:team_id, :theme1_id, :theme2_id, :theme3_id, :theme4_id, :theme5_id)");
  $sql->bindParam(':team_id', $teamId);
  $sql->bindParam(':theme1_id',$_POST['theme1']);
  $sql->bindParam(':theme2_id',$_POST['theme2']);
  $sql->bindParam(':theme3_id',$_POST['theme3']);
  $sql->bindParam(':theme4_id',$_POST['theme4']);
  $sql->bindParam(':theme5_id',$_POST['theme5']);
  if ($sql->execute()) {
    // $_SESSION["snackbar"] = "Vote Cast";
    print "<script>alert('Vote cast.');</script>";
  }
}

$sql = "SELECT team_id, theme1_id, theme2_id, theme3_id, theme4_id, theme5_id
        FROM votes WHERE team_id = $teamId";
$stmt = $conn->prepare($sql);
$stmt->execute();
$myVote = $stmt->fetch(PDO::FETCH_ASSOC);

$sql = "SELECT theme, theme_id FROM themes";
$stmt = $conn->prepare($sql);
$stmt->execute();
$themeResults = $stmt->fetchAll();
$themes = array();
foreach ($themeResults as $temp) {
  $themes[$temp['theme_id']] = $temp['theme'];
}


?>

<html>
<head>
<title>Game Jam</title>
  <link rel="stylesheet" type="text/css" href="../index.css" />
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
</head>
<body>
<?php include("../nav.php"); ?>
<div class="header">
  <span class="heading"><strong>CAST YOUR VOTES!</strong></span>
</div>
<div class="flex_col">
<p class="title">Welcome <?php print($teamName) ?> </p>

<ul id="choices">
  <?php 
    // $conn = new PDO('sqlite:../test.db');
    if ($myVote) {
      $t1 = $myVote["theme1_id"];
      $t2 = $myVote["theme2_id"];
      $t3 = $myVote["theme3_id"];
      $t4 = $myVote["theme4_id"];
      $t5 = $myVote["theme5_id"];
      foreach(array($t1,$t2,$t3,$t4,$t5) as $id) {
        $name = $themes[$id];
        print "<li class='choice draggable'><input type='hidden' value='$id'>"; 
        print $name;
        print "</li>";
      }
    } else {
      foreach($themeResults as $themeResult) {
        $name = $themeResult['theme'];
        $id = $themeResult['theme_id'];
        print "<li class='choice draggable'><input type='hidden' value='$id'>"; 
        print $name;
        print "</li>";
      }
    }
  ?>

  <li id="dummyChoice"></li>
</ul>

<span class="submitbtn center" onclick="castVote()">Cast my Vote!</span>
<form id="voteForm" method="post">
  <input type="text" name="theme1">
  <input type="text" name="theme2">
  <input type="text" name="theme3">
  <input type="text" name="theme4">
  <input type="text" name="theme5">
</form>
</div>
</body>
</html>

<script>
function castVote() {
  let choices = document.getElementById("choices");
  let voteForm = document.getElementById("voteForm");
  for (let i=0; i<voteForm.children.length; i++) {
    let choice = choices.children[i];
    let hiddenInput = choice.children[0];
    let formInput = voteForm.children[i];
    formInput.value = hiddenInput.value;
  }
  // console.log(voteForm);
  voteForm.submit();
}

//adapted from https://codepen.io/retrofuturistic/pen/tlbHE
var dragSrcEl = null;

function handleDragStart(e) {
  // Target (this) element is the source node.
  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.outerHTML);

  this.classList.add('ghost');
}
function handleDragOver(e) {
  if (e.preventDefault) {
    e.preventDefault(); // Necessary. Allows us to drop.
  }
  this.classList.add('over');

  e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

  return false;
}

function handleDragLeave(e) {
  this.classList.remove('over');
}

function handleDrop(e) {
  // this/e.target is current target element.

  if (e.stopPropagation) {
    e.stopPropagation(); // Stops some browsers from redirecting.
  }

  // Don't do anything if dropping the same choice we're dragging.
  if (dragSrcEl != this) {
    // Set the source choice's HTML to the HTML of the choice we dropped on.
    this.parentNode.removeChild(dragSrcEl);
    var dropHTML = e.dataTransfer.getData('text/html');
    this.insertAdjacentHTML('beforebegin', dropHTML);
    var dropElem = this.previousSibling;
    addDnDHandlers(dropElem);
    
  }
  this.classList.remove('over');
  return false;
}

function handleDragEnd(e) {
  this.classList.remove('ghost');  
}

function addDnDHandlers(elem) {
  elem.addEventListener('dragstart', handleDragStart, false);
  elem.addEventListener('dragover', handleDragOver, false);
  elem.addEventListener('dragleave', handleDragLeave, false);
  elem.addEventListener('drop', handleDrop, false);
  elem.addEventListener('dragend', handleDragEnd, false);
}

var cols = document.querySelectorAll('#choices .choice');
cols.forEach(c => addDnDHandlers(c));

var dummyChoice = document.getElementById("dummyChoice");
dummyChoice.addEventListener('dragover', handleDragOver, false);
dummyChoice.addEventListener('dragleave', handleDragLeave, false);
dummyChoice.addEventListener('drop', handleDrop, false);
dummyChoice.addEventListener('dragend', handleDragEnd, false);

</script>