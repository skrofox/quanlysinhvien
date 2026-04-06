@extends('.app')

@section('title', 'Thông điệp Hiệu trưởng - Đại học Công nghệ')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Trang chủ</a>
            <span>›</span>
            <a href="#" class="hover:text-blue-600">Giới thiệu</a>
            <span>›</span>
            <span class="text-blue-700 font-medium">Thông điệp Hiệu trưởng</span>
        </div>

        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">
            
            <!-- Header tiêu đề -->
            <div class="bg-gradient-to-r from-blue-700 via-blue-600 to-cyan-500 text-white py-16 px-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight">
                    THÔNG ĐIỆP CỦA HIỆU TRƯỞNG
                </h1>
                <p class="mt-4 text-xl opacity-90">Trường Đại học Công nghệ - Đại học Đà Nẵng</p>
            </div>

            <div class="p-8 md:p-12">
                <div class="flex flex-col lg:flex-row gap-12 items-start">
                    
                    <!-- Ảnh Hiệu trưởng + Thông tin -->
                    <div class="lg:w-5/12 flex-shrink-0">
                        <div class="relative">
                            <img src="https://cdn.tienphong.vn/images/6149ab0c828d30ef9de2bb2d5144851c08d3dfc082d8c93b8ce574d470da099f347d7d08ab2e38fda8686c0e8768cff8fc032dcb64017fa987d6600b9b4d4a5a033b8fcb941f55c032ab92b7ef1080ef/anh-man-hinh-2025-11-17-luc-175446.png.avif" 
                                 alt="Hiệu trưởng Trường Đại học Công nghệ"
                                 class="w-full rounded-2xl shadow-xl object-cover aspect-[4/3]">
                            
                            <!-- Overlay tên -->
                            <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 bg-white shadow-lg rounded-2xl px-8 py-4 text-center">
                                <p class="font-bold text-xl text-blue-900">PGS.TS. Nguyễn Văn A</p>
                                <p class="text-blue-600 font-medium">Hiệu trưởng</p>
                            </div>
                        </div>
                    </div>

                    <!-- Nội dung chính -->
                    <div class="lg:w-7/12 text-gray-700 leading-relaxed text-[17.5px]">
                        
                        <p class="mb-8 text-lg">
                            Kính gửi quý vị phụ huynh, các em học sinh, sinh viên và toàn thể cán bộ, giảng viên Nhà trường,
                        </p>

                        <div class="prose prose-lg max-w-none">
                            <p class="mb-6">
                                Với sứ mệnh đào tạo nguồn nhân lực công nghệ chất lượng cao, sáng tạo và hội nhập quốc tế, 
                                Trường Đại học Công nghệ luôn nỗ lực không ngừng để mang đến môi trường học tập hiện đại, 
                                chương trình đào tạo tiên tiến và cơ hội phát triển tốt nhất cho người học.
                            </p>

                            <p class="mb-6">
                                Trong bối cảnh cách mạng công nghiệp 4.0 và chuyển đổi số mạnh mẽ, Nhà trường cam kết 
                                đồng hành cùng sinh viên phát triển toàn diện cả về kiến thức chuyên môn, kỹ năng thực tiễn 
                                và đạo đức nghề nghiệp.
                            </p>

                            <p class="mb-6">
                                Chúng tôi tin rằng, mỗi sinh viên của Trường Đại học Công nghệ đều là một tài năng tương lai, 
                                sẵn sàng đóng góp cho sự phát triển của đất nước và xã hội.
                            </p>
                        </div>

                        <!-- Quote nổi bật -->
                        <div class="my-12 bg-blue-50 border-l-4 border-blue-600 pl-6 py-6 italic text-blue-800">
                            “Hãy dám nghĩ lớn, học tập không ngừng nghỉ và hành động sáng tạo. 
                            Tương lai thuộc về những người dám thay đổi và dẫn dắt công nghệ.”
                        </div>

                        <div class="mt-16 pt-10 border-t border-gray-200">
                            <p class="italic text-gray-600">Trân trọng cảm ơn và chào mừng tất cả các bạn đã và sẽ đồng hành cùng Nhà trường.</p>
                            
                            <div class="mt-8 flex items-center gap-4">
                                <div>
                                    <p class="font-bold text-2xl text-blue-900">PGS.TS. Nguyễn Văn A</p>
                                    <p class="text-blue-600">Hiệu trưởng</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nút hành động -->
        <div class="mt-10 text-center">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-3 bg-blue-600 hover:bg-blue-700 text-white font-medium px-8 py-4 rounded-2xl transition-all shadow-md hover:shadow-xl">
                <span>Xem thêm về Nhà trường</span>
                <span class="text-xl">→</span>
            </a>
        </div>
    </div>
</div>
@endsection