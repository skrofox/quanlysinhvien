@extends('layouts.app')

@section('title', 'Thông điệp Hiệu trưởng')

@section('content')
    <div class="max-w-5xl mx-auto py-12 px-6">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <!-- Tiêu đề trang -->
            <div class="bg-blue-700 text-white py-8 px-10">
                <h1 class="text-4xl font-bold">Thông điệp của Hiệu trưởng</h1>
            </div>

            <div class="p-10">
                <div class="flex flex-col lg:flex-row gap-10">

                    <!-- Ảnh Hiệu trưởng -->
                    <div class="lg:w-1/3">
                        <img src="{{ asset('images/hieu-truong.jpg') }}"
                             alt="Hiệu trưởng"
                             class="w-full rounded-xl shadow-md">
                        <p class="text-center mt-4 text-lg font-semibold text-blue-900">
                            PGS.TS. Nguyễn Văn A<br>
                            <span class="text-sm font-normal text-gray-600">Hiệu trưởng Trường Đại học Đà Nẵng</span>
                        </p>
                    </div>

                    <!-- Nội dung thông điệp -->
                    <div class="lg:w-2/3 text-gray-700 leading-relaxed text-[17px]">
                        <p class="mb-6">
                            Kính gửi quý vị phụ huynh, các em học sinh, sinh viên và toàn thể cán bộ, giảng viên...
                        </p>

                        <p class="mb-6">
                            <!-- Dán nội dung thông điệp thật vào đây -->
                            Trường Đại học Đà Nẵng với sứ mệnh đào tạo nguồn nhân lực chất lượng cao, luôn nỗ lực không ngừng...
                        </p>

                        <!-- Thêm nhiều đoạn văn nếu cần -->

                        <div class="mt-16 pt-8 border-t border-gray-200">
                            <p class="italic">Trân trọng cảm ơn và chào mừng,</p>
                            <p class="font-bold mt-3 text-xl">Hiệu trưởng</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection