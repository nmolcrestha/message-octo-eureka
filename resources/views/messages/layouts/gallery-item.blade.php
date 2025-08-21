@php
    $image = json_decode($photo->attachment);
@endphp
<li>
    <a class="venobox" data-gall="{{ $photo->id }}" href="{{ asset($image) }}">
        <img src="{{ asset($image) }}" alt="{{ $photo->id }}" class="img-fluid w-100" loading="lazy">
    </a>
</li>