{{-- ============================================================
     FILE: resources/views/admin/experience/create.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Add Experience')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.experience.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)
            <p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i class="fas fa-exclamation-circle"></i>
                {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <div class="form-grid">
            <div class="form-group">
                <label>Job Title *</label>
                <input type="text" name="job_title" value="{{ old('job_title') }}"
                    placeholder="e.g. Senior Laravel Developer" required>
            </div>
            <div class="form-group">
                <label>Company *</label>
                <input type="text" name="company" value="{{ old('company') }}" placeholder="e.g. Tech Corp Ltd."
                    required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g. Dhaka, Bangladesh">
            </div>
            <div class="form-group">
                <label>Company Logo</label>
                <input type="file" name="company_logo" accept="image/*">
                <span class="form-hint">Optional — max 1MB</span>
            </div>
            <div class="form-group">
                <label>Start Date *</label>
                <input type="text" name="start_date" value="{{ old('start_date') }}" placeholder="e.g. January 2022"
                    required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="text" name="end_date" value="{{ old('end_date') }}" placeholder="e.g. December 2023"
                    id="endDateInput">
                <span class="form-hint">Currently working হলে খালি রাখো</span>
            </div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;">
                <label class="form-check">
                    <input type="checkbox" name="is_current" value="1" id="isCurrentCheck"
                        {{ old('is_current') ? 'checked' : '' }}>
                    I currently work here
                </label>
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
            </div>
            <div class="form-group full">
                <label>Job Description *</label>
                <textarea name="description" rows="5" placeholder="Describe your responsibilities and achievements..."
                    required>{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1" checked>
                    Show on portfolio
                </label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Experience</button>
            <a href="{{ route('admin.experience.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('isCurrentCheck').addEventListener('change', function() {
    document.getElementById('endDateInput').disabled = this.checked;
    if (this.checked) document.getElementById('endDateInput').value = '';
});
</script>
@endpush
@endsection