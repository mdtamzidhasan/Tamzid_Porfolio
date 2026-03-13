{{-- ============================================================
     FILE: resources/views/admin/education/edit.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Edit Education')

@section('content')
<div class="admin-form-card">
    <form action="{{ route('admin.education.update', $education) }}" method="POST">
        @csrf @method('PUT')
        @if($errors->any())
        <div
            style="background:rgba(255,80,80,0.08);border:1px solid rgba(255,80,80,0.2);border-radius:10px;padding:14px;margin-bottom:20px;">
            @foreach($errors->all() as $error)<p style="color:#FF5050;font-size:13px;margin-bottom:4px;"><i
                    class="fas fa-exclamation-circle"></i> {{ $error }}</p>@endforeach
        </div>
        @endif
        <div class="form-grid">
            <div class="form-group"><label>Degree *</label><input type="text" name="degree"
                    value="{{ old('degree', $education->degree) }}" required></div>
            <div class="form-group"><label>Institution *</label><input type="text" name="institution"
                    value="{{ old('institution', $education->institution) }}" required></div>
            <div class="form-group"><label>Field of Study</label><input type="text" name="field_of_study"
                    value="{{ old('field_of_study', $education->field_of_study) }}"></div>
            <div class="form-group"><label>Grade / CGPA</label><input type="text" name="grade"
                    value="{{ old('grade', $education->grade) }}"></div>
            <div class="form-group"><label>Start Year *</label><input type="text" name="start_year"
                    value="{{ old('start_year', $education->start_year) }}" required></div>
            <div class="form-group"><label>End Year</label><input type="text" name="end_year"
                    value="{{ old('end_year', $education->end_year) }}"></div>
            <div class="form-group full"><label>Description</label><textarea name="description"
                    rows="3">{{ old('description', $education->description) }}</textarea></div>
            <div class="form-group"><label>Sort Order</label><input type="number" name="sort_order"
                    value="{{ old('sort_order', $education->sort_order) }}"></div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;"><label
                    class="form-check"><input type="checkbox" name="is_active" value="1"
                        {{ old('is_active', $education->is_active) ? 'checked' : '' }}> Show on portfolio</label></div>
        </div>
        <div style="display:flex;gap:12px;margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Education</button>
            <a href="{{ route('admin.education.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection