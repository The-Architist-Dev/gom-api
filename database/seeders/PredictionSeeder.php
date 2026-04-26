<?php

namespace Database\Seeders;

use App\Models\Prediction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PredictionSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Prediction::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Map user by free_predictions_used → how many predictions to seed
        // Only seed predictions for users who have actually analyzed (free_used > 0)
        $users = User::all();
        if ($users->isEmpty()) return;

        $samples = [
            [
                'final_prediction' => 'Gốm Bát Tràng',
                'country'          => 'Việt Nam',
                'era'              => 'Thế kỷ 17-18',
                'confidence'       => 0.91,
                'image'            => 'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Gốm Bát Tràng', 'confidence' => 0.93, 'reasoning' => 'Men ngọc đặc trưng, hoa văn rồng phượng thời Lê Trung Hưng.'],
                    ['name' => 'Art Historian', 'verdict' => 'Gốm Bát Tràng', 'confidence' => 0.89, 'reasoning' => 'Phong cách trang trí phù hợp với đồ gốm xuất khẩu thế kỷ 17.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Gốm Bát Tràng', 'confidence' => 0.94, 'reasoning' => 'Thành phần đất sét và men phù hợp với nguyên liệu vùng Gia Lâm, Hà Nội.'],
                ],
            ],
            [
                'final_prediction' => 'Sứ Cảnh Đức Trấn',
                'country'          => 'Trung Quốc',
                'era'              => 'Triều Minh',
                'confidence'       => 0.87,
                'image'            => 'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Sứ Cảnh Đức Trấn', 'confidence' => 0.85, 'reasoning' => 'Hoa văn hoa lam kép điển hình thời Minh, nét vẽ sắc bén.'],
                    ['name' => 'Art Historian', 'verdict' => 'Sứ Cảnh Đức Trấn', 'confidence' => 0.90, 'reasoning' => 'Phong cách bố cục đặc trưng lò Quan Diêu thời Vĩnh Lạc.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Cảnh Đức Trấn (Không rõ lò)', 'confidence' => 0.82, 'reasoning' => 'Men trắng trong, độ nung cao nhưng cần phân tích thêm.'],
                ],
            ],
            [
                'final_prediction' => 'Gốm Raku Nhật Bản',
                'country'          => 'Nhật Bản',
                'era'              => 'Thời Edo (1603-1868)',
                'confidence'       => 0.78,
                'image'            => 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Gốm Raku', 'confidence' => 0.82, 'reasoning' => 'Kỹ thuật nung tay nhanh tạo bề mặt không đều đặc trưng phong cách Raku.'],
                    ['name' => 'Art Historian', 'verdict' => 'Gốm Raku', 'confidence' => 0.75, 'reasoning' => 'Hình dáng bát trà thể hiện triết lý wabi-sabi của trà đạo Rikyu.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Gốm Shigaraki hoặc Raku', 'confidence' => 0.71, 'reasoning' => 'Đất sét thô, nhiều hạt cát, cần phân tích hóa học để phân biệt.'],
                ],
            ],
            [
                'final_prediction' => 'Gốm Celadon Goryeo',
                'country'          => 'Hàn Quốc',
                'era'              => 'Thời Goryeo (918-1392)',
                'confidence'       => 0.94,
                'image'            => 'https://images.unsplash.com/photo-1612196808214-b7e239e5f6d1?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Celadon Goryeo', 'confidence' => 0.96, 'reasoning' => 'Kỹ thuật khảm sanggam độc nhất vô nhị, hoa văn mây và hạc điển hình.'],
                    ['name' => 'Art Historian', 'verdict' => 'Celadon Goryeo', 'confidence' => 0.93, 'reasoning' => 'Màu men xanh ngọc bích đặc trưng thời Goryeo trung kỳ thế kỷ 12.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Celadon Goryeo', 'confidence' => 0.95, 'reasoning' => 'Hàm lượng sắt trong men tạo màu celadon đặc trưng lò Gangjin.'],
                ],
            ],
            [
                'final_prediction' => 'Gốm Iznik Ottoman',
                'country'          => 'Thổ Nhĩ Kỳ',
                'era'              => 'Thế kỷ 16',
                'confidence'       => 0.83,
                'image'            => 'https://images.unsplash.com/photo-1604326615608-e685cc26ba44?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Gốm Iznik', 'confidence' => 0.88, 'reasoning' => 'Hoa văn tulip và thạch lựu trên nền trắng tinh điển hình Iznik thế kỷ 16.'],
                    ['name' => 'Art Historian', 'verdict' => 'Gốm Iznik', 'confidence' => 0.82, 'reasoning' => 'Bảng màu đỏ san hô, xanh cobalt và trắng đặc trưng giai đoạn đỉnh cao Ottoman.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Gốm Iznik', 'confidence' => 0.80, 'reasoning' => 'Lớp engobe trắng tinh và men siêu bóng phù hợp kỹ thuật Iznik truyền thống.'],
                ],
            ],
            [
                'final_prediction' => 'Gốm Chu Đậu',
                'country'          => 'Việt Nam',
                'era'              => 'Thế kỷ 14-15',
                'confidence'       => 0.76,
                'image'            => 'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Gốm Chu Đậu', 'confidence' => 0.80, 'reasoning' => 'Hoa văn sen và mây vẽ chìm dưới men trắng ngà điển hình Hải Dương.'],
                    ['name' => 'Art Historian', 'verdict' => 'Gốm Chu Đậu hoặc Bát Tràng', 'confidence' => 0.72, 'reasoning' => 'Phong cách trang trí có thể thuộc một trong hai dòng lớn Bắc Việt.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Gốm Chu Đậu', 'confidence' => 0.77, 'reasoning' => 'Đất sét mịn vùng Hải Dương, nhiệt độ nung thấp hơn Bát Tràng.'],
                ],
            ],
            [
                'final_prediction' => 'Sứ Meissen',
                'country'          => 'Đức',
                'era'              => 'Thế kỷ 18',
                'confidence'       => 0.89,
                'image'            => 'https://images.unsplash.com/photo-1600264854570-2dcfbe47e30a?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Sứ Meissen', 'confidence' => 0.92, 'reasoning' => 'Dấu hai thanh kiếm chéo màu xanh cobalt điển hình Meissen thế kỷ 18.'],
                    ['name' => 'Art Historian', 'verdict' => 'Sứ Meissen', 'confidence' => 0.87, 'reasoning' => 'Phong cách hoa Đức kết hợp ảnh hưởng Trung Hoa (Chinoiserie) đầu thế kỷ 18.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Sứ Meissen', 'confidence' => 0.91, 'reasoning' => 'Kaolin Saxony tinh khiết tạo sứ cứng trắng ngà đặc trưng châu Âu đầu tiên.'],
                ],
            ],
            [
                'final_prediction' => 'Gốm Bàu Trúc',
                'country'          => 'Việt Nam',
                'era'              => 'Truyền thống Chăm (hàng nghìn năm)',
                'confidence'       => 0.88,
                'image'            => 'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?w=400',
                'agents'           => [
                    ['name' => 'Archaeologist', 'verdict' => 'Gốm Bàu Trúc', 'confidence' => 0.90, 'reasoning' => 'Kỹ thuật nặn tay không dùng bàn xoay, đất sét pha cát sông Thu Bồn đặc trưng.'],
                    ['name' => 'Art Historian', 'verdict' => 'Gốm Chăm Pa', 'confidence' => 0.86, 'reasoning' => 'Hoa văn hình học và biểu tượng Hindu đặc trưng văn hóa Chăm cổ đại.'],
                    ['name' => 'Material Analyst', 'verdict' => 'Gốm Bàu Trúc', 'confidence' => 0.88, 'reasoning' => 'Nung bằng rơm ngoài trời tạo bề mặt không đồng đều, không có men bảo vệ.'],
                ],
            ],
        ];

        $now      = now();
        $total    = count($samples);
        $predIdx  = 0;
        $inserts  = [];

        foreach ($users as $user) {
            $freeUsed = (int) $user->free_predictions_used;
            $balance  = (float) $user->token_balance;

            // Number of predictions = free_used + token-based predictions (1 per 1 credit spent, capped)
            $tokenPreds = $balance > 0 ? min((int) floor($balance / 10), 15) : 0;
            $count      = $freeUsed + $tokenPreds;

            if ($count === 0) continue;

            for ($i = 0; $i < $count; $i++) {
                $sample = $samples[$predIdx % $total];
                $predIdx++;

                $inserts[] = [
                    'user_id'          => $user->id,
                    'image'            => $sample['image'],
                    'final_prediction' => $sample['final_prediction'],
                    'country'          => $sample['country'],
                    'era'              => $sample['era'],
                    'result_json'      => json_encode([
                        'final_prediction' => $sample['final_prediction'],
                        'country'          => $sample['country'],
                        'era'              => $sample['era'],
                        'confidence'       => $sample['confidence'],
                        'certainty'        => round($sample['confidence'] * 100) . '%',
                        'agents'           => $sample['agents'],
                        'verdict'          => $sample['agents'][0]['reasoning'],
                        'debate_summary'   => 'Hội đồng ' . count($sample['agents']) . ' AI chuyên gia đồng thuận sau phân tích đa chiều.',
                    ]),
                    'created_at' => $now->copy()->subDays(rand(1, 120))->subHours(rand(0, 23))->toDateTimeString(),
                    'updated_at' => $now->copy()->subDays(rand(0, 5))->toDateTimeString(),
                ];
            }
        }

        // Bulk insert in chunks of 50
        foreach (array_chunk($inserts, 50) as $chunk) {
            Prediction::insert($chunk);
        }
    }
}
