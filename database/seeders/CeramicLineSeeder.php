<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CeramicLine;

class CeramicLineSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        CeramicLine::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Thematic Unsplash ceramic image pools (stable CDN URLs)
        $imgVN  = 'https://images.unsplash.com/photo-1578749556568-bc2c40e68b61?auto=format&fit=crop&q=80&w=800';
        $imgBW  = 'https://images.unsplash.com/photo-1565193566173-7a0ee3dbe261?auto=format&fit=crop&q=80&w=800';
        $imgJP  = 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?auto=format&fit=crop&q=80&w=800';
        $imgKR  = 'https://images.unsplash.com/photo-1612196808214-b7e239e5f6d1?auto=format&fit=crop&q=80&w=800';
        $imgEU  = 'https://images.unsplash.com/photo-1600264854570-2dcfbe47e30a?auto=format&fit=crop&q=80&w=800';
        $imgTK  = 'https://images.unsplash.com/photo-1604326615608-e685cc26ba44?auto=format&fit=crop&q=80&w=800';
        $imgCH  = 'https://images.unsplash.com/photo-1495121553079-4c61bcce1894?auto=format&fit=crop&q=80&w=800';

        $lines = [
            // === VIỆT NAM ===
            [
                'name' => 'Gốm Bát Tràng',
                'origin' => 'Hà Nội',
                'country' => 'Việt Nam',
                'era' => 'Thế kỷ 14 - nay',
                'description' => 'Làng gốm cổ nổi tiếng nhất Việt Nam, nổi bật với men ngọc, men rạn và gốm hoa lam truyền thống.',
                'style' => 'Men ngọc, Men rạn, Hoa lam',
                'image_url' => $imgVN,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Biên Hòa',
                'origin' => 'Đồng Nai',
                'country' => 'Việt Nam',
                'era' => 'Đầu thế kỷ 20 - nay',
                'description' => 'Phong cách gốm mỹ thuật kết hợp giữa nghệ thuật Đông Dương và kỹ thuật phương Tây, men màu rực rỡ.',
                'style' => 'Men màu, Chạm khắc nổi',
                'image_url' => $imgVN,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Phù Lãng',
                'origin' => 'Bắc Ninh',
                'country' => 'Việt Nam',
                'era' => 'Thế kỷ 13 - nay',
                'description' => 'Nổi tiếng với gốm men da lươn, sản phẩm mang nét mộc mạc, giản dị của vùng Kinh Bắc.',
                'style' => 'Men da lươn, Men nâu',
                'image_url' => $imgVN,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Chu Đậu',
                'origin' => 'Hải Dương',
                'country' => 'Việt Nam',
                'era' => 'Thế kỷ 13 - 17',
                'description' => 'Dòng gốm cổ quý giá, từng được xuất khẩu sang Nhật Bản và Trung Đông. Nổi tiếng với hoa văn vẽ chìm.',
                'style' => 'Hoa lam, Men trắng ngà',
                'image_url' => $imgBW,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Thanh Hà',
                'origin' => 'Quảng Nam',
                'country' => 'Việt Nam',
                'era' => 'Thế kỷ 16 - nay',
                'description' => 'Làng gốm cổ bên sông Thu Bồn, gần phố cổ Hội An, nổi bật với gốm đất nung truyền thống.',
                'style' => 'Đất nung, Không men',
                'image_url' => $imgVN,
                'is_featured' => false,
            ],
            [
                'name' => 'Gốm Bàu Trúc',
                'origin' => 'Ninh Thuận',
                'country' => 'Việt Nam',
                'era' => 'Hàng nghìn năm',
                'description' => 'Dòng gốm Chăm cổ xưa nhất Đông Nam Á, làm hoàn toàn thủ công không dùng bàn xoay.',
                'style' => 'Thủ công, Đất nung',
                'image_url' => $imgVN,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Mỹ Thiện',
                'origin' => 'Bình Dương',
                'country' => 'Việt Nam',
                'era' => 'Thế kỷ 19 - nay',
                'description' => 'Gốm sứ truyền thống tỉnh Bình Dương với kỹ thuật vẽ tay tinh xảo, màu sắc phong phú.',
                'style' => 'Men màu, Vẽ tay',
                'image_url' => $imgVN,
                'is_featured' => false,
            ],

            // === TRUNG QUỐC ===
            [
                'name' => 'Sứ Cảnh Đức Trấn',
                'origin' => 'Giang Tây',
                'country' => 'Trung Quốc',
                'era' => 'Thế kỷ 10 - nay',
                'description' => 'Kinh đô sứ của thế giới, nổi tiếng với sứ hoa lam (Blue and White) và sứ men trắng tinh xảo.',
                'style' => 'Hoa lam, Men trắng, Ngũ thái',
                'image_url' => $imgBW,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Nghi Hưng (Tử Sa)',
                'origin' => 'Giang Tô',
                'country' => 'Trung Quốc',
                'era' => 'Thời Tống',
                'description' => 'Nổi tiếng thế giới với ấm trà tử sa, được làm từ đất sét đặc biệt có màu tím đỏ.',
                'style' => 'Tử sa, Không men',
                'image_url' => $imgJP,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Long Tuyền (Celadon)',
                'origin' => 'Chiết Giang',
                'country' => 'Trung Quốc',
                'era' => 'Thời Tống - Nguyên',
                'description' => 'Dòng men ngọc bích (celadon) nổi tiếng nhất, với lớp men xanh ngọc trong suốt tuyệt đẹp.',
                'style' => 'Men ngọc, Celadon',
                'image_url' => $imgKR,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Nhữ Diêu',
                'origin' => 'Hà Nam',
                'country' => 'Trung Quốc',
                'era' => 'Thời Bắc Tống',
                'description' => 'Một trong 5 đại danh lò gốm Trung Quốc, men xanh thiên thanh cực kỳ quý hiếm.',
                'style' => 'Men xanh thiên thanh',
                'image_url' => $imgCH,
                'is_featured' => false,
            ],
            [
                'name' => 'Gốm Đức Hóa',
                'origin' => 'Phúc Kiến',
                'country' => 'Trung Quốc',
                'era' => 'Thế kỷ 14 - nay',
                'description' => 'Sứ trắng tinh khiết Blanc de Chine, nổi tiếng với tượng Phật và đồ thờ phụng.',
                'style' => 'Blanc de Chine, Sứ trắng',
                'image_url' => $imgEU,
                'is_featured' => false,
            ],

            // === NHẬT BẢN ===
            [
                'name' => 'Gốm Raku',
                'origin' => 'Kyoto',
                'country' => 'Nhật Bản',
                'era' => 'Thế kỷ 16 - nay',
                'description' => 'Phong cách gốm gắn liền với trà đạo Nhật Bản, thể hiện triết lý wabi-sabi.',
                'style' => 'Raku, Wabi-sabi',
                'image_url' => $imgJP,
                'is_featured' => true,
            ],
            [
                'name' => 'Sứ Arita (Imari)',
                'origin' => 'Saga',
                'country' => 'Nhật Bản',
                'era' => 'Thế kỷ 17 - nay',
                'description' => 'Sứ xuất khẩu nổi tiếng của Nhật, men nhiều màu rực rỡ với hoa văn Nhật đặc trưng.',
                'style' => 'Sứ vẽ màu, Imari',
                'image_url' => $imgBW,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Bizen',
                'origin' => 'Okayama',
                'country' => 'Nhật Bản',
                'era' => 'Thời Kamakura',
                'description' => 'Dòng gốm không tráng men, nung ở nhiệt độ cao tạo nên vẻ đẹp tự nhiên độc đáo.',
                'style' => 'Không men, Nung củi',
                'image_url' => $imgJP,
                'is_featured' => false,
            ],
            [
                'name' => 'Gốm Hagi',
                'origin' => 'Yamaguchi',
                'country' => 'Nhật Bản',
                'era' => 'Thế kỷ 16 - nay',
                'description' => 'Được yêu thích trong giới trà đạo, men rạn tự nhiên thay đổi theo thời gian sử dụng.',
                'style' => 'Men rạn, Trà đạo',
                'image_url' => $imgJP,
                'is_featured' => false,
            ],
            [
                'name' => 'Gốm Shigaraki',
                'origin' => 'Shiga',
                'country' => 'Nhật Bản',
                'era' => 'Thế kỷ 13 - nay',
                'description' => 'Một trong 6 lò gốm cổ Nhật Bản, nổi bật với kết cấu đất thô tự nhiên và vảy tro đặc trưng.',
                'style' => 'Tro tự nhiên, Không men',
                'image_url' => $imgJP,
                'is_featured' => false,
            ],

            // === HÀN QUỐC ===
            [
                'name' => 'Gốm Celadon Goryeo',
                'origin' => 'Gangjin',
                'country' => 'Hàn Quốc',
                'era' => 'Thời Goryeo (918-1392)',
                'description' => 'Men ngọc bích hoàng gia Hàn Quốc, kỹ thuật khảm sanggam độc đáo trên thế giới.',
                'style' => 'Men ngọc, Sanggam',
                'image_url' => $imgKR,
                'is_featured' => true,
            ],
            [
                'name' => 'Sứ trắng Joseon',
                'origin' => 'Gwangju',
                'country' => 'Hàn Quốc',
                'era' => 'Thời Joseon (1392-1897)',
                'description' => 'Sứ trắng tinh khiết phản ánh tinh thần Nho giáo, vẽ hoa lam đậm chất Hàn Quốc.',
                'style' => 'Sứ trắng, Hoa lam',
                'image_url' => $imgBW,
                'is_featured' => false,
            ],

            // === THÁI LAN ===
            [
                'name' => 'Gốm Sawankhalok',
                'origin' => 'Sukhothai',
                'country' => 'Thái Lan',
                'era' => 'Thế kỷ 13 - 15',
                'description' => 'Gốm cổ Thái Lan thời Sukhothai, ảnh hưởng sâu sắc từ kỹ thuật Trung Hoa.',
                'style' => 'Men xanh celadon, Hoa văn cá',
                'image_url' => $imgKR,
                'is_featured' => false,
            ],
            [
                'name' => 'Gốm Bencharong',
                'origin' => 'Bangkok',
                'country' => 'Thái Lan',
                'era' => 'Thế kỷ 18 - nay',
                'description' => 'Gốm hoàng gia Thái 5 màu, trang trí công phu với hoa văn truyền thống Thái.',
                'style' => 'Ngũ sắc, Hoàng gia',
                'image_url' => $imgTK,
                'is_featured' => true,
            ],

            // === CHÂU ÂU ===
            [
                'name' => 'Sứ Meissen',
                'origin' => 'Sachsen',
                'country' => 'Đức',
                'era' => 'Thế kỷ 18 - nay',
                'description' => 'Nhà sản xuất sứ đầu tiên tại châu Âu, nổi tiếng với biểu tượng hai thanh kiếm chéo.',
                'style' => 'Sứ cứng, Vẽ tay',
                'image_url' => $imgEU,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Delft',
                'origin' => 'Delft',
                'country' => 'Hà Lan',
                'era' => 'Thế kỷ 17 - nay',
                'description' => 'Gốm men thiếc nổi tiếng với hoa văn xanh-trắng, lấy cảm hứng từ sứ Trung Hoa.',
                'style' => 'Men thiếc, Xanh-trắng',
                'image_url' => $imgBW,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Majolica',
                'origin' => 'Faenza, Deruta',
                'country' => 'Ý',
                'era' => 'Thời Phục Hưng',
                'description' => 'Gốm tráng men thiếc rực rỡ sắc màu, mang đậm phong cách nghệ thuật Phục Hưng Ý.',
                'style' => 'Men thiếc, Đa sắc',
                'image_url' => $imgTK,
                'is_featured' => false,
            ],
            [
                'name' => 'Sứ Limoges',
                'origin' => 'Limoges',
                'country' => 'Pháp',
                'era' => 'Thế kỷ 18 - nay',
                'description' => 'Sứ cao cấp Pháp, men trắng tinh khiết và vẽ tay tinh xảo, biểu tượng xa xỉ châu Âu.',
                'style' => 'Sứ cứng, Vẽ tay',
                'image_url' => $imgEU,
                'is_featured' => false,
            ],
            [
                'name' => 'Sứ Wedgwood',
                'origin' => 'Staffordshire',
                'country' => 'Anh',
                'era' => 'Thế kỷ 18 - nay',
                'description' => 'Thương hiệu sứ hoàng gia Anh, nổi tiếng với dòng Jasperware xanh-trắng tân cổ điển.',
                'style' => 'Jasperware, Tân cổ điển',
                'image_url' => $imgEU,
                'is_featured' => false,
            ],

            // === TRUNG ĐÔNG ===
            [
                'name' => 'Gốm Iznik',
                'origin' => 'Bursa',
                'country' => 'Thổ Nhĩ Kỳ',
                'era' => 'Thế kỷ 15 - 17',
                'description' => 'Gốm Ottoman vĩ đại, hoa văn hoa tulip và cẩm chướng trên men xanh-đỏ rực rỡ.',
                'style' => 'Men xanh-đỏ, Hoa tulip',
                'image_url' => $imgTK,
                'is_featured' => true,
            ],
            [
                'name' => 'Gốm Ba Tư (Kashan)',
                'origin' => 'Isfahan',
                'country' => 'Iran',
                'era' => 'Thế kỷ 12 - 14',
                'description' => 'Gốm men láng Ba Tư với kỹ thuật Mina\'i và Lustre, ảnh hưởng sâu rộng đến gốm Hồi giáo.',
                'style' => 'Lustre, Mina\'i',
                'image_url' => $imgTK,
                'is_featured' => false,
            ],

            // === CHÂU MỸ ===
            [
                'name' => 'Gốm Pueblo',
                'origin' => 'New Mexico',
                'country' => 'Hoa Kỳ',
                'era' => 'Hàng nghìn năm - nay',
                'description' => 'Gốm thổ dân Pueblo Bắc Mỹ, hoa văn hình học truyền thống trên nền đất nung.',
                'style' => 'Đất nung, Hình học',
                'image_url' => $imgVN,
                'is_featured' => false,
            ],
            [
                'name' => 'Gốm Talavera',
                'origin' => 'Puebla',
                'country' => 'Mexico',
                'era' => 'Thế kỷ 16 - nay',
                'description' => 'Di sản UNESCO, kết hợp kỹ thuật gốm Tây Ban Nha và nghệ thuật bản địa Mexico.',
                'style' => 'Men thiếc, Đa sắc',
                'image_url' => $imgTK,
                'is_featured' => false,
            ],

            // === CHÂU PHI & KHÁC ===
            [
                'name' => 'Gốm Ndebele',
                'origin' => 'Zimbabwe',
                'country' => 'Zimbabwe',
                'era' => 'Thế kỷ 19 - nay',
                'description' => 'Gốm truyền thống của người Ndebele với hoa văn hình học đậm màu sắc sặc sỡ đặc trưng châu Phi.',
                'style' => 'Hình học, Đa sắc',
                'image_url' => null,
                'is_featured' => false,
            ],
            [
                'name' => 'Gốm Raku Đương Đại',
                'origin' => 'Toàn cầu',
                'country' => 'Quốc tế',
                'era' => 'Thế kỷ 20 - nay',
                'description' => 'Phong trào gốm Raku đương đại kết hợp kỹ thuật Nhật Bản cổ điển với tư duy nghệ thuật hiện đại.',
                'style' => 'Đương đại, Thử nghiệm',
                'image_url' => $imgJP,
                'is_featured' => false,
            ],
        ];

        foreach ($lines as $line) {
            CeramicLine::create($line);
        }
    }
}
