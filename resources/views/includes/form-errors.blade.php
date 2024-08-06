<div class="alert alert-danger alert-dissmissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
