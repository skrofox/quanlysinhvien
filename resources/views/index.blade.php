@extends('app')

@section('content')
    <section class="relative w-full h-[600px] bg-gray-900 overflow-hidden" x-data="{
        activeSlide: 0,
        slides: [
            { image: 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80', title: 'Khởi đầu hành trình thanh xuân rực rỡ', subtitle: 'Chào mừng tân sinh viên khóa 2026. Hãy để Đại học Công Nghệ là nơi chắp cánh ước mơ của bạn.', tag: 'TUYỂN SINH 2026' },
            { image: 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80', title: 'Môi trường học tập tiêu chuẩn Quốc tế', subtitle: 'Hệ thống cơ sở vật chất hiện đại, đáp ứng nhu cầu học tập và nghiên cứu 4.0', tag: 'CƠ SỞ VẬT CHẤT' },
            { image: 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80', title: 'Nghiên cứu khoa học & Đổi mới sáng tạo', subtitle: 'Nền tảng vững chắc cho sự phát triển toàn diện, ươm mầm tài năng công nghệ.', tag: 'NGHIÊN CỨU' }
        ],
        init() { setInterval(() => { this.activeSlide = (this.activeSlide + 1) % this.slides.length }, 6000); }
    }">
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0 w-full h-full">

                <div class="absolute inset-0 bg-black/40 z-10"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-900/50 to-transparent z-10">
                </div>

                <img :src="slide.image" class="w-full h-full object-cover select-none">

                <div class="absolute inset-0 z-20 flex items-center">
                    <div class="container mx-auto px-6 w-full">
                        <div class="max-w-3xl transform translate-y-4" x-show="activeSlide === index"
                            x-transition:enter="transition ease-out duration-1000 delay-300"
                            x-transition:enter-start="opacity-0 translate-y-12"
                            x-transition:enter-end="opacity-100 translate-y-0">

                            <span
                                class="inline-block px-4 py-1.5 bg-blue-600 font-bold text-white text-sm uppercase tracking-wider rounded-md mb-6 shadow-md"
                                x-text="slide.tag"></span>
                            <h2 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white mb-6 leading-[1.1]"
                                x-text="slide.title"></h2>
                            <p class="text-xl md:text-2xl text-blue-100 mb-10 font-light" x-text="slide.subtitle"></p>

                            <div class="flex gap-4">
                                <a href="#"
                                    class="inline-flex items-center justify-center bg-white text-blue-900 font-bold px-8 py-4 rounded-full transition-all duration-300 shadow-xl hover:shadow-2xl hover:bg-gray-50 transform hover:-translate-y-1">
                                    Tìm hiểu thêm
                                </a>
                                <a href="{{ route('login') }}"
                                    class="inline-flex items-center justify-center bg-blue-700/80 backdrop-blur-md border border-blue-500/50 hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    Đăng nhập ngay <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- Controls -->
        <button @click="activeSlide = activeSlide === 0 ? slides.length - 1 : activeSlide - 1"
            class="absolute left-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-black/20 border border-white/20 hover:bg-white/20 flex items-center justify-center text-white backdrop-blur-md transition-all z-30 group">
            <svg class="w-8 h-8 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1"
            class="absolute right-6 top-1/2 -translate-y-1/2 w-14 h-14 rounded-full bg-black/20 border border-white/20 hover:bg-white/20 flex items-center justify-center text-white backdrop-blur-md transition-all z-30 group">
            <svg class="w-8 h-8 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Indicators -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex space-x-3 z-30">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index"
                    :class="{
                        'w-10 bg-white': activeSlide === index,
                        'w-3 bg-white/40 hover:bg-white/60': activeSlide !==
                            index
                    }"
                    class="h-3 rounded-full transition-all duration-500 shadow-sm"></button>
            </template>
        </div>
    </section>

    <!-- News Section (Newspaper Layout) -->
    <main class="bg-gray-50 py-20">
        <div class="container mx-auto px-4">
            <div class="flex items-end justify-between mb-10 border-b-2 border-gray-200 pb-4">
                <div>
                    <span class="text-blue-600 font-bold uppercase tracking-widest text-sm mb-2 block">Cập nhật tin
                        tức</span>
                    <h2 class="text-4xl font-extrabold text-gray-900 border-l-8 border-blue-600 pl-4">Tin tức & Sự kiện
                    </h2>
                </div>
                <a href="#"
                    class="hidden sm:flex text-blue-700 hover:text-blue-900 font-bold items-center gap-2 group bg-blue-50 px-5 py-2.5 rounded-full transition-colors">
                    Xem tất cả tin tức
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Left: Big Featured Article -->
                <div class="lg:col-span-8">
                    @if($featuredNews)
                    <article
                        class="group relative overflow-hidden rounded-3xl shadow-lg bg-white hover:shadow-2xl transition-all duration-500 h-full flex flex-col border border-gray-100">
                        <div class="overflow-hidden relative h-[400px]">
                            <img src="{{ $featuredNews->thumbnail ?? 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}"
                                alt="{{ $featuredNews->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-6 left-6 flex gap-2">
                                <span
                                    class="bg-blue-600 text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded shadow-lg backdrop-blur-md">{{ $featuredNews->category->name }}</span>
                                <span
                                    class="bg-red-600 text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded shadow-lg backdrop-blur-md">Nổi bật</span>
                            </div>
                        </div>
                        <div class="p-8 flex-grow flex flex-col justify-between">
                            <div>
                                <div class="flex gap-4 text-sm text-gray-500 font-medium mb-4">
                                    <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg> {{ $featuredNews->published_at ? $featuredNews->published_at->diffForHumans() : $featuredNews->created_at->diffForHumans() }}</span>
                                    <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg> {{ number_format($featuredNews->views) }} lượt xem</span>
                                </div>
                                <h3
                                    class="text-3xl font-extrabold text-gray-900 leading-tight mb-4 group-hover:text-blue-600 transition-colors">
                                    <a href="{{ route('news.show', $featuredNews->slug) }}">{{ $featuredNews->title }}</a>
                                </h3>
                                <p class="text-gray-600 mb-6 text-lg line-clamp-3 leading-relaxed">
                                    {{ $featuredNews->summary }}
                                </p>
                            </div>
                            <div class="pt-6 mt-2 border-t border-gray-100 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name=Admin&background=EBF4FF&color=1E40AF"
                                        alt="Author" class="w-10 h-10 rounded-full">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">Ban Truyền thông</p>
                                        <p class="text-xs text-gray-500">Phòng Công tác SV</p>
                                    </div>
                                </div>
                                <a href="{{ route('news.show', $featuredNews->slug) }}"
                                    class="text-blue-600 hover:text-blue-800 font-bold flex items-center gap-1">
                                    Đọc tiếp <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                    @else
                    <div class="h-full flex items-center justify-center bg-gray-100 rounded-3xl border-2 border-dashed border-gray-300">
                        <p class="text-gray-500">Chưa có tin nổi bật</p>
                    </div>
                    @endif
                </div>

                <!-- Right: List of smaller articles -->
                <div class="lg:col-span-4 flex flex-col gap-6">

                    @foreach($latestNews as $article)
                    <article
                        class="group flex gap-5 bg-white p-4 rounded-2xl shadow border border-gray-100 hover:shadow-xl hover:border-blue-100 transition-all duration-300">
                        <div class="w-32 h-32 flex-shrink-0 overflow-hidden rounded-xl bg-gray-200">
                            <img src="{{ $article->thumbnail ?? 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="text-blue-600 text-xs font-bold uppercase tracking-wider mb-2">{{ $article->category->name }}</span>
                            <h4
                                class="text-lg font-bold text-gray-900 leading-snug group-hover:text-blue-600 transition-colors line-clamp-3 mb-2">
                                <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                            </h4>
                            <div class="text-sm text-gray-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                {{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                    </article>
                    @endforeach

                    <a href="{{ route('news.index') }}"
                        class="bg-white border-2 border-dashed border-gray-300 text-gray-600 font-bold py-4 rounded-2xl hover:border-blue-500 hover:text-blue-600 transition-all duration-300 h-full flex flex-col items-center justify-center">
                        <svg class="w-8 h-8 mb-2 text-gray-400 group-hover:text-blue-500" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14">
                            </path>
                        </svg>
                        Khám phá thêm chuyên mục

                </div>
            </div>
        </div>
    </main>

    <!-- Highlight Banner/CTAs -->
    <section class="bg-blue-900 relative">
        <div class="container mx-auto">
            <div
                class="flex flex-col lg:flex-row shadow-2xl overflow-hidden rounded-t-3xl md:-mt-10 relative z-20 bg-white">
                <div
                    class="w-full lg:w-1/2 p-10 lg:p-16 bg-blue-600 text-white flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute -right-20 -bottom-20 opacity-10">
                        <svg width="300" height="300" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99z" />
                        </svg>
                    </div>
                    <span class="uppercase tracking-widest font-bold text-sm text-blue-200 mb-2">Dành cho Tân sinh
                        viên</span>
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight">Cổng Đăng ký Tuyển sinh Trực tuyến</h2>
                    <p class="text-blue-100 text-lg mb-8">Nhanh chóng, tiện lợi, dễ dàng. Tra cứu thông tin hồ sơ và
                        nhận kết quả trực tiếp qua SMS và Email.</p>
                    <a href="#"
                        class="self-start px-8 py-4 bg-white text-blue-700 font-bold rounded-full shadow-lg hover:shadow-2xl hover:bg-gray-50 transition transform hover:-translate-y-1 inline-flex items-center gap-2">
                        Truy cập ngay <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>
                <div class="w-full lg:w-1/2 p-10 lg:p-16 flex flex-col justify-center bg-gray-50">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-6 border-b-2 border-gray-200 pb-4">Liên kết
                        nhanh hệ thống</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <a href="#"
                            class="flex flex-col p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-500 hover:shadow-md transition group">
                            <span
                                class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </span>
                            <span class="font-bold text-gray-800">Cổng Sinh viên</span>
                            <span class="text-sm text-gray-500">Xem điểm, lịch thi, học phí</span>
                        </a>
                        <a href="#"
                            class="flex flex-col p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-500 hover:shadow-md transition group">
                            <span
                                class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </span>
                            <span class="font-bold text-gray-800">Thư viện số</span>
                            <span class="text-sm text-gray-500">Tài liệu, giáo trình số hóa</span>
                        </a>
                        <a href="#"
                            class="flex flex-col p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-500 hover:shadow-md transition group">
                            <span
                                class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </span>
                            <span class="font-bold text-gray-800">E-Learning</span>
                            <span class="text-sm text-gray-500">Hệ thống học tập trực tuyến</span>
                        </a>
                        <a href="#"
                            class="flex flex-col p-4 bg-white border border-gray-200 rounded-xl hover:border-blue-500 hover:shadow-md transition group">
                            <span
                                class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </span>
                            <span class="font-bold text-gray-800">Email Cấp Trường</span>
                            <span class="text-sm text-gray-500">Hòm thư điện tử nội bộ</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
