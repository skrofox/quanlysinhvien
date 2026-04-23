@extends('app')

@section('content')
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <section class="relative bg-blue-900 py-24 overflow-hidden">
            <div class="absolute inset-0 opacity-20">
                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
                     class="w-full h-full object-cover" alt="Background">
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/50 to-blue-900/90"></div>
            
            <div class="container mx-auto px-6 relative z-10 text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold text-white mb-6 tracking-tight">Liên hệ với chúng tôi</h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto font-light leading-relaxed">
                    Chúng tôi luôn sẵn sàng lắng nghe và giải đáp mọi thắc mắc của bạn. Hãy kết nối với Đại học Công Nghệ để cùng kiến tạo tương lai.
                </p>
            </div>
        </section>

        <!-- Main Content -->
        <section class="container mx-auto px-6 -mt-16 pb-24 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Contact Info Cards -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Address -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 transform transition hover:-translate-y-1">
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Địa chỉ trụ sở</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Số 123, Đường Công Nghệ, Quận Tri Thức,<br>Thành phố Sáng Tạo, Việt Nam
                        </p>
                    </div>

                    <!-- Phone & Email -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 transform transition hover:-translate-y-1">
                        <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center text-green-600 mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Thông tin liên lạc</h3>
                        <div class="space-y-2">
                            <p class="text-gray-600 flex items-center gap-2">
                                <span class="font-semibold text-gray-900">Hotline:</span> (024) 3.123.4567
                            </p>
                            <p class="text-gray-600 flex items-center gap-2">
                                <span class="font-semibold text-gray-900">Email:</span> lienhe@dhcn.edu.vn
                            </p>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="bg-white p-8 rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 transform transition hover:-translate-y-1">
                        <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-600 mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Giờ làm việc</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Thứ 2 - Thứ 6: 08:00 - 17:00<br>
                            Thứ 7: 08:00 - 12:00
                        </p>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white p-10 md:p-12 rounded-[2rem] shadow-2xl shadow-blue-900/10 border border-gray-100">
                        <div class="mb-10">
                            <h2 class="text-3xl font-black text-gray-900 mb-4 tracking-tight">Gửi tin nhắn cho chúng tôi</h2>
                            <p class="text-gray-500">Chúng tôi sẽ phản hồi yêu cầu của bạn trong vòng 24 giờ làm việc.</p>
                        </div>

                        <form action="#" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Họ và tên</label>
                                    <input type="text" placeholder="Nguyễn Văn A" 
                                           class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700 ml-1">Địa chỉ Email</label>
                                    <input type="email" placeholder="example@email.com" 
                                           class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Chủ đề</label>
                                <select class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none appearance-none">
                                    <option>Tư vấn tuyển sinh</option>
                                    <option>Hỗ trợ đào tạo</option>
                                    <option>Hợp tác doanh nghiệp</option>
                                    <option>Vấn đề kỹ thuật</option>
                                    <option>Khác</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 ml-1">Nội dung tin nhắn</label>
                                <textarea rows="5" placeholder="Nhập nội dung cần trao đổi tại đây..." 
                                          class="w-full px-6 py-4 bg-gray-50 border-2 border-transparent rounded-2xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all outline-none"></textarea>
                            </div>

                            <button type="submit" 
                                    class="w-full py-5 bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold rounded-2xl shadow-lg shadow-blue-600/30 hover:shadow-xl hover:shadow-blue-600/40 transform transition hover:-translate-y-1 active:scale-[0.98]">
                                Gửi yêu cầu ngay
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Map Placeholder -->
            <div class="mt-16 rounded-[2.5rem] overflow-hidden shadow-2xl border-8 border-white">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.8639860443346!2d105.780318414407!3d21.038132792833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab354920c233%3A0x5d0313a3edc8f39!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgLSDEkEhRR0hO!5e0!3m2!1svi!2s!4v1650000000000!5m2!1svi!2s" 
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </div>
@endsection
