<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller {
    public function index() {
        $testimonials = Testimonial::orderBy('sort_order')->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }
    public function create() { return view('admin.testimonials.create'); }
    public function store(Request $request) {
        $data = $request->validate([
            'client_name'  => 'required|string|max:255',
            'client_title' => 'nullable|string',
            'company'      => 'nullable|string',
            'review'       => 'required|string',
            'rating'       => 'required|integer|min:1|max:5',
            'sort_order'   => 'nullable|integer',
            'is_active'    => 'boolean',
            'client_photo' => 'nullable|image|max:1024',
        ]);
        if ($request->hasFile('client_photo')) {
            $data['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }
        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added!');
    }
    public function edit(Testimonial $testimonial) { return view('admin.testimonials.edit', compact('testimonial')); }
    public function update(Request $request, Testimonial $testimonial) {
        $data = $request->validate([
            'client_name'  => 'required|string|max:255',
            'client_title' => 'nullable|string',
            'company'      => 'nullable|string',
            'review'       => 'required|string',
            'rating'       => 'required|integer|min:1|max:5',
            'sort_order'   => 'nullable|integer',
            'is_active'    => 'boolean',
            'client_photo' => 'nullable|image|max:1024',
        ]);
        if ($request->hasFile('client_photo')) {
            if ($testimonial->client_photo) Storage::disk('public')->delete($testimonial->client_photo);
            $data['client_photo'] = $request->file('client_photo')->store('testimonials', 'public');
        }
        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Updated!');
    }
    public function destroy(Testimonial $testimonial) {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Deleted!');
    }
}