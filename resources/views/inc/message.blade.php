<script>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    swal({
        title: "{{ $error }}",
        type: "error",
        showConfirmButton: false,
        timer: 1000
    });

    @endforeach
    @endif

    @if (session('success') != null)
    swal({
        title: "{{session('success')}}",
        type: "success",
        showConfirmButton: false,
        timer: 2000
    });
    @endif

    {{--@if (session('failed') != null)--}}
    {{--swal({--}}
    {{--title: "{{session('failed')}}",--}}
    {{--type: "error",--}}
    {{--showConfirmButton: false,--}}
    {{--timer: 2000--}}
    {{--});--}}
    {{--@endif--}}
</script>