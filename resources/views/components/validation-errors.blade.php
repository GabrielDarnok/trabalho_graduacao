@if ($errors->any())
    <div {{ $attributes }}>
        <script>let errors = '';</script>
        <ul class="mt-3 list-disc list-inside text-sm text-red-600" style="align-items: center; display: flex; flex-direction: column;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <script>
        @foreach ($errors->all() as $error)
            errors += {!! json_encode($error) !!} + '\n';
        @endforeach
        console.log(errors);
        if (errors) {
            Swal.fire(
                'Opa!',
                errors,
                'error'
            );
        }
    </script>
@endif
