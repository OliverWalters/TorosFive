document.addEventListener('DOMContentLoaded', function() {
    const checkbox = document.getElementById('imgChange');
    const input = document.getElementById('img');
    checkbox.addEventListener('change', function() {
        input.disabled = !this.checked;
    });
    input.disabled = !checkbox.checked;
});


