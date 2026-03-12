@extends('layouts.frontend.main')
@section('title', $gallery->name)
@section('meta')
@endsection

@section('content')
<style>
    :root {
        --primary-purple: #7c3aed;
        --secondary-purple: #a855f7;
        --light-purple: #c4b5fd;
        --dark-purple: #5b21b6;
        --accent-purple: #ede9fe;
        --gradient-primary: linear-gradient(135deg,
                #7c3aed 0%,
                #a855f7 50%,
                #c084fc 100%);
        --gradient-secondary: linear-gradient(135deg, #f3e8ff 0%, #ede9fe 100%);
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "Poppins", "Inter", -apple-system, BlinkMacSystemFont,
            "Segoe UI", Roboto, sans-serif;
        line-height: 1.7;
        color: var(--text-dark);
        background: #ffffff;
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
        background: var(--gradient-primary);
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
        background: var(--gradient-primary);
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
        color: var(--text-dark) !important;
        position: relative;
        transition: all 0.3s ease;
        padding: 12px 20px !important;
        border-radius: 10px;
        margin: 0 5px;
    }

    .nav-link:hover {
        color: var(--primary-purple) !important;
        background: rgba(124, 58, 237, 0.1);
        transform: translateY(-1px);
    }

    .nav-link.active {
        color: var(--primary-purple) !important;
        /* background: rgba(124, 58, 237, 0.15); */
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
        background: var(--gradient-primary);
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

    /* Buttons */
    .btn-primary {
        background: var(--gradient-primary);
        border: none;
        border-radius: 12px;
        padding: 14px 32px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);
    }

    .btn-outline-primary {
        border: 2px solid var(--primary-purple);
        color: var(--primary-purple);
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background: var(--gradient-primary);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.2);
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg,
                rgba(102, 126, 234, 0.15) 0%,
                rgba(118, 75, 162, 0.2) 50%,
                rgba(139, 92, 246, 0.18) 100%);
        min-height: 95vh;
        position: relative;
        display: flex;
        align-items: center;
        overflow: hidden;
        padding: 4rem 0;
        z-index: 10;
    }

    .hero-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url("https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80");
        background-size: cover;
        background-position: center;
        opacity: 0.8;
        z-index: 1;
        animation: backgroundMove 30s ease-in-out infinite;
    }

    @keyframes backgroundMove {

        0%,
        100% {
            transform: scale(1) translateY(0);
        }

        50% {
            transform: scale(1.05) translateY(-10px);
        }
    }

    .hero-section::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 30%,
                rgba(102, 126, 234, 0.25) 0%,
                transparent 60%),
            radial-gradient(circle at 80% 70%,
                rgba(139, 92, 246, 0.2) 0%,
                transparent 60%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        color: white;
    }

    .hero-title {
        font-family: "Playfair Display", serif;
        font-size: 4rem;
        font-weight: 900;
        line-height: 1.2;
        margin-bottom: 1.5rem;
        color: #ffffff;
        text-shadow: 3px 3px 20px rgba(0, 0, 0, 0.8),
            0 0 40px rgba(0, 0, 0, 0.6), 2px 2px 10px rgba(0, 0, 0, 0.9);
        letter-spacing: -0.02em;
    }

    .hero-subtitle {
        font-size: 1.4rem;
        font-weight: 500;
        margin-bottom: 2rem;
        line-height: 1.7;
        color: #ffffff;
        text-shadow: 3px 3px 20px rgba(0, 0, 0, 0.8),
            0 0 40px rgba(0, 0, 0, 0.6), 2px 2px 10px rgba(0, 0, 0, 0.9);
    }

    /* Service Cards */
    .service-card {
        background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
        border-radius: 28px;
        box-shadow: 0 12px 35px rgba(139, 92, 246, 0.1);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
        position: relative;
        height: 100%;
        border: 1px solid rgba(139, 92, 246, 0.08);
    }

    .service-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 28px 28px 0 0;
        margin: 0;
        display: block;
        padding: 0;
    }

    .service-card .card-body {
        padding: 0 !important;
    }

    .service-card .card-body .p-4 {
        padding: 1.5rem !important;
    }

    .service-card .card-body>*:first-child {
        margin-top: 0;
    }

    .service-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(135deg,
                #667eea 0%,
                #764ba2 50%,
                #8b5cf6 100%);
        transform: scaleX(0);
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-card:hover::before {
        transform: scaleX(1);
    }

    .service-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 50px rgba(139, 92, 246, 0.2);
        border-color: rgba(139, 92, 246, 0.2);
    }

    .service-icon {
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg,
                #667eea 0%,
                #764ba2 50%,
                #8b5cf6 100%);
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2.8rem;
        box-shadow: 0 12px 35px rgba(139, 92, 246, 0.4);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .service-card:hover .service-icon {
        transform: scale(1.2) rotate(12deg);
        box-shadow: 0 18px 45px rgba(139, 92, 246, 0.6);
        animation: iconPulse 2s ease-in-out infinite;
    }

    @keyframes iconPulse {

        0%,
        100% {
            box-shadow: 0 18px 45px rgba(139, 92, 246, 0.6);
        }

        50% {
            box-shadow: 0 18px 55px rgba(139, 92, 246, 0.8);
        }
    }

    .section-title {
        font-family: "Playfair Display", serif;
        font-size: 3.2rem;
        font-weight: 900;
        color: #1f2937;
        margin-bottom: 3rem;
        position: relative;
        text-align: center;
        letter-spacing: -0.01em;
        line-height: 1.2;
    }

    .section-title::after {
        content: "";
        position: absolute;
        bottom: -18px;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 6px;
        background: linear-gradient(135deg,
                #667eea 0%,
                #764ba2 50%,
                #8b5cf6 100%);
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
        animation: titleUnderline 3s ease-in-out infinite;
    }

    @keyframes titleUnderline {

        0%,
        100% {
            width: 120px;
            opacity: 0.9;
        }

        50% {
            width: 140px;
            opacity: 1;
        }
    }

    /* Tech Stack */
    .tech-stack {
        background: var(--gradient-secondary);
        border-radius: 15px;
        padding: 2rem;
        margin-top: 2rem;
    }

    .tech-item {
        display: inline-block;
        background: white;
        color: var(--primary-purple);
        padding: 8px 16px;
        border-radius: 25px;
        margin: 5px;
        font-size: 0.9rem;
        font-weight: 600;
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .tech-item:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Process Steps */
    .process-step {
        text-align: center;
        padding: 2rem;
        position: relative;
    }

    .process-number {
        width: 60px;
        height: 60px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 8px 25px rgba(124, 58, 237, 0.3);
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
        color: var(--primary-purple);
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
        color: var(--primary-purple);
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
        color: var(--primary-purple);
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
        background: var(--primary-purple);
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
        color: var(--primary-purple);
        width: 20px;
    }

    /* Enhanced CTA Section Styles */
    .cta-section {
        position: relative;
        overflow: hidden;
    }

    .cta-bg-animation {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .floating-shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .shape-1 {
        width: 80px;
        height: 80px;
        top: 20%;
        left: 10%;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 120px;
        height: 120px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .shape-3 {
        width: 60px;
        height: 60px;
        top: 40%;
        left: 80%;
        animation-delay: 4s;
    }

    .shape-4 {
        width: 100px;
        height: 100px;
        bottom: 20%;
        left: 20%;
        animation-delay: 1s;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
            opacity: 0.7;
        }

        50% {
            transform: translateY(-20px) rotate(180deg);
            opacity: 1;
        }
    }

    .cta-badge {
        display: inline-block;
        margin-bottom: 2rem;
    }

    .badge-text {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 12px 24px;
        border-radius: 50px;
        font-size: 0.95rem;
        font-weight: 600;
        color: white;
        display: inline-flex;
        align-items: center;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
        }
    }

    .cta-title {
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .highlight-text {
        background: linear-gradient(135deg, #ffd700 0%, #ffa500 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }

    .highlight-text::after {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(135deg, #ffd700 0%, #ffa500 100%);
        border-radius: 2px;
        animation: underline-glow 2s ease-in-out infinite alternate;
    }

    @keyframes underline-glow {
        0% {
            box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
        }

        100% {
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.8);
        }
    }

    .cta-subtitle {
        font-size: 1.3rem;
        font-weight: 400;
        line-height: 1.6;
        opacity: 0.95;
        max-width: 800px;
        margin: 0 auto 3rem;
    }

    .cta-buttons {
        display: flex;
        gap: 2rem;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .cta-btn-primary {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        color: var(--primary-purple);
        border: none;
        border-radius: 15px;
        padding: 20px 40px;
        font-weight: 700;
        font-size: 1.1rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 250px;
    }

    .cta-btn-primary::before {
        content: "";
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg,
                transparent,
                rgba(124, 58, 237, 0.1),
                transparent);
        transition: left 0.5s;
    }

    .cta-btn-primary:hover::before {
        left: 100%;
    }

    .cta-btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    }

    .cta-btn-secondary {
        background: transparent;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 18px 38px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 250px;
        backdrop-filter: blur(10px);
    }

    .cta-btn-secondary:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
    }

    .btn-text {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .btn-subtext {
        font-size: 0.85rem;
        font-weight: 500;
        opacity: 0.8;
    }

    .trust-indicators {
        margin-top: 3rem;
    }

    .trust-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        height: 100%;
    }

    .trust-item:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .trust-item i {
        font-size: 2rem;
        color: #ffd700;
        margin-bottom: 1rem;
        animation: bounce 2s infinite;
    }

    .trust-item span {
        font-size: 0.95rem;
        font-weight: 600;
        text-align: center;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-10px);
        }

        60% {
            transform: translateY(-5px);
        }
    }

    /* Typography Enhancements */
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: "Poppins", sans-serif;
        font-weight: 700;
        line-height: 1.3;
    }

    p,
    .lead,
    .card-text {
        font-family: "Poppins", sans-serif;
        font-size: 1.05rem;
        line-height: 1.8;
        color: #4b5563;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
    }

    /* Smooth Scroll Behavior */
    html {
        scroll-behavior: smooth;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .cta-title {
            font-size: 2.5rem;
        }

        .cta-subtitle {
            font-size: 1.1rem;
        }

        .cta-buttons {
            flex-direction: column;
            gap: 1rem;
        }

        .cta-btn-primary,
        .cta-btn-secondary {
            min-width: 100%;
            max-width: 300px;
        }

        .trust-item {
            margin-bottom: 1rem;
        }
    }
</style>
<!-- Hero Background -->
    <style>
        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset("storage/".$gallery->feature_image) }}');
            background-size: cover;
            background-position: center;
            opacity: 0.8;
            z-index: 1;
            animation: backgroundMove 30s ease-in-out infinite;
        }
    </style>
<!-- Hero Section -->
<section class="hero-section mt-5">
    <div class="container mt-5">
        <div class="row">
            <div
                class="col-lg-8 mx-auto text-center hero-content"
                data-aos="zoom-in"
                data-aos-duration="1500">
                <h1 class="hero-title">
                    {{ $gallery->name }}
                </h1>
            </div>
        </div>
    </div>
</section>

<!-- Galleries Section -->
<section class="py-5" style="padding: 6rem 0">
    <div class="container py-5">
        <h1 class="mb-4 text-center">{{ $gallery->name }}</h1>
        <p class="text-center mb-5">{{ $gallery->description ?? '' }}</p>

        <div class="row g-4">
            @foreach($images as $image)
            <div class="col-md-6 col-lg-4">
                <img src="{{ asset('storage/'.$image) }}"
                    style="width:100%;height:250px;object-fit:cover;border-radius:8px;">
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Bootstrap Collapse JS (ensure included in your layout) -->
@endsection