<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Home')</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;900&display=swap"
        rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        :root {
            --primary-color: #df454c;
            --primary-hover: #c93d43;
            --text-dark: #1a1a1a;
            --text-light: #666666;
            --bg-light: #f8f9fa;
            --white: #ffffff;
            --black: #000000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI",
                Roboto, sans-serif;
            line-height: 1.6;
            color: var(--text-dark);
            background: var(--white);
            overflow-x: hidden;
            cursor: none;
        }

        /* Modern Cursor Animation */
        .custom-cursor {
            width: 15px;
            height: 15px;
            background: #8b5cf6;
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 99999;
            transition: transform 0.1s ease-out;
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.6);
            mix-blend-mode: difference;
        }

        .cursor-trail {
            width: 8px;
            height: 8px;
            background: linear-gradient(135deg, #667eea, #8b5cf6);
            border-radius: 50%;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 99998;
            transition: all 0.15s ease-out;
            opacity: 0.7;
        }

        .custom-cursor.hover {
            transform: scale(2);
            background: #667eea;
            box-shadow: 0 0 40px rgba(102, 126, 234, 0.8);
        }

        .custom-cursor.click {
            transform: scale(1.5);
            background: #764ba2;
        }

        * {
            cursor: none !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            border-radius: 4px;
        }

        /* Navigation */
        .navbar {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(124, 58, 237, 0.1);
            box-shadow: 0 2px 20px rgba(124, 58, 237, 0.1);
            transition: all 0.3s ease;
            padding: 5px 0;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.99) !important;
            box-shadow: 0 4px 30px rgba(124, 58, 237, 0.15);
            padding: 0.5rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.8rem;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-right: 3rem;
        }

        .navbar-brand img {
            height: 55px;
            width: auto;
            object-fit: contain;
        }

        .navbar-nav {
            gap: 1px;
        }

        .nav-item {
            margin: 0 2px;
        }

        .nav-link {
            font-weight: 600;
            font-size: 1rem;
            color: #1f2937 !important;
            position: relative;
            transition: all 0.3s ease;
            padding: 12px 20px !important;
            border-radius: 10px;
            margin: 0 5px;
        }

        .nav-link:hover {
            color: #7c3aed !important;
            background: rgba(124, 58, 237, 0.1);
            transform: translateY(-1px);
        }

        .nav-link.active {
            color: #7c3aed !important;
            font-weight: 700;
        }

        .nav-link::after {
            content: "";
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 3px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            border-radius: 2px;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 80%;
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28124, 58, 237, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .btn-cta {
            background: var(--primary-color);
            color: var(--white);
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-cta:hover {
            background: var(--primary-hover);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(223, 69, 76, 0.4);
        }

        /* Hero Section */
        .hero-section {
            padding: 120px 0 80px;
            background: var(--white);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .hero-gallery {
            display: flex;
            gap: 1rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }

        .hero-gallery img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .hero-gallery img:hover {
            transform: scale(1.05);
        }

        /* Trusted Companies Section */
        .trusted-companies-section {
            padding: 100px 0 60px;
            background: var(--white);
        }

        .trusted-companies-gallery {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1.5rem;
            margin-bottom: 3rem;
            position: relative;
        }

        .trusted-companies-gallery img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        /* Column-based Zigzag Stagger Pattern for Images (5 columns) - Desktop Hero */
        .hero-section .stagger-wrapper:nth-child(5n+1),
        .hero-section .stagger-wrapper:nth-child(5n+3),
        .hero-section .stagger-wrapper:nth-child(5n+5) {
            transform: translateY(30px);
        }

        .hero-section .stagger-wrapper:nth-child(5n+2),
        .hero-section .stagger-wrapper:nth-child(5n+4) {
            transform: translateY(-30px);
        }

        /* Remove stagger/zigzag for Services section to match screenshot alignment */
        .services-grid-section .stagger-wrapper {
            transform: none !important;
        }

        /* Column-based Zigzag Stagger Pattern for Videos (4 columns) */
        .video-wrapper:nth-child(4n+1),
        .video-wrapper:nth-child(4n+3) {
            transform: translateY(30px);
        }

        .video-wrapper:nth-child(4n+2),
        .video-wrapper:nth-child(4n+4) {
            transform: translateY(-30px);
        }

        .trusted-companies-gallery img:hover {
            transform: translateY(-8px) scale(1.02) !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .trusted-companies-text {
            text-align: center;
            font-size: 1.1rem;
            color: var(--text-light);
            font-weight: 500;
            letter-spacing: 0.5px;
            margin: 0;
        }

        /* Client Logos Section */
        .client-logos-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .client-logos-title {
            text-align: center;
            font-size: 0.95rem;
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .client-logo-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 2rem;
            align-items: center;
        }

        .client-logo {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 120px;
            filter: grayscale(100%);
            opacity: 0.7;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .client-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .client-logo img {
            max-width: 90%;
            max-height: 60px;
            width: auto;
            height: auto;
            object-fit: contain;
        }

        /* Services Grid Section */
        .services-grid-section {
            padding: 80px 0;
        }

        .services-grid-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 3rem;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1.5rem;
        }

        .service-card-grid {
            background: var(--white);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            height: 250px;
        }

        .service-card-grid:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .service-card-grid img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .service-card-grid h5 {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 24px 20px 15px;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--white);
            margin: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0.4) 60%, transparent 100%);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        /* Why Trust Us Section */
        .trust-section {
            padding: 80px 0;
            background: var(--white);
        }

        .trust-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 1rem;
        }

        .trust-subtitle {
            text-align: center;
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 4rem;
        }

        .trust-cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
        }

        .trust-card {
            text-align: center;
        }

        .trust-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 1.8rem;
        }

        .trust-card h4 {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .trust-card p {
            color: var(--text-light);
            line-height: 1.7;
        }

        /* Video Gallery Section */
        .video-gallery-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .video-gallery-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 3rem;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            align-items: center;
        }

        .video-thumbnail {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        /* Column-based Zigzag Stagger Pattern for Images (5 columns) */
        .stagger-wrapper:nth-child(5n+1),
        .stagger-wrapper:nth-child(5n+3),
        .stagger-wrapper:nth-child(5n+5) {
            transform: translateY(30px);
        }

        .stagger-wrapper:nth-child(5n+2),
        .stagger-wrapper:nth-child(5n+4) {
            transform: translateY(-30px);
        }

        /* Column-based Zigzag Stagger Pattern for Videos (4 columns) */
        .video-wrapper:nth-child(4n+1),
        .video-wrapper:nth-child(4n+3) {
            transform: translateY(30px);
        }

        .video-wrapper:nth-child(4n+2),
        .video-wrapper:nth-child(4n+4) {
            transform: translateY(-30px);
        }

        /* Zigzag effect for Services/Events Gallery - Checkerboard pattern */
        .services-grid-section .stagger-wrapper:nth-child(odd) {
            transform: translateY(30px);
        }

        .services-grid-section .stagger-wrapper:nth-child(even) {
            transform: translateY(-30px);
        }

        /* Responsive Mobile Overrides (3 columns) */
        @media (max-width: 768px) {
            .trusted-companies-gallery,
            .video-grid {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 1rem !important;
            }

            .trusted-companies-gallery img,
            .video-thumbnail img,
            .video-thumbnail video,
            .service-card-grid img {
                height: 150px !important;
            }

            /* Reset desktop staggers */
            .stagger-wrapper, .video-wrapper {
                transform: none !important;
            }

            /* 3-Column Stagger Pattern (Down-Up-Down) */
            .stagger-wrapper:nth-child(3n+1),
            .stagger-wrapper:nth-child(3n+3),
            .video-wrapper:nth-child(3n+1),
            .video-wrapper:nth-child(3n+3) {
                transform: translateY(20px) !important;
            }

            .stagger-wrapper:nth-child(3n+2),
            .video-wrapper:nth-child(3n+2) {
                transform: translateY(-20px) !important;
            }
        }

        .video-thumbnail:hover {
            transform: scale(1.03) translateY(-8px) !important;
        }

        .video-thumbnail img,
        .video-thumbnail video {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .video-thumbnail video {
            pointer-events: none;
        }

        .play-button {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Steps Section */
        .steps-section {
            padding: 80px 0;
            background: var(--black);
            color: var(--white);
        }

        .steps-title {
            font-size: 3rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 4rem;
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3rem;
        }

        .step-item {
            text-align: center;
        }

        .step-number {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0 auto 1.5rem;
        }

        .step-item h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .step-item p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.7;
        }

        /* Testimonials Section */
        .testimonials-section {
            padding: 80px 0;
            background: var(--white);
        }

        .testimonials-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 4rem;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .testimonial-card {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .testimonial-stars {
            color: #7c3aed;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .testimonial-text {
            color: var(--text-dark);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 700;
            font-size: 1.2rem;
        }

        .testimonial-name {
            font-weight: 600;
            color: var(--text-dark);
        }

        /* FAQ Section */
        .faq-section {
            padding: 80px 0;
            background: var(--bg-light);
        }

        .faq-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 4rem;
            align-items: start;
        }

        .faq-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .faq-item {
            background: var(--white);
            border-radius: 8px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .faq-question {
            padding: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
        }

        .faq-question:hover {
            background: var(--bg-light);
        }

        .faq-answer {
            padding: 0 1.5rem 1.5rem;
            color: var(--text-light);
            line-height: 1.7;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .faq-icon {
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
        }

        /* Contact Form Section */
        .contact-form-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9ff 0%, #f0f4ff 50%, #ede9fe 100%);
            position: relative;
            overflow: hidden;
        }

        .contact-form-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 30%, rgba(124, 58, 237, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(168, 85, 247, 0.08) 0%, transparent 50%);
            z-index: 0;
        }

        .contact-form-section .container {
            position: relative;
            z-index: 1;
        }

        .contact-form-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 1rem;
            position: relative;
        }

        .contact-form-subtitle {
            text-align: center;
            color: var(--text-light);
            margin-bottom: 3rem;
            font-size: 1.1rem;
        }

        .contact-form-card {
            background: var(--white);
            border-radius: 24px;
            padding: 3.5rem;
            box-shadow: 0 12px 40px rgba(124, 58, 237, 0.15);
            max-width: 900px;
            margin: 0 auto;
            border: 2px solid rgba(124, 58, 237, 0.1);
            position: relative;
            overflow: hidden;
        }

        .contact-form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.75rem;
            display: block;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e5e5e5;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: "Poppins", sans-serif;
            background: #fafafa;
        }

        .form-control:focus {
            outline: none;
            border-color: #7c3aed;
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
        }

        .form-control::placeholder {
            color: #999;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }

        .radio-group {
            display: flex;
            gap: 2rem;
            margin-top: 0.5rem;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2.5rem;
            justify-content: center;
        }

        .form-buttons .btn-cta {
            padding: 14px 40px;
            font-size: 1rem;
            border-radius: 10px;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg,
                    #1a1a2e 0%,
                    #16213e 50%,
                    #0f3460 100%);
            color: white;
            padding: 3rem 0 2rem;
            /* margin-top: 2rem; */
        }

        .footer-content {
            margin-bottom: 2rem;
        }

        .footer h5,
        .footer h6 {
            color: #7c3aed;
            font-weight: 700;
            margin-bottom: 2rem;
            font-size: 1.3rem;
        }

        .footer h6 {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .footer p,
        .footer li {
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .footer a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer a:hover {
            color: #7c3aed;
            transform: translateX(5px);
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 1rem;
            position: relative;
            padding-left: 1.5rem;
        }

        .footer ul li:before {
            content: "→";
            color: #7c3aed;
            position: absolute;
            left: 0;
            font-weight: bold;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            background: rgba(124, 58, 237, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 2px solid rgba(124, 58, 237, 0.3);
            margin-right: 0;
        }

        .social-links a:hover {
            background: #7c3aed;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(124, 58, 237, 0.4);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin-top: 3rem;
            padding-top: 2rem;
        }

        .footer-bottom p {
            margin: 0;
            color: rgba(255, 255, 255, 0.7);
        }

        .contact-info {
            margin-bottom: 1rem;
        }

        .contact-info i {
            color: #7c3aed;
            width: 20px;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .service-grid {
                grid-template-columns: repeat(4, 1fr);
            }

            .client-logo-grid {
                grid-template-columns: repeat(5, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .service-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .client-logo-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 1.5rem;
            }

            .client-logo {
                height: 100px;
                padding: 1rem;
            }

            .client-logo img {
                max-height: 50px;
            }

            .trust-cards {
                grid-template-columns: repeat(2, 1fr);
            }

            .steps-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .video-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .video-thumbnail:nth-child(2n+1) {
                transform: translateY(-25px);
            }

            .video-thumbnail:nth-child(2n+2) {
                transform: translateY(25px);
            }

            .faq-container {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .trusted-companies-gallery {
                gap: 1rem;
            }

            .trusted-companies-gallery img {
                width: 140px;
                height: 200px;
            }

            .trusted-companies-gallery img:nth-child(1),
            .trusted-companies-gallery img:nth-child(3),
            .trusted-companies-gallery img:nth-child(5) {
                transform: translateY(-25px);
            }

            .trusted-companies-gallery img:nth-child(2),
            .trusted-companies-gallery img:nth-child(4) {
                transform: translateY(25px);
            }

            .trusted-companies-text {
                font-size: 0.95rem;
            }

            .service-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .client-logo-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 1rem;
            }

            .client-logo {
                height: 90px;
                padding: 0.8rem;
            }

            .client-logo img {
                max-height: 40px;
            }

            .trust-cards,
            .steps-grid,
            .testimonials-grid,
            .video-grid {
                grid-template-columns: 1fr;
            }

            .video-thumbnail:nth-child(n) {
                transform: translateY(0);
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .contact-form-card {
                padding: 2rem;
            }
        }

        @media (max-width: 576px) {
            .trusted-companies-gallery {
                gap: 0.8rem;
            }

            .trusted-companies-gallery img {
                width: 110px;
                height: 160px;
            }

            .trusted-companies-gallery img:nth-child(1),
            .trusted-companies-gallery img:nth-child(3),
            .trusted-companies-gallery img:nth-child(5) {
                transform: translateY(-20px);
            }

            .trusted-companies-gallery img:nth-child(2),
            .trusted-companies-gallery img:nth-child(4) {
                transform: translateY(20px);
            }

            .trusted-companies-text {
                font-size: 0.9rem;
                padding: 0 1rem;
            }

            .client-logo-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .client-logo {
                height: 80px;
            }

            .client-logo img {
                max-height: 35px;
            }
        }
    </style>
</head>

<body>
    <!-- Modern Cursor -->
    <div class="custom-cursor"></div>
    <div class="cursor-trail"></div>

    @include('layouts.frontend.header')

    @yield('content')
    

    @include('layouts.frontend.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true,
            easing: "ease-out",
        });

        // Modern Cursor Animation
        const cursor = document.querySelector(".custom-cursor");
        const trail = document.querySelector(".cursor-trail");
        let mouseX = 0,
            mouseY = 0;
        let cursorX = 0,
            cursorY = 0;
        let trailX = 0,
            trailY = 0;

        document.addEventListener("mousemove", (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;

            requestAnimationFrame(() => {
                cursorX += (mouseX - cursorX) * 0.5;
                cursorY += (mouseY - cursorY) * 0.5;

                trailX += (mouseX - trailX) * 0.15;
                trailY += (mouseY - trailY) * 0.15;

                cursor.style.left = cursorX + "px";
                cursor.style.top = cursorY + "px";

                trail.style.left = trailX + "px";
                trail.style.top = trailY + "px";
            });
        });

        // Hover effects
        const hoverElements = document.querySelectorAll(
            "a, button, .btn-cta, input, textarea, select, .service-card-grid, .video-thumbnail, .navbar-brand"
        );
        hoverElements.forEach((el) => {
            el.addEventListener("mouseenter", () => cursor.classList.add("hover"));
            el.addEventListener("mouseleave", () =>
                cursor.classList.remove("hover")
            );
        });

        // Click effect
        document.addEventListener("mousedown", () =>
            cursor.classList.add("click")
        );
        document.addEventListener("mouseup", () =>
            cursor.classList.remove("click")
        );

        // FAQ Accordion
        document.querySelectorAll(".faq-question").forEach((question) => {
            question.addEventListener("click", () => {
                const item = question.parentElement;
                const isActive = item.classList.contains("active");

                // Close all FAQ items
                document.querySelectorAll(".faq-item").forEach((i) => {
                    i.classList.remove("active");
                });

                // Open clicked item if it wasn't active
                if (!isActive) {
                    item.classList.add("active");
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener("scroll", function() {
            const navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });

        // Form submission handler
        function handleSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            // Show success message
            alert(
                "Thank you for your request! We'll get back to you within 24 hours."
            );

            // Optionally redirect or reset form
            form.reset();

            // You can also send the form data to your backend here
            // fetch('your-backend-url', { method: 'POST', body: formData })
        }

        // Video thumbnail click handler
        document.querySelectorAll('.video-thumbnail').forEach(thumbnail => {
            const video = thumbnail.querySelector('video');
            const videoUrl = thumbnail.getAttribute('data-video-url');
            
            if (video || videoUrl) {
                thumbnail.addEventListener('click', function() {
                    if (video) {
                        // If video element exists, toggle play/pause
                        if (video.paused) {
                            video.play();
                            video.muted = false;
                            thumbnail.querySelector('.play-button').style.display = 'none';
                        } else {
                            video.pause();
                            thumbnail.querySelector('.play-button').style.display = 'flex';
                        }
                    } else if (videoUrl) {
                        // Open video in new window or modal
                        window.open(videoUrl, '_blank');
                    }
                });
            }
        });
    </script>
</body>

</html>