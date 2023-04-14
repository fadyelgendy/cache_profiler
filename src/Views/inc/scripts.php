<script>
    // Alerts
    var alerts = document.querySelectorAll('.alert');

    [...alerts].forEach((item) => {
        console.log(item);
        setTimeout(function() {
            item.classList.add('hidden');
        }, 3000);
    });

    // Setup
    var hasAuth = document.getElementById('has_auth');
    var authContainer = document.getElementById('auth');

    if (hasAuth) {
        hasAuth.addEventListener('change', function(event) {
            var checked = this.checked;

            if (checked === true) {
                authContainer.style.display = 'block';
            } else {
                authContainer.style.display = 'none';
            }
        });
    }

    // Add
    const _STRING = 'string';
    const _HASH = 'hash';

    var val = document.getElementById('value');
    var dataTypeSelector = document.getElementById('data_type');

    if (dataTypeSelector) {
        dataTypeSelector.addEventListener('change', function() {
            var selected = this.options[this.selectedIndex].value;

            console.log(selected);

            if (selected.length > 0 && selected !== '') {
                val.classList.remove('hidden');
            } else {
                val.classList.add('hidden');
            }

            if (selected === _STRING) {
                handleElements(selected, document.getElementById(selected), _STRING);
            }

            if (selected === _HASH) {
                handleElements(selected, document.getElementById(selected), _HASH);
            }
        });

        function handleElements(selected, elem, rule) {
            if (selected === rule) {
                elem.classList.remove('hidden');
            } else {
                elem.classList.add('hidden');
            }
        }
    }

    // Modal
    const modalButtons = document.querySelectorAll('.modal');

    [...modalButtons].forEach((btn) => {
        var targetModal = btn.getAttribute('data-target');

        var favDialog = document.getElementById(targetModal);
        var confirmBtn = favDialog.querySelector('.confirmBtn');
        var closeModal = favDialog.querySelector('.closeModal');
        var form = favDialog.querySelector('form');

        // "Show the dialog" button opens the <dialog> modally
        btn.addEventListener('click', () => {
            favDialog.showModal();
        });

        closeModal.addEventListener('click', () => {
            favDialog.close();
        });

        if (confirmBtn && form) {
            confirmBtn.addEventListener('click', () => {
                form.submit();
            });
        }
    });
</script>