@extends('.app')

@section('title', 'Lộ trình học - Trường Đại học Công nghệ')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-10">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Trang chủ</a>
            <span>›</span>
            <a href="#" class="hover:text-blue-600">Khung chương trình</a>
            <span>›</span>
            <span class="text-blue-700 font-medium">Lộ trình học</span>
        </div>

        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-700 to-cyan-600 text-white py-16 px-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold">LỘ TRÌNH HỌC</h1>
                <p class="mt-4 text-xl opacity-90">Các chương trình đào tạo - Trường Đại học Công nghệ</p>
            </div>

            <div class="p-10 md:p-16">

                <h2 class="text-3xl font-bold text-blue-900 mb-12 flex items-center gap-4">
                    <span class="text-4xl">🏛️</span>
                    Các Khoa chuyên môn
                </h2>

                <!-- Danh sách các Khoa -->
                <div class="space-y-14">

                    <!-- Khoa Công nghệ Thông tin -->
                    <div>
                        <h3 class="font-bold text-2xl text-blue-800 mb-6 border-b border-blue-100 pb-3">
                            Khoa Công nghệ Thông tin
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Công nghệ Thông tin</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Kỹ thuật Phần mềm</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">An ninh mạng</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Trí tuệ nhân tạo</span>
                            </a>
                        </div>
                    </div>

                    <!-- Khoa Kỹ thuật Máy tính -->
                    <div>
                        <h3 class="font-bold text-2xl text-blue-800 mb-6 border-b border-blue-100 pb-3">
                            Khoa Kỹ thuật Máy tính
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Kỹ thuật Máy tính</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Hệ thống nhúng</span>
                            </a>
                        </div>
                    </div>

                    <!-- Khoa Điện - Điện tử -->
                    <div>
                        <h3 class="font-bold text-2xl text-blue-800 mb-6 border-b border-blue-100 pb-3">
                            Khoa Điện - Điện tử
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Kỹ thuật Điện - Điện tử</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Điện tử Viễn thông</span>
                            </a>
                        </div>
                    </div>

                    <!-- Khoa Cơ khí - Tự động hóa -->
                    <div>
                        <h3 class="font-bold text-2xl text-blue-800 mb-6 border-b border-blue-100 pb-3">
                            Khoa Cơ khí - Tự động hóa
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Cơ khí</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Tự động hóa</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Robot và Trí tuệ nhân tạo</span>
                            </a>
                        </div>
                    </div>

                    <!-- Khoa Công nghệ Sinh học và Môi trường -->
                    <div>
                        <h3 class="font-bold text-2xl text-blue-800 mb-6 border-b border-blue-100 pb-3">
                            Khoa Công nghệ Sinh học và Môi trường
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Công nghệ Sinh học</span>
                            </a>
                            <a href="#" class="flex items-center gap-4 p-5 hover:bg-blue-50 rounded-2xl transition-all group">
                                <span class="text-3xl">📁</span>
                                <span class="font-medium text-lg text-gray-700 group-hover:text-blue-700">Công nghệ Môi trường</span>
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Footer note -->
                <div class="mt-16 text-center text-gray-500">
                    <p class="text-base">Click vào từng ngành để xem chi tiết lộ trình học theo từng học kỳ (8 học kỳ).</p>
                    <p class="mt-2 text-sm">Dữ liệu được cập nhật năm 2026.</p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection