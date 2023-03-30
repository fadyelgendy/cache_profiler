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
        <div class="section_heading">
            <h2><?= $title; ?> Server info:</h2>
            <a href="/">Home</a>
        </div>

        <div class="info_container">
            <?php foreach ($data as $key => $value) : ?>
                <div class="info_item">
                    <h4><?= $key; ?></h4>

                    <div class="table_responsive">
                        <table>
                            <tbody>
                                <thead>
                                    <?php foreach ($value as $k => $v) : ?>
                                        <th><?= $k; ?></th>
                                    <?php endforeach; ?>
                                </thead>

                                <tr>
                                    <?php foreach ($value as $k => $v) : ?>
                                        <td><?= $v; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>