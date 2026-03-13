{{-- ============================================================
     FILE: resources/views/admin/settings/edit.blade.php
============================================================ --}}
@extends('admin.layout')
@section('page-title', 'Settings')

@section('content')
<div class="admin-form-card" style="max-width:700px;">
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        <h3 class="form-section-title" style="margin-top:0">🌐 Site Settings</h3>
        <div class="form-grid">
            <div class="form-group">
                <label>Site Title</label>
                <input type="text" name="site_title"
                    value="{{ \App\Models\Setting::get('site_title', config('app.name')) }}" placeholder="My Portfolio">
            </div>
            <div class="form-group">
                <label>Default Theme</label>
                <select name="default_theme">
                    <option value="dark"
                        {{ \App\Models\Setting::get('default_theme','dark')=='dark' ? 'selected' : '' }}>Dark</option>
                    <option value="light"
                        {{ \App\Models\Setting::get('default_theme','dark')=='light' ? 'selected' : '' }}>Light</option>
                </select>
            </div>
            <div class="form-group full">
                <label>Meta Description (SEO)</label>
                <textarea name="meta_description" rows="3"
                    placeholder="Portfolio description for search engines...">{{ \App\Models\Setting::get('meta_description') }}</textarea>
            </div>
            <div class="form-group full">
                <label>Google Analytics ID</label>
                <input type="text" name="google_analytics" value="{{ \App\Models\Setting::get('google_analytics') }}"
                    placeholder="G-XXXXXXXXXX">
            </div>
        </div>

        <h3 class="form-section-title">📧 Email Settings</h3>
        <div class="form-grid">
            <div class="form-group">
                <label>Contact Email</label>
                <input type="email" name="contact_email" value="{{ \App\Models\Setting::get('contact_email') }}"
                    placeholder="your@email.com">
                <span class="form-hint">Contact form এ submit হলে এই email এ notification যাবে</span>
            </div>
            <div class="form-group">
                <label class="form-check" style="margin-top:28px;">
                    <input type="checkbox" name="email_notifications" value="1"
                        {{ \App\Models\Setting::get('email_notifications','1')=='1' ? 'checked' : '' }}>
                    Email notifications enable
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="margin-top:8px;">
            <i class="fas fa-save"></i> Save Settings
        </button>
    </form>
</div>
@endsection