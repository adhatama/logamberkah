<?php
    $path = __DIR__ . '/../db.txt';
    $db = unserialize(file_get_contents($path));
    // var_dump($db['HARGA_BELI'], $db['HARGA_JUAL']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/tailwind.css">
</head>
<body>
    <div class="container mx-auto">
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold leading-tight">
            Clear headline that explains your products main benefit
        </h1>
    </div>
</body>
</html>