@extends('admin.layout')
@section('page-title', 'Messages')

@section('content')
<div class="admin-table-wrapper">
    <div class="table-toolbar">
        <h3>Contact Messages ({{ $messages->total() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Status</th>
                <th width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr style="{{ !$msg->is_read ? 'font-weight:600' : '' }}">
                <td>{{ $msg->name }}</td>
                <td style="font-size:13px;color:var(--text-muted)">{{ $msg->email }}</td>
                <td>{{ Str::limit($msg->subject, 40) }}</td>
                <td style="font-size:13px;color:var(--text-muted);white-space:nowrap">
                    {{ $msg->created_at->format('M d, Y') }}</td>
                <td><span
                        class="badge {{ $msg->is_read ? 'badge-success' : 'badge-danger' }}">{{ $msg->is_read ? 'Read' : 'New' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.messages.show', $msg) }}" class="action-btn view"><i
                                class="fas fa-eye"></i></a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" style="display:inline"
                            onsubmit="return confirm('Delete this message?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:40px">No messages yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:16px 20px">{{ $messages->links() }}</div>
</div>
@endsection