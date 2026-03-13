 {{-- ============================================================
     FILE: resources/views/admin/skills/create.blade.php
============================================================ --}}
 @extends('admin.layout')
 @section('page-title', 'Add Skill')

 @section('content')
 <div class="admin-form-card">
     <form action="{{ route('admin.skills.store') }}" method="POST">
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
                 <label>Skill Name *</label>
                 <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Laravel" required>
             </div>
             <div class="form-group">
                 <label>Category *</label>
                 <select name="category" required>
                     <option value="">-- Select Category --</option>
                     <option value="Frontend" {{ old('category')=='Frontend' ? 'selected' : '' }}>Frontend</option>
                     <option value="Backend" {{ old('category')=='Backend' ? 'selected' : '' }}>Backend</option>
                     <option value="Database" {{ old('category')=='Database' ? 'selected' : '' }}>Database</option>
                     <option value="DevOps" {{ old('category')=='DevOps' ? 'selected' : '' }}>DevOps</option>
                     <option value="Tools" {{ old('category')=='Tools' ? 'selected' : '' }}>Tools</option>
                     <option value="Other" {{ old('category')=='Other' ? 'selected' : '' }}>Other</option>
                 </select>
             </div>
             <div class="form-group full">
                 <label>Icon Class (Devicon or Font Awesome)</label>
                 <input type="text" name="icon" value="{{ old('icon') }}"
                     placeholder="e.g. devicon-laravel-plain colored  OR  fab fa-php" id="iconInput">
                 <span class="form-hint">
                     Devicon: <a href="https://devicons.github.io/devicon/" target="_blank"
                         style="color:var(--accent)">devicons.github.io</a> |
                     Font Awesome: fab fa-php, fab fa-js, fab fa-react, fab fa-vuejs, fas fa-database
                 </span>
                 <div id="iconPreview" style="margin-top:10px;font-size:36px;color:var(--accent);min-height:40px;">
                 </div>
             </div>
             <div class="form-group">
                 <label>Proficiency % *</label>
                 <input type="number" name="proficiency" value="{{ old('proficiency', 80) }}" min="0" max="100" required
                     id="profInput">
                 <div style="margin-top:8px;height:6px;background:var(--border);border-radius:3px;">
                     <div id="profBar"
                         style="height:100%;background:linear-gradient(135deg,#6C63FF,#00D4AA);border-radius:3px;width:80%;transition:width 0.3s;">
                     </div>
                 </div>
             </div>
             <div class="form-group">
                 <label>Sort Order</label>
                 <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
             </div>
             <div class="form-group" style="justify-content:flex-end;padding-bottom:8px;">
                 <label class="form-check">
                     <input type="checkbox" name="is_active" value="1" checked>
                     Show on portfolio
                 </label>
             </div>
         </div>

         <div style="display:flex;gap:12px;margin-top:8px;">
             <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Skill</button>
             <a href="{{ route('admin.skills.index') }}" class="btn btn-secondary">Cancel</a>
         </div>
     </form>
 </div>

 @push('scripts')
 <script>
// Icon preview
document.getElementById('iconInput').addEventListener('input', function() {
    document.getElementById('iconPreview').innerHTML = this.value ?
        `<i class="${this.value}"></i>` :
        '';
});
// Proficiency bar live
document.getElementById('profInput').addEventListener('input', function() {
    document.getElementById('profBar').style.width = this.value + '%';
});
 </script>
 @endpush
 @endsection