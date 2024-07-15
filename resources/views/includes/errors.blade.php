@if($errors->any())
<div id="errors">   
    <ul>
        @foreach ($errors->all() as $error)
            <li><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</li>
        @endforeach
    </ul>
</div>

@endif