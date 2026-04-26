<?php

namespace Database\Seeders;

use App\Models\Pottery;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PotterySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Pottery::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $users = User::where('free_predictions_used', '>', 0)->get();
        if ($users->isEmpty()) return;

        $now = now();

        // Sample ceramic artifact images (real Unsplash pottery photos)
        $images = [
            'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&q=80&w=800',
            'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&q=80&w=800',
            'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?auto=format&fit=crop&q=80&w=800',
            'https://images.unsplash.com/photo-1612196808214-b7e239e5f6d1?auto=format&fit=crop&q=80&w=800',
            'https://images.unsplash.com/photo-1600264854570-2dcfbe47e30a?auto=format&fit=crop&q=80&w=800',
            'https://images.unsplash.com/photo-1604326615608-e685cc26ba44?auto=format&fit=crop&q=80&w=800',
            'https://images.unsplash.com/photo-1495121553079-4c61bcce1894?auto=format&fit=crop&q=80&w=800',
        ];

        $ceramics = [
            ['Gốm Bát Tràng',           'Việt Nam',      'Thế kỷ 17-18',            0.91,
             ['Archaeologist' => ['v'=>'Gốm Bát Tràng','c'=>0.93,'r'=>'Men ngọc đặc trưng Hà Nội thời Lê Trung Hưng.'],
              'Art Historian'  => ['v'=>'Gốm Bát Tràng','c'=>0.89,'r'=>'Hoa văn rồng phượng xuất khẩu thế kỷ 17.'],
              'Material'       => ['v'=>'Gốm Bát Tràng','c'=>0.94,'r'=>'Đất sét Gia Lâm, men chì điển hình.']]],
            ['Sứ Cảnh Đức Trấn',        'Trung Quốc',    'Triều Minh (1368-1644)',  0.87,
             ['Archaeologist' => ['v'=>'Sứ Cảnh Đức Trấn','c'=>0.85,'r'=>'Hoa lam kép nét vẽ sắc bén thời Vĩnh Lạc.'],
              'Art Historian'  => ['v'=>'Sứ Cảnh Đức Trấn','c'=>0.90,'r'=>'Bố cục lò Quan Diêu phong cách Minh.'],
              'Material'       => ['v'=>'Cảnh Đức Trấn','c'=>0.82,'r'=>'Men trắng trong, độ nung 1280°C.']]],
            ['Gốm Raku Nhật Bản',       'Nhật Bản',      'Thời Edo (1603-1868)',    0.78,
             ['Archaeologist' => ['v'=>'Gốm Raku','c'=>0.82,'r'=>'Kỹ thuật nung tay nhanh tạo bề mặt wabi-sabi.'],
              'Art Historian'  => ['v'=>'Gốm Raku','c'=>0.75,'r'=>'Triết lý trà đạo Rikyu thế kỷ 16.'],
              'Material'       => ['v'=>'Gốm Raku hoặc Shigaraki','c'=>0.71,'r'=>'Đất sét thô, nhiều hạt cát núi lửa.']]],
            ['Gốm Celadon Goryeo',       'Hàn Quốc',     'Thời Goryeo (918-1392)',  0.94,
             ['Archaeologist' => ['v'=>'Celadon Goryeo','c'=>0.96,'r'=>'Kỹ thuật khảm sanggam độc nhất thế giới.'],
              'Art Historian'  => ['v'=>'Celadon Goryeo','c'=>0.93,'r'=>'Men ngọc bích thế kỷ 12 lò Gangjin.'],
              'Material'       => ['v'=>'Celadon Goryeo','c'=>0.95,'r'=>'Sắt oxide tạo màu celadon đặc trưng.']]],
            ['Gốm Iznik Ottoman',        'Thổ Nhĩ Kỳ',   'Thế kỷ 16',              0.83,
             ['Archaeologist' => ['v'=>'Gốm Iznik','c'=>0.88,'r'=>'Hoa tulip và thạch lựu trên nền trắng tinh.'],
              'Art Historian'  => ['v'=>'Gốm Iznik','c'=>0.82,'r'=>'Đỏ san hô + xanh cobalt thời kỳ đỉnh cao Ottoman.'],
              'Material'       => ['v'=>'Gốm Iznik','c'=>0.80,'r'=>'Engobe trắng + men siêu bóng kỹ thuật Iznik.']]],
            ['Gốm Chu Đậu',             'Việt Nam',      'Thế kỷ 14-15',            0.76,
             ['Archaeologist' => ['v'=>'Gốm Chu Đậu','c'=>0.80,'r'=>'Hoa văn sen vẽ chìm dưới men trắng ngà Hải Dương.'],
              'Art Historian'  => ['v'=>'Gốm Chu Đậu hoặc Bát Tràng','c'=>0.72,'r'=>'Phong cách Bắc Việt thế kỷ 14.'],
              'Material'       => ['v'=>'Gốm Chu Đậu','c'=>0.77,'r'=>'Đất sét mịn vùng Hải Dương, nhiệt độ nung thấp.']]],
            ['Sứ Meissen',              'Đức',           'Thế kỷ 18',              0.89,
             ['Archaeologist' => ['v'=>'Sứ Meissen','c'=>0.92,'r'=>'Hai thanh kiếm chéo xanh cobalt điển hình.'],
              'Art Historian'  => ['v'=>'Sứ Meissen','c'=>0.87,'r'=>'Hoa Đức kết hợp Chinoiserie đầu thế kỷ 18.'],
              'Material'       => ['v'=>'Sứ Meissen','c'=>0.91,'r'=>'Kaolin Saxony tinh khiết, sứ cứng châu Âu đầu tiên.']]],
            ['Gốm Bàu Trúc',            'Việt Nam',      'Văn hóa Chăm Pa (cổ đại)', 0.88,
             ['Archaeologist' => ['v'=>'Gốm Bàu Trúc','c'=>0.90,'r'=>'Nặn tay không bàn xoay, đất sét pha cát sông.'],
              'Art Historian'  => ['v'=>'Gốm Chăm Pa','c'=>0.86,'r'=>'Hoa văn Hindu đặc trưng văn hóa Chăm cổ đại.'],
              'Material'       => ['v'=>'Gốm Bàu Trúc','c'=>0.88,'r'=>'Nung rơm ngoài trời, không men, bề mặt thô.']]],
            ['Gốm Long Tuyền Celadon',  'Trung Quốc',    'Thời Tống-Nguyên (960-1368)', 0.85,
             ['Archaeologist' => ['v'=>'Long Tuyền Celadon','c'=>0.87,'r'=>'Men ngọc bích trong suốt đặc trưng lò Chiết Giang.'],
              'Art Historian'  => ['v'=>'Long Tuyền Celadon','c'=>0.84,'r'=>'Ảnh hưởng xuất khẩu sang Đông Nam Á, Trung Đông.'],
              'Material'       => ['v'=>'Long Tuyền Celadon','c'=>0.86,'r'=>'Oxide sắt 1-2% tạo màu xanh ngọc đặc trưng.']]],
            ['Gốm Biên Hòa',            'Việt Nam',      'Đầu thế kỷ 20',          0.82,
             ['Archaeologist' => ['v'=>'Gốm Biên Hòa','c'=>0.85,'r'=>'Kỹ thuật Đông Dương kết hợp Việt truyền thống.'],
              'Art Historian'  => ['v'=>'Gốm Biên Hòa','c'=>0.80,'r'=>'Men màu rực rỡ ảnh hưởng nghệ thuật Pháp thuộc.'],
              'Material'       => ['v'=>'Gốm Biên Hòa','c'=>0.82,'r'=>'Đất cao lanh Đồng Nai, men chì phủ nhiều lớp.']]],
            ['Gốm Shigaraki',           'Nhật Bản',      'Thế kỷ 13 - nay',        0.74,
             ['Archaeologist' => ['v'=>'Gốm Shigaraki','c'=>0.76,'r'=>'Kết cấu đất thô tự nhiên, vảy tro đặc trưng Shiga.'],
              'Art Historian'  => ['v'=>'Gốm Bizen hoặc Shigaraki','c'=>0.72,'r'=>'Một trong 6 lò gốm cổ Nhật Bản.'],
              'Material'       => ['v'=>'Gốm Shigaraki','c'=>0.74,'r'=>'Silica cao, nung 1250°C tạo màu cam đặc trưng.']]],
            ['Gốm Delft Hà Lan',        'Hà Lan',        'Thế kỷ 17-18',           0.86,
             ['Archaeologist' => ['v'=>'Gốm Delft','c'=>0.88,'r'=>'Men thiếc xanh-trắng lấy cảm hứng từ sứ Trung Hoa.'],
              'Art Historian'  => ['v'=>'Gốm Delft','c'=>0.85,'r'=>'Phong cảnh Hà Lan và hoa tulip trên đồ dùng hoàng gia.'],
              'Material'       => ['v'=>'Gốm Delft','c'=>0.86,'r'=>'Men thiếc oxide phủ đất sét Delft trắng đục.']]],
        ];

        $inserts = [];
        $imgIdx  = 0;
        $cerIdx  = 0;

        foreach ($users as $user) {
            $count = min((int) $user->free_predictions_used, 5);
            $regDays = $user->created_at
                ? (int) now()->diffInDays($user->created_at)
                : 90;

            for ($i = 0; $i < $count; $i++) {
                $c    = $ceramics[$cerIdx % count($ceramics)];
                $img  = $images[$imgIdx  % count($images)];
                $cerIdx++;
                $imgIdx++;

                $debateData = [];
                foreach ($c[4] as $agentName => $a) {
                    $debateData[] = [
                        'agent'      => $agentName,
                        'verdict'    => $a['v'],
                        'confidence' => $a['c'],
                        'reasoning'  => $a['r'],
                    ];
                }

                $createdAt = $now->copy()
                    ->subDays($regDays - ($i * rand(3, 12)));

                $inserts[] = [
                    'user_id'         => $user->id,
                    'image_path'      => $img,
                    'predicted_label' => $c[0],
                    'country'         => $c[1],
                    'era'             => $c[2],
                    'confidence'      => $c[3],
                    'debate_data'     => json_encode($debateData),
                    'created_at'      => $createdAt->toDateTimeString(),
                    'updated_at'      => $createdAt->toDateTimeString(),
                ];
            }
        }

        foreach (array_chunk($inserts, 50) as $chunk) {
            Pottery::insert($chunk);
        }
    }
}
