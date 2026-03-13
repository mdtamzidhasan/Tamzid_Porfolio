{{-- ============================================================
     FILE: resources/views/admin/experience/edit.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Edit Experience')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.experience.update', $experience) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

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
                <input type="text" name="job_title" value="{{ old('job_title', $experience->job_title) }}" required>
            </div>
            <div class="form-group">
                <label>Company *</label>
                <input type="text" name="company" value="{{ old('company', $experience->company) }}" required>
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location', $experience->location) }}">
            </div>
            <div class="form-group">
                <label>Company Logo</label>
                @if($experience->company_logo)
                <div style="margin-bottom:8px;">
                    <img src="{{ asset('storage/'.$experience->company_logo) }}"
                        style="width:40px;height:40px;border-radius:8px;object-fit:contain;">
                </div>
                @endif
                <input type="file" name="company_logo" accept="image/*">
            </div>
            <div class="form-group">
                <label>Start Date *</label>
                <input type="text" name="start_date" value="{{ old('start_date', $experience->start_date) }}" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="text" name="end_date" value="{{ old('end_date', $experience->end_date) }}"
                    id="endDateInput" {{ $experience->is_current ? 'disabled' : '' }}>
            </div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;">
                <label class="form-check">
                    <input type="checkbox" name="is_current" value="1" id="isCurrentCheck"
                        {{ old('is_current', $experience->is_current) ? 'checked' : '' }}>
                    I currently work here
                </label>
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order) }}">
            </div>
            <div class="form-group full">
                <label>Job Description *</label>
                <textarea name="description" rows="5"
                    required>{{ old('description', $experience->description) }}</textarea>
            </div>
            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $experience->is_active) ? 'checked' : '' }}>
                    Show on portfolio
                </label>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Experience</button>
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