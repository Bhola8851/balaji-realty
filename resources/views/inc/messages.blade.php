<!-- Validation Error -->
@if (count($errors) > 0)
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</div>
@endif
<!-- Success message -->
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>{{$message}}</strong>
</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif