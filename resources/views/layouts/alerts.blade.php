@if ($errors->all())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach
@endif

@if (session()->has("succes"))
    <div class="alert alert-success alert-dismissible fade show">
        <strong>{{ session()->get("succes") }}</strong>
        <button type="button" data-dismiss="alert" class="close"> 
            <span>&times;</span>
        </button>
    </div>
@endif

