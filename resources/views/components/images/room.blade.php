@if($image)
    <img src="{{ asset('assets/image/room') . '/' . $image }}" width="50px" height="50px" class="img-fluid img-thumbnail" alt="image-null">
@else
    <img src="{{ asset('assets/image/default/notFound.png') }}" width="50px" height="50px" class="img-fluid img-thumbnail" alt="image-null">
@endif



