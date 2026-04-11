<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();
        if (!$admin) {
            $admin = User::factory()->create(['name' => 'Admin']);
        }

        $categories = [
            ['name' => 'Thông báo', 'slug' => 'thong-bao'],
            ['name' => 'Đào tạo', 'slug' => 'dao-tao'],
            ['name' => 'Sự kiện', 'slug' => 'su-kien'],
        ];

        foreach ($categories as $cat) {
            NewsCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        $catThongBao = NewsCategory::where('slug', 'thong-bao')->first();
        $catDaoTao = NewsCategory::where('slug', 'dao-tao')->first();
        $catSuKien = NewsCategory::where('slug', 'su-kien')->first();

        $news = [
            [
                'title' => 'Lễ trao bằng tốt nghiệp đợt 1 năm 2026: Trọng thể và đầy cảm xúc',
                'slug' => Str::slug('Lễ trao bằng tốt nghiệp đợt 1 năm 2026'),
                'summary' => 'Sáng ngày 20/03/2026, Trường Đại học Công Nghệ đã tổ chức Lễ Bế giảng và trao bằng tốt nghiệp cho gần 2000 Tân Cử nhân, Kỹ sư.',
                'content' => '<p>Sáng ngày 20/03/2026, Trường Đại học Công Nghệ đã tổ chức Lễ Bế giảng và trao bằng tốt nghiệp cho gần 2000 Tân Cử nhân, Kỹ sư. Buổi lễ đã để lại nhiều ấn tượng sâu sắc và kỳ vọng về một thế hệ tương lai tri thức cao.</p><p>Tại buổi lễ, Hiệu trưởng nhà trường đã gửi lời chúc mừng đến các tân cử nhân và nhấn mạnh tầm quan trọng của việc học tập suốt đời.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
                'category_id' => $catSuKien->id,
                'user_id' => $admin->id,
                'is_featured' => true,
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Hội thảo quốc tế về Trí tuệ nhân tạo và Ứng dụng thực tiễn',
                'slug' => Str::slug('Hội thảo quốc tế về Trí tuệ nhân tạo và Ứng dụng thực tiễn'),
                'summary' => 'Hội thảo quy tụ nhiều chuyên gia hàng đầu trong lĩnh vực AI đến từ các trường đại học và viện nghiên cứu danh tiếng trên thế giới.',
                'content' => '<p>Hội thảo quy tụ nhiều chuyên gia hàng đầu trong lĩnh vực AI đến từ các trường đại học và viện nghiên cứu danh tiếng trên thế giới. Đây là cơ hội để sinh viên tiếp cận với các công nghệ mới nhất.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'category_id' => $catDaoTao->id,
                'user_id' => $admin->id,
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Cuộc thi Khởi nghiệp sinh viên: Cơ hội nhận đầu tư lên tới 500 triệu đồng',
                'slug' => Str::slug('Cuộc thi Khởi nghiệp sinh viên'),
                'summary' => 'Cuộc thi nhằm tìm kiếm và hỗ trợ các ý tưởng khởi nghiệp sáng tạo của sinh viên, đặc biệt là trong lĩnh vực công nghệ.',
                'content' => '<p>Cuộc thi nhằm tìm kiếm và hỗ trợ các ý tưởng khởi nghiệp sáng tạo của sinh viên, đặc biệt là trong lĩnh vực công nghệ. Ban giám khảo là những nhà đầu tư và doanh nhân thành đạt.</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'category_id' => $catThongBao->id,
                'user_id' => $admin->id,
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Phát động Chiến dịch Mùa hè xanh 2026 cùng hàng ngàn phần quà hấp dẫn',
                'slug' => Str::slug('Phát động Chiến dịch Mùa hè xanh 2026'),
                'summary' => 'Chiến dịch Mùa hè xanh năm nay sẽ tập trung vào các hoạt động bảo vệ môi trường và hỗ trợ đồng bào vùng sâu vùng xa.',
                'content' => '<p>Chiến dịch Mùa hè xanh năm nay sẽ tập trung vào các hoạt động bảo vệ môi trường và hỗ trợ đồng bào vùng sâu vùng xa. Hãy cùng tham gia để có một mùa hè ý nghĩa!</p>',
                'thumbnail' => 'https://images.unsplash.com/photo-1577412647305-991150c7d163?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                'category_id' => $catSuKien->id,
                'user_id' => $admin->id,
                'is_featured' => false,
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($news as $n) {
            News::updateOrCreate(['slug' => $n['slug']], $n);
        }
    }
}
