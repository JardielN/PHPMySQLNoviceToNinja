<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/styles/singes.css">
    <title>List of Singers</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p>
            <?php echo $error; ?>
        </p>
        <?php else: ?>
            <p><?=$totalSingers?> Singers have been submitted to the Singers & Almbums Database.</p>
        <?php foreach($singers as $singer): ?>
            <blockquote>
                <p>
                <?=htmlspecialchars($singer['singer_name'], ENT_QUOTES, 'UTF-8') ?>
                (by <a href="mailto:<?php echo htmlspecialchars($singer['email_author'], ENT_QUOTES, 'UTF-8');?>"> <?php
                echo htmlspecialchars($singer['name_author'], ENT_QUOTES, 'UTF-8');?></a> on <?php
                $date = new DateTime($singer['date_added']);
                echo $date->format('jS F Y');
                ?>)
                <a href="/singer/edit?idsingers=<?=$singer['idsingers'];?>">Edit</a>
                <form action="/singer/delete" method="post">
                    <input type="hidden" name="idsingers"
                    value="<?=$singer['idsingers']?>">
                    <input type="submit" value="X">
                </form>
                </p>
            </blockquote>
            <?php endforeach;?>
            <?php endif;?>
</body>
</html>