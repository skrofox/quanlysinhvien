$baseDir = "d:\laragon\www\quanlysinhvien\resources\views"
$routesFile = "d:\laragon\www\quanlysinhvien\routes\web.php"

$pages = @(
    @("gioi-thieu", "lich-su-phat-trien", "Lịch sử phát triển"),
    @("gioi-thieu", "su-mang-tam-nhin", "Sứ mạng - tầm nhìn"),
    @("gioi-thieu", "triet-ly-giao-duc", "Triết lý giáo dục"),
    @("gioi-thieu", "dinh-huong-chien-luoc", "Định hướng chiến lược"),
    @("gioi-thieu", "co-cau-to-chuc", "Cơ cấu tổ chức"),
    @("tuyen-sinh", "thong-tin", "Thông tin tuyển sinh"),
    @("tuyen-sinh", "thong-bao", "Thông báo tuyển sinh"),
    @("tuyen-sinh", "phieu-dang-ky", "Phiếu đăng ký xét tuyển"),
    @("dao-tao", "tra-cuu", "Tra cứu điểm - Thời khóa biểu"),
    @("dao-tao", "lo-trinh-hoc", "Lộ trình học"),
    @("phong-ban", "ban-giam-hieu", "Ban giám hiệu"),
    @("phong-ban", "quan-ly-dao-tao", "Phòng quản lý đào tạo - Chất lượng"),
    @("phong-ban", "tong-hop", "Phòng tổng hợp"),
    @("phong-ban", "ke-hoach-tai-chinh", "Phòng kế hoạch - Tài chính"),
    @("phong-ban", "cong-tac-sinh-vien", "Phòng công tác sinh viên - Hợp tác doanh nghiệp"),
    @("phong-ban", "doan-thanh-nien", "Đoàn thanh niên"),
    @("phong-ban", "trung-tam-tuyen-sinh", "Trung tâm tuyển sinh - Truyền thông"),
    @("trung-tam", "tin-hoc-ngoai-ngu", "Trung tâm Tin học - Ngoại ngữ")
)

# Thêm Routes
$routeContent = "`n// CAU HINH ROUTE MENU`n"

foreach ($p in $pages) {
    # p[0] is folder, p[1] is name, p[2] is title
    $dirPath = "$baseDir\$($p[0])"
    # Create directory if not exist
    if (!(Test-Path $dirPath)) {
        New-Item -ItemType Directory -Force -Path $dirPath | Out-Null
    }

    $filePath = "$dirPath\$($p[1]).blade.php"
    $title = $p[2]
    
    $template = @"
@extends('layouts.app')
@section('title', '$title')
@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="bg-blue-700 text-white py-6 px-8">
            <h1 class="text-3xl font-bold">$title</h1>
        </div>
        <div class="p-8">
            <p class="text-gray-700 text-lg">Đang cập nhật nội dung cho trang $title...</p>
        </div>
    </div>
</div>
@endsection
"@
    Set-Content -Path $filePath -Value $template -Encoding UTF8
    
    # Chuẩn bị route string. E.g. Route::view('/gioi-thieu/lich-su-phat-trien', 'gioi-thieu.lich-su-phat-trien')->name('gioi-thieu.lich-su-phat-trien');
    $url = "/$($p[0])/$($p[1])"
    $view = "$($p[0]).$($p[1])"
    $routeName = $view
    $routeContent += "Route::view('$url', '$view')->name('$routeName');`n"
}

Add-Content -Path $routesFile -Value $routeContent -Encoding UTF8

Write-Host "XONG!"
