@if($errors->all())
    @foreach ($errors->all() as $error)
        <div>{{ $error }}</div>
    @endforeach
@endif