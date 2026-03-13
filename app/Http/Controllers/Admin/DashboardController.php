<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Project, Certificate, Blog, Contact, Skill, Testimonial};

class DashboardController extends Controller {
    public function index() {
        $stats = [
            'projects'     => Project::count(),
            'certificates' => Certificate::count(),
            'blogs'        => Blog::count(),
            'messages'     => Contact::count(),
            'unread'       => Contact::unread()->count(),
            'skills'       => Skill::count(),
            'testimonials' => Testimonial::count(),
        ];
        $recentMessages = Contact::latest()->take(5)->get();
        $recentBlogs    = Blog::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats','recentMessages','recentBlogs'));
    }
}