@if (session('added'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Added',
                text: '{{ session('added') }}',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif

@if (session('updated'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Updated',
                text: '{{ session('updated') }}',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif

@if (session('deleted'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Deleted',
                text: '{{ session('deleted') }}',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif

@if (session('uploaded'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Uploaded',
                text: '{{ session('uploaded') }}',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif

@if (session('booked'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Ticket Booked uccessfully',
                text: '{{ session('booked') }}',
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif
