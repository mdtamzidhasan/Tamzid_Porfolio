@extends('frontend.layout')

@section('content')

{{-- ============================================================
     HERO SECTION
============================================================ --}}
<section id="home" class="hero">
    <div class="hero-bg">
        <div class="hero-grid"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-text" data-aos="fade-right" data-aos-duration="1000">
                <div class="hero-greeting">
                    <span class="greeting-line"></span>
                    <span>Hello, World! 👋</span>
                </div>
                <h1 class="hero-name">
                    I'm <span class="name-highlight">{{ $profile->name ?? 'Your Name' }}</span>
                </h1>
                <div class="hero-role">
                    <span class="role-prefix">A passionate </span>
                    <span id="typed-text"></span>
                </div>
                <p class="hero-bio">{{ Str::limit($profile->bio ?? '', 180) }}</p>

                <div class="hero-cta">
                    <a href="#projects" class="btn btn-primary">
                        <span>View My Work</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    @if($profile->cv_url)
                    <a href="{{ $profile->cv_url }}" download class="btn btn-outline">
                        <i class="fas fa-download"></i>
                        <span>Download CV</span>
                    </a>
                    @endif
                </div>

                <div class="hero-socials">
                    @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank" class="social-icon"><i
                            class="fab fa-github"></i></a>
                    @endif
                    @if($profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="social-icon"><i
                            class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($profile->twitter)
                    <a href="{{ $profile->twitter }}" target="_blank" class="social-icon"><i
                            class="fab fa-twitter"></i></a>
                    @endif
                </div>
            </div>

            <div class="hero-image-wrapper" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="hero-image-container">
                    <div class="image-ring ring-1"></div>
                    <div class="image-ring ring-2"></div>
                    <div class="image-ring ring-3"></div>
                    <img src="{{ $profile->profile_photo_url ?? asset('images/avatar-placeholder.png') }}"
                        alt="{{ $profile->name }}" class="hero-avatar">
                    @if($profile->available_for_work)
                    <div class="availability-badge">
                        <span class="pulse-dot"></span>
                        Available for work
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="hero-scroll-indicator">
            <span>Scroll Down</span>
            <div class="scroll-line"></div>
        </div>
    </div>
</section>


{{-- ============================================================
     STATS SECTION
============================================================ --}}
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-number" data-count="{{ $profile->projects_count ?? 0 }}">0</div>
                <div class="stat-label">Projects Completed</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number" data-count="{{ $profile->years_experience ?? 0 }}">0</div>
                <div class="stat-label">Years Experience</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number" data-count="{{ $profile->clients_count ?? 0 }}">0</div>
                <div class="stat-label">Happy Clients</div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number" data-count="{{ $profile->github_stars ?? 0 }}">0</div>
                <div class="stat-label">GitHub Stars</div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     ABOUT SECTION
============================================================ --}}
<section id="about" class="section about-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">Get to know me</span>
            <h2 class="section-title">About <span class="highlight">Me</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="about-grid">
            <div class="about-image-col" data-aos="fade-right">
                <div class="about-img-wrapper">
                    <img src="{{ $profile->profile_photo_url ?? asset('images/avatar-placeholder.png') }}"
                        alt="{{ $profile->name }}" class="about-img">
                    <div class="about-img-decoration"></div>
                    <div class="exp-badge">
                        <span class="exp-num">{{ $profile->years_experience ?? 0 }}+</span>
                        <span class="exp-text">Years<br>Experience</span>
                    </div>
                </div>
            </div>

            <div class="about-content-col" data-aos="fade-left">
                <h3>Who am I?</h3>
                <p class="about-bio">{{ $profile->bio }}</p>

                <div class="about-info-grid">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $profile->email }}</span>
                        </div>
                    </div>
                    @if($profile->phone)
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <span class="info-label">Phone</span>
                            <span class="info-value">{{ $profile->phone }}</span>
                        </div>
                    </div>
                    @endif
                    @if($profile->location)
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <span class="info-label">Location</span>
                            <span class="info-value">{{ $profile->location }}</span>
                        </div>
                    </div>
                    @endif
                    <div class="info-item">
                        <i class="fas fa-circle{{ $profile->available_for_work ? ' text-green' : '' }}"></i>
                        <div>
                            <span class="info-label">Status</span>
                            <span
                                class="info-value">{{ $profile->available_for_work ? '✅ Available for work' : '❌ Not available' }}</span>
                        </div>
                    </div>
                </div>

                <div class="about-cta">
                    @if($profile->cv_url)
                    <a href="{{ $profile->cv_url }}" download class="btn btn-primary">
                        <i class="fas fa-download"></i> Download CV
                    </a>
                    @endif
                    <a href="#contact" class="btn btn-outline">
                        <i class="fas fa-paper-plane"></i> Hire Me
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ============================================================
     SKILLS SECTION
