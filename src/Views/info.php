<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?> cach</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>

<body>
    <div class="content">
        <h1><?= $title; ?> Server info:</h1>

        <table>
            <thead>
                <th>KEY</th>
                <th>VALUE</th>
            </thead>
            <tbody>
                <?php foreach ($info as $key => $value) : ?>
                    <tr>
                        <td><?= $key; ?></td>
                        <td><?= $value; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>