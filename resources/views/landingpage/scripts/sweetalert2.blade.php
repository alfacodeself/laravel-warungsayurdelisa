<script>
    function swal(type = 'success', message = 'Berhasil') {
        let icon = 'success';
        let title = 'Berhasil';
        if (type == 'error') {
            icon = 'error';
            title = 'Maaf';
        }
        Swal.fire({
            icon,
            title,
            text: message,
        })
    }
</script>
@if (session('success'))
    <script>swal('success', "{!! session('success') !!}");</script>
@endif
@if (session('error'))
    <script>swal('error', "{!! session('error') !!}");</script>
@endif
