@if (session('success'))
    <script type="text/javascript">
        function message() {
            Swal.fire({
                icon: 'success',
                text: "{{ session('success') }}",
            });
        }

        window.onload = message
    </script>
@endif

@if (session('info'))
    <script type="text/javascript">
        function message() {
            Swal.fire({
                icon: 'info',
                text: "{{ session('info') }}",
            });
        }

        window.onload = message
    </script>
@endif

@if (session('error'))
    <script type="text/javascript">
        function message() {
            Swal.fire({
                icon: 'error',
                text: "{{ session('error') }}",
            });
        }

        window.onload = message
    </script>
@endif

@if (session('warning'))
    <script type="text/javascript">
        function message() {
            Swal.fire({
                icon: 'warning',
                text: "{{ session('warning') }}",
            });
        }

        window.onload = message
    </script>
@endif