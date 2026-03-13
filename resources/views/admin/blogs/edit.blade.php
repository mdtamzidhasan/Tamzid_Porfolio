{{-- ============================================================
     FILE: resources/views/admin/blogs/edit.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Edit Blog Post')

@section('content')
<div class="admin-form-card" style="max-width:100%">
    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i
                    class="fas fa-exclamation-circle"></i> {{ $error }}</p>@endforeach
        </div>
        @endif

        <div class="form-grid">
            <div class="form-group full"><label>Post Title *</label><input type="text" name="title"
                    value="{{ old('title', $blog->title) }}" required></div>
            <div class="form-group"><label>Category</label><input type="text" name="category"
                    value="{{ old('category', $blog->category) }}"></div>
            <div class="form-group"><label>Tags</label><input type="text" name="tags"
                    value="{{ old('tags', $blog->tags) }}"></div>
            <div class="form-group"><label>Read Time (minutes)</label><input type="number" name="read_time"
                    value="{{ old('read_time', $blog->read_time) }}" min="1"></div>
            <div class="form-group">
                <label>Thumbnail</label>
                @if($blog->thumbnail_url)
                <div style="margin-bottom:8px;"><img src="{{ $blog->thumbnail_url }}"
                        style="max-width:150px;border-radius:8px;"></div>
                @endif
                <input type="file" name="thumbnail" accept="image/*">
            </div>
            <div class="form-group full"><label>Excerpt</label><textarea name="excerpt"
                    rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea></div>
            <div class="form-group full"><label>Content *</label><textarea name="content" rows="20"
                    required>{{ old('content', $blog->content) }}</textarea></div>
            <div class="form-group" style="display:flex;flex-direction:column;gap:12px;">
                <label class="form-check"><input type="checkbox" name="is_published" value="1"
                        {{ old('is_published', $blog->is_published) ? 'checked' : '' }}> Published</label>
                <label class="form-check"><input type="checkbox" name="is_featured" value="1"
                        {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}> ⭐ Featured</label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Post</button>
            @if($blog->is_published)
            <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-secondary"><i
                    class="fas fa-eye"></i> View Post</a>
            @endif
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection