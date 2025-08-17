<div class="wsus__single_chat_area message-card" data-id="{{ $message->id }}">
    <div class="wsus__single_chat {{ $message->form_id === auth()->id() ? 'chat_right' : '' }}">
        @if(!is_null($message->attachment))
        <a class="venobox" data-gall="gallery01" href="{{ asset(json_decode($message->attachment)) }}">
            <img src="{{ asset(json_decode($message->attachment)) }}" alt="gallery1" class="img-fluid w-100">
        </a>
        @endif
        @if(strlen($message->body)>0)
        <p class="messages">{{ $message->body }}</p>
        @endif
        <span class="time"> {{ timeAgo($message->created_at) }}</span>
        <a class="action" href="#"><i class="fas fa-trash"></i></a>
    </div>
</div>