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
                <h1 class="hero-title" data-aos="fade-up">End to end event videography for businesses</h1>
                <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">Trusted by event managers for seamless execution and exceptional quality.</p>
                <a
                    href="{{ route('inquiry') }}"
                    class="btn-cta"
                    data-aos="fade-up"
                    data-aos-delay="200">
                    Get a Free Quote <i class="fas fa-arrow-right ms-2"></i>
                </a>
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
                <!-- Fallback images if no images in database -->
                <!-- <img
                    src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                    alt="Conference Presentation"
                    data-aos="fade-up"
                    data-aos-delay="100" /> -->
                <!-- <img
                    src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                    alt="Business Meeting"
                    data-aos="fade-up"
                    data-aos-delay="200" /> -->
                <!-- <img
                    src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                    alt="Professional Speaker"
                    data-aos="fade-up"
                    data-aos-delay="300" /> -->
                <!-- <img
                    src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                    alt="Conference Attendee"
                    data-aos="fade-up"
                    data-aos-delay="400" /> -->
                    <h3 style="text-align: center; justify-content: center; align-items: center;">No Image available</h3>
            @endforelse
        </div>
    </div>
</section>

<!-- Types of Event Videography Section -->
<section class="services-grid-section pt-5 mt-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h2 class="services-grid-title" data-aos="fade-right">
                    Types of<br>Event Videography<br>that we cover
                </h2>
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
            <!-- Second Row -->
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

<!-- Client Logos Section -->
<!-- <section class="client-logos-section">
      <div class="container">
        <p class="client-logos-title">
          We've worked with 100+ companies large & small
        </p>
        <div class="client-logo-grid">
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2021/02/Microsoft-Logo.png"
              alt="Microsoft"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Google-Logo.png"
              alt="Google"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Apple-Logo.png"
              alt="Apple"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Amazon-Logo.png"
              alt="Amazon"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Meta-Logo.png"
              alt="Meta"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Netflix-Logo.png"
              alt="Netflix"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2021/03/Porsche-Logo.png"
              alt="Porsche"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/06/Pepsi-Logo.png"
              alt="PepsiCo"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/IBM-Logo.png"
              alt="IBM"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Oracle-Logo.png"
              alt="Oracle"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Intel-Logo.png"
              alt="Intel"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Adobe-Logo.png"
              alt="Adobe"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Salesforce-Logo.png"
              alt="Salesforce"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Cisco-Logo.png"
              alt="Cisco"
            />
          </div>
          <div class="client-logo">
            <img
              src="https://logos-world.net/wp-content/uploads/2020/04/Dell-Logo.png"
              alt="Dell"
            />
          </div>
        </div>
      </div>
    </section> -->

<!-- Services Grid Section -->
<!-- <section class="services-grid-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h2 class="services-grid-title">
                    Premium Technology Solutions that we offer
                </h2>
            </div>
            <div class="col-lg-8">
                <div class="service-grid">
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Web Development" />
                        <h5>Web Development</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Mobile Apps" />
                        <h5>Mobile App Development</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Digital Marketing" />
                        <h5>Digital Marketing</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Cloud Solutions" />
                        <h5>Cloud Solutions</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Cybersecurity" />
                        <h5>Cybersecurity</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="IT Infrastructure" />
                        <h5>IT Infrastructure</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Database Management" />
                        <h5>Database Management</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="API Development" />
                        <h5>API Development</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="E-commerce" />
                        <h5>E-commerce Solutions</h5>
                    </div>
                    <div class="service-card-grid">
                        <img
                            src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80"
                            alt="Consulting" />
                        <h5>IT Consulting</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- Why Trust Us Section -->
