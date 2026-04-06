$path = "d:\laragon\www\quanlysinhvien\resources\views\layouts\header.blade.php"
$cnt = Get-Content -Raw -Encoding UTF8 $path

$regexOptions = [System.Text.RegularExpressions.RegexOptions]::Multiline -bor [System.Text.RegularExpressions.RegexOptions]::IgnoreCase

$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Lịch sử phát triển\s*</a>', '<a href="{{ route(''gioi-thieu.lich-su-phat-trien'') }}"$1>Lịch sử phát triển</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Sứ mạng - tầm nhìn\s*</a>', '<a href="{{ route(''gioi-thieu.su-mang-tam-nhin'') }}"$1>Sứ mạng - tầm nhìn</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Triết lý giáo dục\s*</a>', '<a href="{{ route(''gioi-thieu.triet-ly-giao-duc'') }}"$1>Triết lý giáo dục</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Định hướng chiến lược\s*</a>', '<a href="{{ route(''gioi-thieu.dinh-huong-chien-luoc'') }}"$1>Định hướng chiến lược</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Cơ cấu tổ chức\s*</a>', '<a href="{{ route(''gioi-thieu.co-cau-to-chuc'') }}"$1>Cơ cấu tổ chức</a>', $regexOptions)

$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Thông tin tuyển sinh\s*</a>', '<a href="{{ route(''tuyen-sinh.thong-tin'') }}"$1>Thông tin tuyển sinh</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Thông báo tuyển sinh\s*</a>', '<a href="{{ route(''tuyen-sinh.thong-bao'') }}"$1>Thông báo tuyển sinh</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Phiếu đăng ký xét tuyển\s*</a>', '<a href="{{ route(''tuyen-sinh.phieu-dang-ky'') }}"$1>Phiếu đăng ký xét tuyển</a>', $regexOptions)

$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Tra cứu điểm - Thời khóa biểu\s*</a>', '<a href="{{ route(''dao-tao.tra-cuu'') }}"$1>Tra cứu điểm - Thời khóa biểu</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Lộ trình học\s*</a>', '<a href="{{ route(''dao-tao.lo-trinh-hoc'') }}"$1>Lộ trình học</a>', $regexOptions)

$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Ban giám hiệu\s*</a>', '<a href="{{ route(''phong-ban.ban-giam-hieu'') }}"$1>Ban giám hiệu</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Phòng quản lý đào tạo - Chất lượng\s*(<span class="text-gray-400 text-lg">›</span>)\s*</a>', '<a href="{{ route(''phong-ban.quan-ly-dao-tao'') }}"$1>Phòng quản lý đào tạo - Chất lượng`n                                $2</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Phòng tổng hợp\s*(<span class="text-gray-400 text-lg">›</span>)\s*</a>', '<a href="{{ route(''phong-ban.tong-hop'') }}"$1>Phòng tổng hợp`n                                $2</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Phòng kế hoạch - Tài chính\s*(<span class="text-gray-400 text-lg">›</span>)\s*</a>', '<a href="{{ route(''phong-ban.ke-hoach-tai-chinh'') }}"$1>Phòng kế hoạch - Tài chính`n                                $2</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Phòng công tác sinh viên - Hợp tác doanh nghiệp\s*(<span class="text-gray-400 text-lg">›</span>)\s*</a>', '<a href="{{ route(''phong-ban.cong-tac-sinh-vien'') }}"$1>Phòng công tác sinh viên - Hợp tác doanh nghiệp`n                                $2</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Đoàn thanh niên\s*(<span class="text-gray-400 text-lg">›</span>)\s*</a>', '<a href="{{ route(''phong-ban.doan-thanh-nien'') }}"$1>Đoàn thanh niên`n                                $2</a>', $regexOptions)
$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Trung tâm tuyển sinh - Truyền thông\s*(<span class="text-gray-400 text-lg">›</span>)\s*</a>', '<a href="{{ route(''phong-ban.trung-tam-tuyen-sinh'') }}"$1>Trung tâm tuyển sinh - Truyền thông`n                                $2</a>', $regexOptions)

$cnt = [regex]::Replace($cnt, '<a href="#"(\s*class="[^"]*")>\s*Tin học - Ngoại ngữ\s*</a>', '<a href="{{ route(''trung-tam.tin-hoc-ngoai-ngu'') }}"$1>Tin học - Ngoại ngữ</a>', $regexOptions)

Set-Content -Path $path -Value $cnt -Encoding UTF8
Write-Host "Updated!"
