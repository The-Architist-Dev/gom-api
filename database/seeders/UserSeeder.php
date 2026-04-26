<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $pwd = Hash::make('Test1234!');
        $now = now();

        /**
         * Columns: [name, email, pwd, balance, free_used, phone, reg_days_ago, verified]
         * balance = (credits bought) – (credits spent). Must be ≥ 0 and consistent with PaymentSeeder logic.
         * free_used: 0–5. phone: real VN prefix patterns.
         */
        $users = [
            // ── Super admin ──
            ['Nguyễn Thành Đạt',       'thanhdatadmin2024@gmail.com',   Hash::make('Admin1234!'), 490,  5, '0901112233', 365, true],

            // ── Power users – đã nạp gói Chuyên Gia (200 credits), còn nhiều ──
            ['Nguyễn Minh Tuấn',       'minhtuannguyen95@gmail.com',    $pwd, 192, 5, '0912345601', 310, true],
            ['Trần Quốc Hùng',         'quochung.tran@gmail.com',       $pwd, 187, 5, '0909876502', 280, true],
            ['Lê Hoàng Phúc',          'hoangphuc.le1992@gmail.com',    $pwd, 196, 5, '0934567803', 260, true],
            ['Phạm Đức Thắng',         'ducthang.pham@gmail.com',       $pwd, 183, 5, '0978123404', 250, true],
            ['Hoàng Minh Tú',          'minhtuphuong98@gmail.com',      $pwd, 145, 5, '0898667705', 240, true],
            ['Bùi Quang Huy',          'quanghuy.bui2000@gmail.com',    $pwd, 178, 5, '0776543206', 230, true],
            ['Ngô Thế Vinh',           'thevinh.ngo@gmail.com',         $pwd, 165, 5, '0358912307', 220, true],
            ['Đặng Tiến Dũng',         'tiendung.dang91@gmail.com',     $pwd, 140, 5, '0919283408', 215, true],
            ['Vũ Xuân Trường',         'xuantruong.vu@gmail.com',       $pwd, 158, 5, '0867451209', 200, true],

            // ── Heavy users – đã nạp gói Phổ Biến (50 credits) 1–2 lần ──
            ['Hồ Quang Minh',          'quangminh.ho1997@gmail.com',    $pwd, 43,  5, '0923001110', 190, true],
            ['Lý Thị Hồng Vân',        'hongvan.ly@gmail.com',          $pwd, 38,  5, '0908990011', 185, true],
            ['Phan Thị Thu Hà',        'thuha.phan@gmail.com',          $pwd, 46,  5, '0345671212', 180, true],
            ['Đỗ Minh Nhật',           'minhnhat.do96@gmail.com',       $pwd, 29,  5, '0796543213', 175, true],
            ['Dương Văn Tài',          'vantai.duong@gmail.com',        $pwd, 34,  5, '0562781214', 170, true],
            ['Huỳnh Thị Kim Chi',      'kimchi.huynh1993@gmail.com',    $pwd, 41,  5, '0939904315', 165, true],
            ['Nguyễn Thế Anh',         'theanh.nguyen@gmail.com',       $pwd, 7,   5, '0912007616', 160, true],
            ['Trần Thị Bảo Châu',      'baochau.tran2001@gmail.com',    $pwd, 18,  5, '0974223317', 155, true],
            ['Võ Thanh Phong',         'thanhphong.vo@gmail.com',       $pwd, 22,  5, '0865432118', 150, true],
            ['Lê Ngọc Hân',            'ngochan.le@gmail.com',          $pwd, 13,  5, '0793456719', 145, true],

            // ── Moderate users – còn lượt free, chưa hoặc vừa nạp ──
            ['Trần Thị Lan',           'thilan.tran1998@gmail.com',     $pwd, 10,  4, '0987654320', 140, true],
            ['Lý Thị Mỹ Dung',         'mydung.ly@gmail.com',           $pwd, 0,   4, '0945678921', 135, true],
            ['Phan Quốc Việt',         'quocviet.phan@gmail.com',       $pwd, 10,  3, '0978090123', 130, true],
            ['Hồ Thị Thanh Thúy',      'thanhthuy.ho2002@gmail.com',   $pwd, 0,   2, '0344560924', 125, true],
            ['Vũ Thị Quỳnh Nga',       'quynhnga.vu@gmail.com',         $pwd, 0,   3, '0865781225', 120, true],
            ['Nguyễn Văn Hải',         'vanhaingt99@gmail.com',         $pwd, 10,  4, '0902111226', 115, true],
            ['Phạm Thị Hương',         'phamhg1996@gmail.com',          $pwd, 0,   3, '0776123427', 110, true],
            ['Đặng Văn Khoa',          'vankhoa.dang@gmail.com',        $pwd, 0,   4, '0919219828', 105, true],
            ['Bùi Minh Quân',          'minhquan.bui@gmail.com',        $pwd, 10,  5, '0358098729', 100, true],
            ['Hoàng Thị Thu',          'thuhoang1994@gmail.com',        $pwd, 0,   2, '0869001130', 95,  true],

            // ── Light users – mới đăng ký, dùng 0–2 lượt free ──
            ['Phạm Văn Long',          'pvlong2003@gmail.com',          $pwd, 0, 1, '0945112231', 90, true],
            ['Lê Thị Diễm',            'diem.le.art@gmail.com',         $pwd, 0, 2, '0914556732', 85, true],
            ['Võ Minh Khải',           'minhkhai.vo@gmail.com',         $pwd, 0, 1, '0792556633', 80, true],
            ['Bùi Văn Đạt',            'vandat.bui2004@gmail.com',      $pwd, 0, 0, '0368001134', 75, true],
            ['Hoàng Anh Kiệt',         'anhkiet.hoang@gmail.com',       $pwd, 0, 1, '0982334435', 70, true],
            ['Ngô Thị Hải Yến',        'haiyen.ngo@gmail.com',          $pwd, 0, 0, '0916334436', 65, true],
            ['Hồ Văn Phong',           'vanphong.ho1999@gmail.com',     $pwd, 0, 2, '0345667737', 60, true],
            ['Phan Thị Cẩm Tú',        'camtu.phan.ceramics@gmail.com', $pwd, 0, 1, '0767998838', 55, true],
            ['Lý Quốc Cường',          'quoccuong.ly@gmail.com',        $pwd, 0, 0, '0938881239', 50, true],
            ['Đặng Thị Ngọc Trâm',     'ngoctram.dang@gmail.com',       $pwd, 0, 1, '0856889940', 45, true],

            // ── New / chưa verify ──
            ['Dương Thị Phương Thảo',  'phuongthao.duong2005@gmail.com',$pwd, 0, 0, null,         30, false],
            ['Huỳnh Văn Bảo',          'bao.huynh2006@gmail.com',       $pwd, 0, 0, '0779334442', 28, false],
            ['Nguyễn Thị Cẩm Nhung',   'camnhung.nguyen@gmail.com',     $pwd, 0, 1, '0912556643', 25, true],
            ['Trần Anh Tuấn',          'anhtuan.tran01@gmail.com',      $pwd, 0, 0, '0934778844', 22, false],
            ['Lê Thị Hồng Nhung',      'hongnhung.le@gmail.com',        $pwd, 10, 5, '0857990045', 20, true],
            ['Phạm Đức Huy',           'duchuy.pham@gmail.com',         $pwd, 0,  2, '0778112246', 18, true],
            ['Võ Thị Kiều Trinh',      'kieutrinh.vo@gmail.com',        $pwd, 50, 5, '0856334447', 15, true],
            ['Đặng Văn Bình',          'vanbinh.dang1996@gmail.com',    $pwd, 0,  1, null,         12, true],
            ['Bùi Thị Thu Hà',         'thuha.bui.gom@gmail.com',       $pwd, 0,  3, '0923556648', 10, true],
            ['Hoàng Phương Linh',      'phuonglinh.hoang@gmail.com',    $pwd, 200, 5, '0895778849', 7, true],
        ];

        foreach ($users as [$name, $email, $password, $balance, $freeUsed, $phone, $daysAgo, $verified]) {
            // pravatar.cc: deterministic real portrait photo seeded by email hash
            $avatarUrl = 'https://i.pravatar.cc/200?u=' . urlencode($email);

            User::create([
                'name'                  => $name,
                'email'                 => $email,
                'password'              => $password,
                'avatar'                => $avatarUrl,
                'token_balance'         => (float) $balance,
                'free_predictions_used' => $freeUsed,
                'phone'                 => $phone,
                'email_verified_at'     => $verified
                    ? $now->copy()->subDays($daysAgo - 1)
                    : null,
                'created_at'            => $now->copy()->subDays($daysAgo),
                'updated_at'            => $now->copy()->subDays(max(0, $daysAgo - rand(1, min(10, $daysAgo)))),
            ]);
        }
    }
}