<section class="trust-section">
    <div class="container">
        <h2 class="trust-title">Why companies large and small trust us</h2>
        <p class="trust-subtitle">
            We've earned the trust of our clients through our commitment to
            excellence.
        </p>
        <div class="trust-cards">
            <div class="trust-card" data-aos="fade-up" data-aos-delay="100">
                <div class="trust-icon">
                    <i class="fas fa-award"></i>
                </div>
                <h4>Expert Technology Solutions, Trusted by Top Brands</h4>
                <p>
                    Our team has been trusted by some of the world's leading brands to
                    deliver their most important technology projects, ensuring
                    high-quality solutions and a seamless experience.
                </p>
            </div>
            <div class="trust-card" data-aos="fade-up" data-aos-delay="200">
                <div class="trust-icon">
                    <i class="fas fa-globe"></i>
                </div>
                <h4>Global Reach, Consistent Standards</h4>
                <p>
                    We've partnered with clients to deliver technology solutions across
                    multiple continents, delivering the same high-quality and
                    professional service no matter the location.
                </p>
            </div>
            <div class="trust-card" data-aos="fade-up" data-aos-delay="300">
                <div class="trust-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h4>Fast & Reliable Delivery</h4>
                <p>
                    We understand the importance of deadlines. Our efficient
                    development process ensures your projects are delivered promptly,
                    without compromising on quality.
                </p>
            </div>
            <div class="trust-card" data-aos="fade-up" data-aos-delay="400">
                <div class="trust-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h4>Flexible Solutions & Best Value</h4>
                <p>
                    We offer a range of customizable packages to fit your specific
                    needs and budget, providing exceptional value for your investment.
                </p>
            </div>
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
                <!-- Fallback videos if no videos in database -->
                <div class="video-thumbnail" data-aos="fade-up">
                    <h3 style="text-align: center; justify-content: center; align-items: center;">No Video available</h3>
                </div>
                <!-- <div class="video-thumbnail" data-aos="fade-up" data-aos-delay="100">
                    <img
                        src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Project 2" />
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div> -->
                <!-- <div class="video-thumbnail" data-aos="fade-up" data-aos-delay="200">
                    <img
                        src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Project 3" />
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div> -->
                <!-- <div class="video-thumbnail" data-aos="fade-up" data-aos-delay="300">
                    <img
                        src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Project 4" />
                    <div class="play-button">
                        <i class="fas fa-play"></i>
                    </div>
                </div> -->
            @endforelse
        </div>
        <div class="text-center mt-5 pt-4">
            <a href="{{ route('inquiry') }}" class="btn-cta" data-aos="fade-up">Get a Free Quote <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Steps Section -->
<section class="steps-section">
    <div class="container">
        <h2 class="steps-title">
            Book your event videography<br>shoot in 3 easy steps
        </h2>
        <div class="steps-grid">
            <div class="step-item" data-aos="fade-up" data-aos-delay="100">
                <div class="step-number">1</div>
                <h4>Select and personalize</h4>
                <p>
                    Choose your package or tell us your specific requirements for a
                    custom quote.
                </p>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="200">
                <div class="step-number">2</div>
                <h4>Secure with a deposit</h4>
                <p>
                    Confirm your booking with a small deposit to secure your project
                    timeline and team.
                </p>
            </div>
            <div class="step-item" data-aos="fade-up" data-aos-delay="300">
                <div class="step-number">3</div>
                <h4>Timely delivery</h4>
                <p>
                    Receive your high-quality technology solution within the
                    agreed-upon timeframe.
                </p>
            </div>
        </div>
        <div class="text-center mt-2 pb-5">
            <a href="{{ route('inquiry') }}" class="btn-cta" data-aos="fade-up">Get a Free Quote <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <h2 class="testimonials-title">What our clients say</h2>
        <div class="testimonials-grid">
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">
                    "Tahir Digital Solutions transformed our business with their
                    exceptional web development services. The team was professional,
                    responsive, and delivered beyond our expectations."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">L</div>
                    <div class="testimonial-name">Lisa Anderson</div>
                </div>
            </div>
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">
                    "Their mobile app development expertise helped us launch a
                    successful product. The app is user-friendly, fast, and has
                    exceeded all our performance metrics."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">A</div>
                    <div class="testimonial-name">Ahmed Khan</div>
                </div>
            </div>
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p class="testimonial-text">
                    "Outstanding digital marketing services that significantly
                    increased our online presence and ROI. Highly recommended for any
                    business looking to grow."
                </p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">M</div>
                    <div class="testimonial-name">Maria Garcia</div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('inquiry') }}" class="btn-cta">Get a Free Quote</a>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <div class="container">
        <div class="faq-container">
            <h2 class="faq-title">Frequently asked questions</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question">
                        <span>How do you ensure & assess the developer's skill?</span>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Our developers undergo a rigorous vetting process, including
                        portfolio reviews, skill assessments, and client feedback. We
                        only work with experienced professionals who meet our high
                        standards.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>What if we need to cancel or reschedule?</span>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        We understand that plans can change. Please refer to our
                        cancellation and rescheduling policy outlined in your contract
                        for details on fees and timelines. We strive to be as flexible
                        as possible.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>What are the resolution and many video deliver?</span>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        We deliver projects in various formats and resolutions based on
                        your requirements. Standard deliverables include high-resolution
                        formats suitable for web and mobile platforms.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>Are the audio included in the services I pay?</span>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Yes, audio services are included in our comprehensive packages.
                        We provide full audio integration and optimization as part of
                        our standard service offerings.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question">
                        <span>What are the payment terms?</span>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        Our payment terms are flexible and project-specific. Typically,
                        we require a deposit to begin work, with milestone payments
                        throughout the project and final payment upon completion.
                    </div>
                </div>
            </div>
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