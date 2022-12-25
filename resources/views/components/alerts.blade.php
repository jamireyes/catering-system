{{-- @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}

{{-- @if(session('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}

{{-- @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}

{{-- @if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif --}}

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