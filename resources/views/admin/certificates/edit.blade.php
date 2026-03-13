{{-- ============================================================
     FILE: resources/views/admin/certificates/edit.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Edit Certificate')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i
                    class="fas fa-exclamation-circle"></i> {{ $error }}</p>@endforeach
        </div>
        @endif
        <div class="form-grid">
            <div class="form-group"><label>Title *</label><input type="text" name="title"
                    value="{{ old('title', $certificate->title) }}" required></div>
            <div class="form-group"><label>Issuer *</label><input type="text" name="issuer"
                    value="{{ old('issuer', $certificate->issuer) }}" required></div>
            <div class="form-group"><label>Issue Date *</label><input type="text" name="issue_date"
                    value="{{ old('issue_date', $certificate->issue_date) }}" required></div>
            <div class="form-group"><label>Expiry Date</label><input type="text" name="expiry_date"
                    value="{{ old('expiry_date', $certificate->expiry_date) }}"></div>
            <div class="form-group"><label>Category</label><input type="text" name="category"
                    value="{{ old('category', $certificate->category) }}"></div>
            <div class="form-group"><label>Credential URL</label><input type="url" name="credential_url"
                    value="{{ old('credential_url', $certificate->credential_url) }}"></div>
            <div class="form-group"><label>Sort Order</label><input type="number" name="sort_order"
                    value="{{ old('sort_order', $certificate->sort_order) }}"></div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;"><label
                    class="form-check"><input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $certificate->is_active) ? 'checked' : '' }}> Show on portfolio</label>
            </div>
            <div class="form-group full">
                <label>Certificate Image (নতুন দিলে replace হবে)</label>
                <div style="margin-bottom:10px;">
                    <img src="{{ $certificate->image_url }}"
                        style="max-width:250px;border-radius:10px;border:1px solid var(--border);">
                </div>
                <input type="file" name="image" accept="image/*" id="certImageInput">
                <div id="certPreview" style="margin-top:12px;display:none;"><img id="certPreviewImg"
                        style="max-width:250px;border-radius:10px;border:1px solid var(--border);"></div>
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Certificate</button>
            <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@push('scripts')
<script>
document.getElementById('certImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const r = new FileReader();
        r.onload = e => {
            document.getElementById('certPreviewImg').src = e.target.result;
            document.getElementById('certPreview').style.display = 'block';
        };
        r.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection