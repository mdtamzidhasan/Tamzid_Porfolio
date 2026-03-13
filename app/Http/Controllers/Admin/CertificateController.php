<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller {
    public function index() {
        $certificates = Certificate::orderBy('sort_order')->orderBy('created_at','desc')->get();
        return view('admin.certificates.index', compact('certificates'));
    }
    public function create() { return view('admin.certificates.create'); }

    public function store(Request $request) {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'issuer'         => 'required|string|max:255',
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            'credential_url' => 'nullable|url',
            'issue_date'     => 'required|string',
            'expiry_date'    => 'nullable|string',
            'category'       => 'nullable|string',
            'sort_order'     => 'nullable|integer',
            'is_active'      => 'boolean',
        ]);
        $data['image'] = $request->file('image')->store('certificates', 'public');
        Certificate::create($data);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate added!');
    }

    public function edit(Certificate $certificate) {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate) {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'issuer'         => 'required|string|max:255',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'credential_url' => 'nullable|url',
            'issue_date'     => 'required|string',
            'expiry_date'    => 'nullable|string',
            'category'       => 'nullable|string',
            'sort_order'     => 'nullable|integer',
            'is_active'      => 'boolean',
        ]);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($certificate->image);
            $data['image'] = $request->file('image')->store('certificates', 'public');
        }
        $certificate->update($data);
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated!');
    }

    public function destroy(Certificate $certificate) {
        Storage::disk('public')->delete($certificate->image);
        $certificate->delete();
        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted!');
    }
}