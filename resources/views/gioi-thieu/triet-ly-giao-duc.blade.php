@extends('.app')

@section('title', 'Triết lý giáo dục - Trường Đại học Công nghệ')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-10">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Trang chủ</a>
            <span>›</span>
            <a href="#" class="hover:text-blue-600">Giới thiệu</a>
            <span>›</span>
            <span class="text-blue-700 font-medium">Triết lý giáo dục</span>
        </div>

        <div class="bg-white shadow-2xl rounded-3xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-700 via-indigo-600 to-purple-600 text-white py-16 px-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight">
                    TRIẾT LÝ GIÁO DỤC
                </h1>
                <p class="mt-4 text-xl opacity-90">Trường Đại học Công nghệ - Đại học Đà Nẵng</p>
            </div>

            <div class="p-12 md:p-16">

                <!-- Triết lý chính -->
                <div class="max-w-4xl mx-auto text-center mb-16">
                    <div class="inline-block bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 text-2xl font-medium px-10 py-6 rounded-3xl mb-10">
                        “Học để sáng tạo – Học để phụng sự – Học để dẫn dắt tương lai”
                    </div>
                </div>

                <div class="grid md:grid-cols-12 gap-12 items-center">
                    
                    <!-- Phần trái: Nội dung -->
                    <div class="md:col-span-7 space-y-12">

                        <div>
                            <h2 class="text-2xl font-bold text-blue-900 mb-5 flex items-center gap-3">
                                <span class="text-4xl">🎯</span>
                                Tầm nhìn giáo dục
                            </h2>
                            <p class="text-gray-700 leading-relaxed text-[17.5px]">
                                Chúng tôi tin rằng giáo dục không chỉ là truyền đạt kiến thức, mà là khơi dậy tiềm năng sáng tạo, 
                                rèn luyện nhân cách và trang bị cho người học khả năng thích ứng và dẫn dắt sự thay đổi của xã hội công nghệ tương lai.
                            </p>
                        </div>

                        <div>
                            <h2 class="text-2xl font-bold text-blue-900 mb-5 flex items-center gap-3">
                                <span class="text-4xl">🌱</span>
                                Nguyên tắc cốt lõi
                            </h2>
                            <div class="space-y-8">
                                <div class="flex gap-5">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center font-bold">1</div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Kết hợp hài hòa giữa lý thuyết và thực tiễn</h3>
                                        <p class="text-gray-600 mt-1">Sinh viên được học tập trong môi trường thực hành hiện đại, gắn liền với doanh nghiệp ngay từ năm thứ nhất.</p>
                                    </div>
                                </div>

                                <div class="flex gap-5">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center font-bold">2</div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Khuyến khích tư duy sáng tạo và đổi mới</h3>
                                        <p class="text-gray-600 mt-1">Phát triển tư duy phản biện, khả năng giải quyết vấn đề và tinh thần khởi nghiệp công nghệ.</p>
                                    </div>
                                </div>

                                <div class="flex gap-5">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-700 rounded-xl flex items-center justify-center font-bold">3</div>
                                    <div>
                                        <h3 class="font-semibold text-lg">Giáo dục toàn diện con người</h3>
                                        <p class="text-gray-600 mt-1">Kết hợp đào tạo chuyên môn sâu với giáo dục đạo đức, kỹ năng mềm và trách nhiệm xã hội.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Phần phải: Hình ảnh + Trích dẫn -->
                    <div class="md:col-span-5">
                        <div class="sticky top-8">
                            <img src="data:image/jpeg;base64,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" 
                                 alt="Triết lý giáo dục Trường Đại học Công nghệ"
                                 class="rounded-3xl shadow-2xl w-full">

                            <div class="mt-8 bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-3xl border border-blue-100">
                                <p class="italic text-blue-800 text-lg leading-relaxed">
                                    “Chúng tôi không chỉ dạy sinh viên cách sử dụng công nghệ, mà còn dạy họ cách tạo ra công nghệ mới và sử dụng công nghệ một cách có trách nhiệm vì lợi ích của nhân loại.”
                                </p>
                                <p class="mt-6 text-right font-medium text-blue-900">
                                    — Ban Giám hiệu Trường Đại học Công nghệ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Phần cuối - Cam kết -->
                <div class="mt-20 pt-12 border-t border-gray-200">
                    <h2 class="text-3xl font-bold text-center text-blue-900 mb-10">Cam kết của chúng tôi</h2>
                    
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center p-8 bg-white border border-gray-100 rounded-3xl hover:border-blue-200 transition-colors">
                            <div class="mx-auto w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-4xl mb-6">📚</div>
                            <h3 class="font-semibold mb-3">Chất lượng đào tạo</h3>
                            <p class="text-gray-600">Chương trình đào tạo theo chuẩn quốc tế, cập nhật liên tục theo nhu cầu thực tế của cách mạng 4.0.</p>
                        </div>

                        <div class="text-center p-8 bg-white border border-gray-100 rounded-3xl hover:border-blue-200 transition-colors">
                            <div class="mx-auto w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-4xl mb-6">👥</div>
                            <h3 class="font-semibold mb-3">Người học làm trung tâm</h3>
                            <p class="text-gray-600">Mọi hoạt động của Nhà trường đều hướng đến sự phát triển toàn diện và thành công của sinh viên.</p>
                        </div>

                        <div class="text-center p-8 bg-white border border-gray-100 rounded-3xl hover:border-blue-200 transition-colors">
                            <div class="mx-auto w-16 h-16 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center text-4xl mb-6">🌍</div>
                            <h3 class="font-semibold mb-3">Hội nhập quốc tế</h3>
                            <p class="text-gray-600">Hợp tác chặt chẽ với các trường đại học và doanh nghiệp công nghệ hàng đầu thế giới.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection