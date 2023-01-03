<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?=$title?></title>
<link rel="stylesheet" href="/styles/styles.css">
</head>
<body>

<center>
<h1>SINGERS AND ALBUMS DATABASE</h1>

<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<div class="topnav" id="myTopnav">
  <a href="/" <?php if($currentPage == "index.php"){ echo 'id="active"';} ?>>HOME</a>
  <a href="/singer/list" <?php if($currentPage == "index.php?action=list"){ echo 'id="active"';} ?>>SINGERS</a>
  <a href="/singer/edit" <?php if($currentPage == "index.php?action=edit"){ echo 'id="active"';} ?>>ADD SINGER</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<main>
  <?=$output?>
</main>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>

<footer>
  &copy; JNRM 2022
</footer>
</center>

</body>
</html>