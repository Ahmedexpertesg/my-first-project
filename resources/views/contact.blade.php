@extends('Layouts.master')

@section('content')
<div class="contact-page pt-100 pb-100">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">تواصل معنا</h2>
            <p class="text-muted">لا تتردد للتواصل من أجل أي استفسار</p>
        </div>

        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="mb-3">قم بمراسلتنا</h4>
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" rows="5" class="form-control" required placeholder="Write your message here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary px-4">Send Message</button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4">
                    <h4 class="mb-3">معلومات التواصل</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2 text-primary"></i>
                            <strong>Address:</strong> Turkey
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2 text-primary"></i>
                            <strong>Phone:</strong> <a href="tel:+905351075057">+90 535 107 50 57</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2 text-primary"></i>
                            <strong>Email:</strong> <a href="mailto:info@osus.com">info@osus.com</a>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-globe me-2 text-primary"></i>
                            <strong>Website:</strong> <a href="https://www.osus.com" target="_blank">www.osus.com</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Optional Google Map -->
        <div class="mt-5">
            <iframe
                src="https://maps.google.com/maps?q=turkey&t=&z=6&ie=UTF8&iwloc=&output=embed"
                width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</div>
@endsection
