{{-- ============================================================
     FILE: resources/views/admin/skills/index.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Skills')

@section('content')
<div class="flex-between mb-6">
    <div></div>
    <a href="{{ route('admin.skills.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Skill
    </a>
</div>

@foreach($skills as $category => $categorySkills)
<div class="admin-table-wrapper mb-6">
    <div class="table-toolbar">
        <h3>{{ $category }} ({{ $categorySkills->count() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th width="60">Icon</th>
                <th>Skill Name</th>
                <th>Proficiency</th>
                <th>Sort</th>
                <th>Status</th>
                <th width="100">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorySkills as $skill)
            <tr>
                <td>
                    @if($skill->icon)
                    <i class="{{ $skill->icon }}" style="font-size:28px;color:var(--accent)"></i>
                    @else
                    <span
                        style="width:36px;height:36px;border-radius:8px;background:rgba(108,99,255,0.1);color:var(--accent);display:inline-flex;align-items:center;justify-content:center;font-weight:700">{{ substr($skill->name,0,1) }}</span>
                    @endif
                </td>
                <td><strong>{{ $skill->name }}</strong></td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="flex:1;height:6px;background:var(--border);border-radius:3px;max-width:120px;">
                            <div
                                style="width:{{ $skill->proficiency }}%;height:100%;background:linear-gradient(135deg,#6C63FF,#00D4AA);border-radius:3px;">
                            </div>
                        </div>
                        <span style="font-size:13px;color:var(--text-muted)">{{ $skill->proficiency }}%</span>
                    </div>
                </td>
                <td style="color:var(--text-muted)">{{ $skill->sort_order }}</td>
                <td><span
                        class="badge {{ $skill->is_active ? 'badge-success' : 'badge-danger' }}">{{ $skill->is_active ? 'Active' : 'Hidden' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="action-btn edit"><i
                                class="fas fa-pen"></i></a>
                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" style="display:inline"
                            onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endforeach

@if($skills->isEmpty())
<div class="admin-table-wrapper" style="padding:40px;text-align:center;color:var(--text-muted)">
    No skills yet. <a href="{{ route('admin.skills.create') }}" style="color:var(--accent)">Add one</a>
</div>
@endif
@endsection