<?php
$themecount = 5;

$conn = new PDO('sqlite:./dbs/s2020.db');

if ($_POST) {
  for ($i = 1; $i <= $themecount; $i++) {
    $themeKey = 'theme' . (string)$i;
    $themeName = filter_input(INPUT_POST, $themeKey, FILTER_SANITIZE_STRING);
    if ($themeName) {
      $sql = $conn->prepare("REPLACE INTO themes(theme_id, theme) VALUES(:theme_id, :theme)");
      $sql->bindParam(':theme_id',$i);
      $sql->bindParam(':theme',$themeName);
      $sql->execute();
    }
  }
}
?>

<html>
<head>
<title>Game Jam</title>
      <link rel="stylesheet" type="text/css" href="index.css" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
<body>
<div class="flex_col">
<form method="post" class="teamregistration flex_col">
<div class="formheader flex_col">insert themes</div>

<table class="regform" class="flex_col">
<?php 
$themeresult = $conn->query("SELECT * FROM themes");
$empty = true;
$count = 1;
foreach($themeresult as $row) {
  $empty = false;
  $id = $row['theme_id'];
  $themeName = $row['theme'];
  print "<tr>";
  print "<td><strong>Theme:</strong></td>";
  print "<td><input type='text' name='theme$id' value=\"$themeName\"></td>";
  print "</tr>";
  $count++;
}
if ($empty) {
  // print "No themes Yet!";
}
?>
</table>

  <td class="teamsubmitbtn"><input type="submit" class="submitbtn"></td>
<!-- </table> -->
</form>
</div>
<div class="flex_col">
</div>
</body>
</html>