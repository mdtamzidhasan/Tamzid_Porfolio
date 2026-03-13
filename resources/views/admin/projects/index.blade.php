@extends('admin.layout')
@section('page-title', 'Projects')

@section('content')
<div class="flex-between mb-6">
    <div></div>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Project
    </a>
</div>

<div class="admin-table-wrapper">
    <div class="table-toolbar">
        <h3>All Projects ({{ $projects->count() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th width="80">Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Tech Stack</th>
                <th>Featured</th>
                <th>Status</th>
                <th width="140">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>
                    @if($project->image_url)
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}">
                    @else
                    <div
                        style="width:48px;height:48px;border-radius:8px;background:rgba(108,99,255,0.1);display:flex;align-items:center;justify-content:center;color:var(--accent)">
                        <i class="fas fa-code"></i></div>
                    @endif
                </td>
                <td><strong>{{ $project->title }}</strong></td>
                <td><span class="badge badge-primary">{{ $project->category }}</span></td>
                <td style="font-size:12px;color:var(--text-muted)">{{ Str::limit($project->tech_stack, 40) }}</td>
                <td>{{ $project->is_featured ? '⭐ Yes' : '—' }}</td>
                <td><span
                        class="badge {{ $project->is_active ? 'badge-success' : 'badge-danger' }}">{{ $project->is_active ? 'Active' : 'Hidden' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" class="action-btn view"><i
                                class="fas fa-external-link-alt"></i></a>
                        @endif
                        <a href="{{ route('admin.projects.edit', $project) }}" class="action-btn edit"><i
                                class="fas fa-pen"></i></a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                            style="display:inline" onsubmit="return confirm('Delete this project?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:var(--text-muted);padding:40px">No projects yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection