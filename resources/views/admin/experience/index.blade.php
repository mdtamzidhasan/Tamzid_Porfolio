{{-- ============================================================
     FILE: resources/views/admin/experience/index.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Experience')

@section('content')
<div class="flex-between mb-6">
    <div></div>
    <a href="{{ route('admin.experience.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Experience
    </a>
</div>

<div class="admin-table-wrapper">
    <div class="table-toolbar">
        <h3>Work Experience ({{ $experiences->count() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Job Title</th>
                <th>Company</th>
                <th>Duration</th>
                <th>Current</th>
                <th>Status</th>
                <th width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($experiences as $exp)
            <tr>
                <td><strong>{{ $exp->job_title }}</strong></td>
                <td>
                    <div style="display:flex;align-items:center;gap:8px;">
                        @if($exp->company_logo)
                        <img src="{{ asset('storage/'.$exp->company_logo) }}"
                            style="width:28px;height:28px;border-radius:6px;object-fit:contain;">
                        @endif
                        {{ $exp->company }}
                    </div>
                </td>
                <td style="font-size:13px;color:var(--text-muted)">{{ $exp->start_date }} — {{ $exp->end_label }}</td>
                <td>{{ $exp->is_current ? '<span class="badge badge-success">Current</span>' : '—' }}</td>
                <td><span
                        class="badge {{ $exp->is_active ? 'badge-success' : 'badge-danger' }}">{{ $exp->is_active ? 'Active' : 'Hidden' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.experience.edit', $exp) }}" class="action-btn edit"><i
                                class="fas fa-pen"></i></a>
                        <form action="{{ route('admin.experience.destroy', $exp) }}" method="POST"
                            style="display:inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:var(--text-muted);padding:40px">No experience added yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection