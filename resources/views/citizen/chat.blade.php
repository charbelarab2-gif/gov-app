@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Chat — Conversation #{{ $conversation->id }}</h5>
    </div>

    <div class="card-body" id="chat-box" style="height:400px; overflow-y:auto;">
        @foreach($conversation->messages as $msg)
            <div class="mb-2">
                <strong>{{ $msg->sender_id }}</strong>: {{ $msg->body }}
                <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
            </div>
        @endforeach
    </div>

    <div class="card-footer">
        <div class="input-group">
            <input type="text" id="msg-input" class="form-control" placeholder="Type a message...">
            <button class="btn btn-primary" onclick="sendMessage()">Send</button>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>

const convId = @json($conversation->id);

// Listen for new messages
Echo.private('conversation.' + convId)
    .listen('NewChatMessage', (e) => {
        appendMessage(e.message);
    });

// Append message to chat box
function appendMessage(message) {
    const box = document.getElementById('chat-box');

    box.innerHTML += `
        <div class="mb-2">
            <strong>${message.sender_id}</strong>: ${message.body}
            <small class="text-muted">just now</small>
        </div>
    `;

    box.scrollTop = box.scrollHeight;
}

// Send message via AJAX
function sendMessage() {
    const body = document.getElementById('msg-input').value;

    if (!body.trim()) return;

    fetch(`/conversations/${convId}/messages`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ body })
    })
    .then(res => res.json())
    .then(message => {
        appendMessage(message);
        document.getElementById('msg-input').value = '';
    });
}

</script>
@endpush