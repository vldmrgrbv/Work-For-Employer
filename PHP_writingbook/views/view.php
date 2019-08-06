<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VIEW</title>
</head>
<body>
    <?php
        // require_once 'model.php';
        require_once '../controller.php';
        use CONTROLLER\Autoriz_Types;

        session_start();

        $a = new Autoriz_Types();
        $a->processing();
    ?>    
</body>
</html>