============================================================ --}}
<section id="skills" class="section skills-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">What I work with</span>
            <h2 class="section-title">Skills & <span class="highlight">Technologies</span></h2>
            <div class="section-line"></div>
        </div>

        @foreach($skills as $category => $categorySkills)
        <div class="skill-category" data-aos="fade-up">
            <h3 class="category-title">{{ $category }}</h3>
            <div class="skills-grid">
                @foreach($categorySkills as $skill)
                <div class="skill-card">
                    <div class="skill-icon">
                        @if($skill->icon && str_contains($skill->icon, 'devicon'))
                        <i class="{{ $skill->icon }}"></i>
                        @elseif($skill->icon && str_contains($skill->icon, 'fa'))
                        <i class="{{ $skill->icon }}"></i>
                        @else
                        <span class="skill-letter">{{ substr($skill->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <span class="skill-name">{{ $skill->name }}</span>
                    <div class="skill-bar-wrapper">
                        <div class="skill-bar" data-width="{{ $skill->proficiency }}">
                            <div class="skill-fill"></div>
                        </div>
                        <span class="skill-percent">{{ $skill->proficiency }}%</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</section>


{{-- ============================================================
     PROJECTS SECTION
============================================================ --}}
<section id="projects" class="section projects-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">What I've built</span>
            <h2 class="section-title">My <span class="highlight">Projects</span></h2>
            <div class="section-line"></div>
        </div>

        {{-- Filter Tabs --}}
        <div class="filter-tabs" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">All</button>
            @foreach($projects->pluck('category')->unique() as $cat)
            <button class="filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
            @endforeach
        </div>

        <div class="projects-grid" id="projectsGrid">
            @foreach($projects as $project)
            <div class="project-card {{ $project->is_featured ? 'featured' : '' }}"
                data-category="{{ Str::slug($project->category) }}" data-aos="fade-up">
                <div class="project-image">
                    @if($project->image_url)
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" loading="lazy">
                    @else
                    <div class="project-placeholder">
                        <i class="fas fa-code"></i>
                    </div>
                    @endif
                    @if($project->is_featured)
                    <div class="featured-badge"><i class="fas fa-star"></i> Featured</div>
                    @endif
                    <div class="project-overlay">
                        <h4>{{ $project->title }}</h4>
                        <p>{{ Str::limit($project->description, 100) }}</p>
                        <div class="project-overlay-links">
                            @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" class="project-link">
                                <i class="fas fa-external-link-alt"></i> Live Demo
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="project-link">
                                <i class="fab fa-github"></i> GitHub
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="project-info">
                    <div class="project-category-tag">{{ $project->category }}</div>
                    <h3 class="project-title">{{ $project->title }}</h3>
                    <p class="project-desc">{{ Str::limit($project->description, 120) }}</p>
                    <div class="project-tech">
                        @foreach($project->tech_array as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <div class="project-links">
                        @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" class="btn btn-sm btn-primary">
                            <i class="fas fa-external-link-alt"></i> Live
                        </a>
                        @endif
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-outline">
                            <i class="fab fa-github"></i> Code
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     EXPERIENCE SECTION
============================================================ --}}
<section id="experience" class="section experience-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">My journey</span>
            <h2 class="section-title">Work <span class="highlight">Experience</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="timeline">
            @foreach($experiences as $index => $exp)
            <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}"
                data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-date">
                        <i class="far fa-calendar-alt"></i>
                        {{ $exp->start_date }} — {{ $exp->end_label }}
                    </div>
                    <h3 class="timeline-title">{{ $exp->job_title }}</h3>
                    <div class="timeline-company">
                        @if($exp->company_logo)
                        <img src="{{ asset('storage/'.$exp->company_logo) }}" alt="{{ $exp->company }}"
                            class="company-logo">
                        @endif
                        <span>{{ $exp->company }}</span>
                        @if($exp->location)
                        <span class="timeline-location"><i class="fas fa-map-marker-alt"></i>
                            {{ $exp->location }}</span>
                        @endif
                    </div>
                    <p class="timeline-desc">{{ $exp->description }}</p>
                    @if($exp->is_current)
                    <span class="current-badge">Current</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     EDUCATION SECTION
============================================================ --}}
<section id="education" class="section education-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">Academic background</span>
            <h2 class="section-title">My <span class="highlight">Education</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="education-grid">
            @foreach($educations as $edu)
            <div class="education-card" data-aos="fade-up">
                <div class="edu-icon"><i class="fas fa-graduation-cap"></i></div>
                <div class="edu-content">
                    <div class="edu-year">{{ $edu->start_year }} — {{ $edu->end_year ?? 'Present' }}</div>
                    <h3 class="edu-degree">{{ $edu->degree }}</h3>
                    @if($edu->field_of_study)
                    <div class="edu-field">{{ $edu->field_of_study }}</div>
                    @endif
                    <div class="edu-institution"><i class="fas fa-university"></i> {{ $edu->institution }}</div>
                    @if($edu->grade)
                    <div class="edu-grade"><i class="fas fa-award"></i> {{ $edu->grade }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     CERTIFICATES SECTION
============================================================ --}}
<section id="certificates" class="section certificates-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">My achievements</span>
            <h2 class="section-title">Certificates & <span class="highlight">Awards</span></h2>
            <div class="section-line"></div>
        </div>

        {{-- Category Filter --}}
        @php $certCategories = $certificates->pluck('category')->filter()->unique(); @endphp
        @if($certCategories->count() > 0)
        <div class="filter-tabs" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">All</button>
            @foreach($certCategories as $cat)
            <button class="filter-btn" data-filter="{{ Str::slug($cat) }}">{{ $cat }}</button>
            @endforeach
        </div>
        @endif

        <div class="certificates-grid" id="certsGrid">
            @foreach($certificates as $cert)
            <div class="cert-card" data-category="{{ Str::slug($cert->category) }}" data-aos="fade-up">
                <a href="{{ $cert->image_url }}" class="glightbox cert-image-link" data-gallery="certificates"
                    data-title="{{ $cert->title }} — {{ $cert->issuer }}">
                    <div class="cert-image-wrapper">
                        <img src="{{ $cert->image_url }}" alt="{{ $cert->title }}" loading="lazy">
                        <div class="cert-overlay">
                            <i class="fas fa-expand-alt"></i>
                            <span>View Certificate</span>
                        </div>
                    </div>
                </a>
                <div class="cert-info">
                    <h4 class="cert-title">{{ $cert->title }}</h4>
                    <div class="cert-meta">
                        <span class="cert-issuer"><i class="fas fa-building"></i> {{ $cert->issuer }}</span>
                        <span class="cert-date"><i class="far fa-calendar"></i> {{ $cert->issue_date }}</span>
                    </div>
                    @if($cert->credential_url)
                    <a href="{{ $cert->credential_url }}" target="_blank" class="cert-verify-link">
                        <i class="fas fa-external-link-alt"></i> Verify Credential
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ============================================================
     TESTIMONIALS SECTION
