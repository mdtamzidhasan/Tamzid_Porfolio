@extends('admin.layout')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stat Cards --}}
<div class="stat-cards">
    <div class="stat-card">
        <div class="stat-card-icon purple"><i class="fas fa-code"></i></div>
        <div>
            <div class="stat-card-num">{{ $stats['projects'] }}</div>
            <div class="stat-card-label">Projects</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon teal"><i class="fas fa-certificate"></i></div>
        <div>
            <div class="stat-card-num">{{ $stats['certificates'] }}</div>
            <div class="stat-card-label">Certificates</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon yellow"><i class="fas fa-pen-nib"></i></div>
        <div>
            <div class="stat-card-num">{{ $stats['blogs'] }}</div>
            <div class="stat-card-label">Blog Posts</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon red"><i class="fas fa-envelope"></i></div>
        <div>
            <div class="stat-card-num">{{ $stats['unread'] }}</div>
            <div class="stat-card-label">Unread Messages</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon purple"><i class="fas fa-cogs"></i></div>
        <div>
            <div class="stat-card-num">{{ $stats['skills'] }}</div>
            <div class="stat-card-label">Skills</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon teal"><i class="fas fa-star"></i></div>
        <div>
            <div class="stat-card-num">{{ $stats['testimonials'] }}</div>
            <div class="stat-card-label">Testimonials</div>
        </div>
    </div>
</div>

{{-- Quick Links --}}
<div class="grid-2 mb-6">
    <div class="admin-table-wrapper">
        <div class="table-toolbar">
            <h3>Recent Messages</h3>
            <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentMessages as $msg)
                <tr>
                    <td><strong>{{ $msg->name }}</strong><br><small
                            style="color:var(--text-muted)">{{ $msg->email }}</small></td>
                    <td>{{ Str::limit($msg->subject, 30) }}</td>
                    <td style="white-space:nowrap;color:var(--text-muted);font-size:13px">
                        {{ $msg->created_at->diffForHumans() }}</td>
                    <td><span
                            class="badge {{ $msg->is_read ? 'badge-success' : 'badge-danger' }}">{{ $msg->is_read ? 'Read' : 'Unread' }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:var(--text-muted);padding:30px">No messages yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-table-wrapper">
        <div class="table-toolbar">
            <h3>Recent Blog Posts</h3>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> New
                Post</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentBlogs as $blog)
                <tr>
                    <td>{{ Str::limit($blog->title, 35) }}</td>
                    <td><span class="badge badge-primary">{{ $blog->category ?? 'General' }}</span></td>
                    <td><span
                            class="badge {{ $blog->is_published ? 'badge-success' : 'badge-danger' }}">{{ $blog->is_published ? 'Published' : 'Draft' }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align:center;color:var(--text-muted);padding:30px">No blog posts yet
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Quick Actions --}}
<div class="admin-table-wrapper" style="padding:24px">
    <h3 style="font-family:var(--font-display);font-size:1rem;font-weight:700;margin-bottom:16px">Quick Actions</h3>
    <div style="display:flex;gap:12px;flex-wrap:wrap">
        <a href="{{ route('admin.projects.create') }}" class="btn btn-secondary"><i class="fas fa-plus"></i> Add
            Project</a>
        <a href="{{ route('admin.certificates.create') }}" class="btn btn-secondary"><i class="fas fa-certificate"></i>
            Add Certificate</a>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-secondary"><i class="fas fa-pen"></i> Write Blog</a>
        <a href="{{ route('admin.skills.create') }}" class="btn btn-secondary"><i class="fas fa-cog"></i> Add Skill</a>
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary"><i class="fas fa-user-edit"></i> Edit
            Profile</a>
    </div>
</div>
@endsection