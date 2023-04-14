<dialog id="updateModal<?= $key; ?>">
    <form method="dialog">
        <div class="modal-header">
            <h3>Update: <?= $key; ?></h3>
        </div>

        <div class="modal-body">
            <div class="keys-container">
                <?php if (is_string($data)) : ?>
                    <div>
                        <input type="text" name="string_key" disabled value="<?= $key; ?>">
                    </div>
                    <div>
                        <input type="text" name="string_value" value="<?= $data; ?>">
                    </div>
                <?php else : ?>
                    <?php foreach ($data as $k => $v) : ?>
                        <div>
                            <input type="text" name="hash_keys[]" disabled value="<?= $k; ?>">
                        </div>
                        <div>
                            <input type="text" name="string_values[]" value="<?= $v; ?>">
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="modal-buttons">
            <button value="cancel" class="closeModal">Cancel</button>
            <button class="confirmBtn" value="default">Confirm</button>
        </div>
    </form>
</dialog>