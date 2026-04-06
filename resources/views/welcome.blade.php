@extends('layouts.frontend.main')
@section('title', 'Home')
@section('meta')
@endsection
@section('content')


<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="hero-title" data-aos="fade-up">End to end event Videography & Photography for businesses</h1>
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
                        alt="{{ $image->title ?? 'Conference Image' }}"
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
            A Glimpse from our event<br>videography shoots
        </h2>
        <div class="video-grid">
            @forelse($videos->take(12) as $index => $video)
                <div class="video-wrapper">
                    <div class="video-thumbnail" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" data-video-url="{{ asset($video->media_url) }}">
                        <video muted preload="metadata">
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
@endsection