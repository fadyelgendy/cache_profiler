<?php require __DIR__ . "/inc/header.php"; ?>

<div class="info_container">
    <div class="col-8">
        <h1>settings</h1>
        
    </div>

    <div class="col-4">
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

<?php require __DIR__ . "/inc/footer.php"; ?>