@extends('layouts.frontend.main')
@section('title', 'Home')
@section('meta')
    <meta name="description" content="Professional Videographer and Photographer in Riyadh & Saudi Arabia. Socialese Media specializes in Corporate Videography, Product Photography, and Event Coverage in Riyadh, Jeddah, and across the Kingdom." />
    <meta name="keywords" content="Videographer in Riyadh, Photographer in Riyadh, Videographer in Jeddah, Photographer in Jeddah, Corporate Videography Saudi Arabia, Event Videography Riyadh, Media Production Saudi Arabia" />
@endsection
@section('content')


<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="hero-title" data-aos="fade-up">Professional Event Videography & Photography in Riyadh, Saudi Arabia</h1>
                <a href="{{ route('inquiry') }}" class="btn-cta" data-aos="fade-up" data-aos-delay="200">
                    Get a Free Quote <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>

        <div class="trusted-companies-gallery mt-5 pt-3">
            @forelse($images->take(10) as $index => $image)
                <div class="stagger-wrapper">
                    <img
                        src="{{ asset($image->media_url) }}"
                        alt="{{ $image->title ?? 'Professional Photographer and Videographer in Riyadh Saudi Arabia' }}"
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index + 1) * 100 }}" />
                </div>
            @empty
                <h3 style="text-align: center; justify-content: center; align-items: center;">No Image available</h3>
            @endforelse
        </div>
    </div>
</section>

<!-- Video Gallery Section -->
<section class="video-gallery-section">
    <div class="container">
        <h2 class="video-gallery-title">
            Event Videography & Corporate Shoot Highlights in Riyadh
        </h2>
        <div class="video-grid">
            @forelse($videos->take(12) as $index => $video)
                <div class="video-wrapper">
                    <div class="video-thumbnail" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" data-video-url="{{ asset($video->media_url) }}">
                        <video muted autoplay loop playsinline preload="metadata">
                            <source src="{{ asset($video->media_url) }}" type="video/mp4">
                        </video>
                        <div class="play-button">
                            <i class="fas fa-play"></i>
                        </div>
                    </div>
                </div>
            @empty
                <div class="video-thumbnail" data-aos="fade-up">
                    <h3 style="text-align: center; justify-content: center; align-items: center;">No Video available</h3>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-5 pt-4">
            <a href="{{ route('inquiry') }}" class="btn-cta" data-aos="fade-up">Get a Free Quote <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Trusted Companies Marquee Section -->
<section class="marquee-section">
    <div class="container-fluid">
        <h3 class="marquee-section-title" data-aos="fade-up">Trusted by Industry Leaders</h3>
        <div class="marquee-container">
            <div class="marquee-content">
                <div class="marquee-item">
                    <img src="{{ asset('frontend/assets/img/logo1.png') }}" alt="Global Events">
                    <span class="marquee-name">Global Events</span>
                </div>
                <div class="marquee-item">
                    <img src="{{ asset('frontend/assets/img/logo2.png') }}" alt="Tech Summit">
                    <span class="marquee-name">Tech Summit</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" alt="Google">
                    <span class="marquee-name">Google</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/IBM_logo.svg" alt="IBM">
                    <span class="marquee-name">IBM</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/96/Microsoft_logo_%282012%29.svg" alt="Microsoft">
                    <span class="marquee-name">Microsoft</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg" alt="Netflix">
                    <span class="marquee-name">Netflix</span>
                </div>
                
                <!-- Repeat for seamless loop -->
                <div class="marquee-item">
                    <img src="{{ asset('frontend/assets/img/logo1.png') }}" alt="Global Events">
                    <span class="marquee-name">Global Events</span>
                </div>
                <div class="marquee-item">
                    <img src="{{ asset('frontend/assets/img/logo2.png') }}" alt="Tech Summit">
                    <span class="marquee-name">Tech Summit</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" alt="Google">
                    <span class="marquee-name">Google</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/IBM_logo.svg" alt="IBM">
                    <span class="marquee-name">IBM</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/96/Microsoft_logo_%282012%29.svg" alt="Microsoft">
                    <span class="marquee-name">Microsoft</span>
                </div>
                <div class="marquee-item">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg" alt="Netflix">
                    <span class="marquee-name">Netflix</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Types of Event Videography Section -->
