{{-- ============================================================
     FILE: resources/views/admin/projects/create.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Add Project')

@section('content')
<div class="admin-form-card" style="max-width:100%">
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i
                    class="fas fa-exclamation-circle"></i> {{ $error }}</p>@endforeach
        </div>
        @endif
        <div class="form-grid">
            <div class="form-group"><label>Project Title *</label><input type="text" name="title"
                    value="{{ old('title') }}" required></div>
            <div class="form-group">
                <label>Category *</label>
                <select name="category" required>
                    <option value="">-- Select --</option>
                    @foreach(['Web','Mobile','API','Desktop','Other'] as $cat)
                    <option value="{{ $cat }}" {{ old('category')==$cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group full"><label>Short Description *</label><textarea name="description" rows="3"
                    required>{{ old('description') }}</textarea></div>
            <div class="form-group full"><label>Detailed Description</label><textarea name="long_description"
                    rows="5">{{ old('long_description') }}</textarea></div>
            <div class="form-group full">
                <label>Tech Stack * (comma separated)</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack') }}"
                    placeholder="Laravel, Vue.js, MySQL, Redis">
            </div>
            <div class="form-group"><label>Live URL</label><input type="url" name="live_url"
                    value="{{ old('live_url') }}" placeholder="https://example.com"></div>
            <div class="form-group"><label>GitHub URL</label><input type="url" name="github_url"
                    value="{{ old('github_url') }}" placeholder="https://github.com/..."></div>
            <div class="form-group"><label>Sort Order</label><input type="number" name="sort_order"
                    value="{{ old('sort_order', 0) }}"></div>
            <div class="form-group" style="display:flex;flex-direction:column;gap:12px;justify-content:flex-end;">
                <label class="form-check"><input type="checkbox" name="is_featured" value="1"
                        {{ old('is_featured') ? 'checked' : '' }}> ⭐ Featured Project</label>
                <label class="form-check"><input type="checkbox" name="is_active" value="1" checked> Show on
                    portfolio</label>
            </div>
            <div class="form-group full">
                <label>Project Screenshot</label>
                <input type="file" name="image" accept="image/*" id="projectImgInput">
                <div id="projectPreview" style="display:none;margin-top:12px;"><img id="projectPreviewImg"
                        style="max-width:300px;border-radius:10px;border:1px solid var(--border);"></div>
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@push('scripts')
<script>
document.getElementById('projectImgInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const r = new FileReader();
        r.onload = e => {
            document.getElementById('projectPreviewImg').src = e.target.result;
            document.getElementById('projectPreview').style.display = 'block';
        };
        r.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection