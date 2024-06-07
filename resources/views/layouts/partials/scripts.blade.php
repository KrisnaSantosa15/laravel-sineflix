<script async defer src="https://buttons.github.io/buttons.js"></script>
{{-- <script src="{{ .Site.BaseURL }}/app.bundle.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
<script>
    setTimeout(function() {
        document.getElementById('toast-success')?.remove();
    }, 5000);

    setTimeout(function() {
        document.getElementById('toast-danger')?.remove();
    }, 5000);

    setTimeout(function() {
        document.getElementById('toast-warning')?.remove();
    }, 5000);

    setTimeout(function() {
        document.getElementById('alert-success')?.remove();
    }, 5000);

    setTimeout(function() {
        document.getElementById('alert-danger')?.remove();
    }, 5000);

    setTimeout(function() {
        document.getElementById('alert-warning')?.remove();
    }, 5000);
</script>
{{-- Password visibility toggle --}}
<script>
    function togglePasswordVisibility(elementId, showIconId = 'show-icon', hideIconId = 'hide-icon') {
        const passwordInput = document.getElementById(elementId);
        const showIcon = document.getElementById(showIconId);
        const hideIcon = document.getElementById(hideIconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showIcon.style.display = 'block';
            hideIcon.style.display = 'none';
        } else {
            passwordInput.type = 'password';
            showIcon.style.display = 'none';
            hideIcon.style.display = 'block';
        }
    }
</script>
