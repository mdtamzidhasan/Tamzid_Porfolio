{{-- ============================================================
     FILE: resources/views/admin/blogs/index.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Blog Posts')

@section('content')
<div class="flex-between mb-6">
    <div></div>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> New Post</a>
</div>
<div class="admin-table-wrapper">
    <div class="table-toolbar">
        <h3>Blog Posts ({{ $blogs->total() }})</h3>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th width="80">Thumbnail</th>
                <th>Title</th>
                <th>Category</th>
                <th>Read Time</th>
                <th>Featured</th>
                <th>Status</th>
                <th width="120">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
            <tr>
                <td>
                    @if($blog->thumbnail_url)
                    <img src="{{ $blog->thumbnail_url }}"
                        style="width:60px;height:45px;object-fit:cover;border-radius:8px;">
                    @else
                    <div
                        style="width:60px;height:45px;border-radius:8px;background:rgba(108,99,255,0.1);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:18px;">
                        <i class="fas fa-pen"></i></div>
                    @endif
                </td>
                <td><strong>{{ Str::limit($blog->title, 45) }}</strong><br><small
                        style="color:var(--text-muted)">/blog/{{ $blog->slug }}</small></td>
                <td><span class="badge badge-primary">{{ $blog->category ?? 'General' }}</span></td>
                <td style="color:var(--text-muted);font-size:13px">{{ $blog->read_time }} min</td>
                <td>{{ $blog->is_featured ? '⭐' : '—' }}</td>
                <td><span
                        class="badge {{ $blog->is_published ? 'badge-success' : 'badge-danger' }}">{{ $blog->is_published ? 'Published' : 'Draft' }}</span>
                </td>
                <td>
                    <div class="action-btns">
                        @if($blog->is_published)
                        <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="action-btn view"><i
                                class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ route('admin.blogs.edit', $blog) }}" class="action-btn edit"><i
                                class="fas fa-pen"></i></a>
                        <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" style="display:inline"
                            onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:var(--text-muted);padding:40px">No blog posts yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div style="padding:16px 20px">{{ $blogs->links() }}</div>
</div>
@endsection