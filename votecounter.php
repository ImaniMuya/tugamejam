<html>

<?php
$conn = new PDO('sqlite:./dbs/s2020.db');
$stmt = $conn->prepare("SELECT * FROM votes");
$stmt->execute();
$voteresults = $stmt->fetchAll();
// TODO: print out theme names not ids
$stmt = $conn->prepare("SELECT * FROM themes");
$stmt->execute();
$themeresults = $stmt->fetchAll();

$voteBuckets = array();
$votesToWin = count($voteresults) * 0.6;

//print theme dictionary
$themedict = array(); //currently unused
foreach ($themeresults as $themeresult) {
  $name = $themeresult["theme"];
  $theme_id = $themeresult["theme_id"];
  $themedict[$theme_id] = $name;
  print("<div>");
  print("$theme_id: $name");
  print("</div>");
}
print ("<br>");

printVoteTable($voteresults);

function printVoteTable($voteresults) {
  print "<table>";
  print "<tr>";
  print "<th>id</th>";
  print "<th>t1</th>";
  print "<th>t2</th>";
  print "<th>t3</th>";
  print "<th>t4</th>";
  print "<th>t5</th>";
  print "</tr>";
  foreach($voteresults as $vote) {
    $id = $vote['team_id'];
    $t1 = $vote['theme1_id'];
    $t2 = $vote['theme2_id'];
    $t3 = $vote['theme3_id'];
    $t4 = $vote['theme4_id'];
    $t5 = $vote['theme5_id'];
    print "<tr>";
    print "<td>$id</td>";
    print "<td>$t1</td>";
    print "<td>$t2</td>";
    print "<td>$t3</td>";
    print "<td>$t4</td>";
    print "<td>$t5</td>";
    print "</tr>";
  }
  print "</table>";
}

foreach($voteresults as $vote) {
  $voteBuckets[$vote['theme1_id']]++;
  arsort($voteBuckets);
  $leadingThemeId = current(array_keys($voteBuckets));
  $losingThemeId = end(array_keys($voteBuckets));
}
var_dump($voteBuckets);
print("<br><br>");

do {
  if ($leadingThemeId == $losingThemeId) {
    print("It's a draw!");
    break;
  }
  $voteBuckets = array();
  foreach($voteresults as $i => $vote) {
    if ($voteresults[$i]['theme1_id'] == $losingThemeId) {
      $voteresults[$i]['theme1_id'] = $voteresults[$i]['theme2_id'];
      $voteresults[$i]['theme2_id'] = $voteresults[$i]['theme3_id'];
      $voteresults[$i]['theme3_id'] = $voteresults[$i]['theme4_id'];
      $voteresults[$i]['theme4_id'] = $voteresults[$i]['theme5_id'];
      $voteresults[$i]['theme5_id'] = "";
    }
    $voteBuckets[$voteresults[$i]['theme1_id']]++;
  }
  arsort($voteBuckets);
  $leadingThemeId = current(array_keys($voteBuckets));
  $losingThemeId = end(array_keys($voteBuckets));

  printVoteTable($voteresults);
  var_dump($voteBuckets);
  print("<br><br>");
} while ($voteBuckets[$leadingThemeId] <= $votesToWin);

$stmt = $conn->prepare("SELECT theme_id, theme FROM themes WHERE theme_id=$leadingThemeId");
$stmt->execute();
$theme = $stmt->fetch();
print("<h1> $leadingThemeId -- ". $theme['theme'] ."</h1>");
?>