<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    @import url('../styles/layoutt.css');
    </style>
    <title>Document</title>
</head>
<body>
    <center>
    <form action="" method="post">
    <input type="hidden" name="singer[idsingers]" value="<?=$singer['idsingers'] ?? ''?>">
    <label for="singer_name"><h3>Type your singer name:</h3></label>
    <input type="text" id="singer_name" name="singer[singer_name]" value="<?=$singer['singer_name'] ?? ''?>">
    <label for="singer_date"><h3>Type your singer's born date:</h3></label>
    <input type="text" id="singer_date" name="singer[singer_date]" value="<?=$singer['singer_date'] ?? ''?>">
    <input type="submit" name="submit" value="Add">
</form>
    </center>

</body>
</html>