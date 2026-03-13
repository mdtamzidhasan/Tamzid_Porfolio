{{-- ============================================================
     FILE: resources/views/admin/testimonials/create.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Add Testimonial')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i
                    class="fas fa-exclamation-circle"></i> {{ $error }}</p>@endforeach
        </div>
        @endif
        <div class="form-grid">
            <div class="form-group"><label>Client Name *</label><input type="text" name="client_name"
                    value="{{ old('client_name') }}" required></div>
            <div class="form-group"><label>Client Title</label><input type="text" name="client_title"
                    value="{{ old('client_title') }}" placeholder="e.g. CEO, Project Manager"></div>
            <div class="form-group"><label>Company</label><input type="text" name="company" value="{{ old('company') }}"
                    placeholder="e.g. Tech Corp"></div>
            <div class="form-group">
                <label>Rating *</label>
                <select name="rating" required>
                    @for($i=5;$i>=1;$i--)
                    <option value="{{ $i }}" {{ old('rating',5)==$i ? 'selected' : '' }}>{{ $i }} Star{{ $i>1?'s':'' }}
                    </option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label>Client Photo</label>
                <input type="file" name="client_photo" accept="image/*" id="photoInput">
                <img id="photoPreview"
                    style="display:none;margin-top:10px;width:60px;height:60px;border-radius:50%;object-fit:cover;">
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="form-group full">
                <label>Review / Testimonial *</label>
                <textarea name="review" rows="5" placeholder="Write the client's review..."
                    required>{{ old('review') }}</textarea>
            </div>
            <div class="form-group"><label class="form-check"><input type="checkbox" name="is_active" value="1" checked>
                    Show on portfolio</label></div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@push('scripts')
<script>
document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const r = new FileReader();
        r.onload = e => {
            const p = document.getElementById('photoPreview');
            p.src = e.target.result;
            p.style.display = 'block';
        };
        r.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection