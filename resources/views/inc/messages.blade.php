@if(count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger container">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alert alert-success container">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger contrainer">
        {{session('error')}}
    </div>
@endif