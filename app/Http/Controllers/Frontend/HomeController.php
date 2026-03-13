<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\{Profile, Skill, Project, Experience, Education, Certificate, Testimonial, Blog, Contact};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller {
    public function index() {
        $profile      = Profile::first();
        $skills       = Skill::active()->ordered()->get()->groupBy('category');
        $projects     = Project::active()->orderBy('is_featured', 'desc')->orderBy('sort_order')->get();
        $experiences  = Experience::active()->orderBy('sort_order')->get();
        $educations   = Education::active()->orderBy('sort_order')->get();
        $certificates = Certificate::active()->orderBy('sort_order')->get();
        $testimonials = Testimonial::active()->orderBy('sort_order')->get();
        $blogs        = Blog::published()->latest('published_at')->take(3)->get();

        return view('frontend.home', compact(
            'profile','skills','projects','experiences',
            'educations','certificates','testimonials','blogs'
        ));
    }

    public function blog() {
        $profile = Profile::first();
        $blogs   = Blog::published()->latest('published_at')->paginate(9);
        return view('frontend.blog', compact('profile','blogs'));
    }

    public function blogShow(string $slug) {
        $profile = Profile::first();
        $blog    = Blog::published()->where('slug', $slug)->firstOrFail();
        $related = Blog::published()->where('id', '!=', $blog->id)
                        ->where('category', $blog->category)
                        ->take(3)->get();
        return view('frontend.blog-show', compact('profile','blog','related'));
    }

    public function sendContact(Request $request) {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        Contact::create($data);

        // Send email notification
        try {
            $profile = Profile::first();
            Mail::send('emails.contact', $data, function($mail) use ($profile, $data) {
                $mail->to($profile->email)
                     ->subject('New Contact: ' . $data['subject'])
                     ->replyTo($data['email'], $data['name']);
            });
        } catch (\Exception $e) { /* log silently */ }

        return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
    }
}