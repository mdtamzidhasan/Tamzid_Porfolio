{{-- ============================================================
     FILE: resources/views/admin/testimonials/edit.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Edit Testimonial')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i
                    class="fas fa-exclamation-circle"></i> {{ $error }}</p>@endforeach
        </div>
        @endif
        <div class="form-grid">
            <div class="form-group"><label>Client Name *</label><input type="text" name="client_name"
                    value="{{ old('client_name', $testimonial->client_name) }}" required></div>
            <div class="form-group"><label>Client Title</label><input type="text" name="client_title"
                    value="{{ old('client_title', $testimonial->client_title) }}"></div>
            <div class="form-group"><label>Company</label><input type="text" name="company"
                    value="{{ old('company', $testimonial->company) }}"></div>
            <div class="form-group">
                <label>Rating *</label>
                <select name="rating" required>
                    @for($i=5;$i>=1;$i--)
                    <option value="{{ $i }}" {{ old('rating',$testimonial->rating)==$i ? 'selected' : '' }}>{{ $i }}
                        Star{{ $i>1?'s':'' }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label>Client Photo</label>
                @if($testimonial->client_photo)
                <div style="margin-bottom:8px;"><img src="{{ $testimonial->photo_url }}"
                        style="width:50px;height:50px;border-radius:50%;object-fit:cover;"></div>
                @endif
                <input type="file" name="client_photo" accept="image/*">
            </div>
            <div class="form-group"><label>Sort Order</label><input type="number" name="sort_order"
                    value="{{ old('sort_order', $testimonial->sort_order) }}"></div>
            <div class="form-group full"><label>Review *</label><textarea name="review" rows="5"
                    required>{{ old('review', $testimonial->review) }}</textarea></div>
            <div class="form-group"><label class="form-check"><input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}> Show on portfolio</label>
            </div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection