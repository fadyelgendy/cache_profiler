<div class="actions">
    <form action="handler.php?driver=<?= $title; ?>" method="POST" class="inline-form">
        <input type="hidden" name="form_type" value="flush_current">
        <button type="submit" class="warning">Flush Current</button>
    </form>

    <form action="handler.php?driver=<?= $title; ?>" method="POST" class="inline-form">
        <input type="hidden" name="form_type" value="flush_all">
        <button type="submit" class="danger">Flush All</button>
    </form>

    <form action="handler.php?driver=<?= $title; ?>" method="POST" class="inline-form">
        <input type="hidden" name="form_type" value="close_connection">
        <button type="submit" class="primary">close Connection</button>
    </form>

    <button onclick="window.location.reload()" class="success">Reload</button>
</div>