============================================================ --}}
@if($testimonials->count() > 0)
<section id="testimonials" class="section testimonials-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">What people say</span>
            <h2 class="section-title">Client <span class="highlight">Testimonials</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="testimonials-slider" data-aos="fade-up">
            <div class="testimonials-track" id="testimonialsTrack">
                @foreach($testimonials as $testimonial)
                <div class="testimonial-card">
                    <div class="testimonial-stars">
                        @for($i = 1; $i <= 5; $i++) <i
                            class="fas fa-star {{ $i <= $testimonial->rating ? 'active' : '' }}"></i>
                            @endfor
                    </div>
                    <div class="testimonial-quote"><i class="fas fa-quote-left"></i></div>
                    <p class="testimonial-text">{{ $testimonial->review }}</p>
                    <div class="testimonial-author">
                        <img src="{{ $testimonial->photo_url }}" alt="{{ $testimonial->client_name }}">
                        <div>
                            <span class="author-name">{{ $testimonial->client_name }}</span>
                            <span class="author-title">{{ $testimonial->client_title }} @if($testimonial->company)@
                                {{ $testimonial->company }}@endif</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="testimonial-controls">
                <button class="testimonial-btn" id="prevTestimonial"><i class="fas fa-chevron-left"></i></button>
                <div class="testimonial-dots" id="testimonialDots"></div>
                <button class="testimonial-btn" id="nextTestimonial"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</section>
