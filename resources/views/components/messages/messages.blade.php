@if(isset($errors) && count($errors) > 0)
  <div class="bg-red-300 pl-3 py-1">
    @foreach ($errors->all() as $error)
        <small class="font-bold text-red-800 block">{{$error}}</small>
    @endforeach
    </div>  
@endif