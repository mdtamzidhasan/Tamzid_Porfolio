{{-- ============================================================
     FILE: resources/views/admin/messages/show.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'View Message')

@section('content')
<div style="max-width:700px;">
    <div class="admin-form-card">
        <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:24px;">
            <div>
                <h2 style="font-family:var(--font-display);font-size:1.3rem;font-weight:700;margin-bottom:8px;">
                    {{ $contact->subject }}</h2>
                <span
                    class="badge {{ $contact->is_read ? 'badge-success' : 'badge-danger' }}">{{ $contact->is_read ? 'Read' : 'New' }}</span>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm"><i
                    class="fas fa-arrow-left"></i> Back</a>
        </div>

        <div
            style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;padding:20px;background:var(--bg-2);border-radius:12px;">
            <div>
                <span style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:4px;">From</span>
                <strong>{{ $contact->name }}</strong>
            </div>
            <div>
                <span style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:4px;">Email</span>
                <a href="mailto:{{ $contact->email }}" style="color:var(--accent)">{{ $contact->email }}</a>
            </div>
            <div>
                <span style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:4px;">Received</span>
                {{ $contact->created_at->format('M d, Y — h:i A') }}
            </div>
            <div>
                <span style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:4px;">Read at</span>
                {{ $contact->read_at ? $contact->read_at->format('M d, Y — h:i A') : '—' }}
            </div>
        </div>

        <div style="padding:24px;background:var(--bg-2);border-radius:12px;margin-bottom:24px;">
            <span
                style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:12px;text-transform:uppercase;letter-spacing:1px;">Message</span>
            <p style="line-height:1.8;color:var(--text-primary);">{{ $contact->message }}</p>
        </div>

        <div style="display:flex;gap:12px;">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="btn btn-primary">
                <i class="fas fa-reply"></i> Reply via Email
            </a>
            <form action="{{ route('admin.messages.destroy', $contact) }}" method="POST"
                onsubmit="return confirm('Delete this message?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection