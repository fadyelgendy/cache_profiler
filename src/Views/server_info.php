<?php foreach ($data as $key => $value) : ?>
    <h4><?= $key; ?></h4>
    <div class="info_item">
        <?php foreach ($value as $k => $v) : ?>
            <div class="item">
                <h5><?= formatKeys($k); ?></h5>
                <p><?= $v; ?></p>
            </div>
        <?php endforeach; ?>

    </div>
<?php endforeach; ?>