@endif


{{-- ============================================================
     BLOG SECTION
============================================================ --}}
@if($blogs->count() > 0)
<section id="blog" class="section blog-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">My thoughts</span>
            <h2 class="section-title">Latest <span class="highlight">Blog Posts</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="blog-grid">
            @foreach($blogs as $blog)
            <article class="blog-card" data-aos="fade-up">
                <div class="blog-image">
                    @if($blog->thumbnail_url)
                    <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}" loading="lazy">
                    @else
                    <div class="blog-placeholder"><i class="fas fa-pen"></i></div>
                    @endif
                    @if($blog->category)
                    <span class="blog-category">{{ $blog->category }}</span>
                    @endif
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="far fa-calendar"></i> {{ $blog->published_at?->format('M d, Y') }}</span>
                        <span><i class="far fa-clock"></i> {{ $blog->read_time }} min read</span>
                    </div>
                    <h3 class="blog-title">
                        <a href="{{ route('blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                    </h3>
                    <p class="blog-excerpt">{{ Str::limit($blog->excerpt ?? strip_tags($blog->content), 120) }}</p>
                    <a href="{{ route('blog.show', $blog->slug) }}" class="blog-read-more">
                        Read More <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <div class="section-cta" data-aos="fade-up">
            <a href="{{ route('blog.index') }}" class="btn btn-outline">
                View All Posts <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>
@endif


{{-- ============================================================
     CONTACT SECTION
============================================================ --}}
<section id="contact" class="section contact-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">Get in touch</span>
            <h2 class="section-title">Contact <span class="highlight">Me</span></h2>
            <div class="section-line"></div>
        </div>

        <div class="contact-grid">
            <div class="contact-info" data-aos="fade-right">
                <h3>Let's talk about your project</h3>
                <p>I'm always open to discussing new projects, creative ideas, or opportunities to be part of your
                    vision.</p>

                <div class="contact-details">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <span class="contact-label">Email</span>
                            <a href="mailto:{{ $profile->email }}" class="contact-value">{{ $profile->email }}</a>
                        </div>
                    </div>
                    @if($profile->phone)
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <span class="contact-label">Phone</span>
                            <a href="tel:{{ $profile->phone }}" class="contact-value">{{ $profile->phone }}</a>
                        </div>
                    </div>
                    @endif
                    @if($profile->location)
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <span class="contact-label">Location</span>
                            <span class="contact-value">{{ $profile->location }}</span>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="contact-socials">
                    @if($profile->github)
                    <a href="{{ $profile->github }}" target="_blank" class="social-icon-lg"><i
                            class="fab fa-github"></i></a>
                    @endif
                    @if($profile->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="social-icon-lg"><i
                            class="fab fa-linkedin-in"></i></a>
                    @endif
                    @if($profile->twitter)
                    <a href="{{ $profile->twitter }}" target="_blank" class="social-icon-lg"><i
                            class="fab fa-twitter"></i></a>
                    @endif
                    @if($profile->facebook)
                    <a href="{{ $profile->facebook }}" target="_blank" class="social-icon-lg"><i
                            class="fab fa-facebook-f"></i></a>
                    @endif
                </div>
            </div>

            <div class="contact-form-wrapper" data-aos="fade-left">
                <form id="contactForm" class="contact-form">
                    @csrf
                    <div id="formAlert" class="form-alert" style="display:none;"></div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Your Name</label>
                            <input type="text" name="name" placeholder="John Doe" required>
                        </div>
                        <div class="form-group">
                            <label>Your Email</label>
                            <input type="email" name="email" placeholder="john@example.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" placeholder="Project inquiry" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="message" rows="6" placeholder="Tell me about your project..."
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full" id="submitBtn">
                        <span class="btn-text"><i class="fas fa-paper-plane"></i> Send Message</span>
                        <span class="btn-loading" style="display:none;"><i class="fas fa-spinner fa-spin"></i>
                            Sending...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection