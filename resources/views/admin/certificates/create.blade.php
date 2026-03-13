@extends('admin.layout')
@section('page-title', 'Add Certificate')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
        <div class="form-errors mb-4"
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;">
            @foreach($errors->all() as $error)
            <p style="color:#FF5050;font-size:13px;"><i class="fas fa-exclamation-circle"></i> {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <div class="form-grid">
            <div class="form-group">
                <label>Certificate Title *</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g. Laravel Certification"
                    required>
            </div>
            <div class="form-group">
                <label>Issuer / Organization *</label>
                <input type="text" name="issuer" value="{{ old('issuer') }}" placeholder="e.g. Udemy, Google, Coursera"
                    required>
            </div>
            <div class="form-group">
                <label>Issue Date *</label>
                <input type="text" name="issue_date" value="{{ old('issue_date') }}" placeholder="e.g. January 2024"
                    required>
            </div>
            <div class="form-group">
                <label>Expiry Date (if any)</label>
                <input type="text" name="expiry_date" value="{{ old('expiry_date') }}" placeholder="e.g. January 2027">
            </div>
            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="{{ old('category') }}"
                    placeholder="e.g. Web Dev, Cloud, Security">
            </div>
            <div class="form-group">
                <label>Credential URL</label>
                <input type="url" name="credential_url" value="{{ old('credential_url') }}"
                    placeholder="https://credential-link.com">
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    Show on portfolio
                </label>
            </div>
            <div class="form-group full">
                <label>Certificate Image * (JPG, PNG, WEBP — max 5MB)</label>
                <input type="file" name="image" accept="image/*" required id="certImageInput">
                <div id="certPreview" style="margin-top:12px;display:none;">
                    <img id="certPreviewImg" style="max-width:300px;border-radius:12px;border:1px solid var(--border);">
                </div>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Certificate</button>
            <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('certImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('certPreviewImg').src = e.target.result;
            document.getElementById('certPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection