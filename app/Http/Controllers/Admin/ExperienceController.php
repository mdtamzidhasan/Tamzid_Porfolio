<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller {
    public function index() {
        $experiences = Experience::orderBy('sort_order')->get();
        return view('admin.experience.index', compact('experiences'));
    }
    public function create() { return view('admin.experience.create'); }
    public function store(Request $request) {
        $data = $request->validate([
            'job_title'   => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'nullable|string',
            'start_date'  => 'required|string',
            'end_date'    => 'nullable|string',
            'is_current'  => 'boolean',
            'description' => 'required|string',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'boolean',
            'company_logo'=> 'nullable|image|max:1024',
        ]);
        if ($request->hasFile('company_logo')) {
            $data['company_logo'] = $request->file('company_logo')->store('experience', 'public');
        }
        Experience::create($data);
        return redirect()->route('admin.experience.index')->with('success', 'Experience added!');
    }
    public function edit(Experience $experience) { return view('admin.experience.edit', compact('experience')); }
    public function update(Request $request, Experience $experience) {
        $data = $request->validate([
            'job_title'   => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'nullable|string',
            'start_date'  => 'required|string',
            'end_date'    => 'nullable|string',
            'is_current'  => 'boolean',
            'description' => 'required|string',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'boolean',
            'company_logo'=> 'nullable|image|max:1024',
        ]);
        if ($request->hasFile('company_logo')) {
            if ($experience->company_logo) Storage::disk('public')->delete($experience->company_logo);
            $data['company_logo'] = $request->file('company_logo')->store('experience', 'public');
        }
        $experience->update($data);
        return redirect()->route('admin.experience.index')->with('success', 'Experience updated!');
    }
    public function destroy(Experience $experience) {
        $experience->delete();
        return redirect()->route('admin.experience.index')->with('success', 'Deleted!');
    }
}