<section class="services-grid-section pt-5 mt-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h1 class="hero-title" data-aos="fade-up">Types of Event Videography</h1>
            </div>
        </div>
        <div class="trusted-companies-gallery mb-5">
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=400&q=80" alt="Corporate Events">
                    <h5>Corporate Events</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://eventvideographer.com/wp-content/uploads/2025/05/Corporate-events-1-150x150.webp" alt="Concerts">
                    <h5>Concerts</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=400&q=80" alt="Conferences">
                    <h5>Conferences</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=400&q=80" alt="Exhibitions">
                    <h5>Exhibitions</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="500">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=400&q=80" alt="Trade Shows">
                    <h5>Trade Shows</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="600">
                    <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?auto=format&fit=crop&w=400&q=80" alt="Fashion Shows">
                    <h5>Fashion Shows</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="700">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=400&q=80" alt="Local Events">
                    <h5>Local Events</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="800">
                    <img src="https://images.unsplash.com/photo-1504450758481-7338eba7524a?auto=format&fit=crop&w=400&q=80" alt="Sports Events">
                    <h5>Sports Events</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="900">
                    <img src="https://eventvideographer.com/wp-content/uploads/2025/05/private-events-150x150.webp" alt="Private Events">
                    <h5>Private Events</h5>
                </div>
            </div>
            <div class="stagger-wrapper">
                <div class="service-card-grid" data-aos="fade-up" data-aos-delay="1000">
                    <img src="https://eventvideographer.com/wp-content/uploads/2025/05/activation-150x150.webp" alt="Brand Activations">
                    <h5>Brand Activations</h5>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ route('inquiry') }}" class="btn-cta" data-aos="fade-up">Get a Free Quote <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <div class="container">
        <h2 class="contact-form-title">Get a FREE quote</h2>
        <p class="contact-form-subtitle">
            Complete the form below and our team will get back to you with a
            personalized quote within 24 hours.
        </p>
        <div class="contact-form-card">
            <form id="quoteForm" onsubmit="handleSubmit(event)">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Your Name *</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Enter your name"
                                required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Email Address *</label>
                            <input
                                type="email"
                                class="form-control"
                                placeholder="your.email@example.com"
                                required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input
                                type="tel"
                                class="form-control"
                                placeholder="+966 509143463" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Preferred Contact Method</label>
                            <select class="form-control">
                                <option>Email</option>
                                <option>Phone</option>
                                <option>WhatsApp</option>
                                <option>Telegram</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Project Type</label>
                            <select class="form-control">
                                <option>Select project type</option>
                                <option>Web Development</option>
                                <option>Mobile App Development</option>
                                <option>Digital Marketing</option>
                                <option>IT Infrastructure</option>
                                <option>Cloud Solutions</option>
                                <option>Cybersecurity</option>
                                <option>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Project Timeline</label>
                            <select class="form-control">
                                <option>Select timeline</option>
                                <option>1-2 weeks</option>
                                <option>1 month</option>
                                <option>2-3 months</option>
                                <option>3+ months</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Project Description *</label>
                    <textarea
                        class="form-control"
                        rows="5"
                        placeholder="Tell us about your project requirements..."
                        required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Budget (Optional)</label>
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Enter your budget range if available" />
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-cta">
                        <i class="fas fa-paper-plane me-2"></i>Submit Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-lg border-0" style="border-radius: 20px; background: #000; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" aria-label="Close" style="background-color: rgba(0,0,0,0.5); padding: 10px; border-radius: 50%;"></button>
                <div style="background: #000; display: flex; align-items: center; justify-content: center; min-height: 400px;">
                    <video id="modalVideo" controls class="w-100" style="max-height: 85vh; display: block;">
                        <source src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection