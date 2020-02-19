<link rel="stylesheet" type="text/css" href="/~gamejamdev/css/snackbar.css" />
<div id="snackbar">Default Snackbar Message!</div>
<script>
function showSnackbar(message) {
  var snackbar = document.getElementById("snackbar");
  snackbar.innerHTML = message;
  snackbar.classList.add("show");
  setTimeout(function(){ snackbar.classList.remove("show"); }, 3000);
}
</script>

<?php
if ($_SESSION["snackbar"]) {
    $snackmsg = $_SESSION["snackbar"];
    print "<script type='text/javascript'>showSnackbar(\"$snackmsg\")</script>";
    $_SESSION["snackbar"] = "";
}

?>

