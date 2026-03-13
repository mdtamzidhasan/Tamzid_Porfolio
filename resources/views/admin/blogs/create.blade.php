{{-- ============================================================
     FILE: resources/views/admin/blogs/create.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'New Blog Post')

@section('content')
<div class="admin-form-card" style="max-width:100%">
    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i
                    class="fas fa-exclamation-circle"></i> {{ $error }}</p>@endforeach
        </div>
        @endif

        <div class="form-grid">
            <div class="form-group full">
                <label>Post Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Write a compelling title..."
                    required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="{{ old('category') }}"
                    placeholder="e.g. Laravel, JavaScript, Tips">
            </div>
            <div class="form-group">
                <label>Tags (comma separated)</label>
                <input type="text" name="tags" value="{{ old('tags') }}" placeholder="laravel, php, tutorial">
            </div>
            <div class="form-group">
                <label>Read Time (minutes)</label>
                <input type="number" name="read_time" value="{{ old('read_time', 5) }}" min="1">
            </div>
            <div class="form-group">
                <label>Thumbnail Image</label>
                <input type="file" name="thumbnail" accept="image/*" id="thumbInput">
                <img id="thumbPreview" style="display:none;margin-top:10px;max-width:200px;border-radius:8px;">
            </div>
            <div class="form-group full">
                <label>Excerpt / Summary</label>
                <textarea name="excerpt" rows="3"
                    placeholder="Short description shown in blog listing...">{{ old('excerpt') }}</textarea>
            </div>
            <div class="form-group full">
                <label>Content *</label>
                <textarea name="content" id="blogContent" rows="20" required>{{ old('content') }}</textarea>
            </div>
            <div class="form-group" style="display:flex;flex-direction:column;gap:12px;">
                <label class="form-check"><input type="checkbox" name="is_published" value="1"
                        {{ old('is_published') ? 'checked' : '' }}> Publish immediately</label>
                <label class="form-check"><input type="checkbox" name="is_featured" value="1"
                        {{ old('is_featured') ? 'checked' : '' }}> ⭐ Featured post</label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Post</button>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/theme/dracula.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.16/codemirror.min.js"></script>
<script>
// Thumbnail preview
document.getElementById('thumbInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const r = new FileReader();
        r.onload = e => {
            const p = document.getElementById('thumbPreview');
            p.src = e.target.result;
            p.style.display = 'block';
        };
        r.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection