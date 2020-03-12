<?php 
$_SESSION["qwerty"] = "Testtttaasdf.";
var_dump($_SERVER["DOCUMENT_ROOT"]);
print("<br>");
var_dump($_SESSION["snackbar"]);

$conn = new PDO("sqlite:./dbs/s2020.db");
$sql = "SELECT team_id, answer, question_id, question, question_type
FROM subm_answers INNER JOIN subm_questions USING(question_id)
ORDER BY question_id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_GROUP);

print("<br>");
var_dump($result);
//phpinfo();

// $conn = new PDO('sqlite:../test.db');

// $sql = "SELECT team_id, answer, question_id, question, question_type
// FROM subm_answers INNER JOIN subm_questions USING(question_id)
// ORDER BY question_id";
// $stmt = $conn->prepare($sql);
// $stmt->execute();
// $result = $stmt->fetchAll(PDO::FETCH_GROUP);

// var_dump($result);

?>

