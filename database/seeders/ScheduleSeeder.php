<?php

namespace Database\Seeders;

use App\Models\AcademicBatch;
use App\Models\Schedule;
use App\Models\Semester;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('vi_VN');

        $semesters = Semester::all();
        $batches = AcademicBatch::all();

        if ($semesters->isEmpty() || $batches->isEmpty()) {
            return;
        }

        $scheduleTitles = [
            'Lịch học lý thuyết',
            'Lịch thực hành',
            'Lịch thi kết thúc học phần',
            'Lịch thi bổ sung',
            'Lịch học Giáo dục quốc phòng',
            'Lịch thực tập doanh nghiệp',
            'Lịch bảo vệ đồ án tốt nghiệp',
        ];

        $excelFiles = [
            'lich-hoc-tuan-1.xlsx',
            'lich-hoc-tuan-2.xlsx',
            'lich-thi-ky-1.xlsx',
            'lich-thi-ky-2.xlsx',
            'danh-sach-phong-trong.xlsx',
            'lich-hoc-bo-sung.xlsx',
        ];

        // Tạo khoảng 15-20 lịch học ngẫu nhiên
        for ($i = 0; $i < 20; $i++) {
            $batch = $batches->random();
            $semester = $semesters->random();
            
            $type = $faker->randomElement(['file', 'drive', 'both']);
            $filePath = null;
            $driveLink = null;

            if ($type === 'file' || $type === 'both') {
                $randomFile = $faker->randomElement($excelFiles);
                // Tạo đường dẫn giả: schedules/YYYY/MM/file.xlsx
                $filePath = 'schedules/' . $faker->year . '/' . str_pad($faker->month, 2, '0', STR_PAD_LEFT) . '/' . $randomFile;
            }

            if ($type === 'drive' || $type === 'both') {
                $driveLink = 'https://docs.google.com/spreadsheets/d/' . $faker->regexify('[a-zA-Z0-9_-]{44}');
            }

            Schedule::create([
                'title' => $faker->randomElement($scheduleTitles) . ' - ' . $batch->start_year,
                'file_path' => $filePath,
                'drive_link' => $driveLink,
                'semester_id' => $semester->id,
                'academic_batch_id' => $faker->boolean(80) ? $batch->id : null, // 80% gắn với 1 khóa, 20% là lịch chung
                'is_active' => $faker->boolean(90), // 90% là đang hoạt động
                'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
            ]);
        }
    }
}
