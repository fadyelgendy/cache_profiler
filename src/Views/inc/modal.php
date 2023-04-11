<!-- A modal dialog containing a form -->
<dialog id="favDialog">
    <form method="dialog">
        <p>
            <label>Favorite animal:
                <select>
                    <option value="default">Choose…</option>
                    <option>Brine shrimp</option>
                    <option>Red panda</option>
                    <option>Spider monkey</option>
                </select>
            </label>
        </p>
        <div>
            <button value="cancel">Cancel</button>
            <button id="confirmBtn" value="default">Confirm</button>
        </div>
    </form>
</dialog>
<p>
    <button id="showDialog">Show the dialog</button>
</p>
<output></output>

<script>
    const showButton = document.getElementById('showDialog');
    const favDialog = document.getElementById('favDialog');
    const outputBox = document.querySelector('output');
    const selectEl = favDialog.querySelector('select');
    const confirmBtn = favDialog.querySelector('#confirmBtn');

    // "Show the dialog" button opens the <dialog> modally
    showButton.addEventListener('click', () => {
        favDialog.showModal();
    });
    // "Favorite animal" input sets the value of the submit button
    selectEl.addEventListener('change', (e) => {
        confirmBtn.value = selectEl.value;
    });
    // "Confirm" button of form triggers "close" on dialog because of [method="dialog"]
    favDialog.addEventListener('close', () => {
        outputBox.value = `ReturnValue: ${favDialog.returnValue}.`;
    });
</script>