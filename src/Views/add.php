<form action="handler.php?driver=<?= $title; ?>" method="POST">
    <input type="hidden" name="form_type" value="store">

    <div class="form-group">
        <label for="data_type">Data Type</label>
        <select name="data_type" id="data_type">
            <option value="">Select Datatype</option>
            <?php foreach (\Fadyandrawes\CacheProfiler\Enums\DatatypeEnum::cases() as $datatype) : ?>
                <option value="<?= $datatype->value; ?>"><?= $datatype->value; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div id="string" class="hidden">
        <div class="form-group">
            <label for="string_key">key</label>
            <div>
                <input type="text" name="string_key" id="string_key" placeholder="key">
            </div>
        </div>
    </div>

    <div id="hash" class="hidden">
        <div class="form-group">
            <label for="hash">Hash</label>
            <div>
                <input type="text" name="hash" id="hash" placeholder="hash">
            </div>
        </div>

        <div class="form-group">
            <label for="hash_key">key</label>
            <div>
                <input type="text" name="hash_key" id="hash_key" placeholder="key">
            </div>
        </div>
    </div>

    <div id="value" class="hidden">
        <div class="form-group">
            <label for="value">value</label>
            <div>
                <input type="text" name="value" id="value" placeholder="value">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="expiration">Expiration</label>
        <div>
            <input type="number" name="expiration" id="expiration" value="3600" min="0">
            <small>in seconds default 1 hour</small>
        </div>
    </div>

    <div class="form-group form-footer">
        <div></div>
        <button type="submit" class="<?= $title; ?>">Save</button>
    </div>
</form>