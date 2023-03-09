<?php
include "../vendor/autoload.php";
$obj = new \Trensy\KendoUI\Boostrap();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test</title>
    <?php
        echo implode("\r\n", $obj->getScript());
    ?>
</head>
<body>
    <?php
    $datepicker = new \Kendo\UI\DatePicker('datepicker');
    // Configure the datepicker using the fluent API
    $datepicker->start('year')
        ->format('MMMM yyyy');
    // Output the datepicker HTML and JavaScript by echo-ing the result of the render method
    echo $datepicker->render();
    ?>
</body>
</html>