<dialog id="showModal<?= $key; ?>">
    <div class="modal-header">
        <h3>Update: <?= $key; ?></h3>
    </div>

    <div class="modal-body">
        <div class="keys-container">
            <?php if (is_string($data)) : ?>
                <div><?= $key; ?></div>
                <div><?= $data; ?></div>
            <?php else : ?>
                <?php foreach ($data as $k => $v) : ?>
                    <div><?= $k; ?> </div>
                    <div><?= $v; ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="modal-buttons">
        <button value="cancel" class="closeModal">Cancel</button>
    </div>
</dialog>