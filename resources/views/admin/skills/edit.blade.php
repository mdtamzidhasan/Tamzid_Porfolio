 {{-- ============================================================
     FILE: resources/views/admin/skills/edit.blade.php
============================================================ --}}
 @extends('admin.layout')
 @section('page-title', 'Edit Skill')

 @section('content')
 <div class="admin-form-card">
     <form action="{{ route('admin.skills.update', $skill) }}" method="POST">
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
                 <label>Skill Name *</label>
                 <input type="text" name="name" value="{{ old('name', $skill->name) }}" required>
             </div>
             <div class="form-group">
                 <label>Category *</label>
                 <select name="category" required>
                     @foreach(['Frontend','Backend','Database','DevOps','Tools','Other'] as $cat)
                     <option value="{{ $cat }}" {{ old('category', $skill->category)==$cat ? 'selected' : '' }}>
                         {{ $cat }}</option>
                     @endforeach
                 </select>
             </div>
             <div class="form-group full">
                 <label>Icon Class</label>
                 <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}" id="iconInput">
                 <div id="iconPreview" style="margin-top:10px;font-size:36px;color:var(--accent);">
                     @if($skill->icon)<i class="{{ $skill->icon }}"></i>@endif
                 </div>
             </div>
             <div class="form-group">
                 <label>Proficiency % *</label>
                 <input type="number" name="proficiency" value="{{ old('proficiency', $skill->proficiency) }}" min="0"
                     max="100" required id="profInput">
                 <div style="margin-top:8px;height:6px;background:var(--border);border-radius:3px;">
                     <div id="profBar"
                         style="height:100%;background:linear-gradient(135deg,#6C63FF,#00D4AA);border-radius:3px;width:{{ $skill->proficiency }}%;transition:width 0.3s;">
                     </div>
                 </div>
             </div>
             <div class="form-group">
                 <label>Sort Order</label>
                 <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order) }}">
             </div>
             <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;">
                 <label class="form-check">
                     <input type="checkbox" name="is_active" value="1"
                         {{ old('is_active', $skill->is_active) ? 'checked' : '' }}>
                     Show on portfolio
                 </label>
             </div>
         </div>

         <div style="display:flex;gap:12px;margin-top:8px;">
             <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Skill</button>
             <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
         </div>
     </form>
 </div>

 @push('scripts')
 <script>
document.getElementById('iconInput').addEventListener('input', function() {
    document.getElementById('iconPreview').innerHTML = this.value ? `<i class="${this.value}"></i>` : '';
});
document.getElementById('profInput').addEventListener('input', function() {
    document.getElementById('profBar').style.width = this.value + '%';
});
 </script>
 @endpush
 @endsection