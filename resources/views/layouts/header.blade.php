<header class="bg-white shadow-sm sticky top-0 z-50">
    <!-- Top part -->
    <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center space-x-3">
            <div
                class="w-14 h-14 bg-gradient-to-br from-blue-700 to-blue-900 text-white rounded-full flex items-center justify-center font-bold text-2xl shadow-lg ring-4 ring-blue-100">
                QL
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-blue-900 tracking-tight">Đại học Công Nghệ</h1>
                <p class="text-sm text-gray-500 font-semibold uppercase tracking-widest mt-0.5">Hệ thống Quản lý
                    Sinh viên</p>
            </div>
        </div>

        <div class="w-full flex justify-end md:w-auto mt-4 md:mt-0">
            <div class="flex flex-col md:flex-row items-center gap-6 w-full md:w-auto">
                <div class="w-full md:w-[320px]">
                    <form class="relative group" action="#" method="GET">
                        <input type="text" name="q"
                            class="w-full bg-gray-100/80 border-2 border-transparent placeholder-gray-400 text-gray-700 rounded-full py-2.5 pl-6 pr-12 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:bg-white focus:border-blue-500 transition-all duration-300 shadow-sm hover:bg-gray-100"
                            placeholder="Tìm kiếm...">
                        <button type="submit"
                            class="absolute right-1.5 top-1.5 bottom-1.5 px-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full transition-all group-focus-within:bg-blue-700 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-3">
                        @auth
                            {{-- <a href="{{ url('/dashboard') }}"
                                class="font-bold text-blue-800 hover:text-blue-600 transition-colors px-3 py-2 bg-blue-50 rounded-full hover:bg-blue-100">Quản
                                trị</a> --}}
                            <form method="POST" action="{{ route('logout') ?? '#' }}" x-data>
                                @csrf
                                <button type="submit"
                                    class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg font-medium transition-colors text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Đăng xuất
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="font-bold text-gray-700 hover:text-blue-700 transition-colors px-4 py-2.5 rounded-full hover:bg-blue-50 tracking-wide">Đăng
                                nhập</a>

                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <div class="bg-gradient-to-r from-blue-900 to-blue-800 text-white shadow-md">
        <div class="container mx-auto px-4">
            <ul
                class="flex flex-wrap items-center justify-center lg:justify-start text-[15px] font-semibold tracking-wide">
                <li><a href="{{ route('home') }}"
                        class="block py-4 px-5 bg-blue-700/50 border-b-4 border-blue-400 shadow-inner">Trang chủ</a>
                </li>
                <li class="relative group">
                    <a href="#"
                       class="block py-4 px-5 hover:bg-blue-700/50 transition-colors border-b-4 border-transparent hover:border-blue-400">
                        Giới thiệu
                    </a>

                    <!-- Dropdown Menu -->
                    <ul class="absolute left-0 mt-1 w-64 bg-white shadow-lg rounded-md py-2 z-50
                               opacity-0 invisible group-hover:opacity-100 group-hover:visible
                               transition-all duration-200 border border-gray-200">

                        <li>
                            <a href="{{ route('thong-diep-hieu-truong') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Thông điệp Hiệu trưởng
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gioi-thieu.lich-su-phat-trien') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Lịch sử phát triển
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gioi-thieu.su-mang-tam-nhin') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Sứ mạng - tầm nhìn
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gioi-thieu.triet-ly-giao-duc') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Triết lý giáo dục
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gioi-thieu.dinh-huong-chien-luoc') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Định hướng chiến lược
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gioi-thieu.co-cau-to-chuc') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Cơ cấu tổ chức
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="relative group">
                    <a href="#"
                       class="block py-4 px-5 hover:bg-blue-700/50 transition-colors border-b-4 border-transparent hover:border-blue-400">
                        Tuyển sinh
                    </a>

                    <!-- Dropdown Menu -->
                    <ul class="absolute left-0 mt-1 w-64 bg-white shadow-lg rounded-md py-2 z-50
                               opacity-0 invisible group-hover:opacity-100 group-hover:visible
                               transition-all duration-200 border border-gray-200">

                        <li>
                            <a href="{{ route('tuyen-sinh.thong-tin') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Thông tin tuyển sinh
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tuyen-sinh.thong-bao') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Thông báo tuyển sinh
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('tuyen-sinh.phieu-dang-ky') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Phiếu đăng ký xét tuyển
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="relative group">
                    <a href="#"
                       class="block py-4 px-5 hover:bg-blue-700/50 transition-colors border-b-4 border-transparent hover:border-blue-400">
                        Thông tin đào tạo
                    </a>

                    <!-- Dropdown Menu -->
                    <ul class="absolute left-0 mt-1 w-64 bg-white shadow-lg rounded-md py-2 z-50
                               opacity-0 invisible group-hover:opacity-100 group-hover:visible
                               transition-all duration-200 border border-gray-200">

                        <li>
                            <a href="{{ route('dao-tao.tra-cuu') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Tra cứu điểm - Thời khóa biểu
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('dao-tao.lo-trinh-hoc') }}"
                                class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Lộ trình học
                            </a>
                        </li>


                    </ul>
                </li>
                <li class="relative group">
                    <!-- Nút chính (giống "PHONG BAN") -->
                    <a href="#"
                       class="flex items-center gap-1 px-6 py-4 text-white font-medium hover:bg-white/20 transition-colors rounded-full">
                        Phòng ban
                    </a>

                    <!-- Dropdown Menu -->
                    <ul class="absolute left-0 mt-2 w-96 bg-white shadow-xl rounded-lg py-3 z-50
                               opacity-0 invisible group-hover:opacity-100 group-hover:visible
                               transition-all duration-200 border border-gray-100">

                        <li>
                            <a href="{{ route('phong-ban.ban-giam-hieu') }}"
                               class="flex items-center justify-between px-6 py-3.5 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Ban giám hiệu
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('phong-ban.quan-ly-dao-tao') }}"
                               class="flex items-center justify-between px-6 py-3.5 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Phòng quản lý đào tạo - Chất lượng
                                <span class="text-gray-400 text-lg">›</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('phong-ban.tong-hop') }}"
                               class="flex items-center justify-between px-6 py-3.5 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Phòng tổng hợp
                                <span class="text-gray-400 text-lg">›</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('phong-ban.ke-hoach-tai-chinh') }}"
                               class="flex items-center justify-between px-6 py-3.5 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Phòng kế hoạch - Tài chính
                                <span class="text-gray-400 text-lg">›</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('phong-ban.cong-tac-sinh-vien') }}"
                               class="flex items-center justify-between px-6 py-3.5 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Phòng công tác sinh viên - Hợp tác doanh nghiệp
                                <span class="text-gray-400 text-lg">›</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('phong-ban.doan-thanh-nien') }}"
                               class="flex items-center justify-between px-6 py-3.5 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Đoàn thanh niên
                                <span class="text-gray-400 text-lg">›</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('phong-ban.trung-tam-tuyen-sinh') }}"
                               class="flex items-center justify-between px-6 py-3.5 text-gray-800 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Trung tâm tuyển sinh - Truyền thông
                                <span class="text-gray-400 text-lg">›</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="relative group">
                    <a href="#"
                       class="block py-4 px-5 hover:bg-blue-700/50 transition-colors border-b-4 border-transparent hover:border-blue-400">
                        Trung tâm
                    </a>

                    <!-- Dropdown Menu -->
                    <ul class="absolute left-0 mt-1 w-64 bg-white shadow-lg rounded-md py-2 z-50
                               opacity-0 invisible group-hover:opacity-100 group-hover:visible
                               transition-all duration-200 border border-gray-200">

                        <li>
                            <a href="{{ route('trung-tam.tin-hoc-ngoai-ngu') }}"
                               class="block px-5 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-colors">
                                Tin học - Ngoại ngữ
                            </a>
                            </li>


                    </ul>
                </li>
                @if (Auth::user()?->hasRole('giang_vien'))
                    <li><a href="{{ route('giang_vien') }}"
                            class="block py-4 px-5 hover:bg-blue-700/50 transition-colors border-b-4 border-transparent hover:border-blue-400">Giảng
                            viên</a></li>
                @elseif (Auth::user()?->hasRole('sinh_vien'))
                    <li><a href="{{ route('sinh_vien') }}"
                            class="block py-4 px-5 hover:bg-blue-700/50 transition-colors border-b-4 border-transparent hover:border-blue-400">Sinh
                            viên</a></li>
                @endif
                <li><a href="#"
                        class="block py-4 px-5 hover:bg-blue-700/50 transition-colors border-b-4 border-transparent hover:border-blue-400">Liên
                        hệ</a></li>
            </ul>
        </div>
    </div>
</header>
