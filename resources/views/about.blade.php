@extends('Layouts.master')

@section('content')
<div class="about-section py-5 bg-light" dir="rtl" style="text-align: right;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">من نحن</h2>
            <p class="text-muted">تعرف على رؤيتنا ورسالتنا وقيمنا</p>
        </div>

        <div class="row align-items-center">
            <!-- Image -->
            <div class="col-md-6 mb-4">
                <img src="https://esystems.com.pg/assets/img/upd/aboutUskey.jpg" alt="About Us" class="img-fluid rounded shadow">
            </div>

            <!-- Text -->
            <div class="col-md-6">
                <h4 class="mb-3">متجر OSUS - وجهتك لكل ما تحتاجه!</h4>
                <p>
                    متجر OSUS هو متجر إلكتروني شامل متخصص في تقديم مجموعة واسعة من المنتجات التي تلبي جميع احتياجات العملاء، بدءًا من الإلكترونيات والأزياء، وصولًا إلى المستلزمات المنزلية والجمال والعناية الشخصية.
                </p>
                <p>
                    نهدف إلى توفير تجربة تسوق إلكتروني سلسة وآمنة وسريعة، مع التركيز على الجودة، الأسعار المناسبة، وخدمة العملاء المميزة.
                </p>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check text-success ms-2"></i> تشكيلة واسعة من المنتجات</li>
                    <li><i class="fas fa-check text-success ms-2"></i> توصيل سريع وآمن</li>
                    <li><i class="fas fa-check text-success ms-2"></i> دعم عملاء متوفر على مدار الساعة</li>
                    <li><i class="fas fa-check text-success ms-2"></i> ضمان الجودة ورضا العملاء</li>
                </ul>
            </div>
        </div>

        <!-- Our Mission & Vision -->
        <div class="row mt-5">
            <div class="col-md-6">
                <h5 class="fw-bold">رؤيتنا</h5>
                <p>
                    أن نكون المنصة الأولى للتسوق الإلكتروني في العالم العربي من حيث التنوع والجودة والموثوقية.
                </p>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold">رسالتنا</h5>
                <p>
                    تزويد العملاء بأفضل تجربة تسوق عبر الإنترنت، من خلال تقديم منتجات عالية الجودة وخدمة ممتازة واهتمام بأدق التفاصيل.
                </p>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center mt-5">
            <a href="{{ route('product') }}" class="btn btn-primary px-4 py-2">تصفح منتجاتنا</a>
        </div>
    </div>
</div>
@endsection
