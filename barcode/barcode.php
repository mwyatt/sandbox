<html>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
    .sku-container {
        font-size: 16px;
        /*font-weight: bold;*/
        font-family: arial;
        text-align: center;
    }

    .barcode-container {
        text-align: center;
        margin-bottom: 1em;
    }
    </style>
</head>
<body>
    <div class="barcode-container">

        <?php echo $barcode ?>
        
    </div>
    <div class="sku-container"><?php echo $item['sku'] ?></div>
</body>
</html>
