<html>
    <head></head>
    <body>
        <?php
        if(isset($_COOKIE['count']))
            {
                echo "You have visited ".$_COOKIE['count']. " times.";
            }
        ?>
    </body>
</html>