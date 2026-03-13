{{-- ============================================================
     FILE: resources/views/admin/education/index.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Education')

@section('content')
<div class="flex-between mb-6">
    <div></div>
    <a href="{{ route('admin.education.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add
        Education</a>
</div>
<div class="admin-table-wrapper">
    <div class="table-toolbar">
        <h3>Education ({{ $educations->count() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Degree</th>
                <th>Institution</th>
                <th>Field</th>
                <th>Year</th>
                <th>Grade</th>
                <th>Status</th>
                <th width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($educations as $edu)
            <tr>
                <td><strong>{{ $edu->degree }}</strong></td>
                <td>{{ $edu->institution }}</td>
                <td style="color:var(--text-muted);font-size:13px">{{ $edu->field_of_study ?? '—' }}</td>
                <td style="color:var(--text-muted);font-size:13px">{{ $edu->start_year }} —
                    {{ $edu->end_year ?? 'Present' }}</td>
                <td>{{ $edu->grade ?? '—' }}</td>
                <td><span
                        class="badge {{ $edu->is_active ? 'badge-success' : 'badge-danger' }}">{{ $edu->is_active ? 'Active' : 'Hidden' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.education.edit', $edu) }}" class="action-btn edit"><i
                                class="fas fa-pen"></i></a>
                        <form action="{{ route('admin.education.destroy', $edu) }}" method="POST" style="display:inline"
                            onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:var(--text-muted);padding:40px">No education added yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection