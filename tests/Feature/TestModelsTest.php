<?php

namespace Tests\Feature;

use App\Models\ChiTietPhieuXuat;
use App\Models\DonHang;
use App\Models\MaGiamGia;
use App\Models\NhaCungCap;
use App\Models\PhieuNhap;
use App\Models\PhieuXuat;
use App\Models\SanPham;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_models_route_creates_a_store_and_loads_its_relations(): void
    {
        $response = $this->getJson('/test-models');

        $response
            ->assertOk()
            ->assertJsonPath('thong_bao', 'Kết nối Model CuaHang thành công!')
            ->assertJsonPath('cua_hang_moi_tao.ten_cua_hang', 'Bách Hóa Xanh - Nguyễn Huệ')
            ->assertJsonPath('tat_ca_cua_hang.0.id', 1)
            ->assertJsonPath('tat_ca_cua_hang.0.don_hang', [])
            ->assertJsonPath('tat_ca_cua_hang.0.ton_kho', []);
    }

    public function test_user_factory_matches_the_user_schema_and_hashes_passwords(): void
    {
        $user = User::factory()->create();

        $this->assertSame('nguoi_dung', $user->getTable());
        $this->assertSame('mat_khau', $user->getAuthPasswordName());
        $this->assertTrue(password_verify('password', $user->getAuthPassword()));
        $this->assertNotEmpty($user->so_dien_thoai);
    }

    public function test_database_seeder_uses_the_user_schema(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('nguoi_dung', [
            'so_dien_thoai' => '0900000000',
            'ho_ten' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function test_models_allow_mass_assignment_of_migration_columns(): void
    {
        $cases = [
            [new SanPham, ['mo_ta' => 'Mô tả', 'hinh_anh_chinh' => 'san-pham.jpg']],
            [new NhaCungCap, ['ma_so_thue' => '123456', 'ghi_chu' => 'Nhà cung cấp']],
            [new DonHang, ['ghi_chu' => 'Đơn hàng']],
            [new PhieuNhap, ['ghi_chu' => 'Phiếu nhập']],
            [new PhieuXuat, ['ly_do' => 'Lý do', 'ghi_chu' => 'Phiếu xuất']],
            [new ChiTietPhieuXuat, ['ghi_chu' => 'Chi tiết phiếu xuất']],
        ];

        foreach ($cases as [$model, $attributes]) {
            $model->fill($attributes);
            foreach ($attributes as $key => $value) {
                $this->assertSame($value, $model->getAttribute($key), $model::class."::$key");
            }
        }
    }

    public function test_coupon_usage_limit_is_required_and_checked_as_a_number(): void
    {
        $coupon = new MaGiamGia([
            'ma_khuyen_mai' => 'TEST10',
            'loai_giam_gia' => 'phan_tram',
            'gia_tri_giam' => 10,
            'ngay_bat_dau' => now()->subDay(),
            'ngay_ket_thuc' => now()->addDay(),
            'so_luong' => '2',
            'da_su_dung' => '1',
        ]);

        $this->assertTrue($coupon->conHieuLuc());

        $coupon->da_su_dung = 2;
        $this->assertFalse($coupon->conHieuLuc());
    }
}
