@extends('layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Contact Messages</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($messages->count())
    <table class="table table-striped table-bordered align-middle">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Received At</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
            <tr class="{{ $message->read ? '' : 'table-warning' }}">
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->subject }}</td>
                <td>{{ Str::limit($message->message, 50) }}</td>
                <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                <td>
                    @if($message->read)
                        <span class="badge bg-success">Read</span>
                    @else
                        <span class="badge bg-warning text-dark">Unread</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No messages found.</p>
    @endif
</div>
@endsection
