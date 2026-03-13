{{-- ============================================================
     FILE: resources/views/admin/testimonials/index.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Testimonials')

@section('content')
<div class="flex-between mb-6">
    <div></div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
        Testimonial</a>
</div>
<div class="admin-table-wrapper">
    <div class="table-toolbar">
        <h3>Testimonials ({{ $testimonials->count() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th width="60">Photo</th>
                <th>Client</th>
                <th>Company</th>
                <th>Rating</th>
                <th>Status</th>
                <th width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $t)
            <tr>
                <td><img src="{{ $t->photo_url }}" style="width:40px;height:40px;border-radius:50%;object-fit:cover;">
                </td>
                <td><strong>{{ $t->client_name }}</strong><br><small
                        style="color:var(--text-muted)">{{ $t->client_title }}</small></td>
                <td>{{ $t->company ?? '—' }}</td>
                <td>
                    @for($i=1;$i<=5;$i++) <i class="fas fa-star"
                        style="color:{{ $i<=$t->rating ? '#FFD700' : 'var(--border)' }};font-size:12px;"></i>
                        @endfor
                </td>
                <td><span
                        class="badge {{ $t->is_active ? 'badge-success' : 'badge-danger' }}">{{ $t->is_active ? 'Active' : 'Hidden' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="action-btn edit"><i
                                class="fas fa-pen"></i></a>
                        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST"
                            style="display:inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:40px">No testimonials yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection