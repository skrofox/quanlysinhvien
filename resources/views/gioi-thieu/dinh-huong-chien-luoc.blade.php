@extends('.app')

@section('title', 'Định hướng chiến lược - Trường Đại học Công nghệ')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-10">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Trang chủ</a>
            <span>›</span>
            <a href="#" class="hover:text-blue-600">Giới thiệu</a>
            <span>›</span>
            <span class="text-blue-700 font-medium">Định hướng chiến lược</span>
        </div>

        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-700 via-blue-800 to-indigo-700 text-white py-16 px-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight">
                    ĐỊNH HƯỚNG CHIẾN LƯỢC
                </h1>
                <p class="mt-4 text-xl opacity-90">Trường Đại học Công nghệ - Đại học Đà Nẵng</p>
                <p class="mt-2 text-lg opacity-75">Giai đoạn 2025 – 2035</p>
            </div>

            <div class="p-12 md:p-16">

                <!-- Lời mở đầu -->
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Với tầm nhìn trở thành trường đại học công nghệ hàng đầu Việt Nam và có uy tín trong khu vực, 
                        Trường Đại học Công nghệ xác định rõ định hướng chiến lược phát triển bền vững trong giai đoạn tới.
                    </p>
                </div>

                <!-- Các định hướng chính -->
                <div class="grid md:grid-cols-2 gap-10">

                    <!-- Định hướng 1 -->
                    <div class="bg-white border border-gray-100 rounded-3xl p-8 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-blue-100 text-blue-700 rounded-2xl flex items-center justify-center text-4xl">📚</div>
                            <h3 class="text-2xl font-bold text-blue-900">1. Phát triển chương trình đào tạo</h3>
                        </div>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Xây dựng và cập nhật chương trình đào tạo theo chuẩn quốc tế (ABET, AUN-QA)
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Tăng cường các ngành công nghệ cốt lõi: Trí tuệ nhân tạo, An ninh mạng, Công nghệ phần mềm, Khoa học dữ liệu
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Đẩy mạnh đào tạo liên ngành và chương trình chất lượng cao
                            </li>
                        </ul>
                    </div>

                    <!-- Định hướng 2 -->
                    <div class="bg-white border border-gray-100 rounded-3xl p-8 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center text-4xl">🔬</div>
                            <h3 class="text-2xl font-bold text-blue-900">2. Nghiên cứu khoa học &amp; Chuyển giao công nghệ</h3>
                        </div>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Tăng cường nghiên cứu ứng dụng phục vụ doanh nghiệp và địa phương
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Xây dựng các phòng thí nghiệm trọng điểm về AI, IoT và Công nghệ xanh
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Đẩy mạnh hợp tác quốc tế trong nghiên cứu và xuất bản công bố quốc tế
                            </li>
                        </ul>
                    </div>

                    <!-- Định hướng 3 -->
                    <div class="bg-white border border-gray-100 rounded-3xl p-8 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-amber-100 text-amber-700 rounded-2xl flex items-center justify-center text-4xl">🏢</div>
                            <h3 class="text-2xl font-bold text-blue-900">3. Hợp tác doanh nghiệp &amp; Khởi nghiệp</h3>
                        </div>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Mở rộng hợp tác với các tập đoàn công nghệ lớn trong và ngoài nước
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Xây dựng Trung tâm Khởi nghiệp và Đổi mới sáng tạo (Innovation Hub)
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Tăng tỷ lệ sinh viên có việc làm đúng chuyên ngành sau tốt nghiệp lên trên 95%
                            </li>
                        </ul>
                    </div>

                    <!-- Định hướng 4 -->
                    <div class="bg-white border border-gray-100 rounded-3xl p-8 hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-14 h-14 bg-purple-100 text-purple-700 rounded-2xl flex items-center justify-center text-4xl">🌍</div>
                            <h3 class="text-2xl font-bold text-blue-900">4. Hội nhập quốc tế &amp; Phát triển bền vững</h3>
                        </div>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Tăng cường chương trình liên kết quốc tế và trao đổi sinh viên, giảng viên
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Đẩy mạnh chuyển đổi số trong quản lý và giảng dạy
                            </li>
                            <li class="flex gap-3">
                                <span class="text-green-500 mt-1">→</span>
                                Xây dựng trường đại học xanh, thân thiện với môi trường
                            </li>
                        </ul>
                    </div>

                </div>

                <!-- Mục tiêu cụ thể -->
                <div class="mt-20">
                    <h2 class="text-3xl font-bold text-blue-900 text-center mb-10">Mục tiêu chiến lược đến năm 2035</h2>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-3xl p-10">
                        <div class="grid md:grid-cols-2 gap-x-16 gap-y-8 text-gray-700">
                            <div class="flex gap-4">
                                <span class="text-2xl text-blue-600 font-bold">01</span>
                                <div>
                                    <p class="font-semibold">Top 10 trường đại học công nghệ hàng đầu Việt Nam</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="text-2xl text-blue-600 font-bold">02</span>
                                <div>
                                    <p class="font-semibold">Đạt chuẩn kiểm định quốc tế AUN-QA và ABET cho ít nhất 70% chương trình đào tạo</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="text-2xl text-blue-600 font-bold">03</span>
                                <div>
                                    <p class="font-semibold">Tỷ lệ sinh viên có việc làm đúng chuyên ngành đạt trên 95%</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <span class="text-2xl text-blue-600 font-bold">04</span>
                                <div>
                                    <p class="font-semibold">Trở thành trung tâm nghiên cứu và chuyển giao công nghệ khu vực miền Trung</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Phần kết -->
        <div class="mt-12 text-center text-gray-500 italic">
            <p>“Xây dựng một trường đại học công nghệ thông minh – sáng tạo – bền vững”</p>
        </div>
    </div>
</div>
@endsection