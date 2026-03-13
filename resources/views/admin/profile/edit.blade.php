@extends('admin.layout')
@section('page-title', 'Edit Profile')

@section('content')
<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
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

    {{-- Personal Info --}}
    <div class="admin-form-card mb-6" style="max-width:100%">
        <h3 class="form-section-title" style="margin-top:0">👤 Personal Information</h3>
        <div class="form-grid">
            <div class="form-group">
                <label>Full Name *</label>
                <input type="text" name="name" value="{{ old('name', $profile->name) }}" required>
            </div>
            <div class="form-group">
                <label>Professional Title *</label>
                <input type="text" name="title" value="{{ old('title', $profile->title) }}"
                    placeholder="e.g. Full Stack Developer" required>
            </div>
            <div class="form-group full">
                <label>Typing Taglines (comma separated)</label>
                <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}"
                    placeholder="Laravel Developer,Full Stack Developer,React Developer">
                <span class="form-hint">Hero section এ typing animation এ দেখাবে</span>
            </div>
            <div class="form-group full">
                <label>Bio / About Me *</label>
                <textarea name="bio" rows="5" required>{{ old('bio', $profile->bio) }}</textarea>
            </div>
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" value="{{ old('email', $profile->email) }}" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}"
                    placeholder="+880 1xxx-xxxxxx">
            </div>
            <div class="form-group">
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location', $profile->location) }}"
                    placeholder="Dhaka, Bangladesh">
            </div>
            <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;">
                <label class="form-check">
                    <input type="checkbox" name="available_for_work" value="1"
                        {{ old('available_for_work', $profile->available_for_work) ? 'checked' : '' }}>
                    Available for work
                </label>
            </div>
        </div>

        {{-- Stats --}}
        <h3 class="form-section-title">📊 Stats Counter</h3>
        <div class="form-grid">
            <div class="form-group">
                <label>Projects Completed</label>
                <input type="number" name="projects_count" value="{{ old('projects_count', $profile->projects_count) }}"
                    min="0">
            </div>
            <div class="form-group">
                <label>Years Experience</label>
                <input type="number" name="years_experience"
                    value="{{ old('years_experience', $profile->years_experience) }}" min="0">
            </div>
            <div class="form-group">
                <label>Happy Clients</label>
                <input type="number" name="clients_count" value="{{ old('clients_count', $profile->clients_count) }}"
                    min="0">
            </div>
            <div class="form-group">
                <label>GitHub Stars</label>
                <input type="number" name="github_stars" value="{{ old('github_stars', $profile->github_stars) }}"
                    min="0">
            </div>
        </div>

        {{-- Social Links --}}
        <h3 class="form-section-title">🔗 Social Links</h3>
        <div class="form-grid">
            <div class="form-group">
                <label><i class="fab fa-github"></i> GitHub URL</label>
                <input type="url" name="github" value="{{ old('github', $profile->github) }}"
                    placeholder="https://github.com/username">
            </div>
            <div class="form-group">
                <label><i class="fab fa-linkedin"></i> LinkedIn URL</label>
                <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin) }}"
                    placeholder="https://linkedin.com/in/username">
            </div>
            <div class="form-group">
                <label><i class="fab fa-twitter"></i> Twitter URL</label>
                <input type="url" name="twitter" value="{{ old('twitter', $profile->twitter) }}"
                    placeholder="https://twitter.com/username">
            </div>
            <div class="form-group">
                <label><i class="fab fa-facebook"></i> Facebook URL</label>
                <input type="url" name="facebook" value="{{ old('facebook', $profile->facebook) }}"
                    placeholder="https://facebook.com/username">
            </div>
        </div>

        {{-- File Uploads --}}
        <h3 class="form-section-title">📁 Files & Images</h3>
        <div class="form-grid">
            <div class="form-group">
                <label>Profile Photo</label>
                @if($profile->profile_photo)
                <div style="margin-bottom:10px;">
                    <img src="{{ $profile->profile_photo_url }}"
                        style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:2px solid var(--accent);">
                </div>
                @endif
                <input type="file" name="profile_photo" accept="image/*" id="photoInput">
                <span class="form-hint">JPG, PNG, WEBP — max 2MB</span>
                <img id="photoPreview"
                    style="display:none;margin-top:10px;width:80px;height:80px;border-radius:50%;object-fit:cover;">
            </div>
            <div class="form-group">
                <label>CV / Resume (PDF)</label>
                @if($profile->cv_file)
                <div style="margin-bottom:10px;">
                    <a href="{{ $profile->cv_url }}" target="_blank" class="btn btn-secondary btn-sm">
                        <i class="fas fa-file-pdf"></i> Current CV
                    </a>
                </div>
                @endif
                <input type="file" name="cv_file" accept=".pdf">
                <span class="form-hint">PDF only — max 5MB</span>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Save Profile
        </button>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('photoInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('photoPreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection