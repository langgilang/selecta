<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    require 'assets/vendor/autoload.php';

    for ($i = 0; $i < $row->ticket_total; $i++) {
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        echo '<hr>';
        echo '<img style="width: 50%;" src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->order_key, $generator::TYPE_CODE_128)) . '"><br>';
        echo $row->order_key . ' - ' . strtoupper($row->paket_name) . ' - ' . date('d F Y', strtotime($row->reservationdate));
    }

    ?>
</body>

</html>