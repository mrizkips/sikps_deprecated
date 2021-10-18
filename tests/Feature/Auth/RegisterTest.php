<?php

namespace Tests\Feature\Auth;

use App\Models\Jurusan;
use App\Models\Kbb;
use App\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Menampilkan halaman register.
     *
     * @return void
     */
    public function testMenampilkanHalamanRegister()
    {
        $response = $this->get(route('register'));
        $response->assertSuccessful();
    }

    /**
     * Test registrasi mahasiswa.
     *
     * @return void
     */
    public function testRegistrasiMahasiswa()
    {
        // Buat data
        $kbb = Kbb::create(['nama' => 'Bandung']);
        $jurusan = Jurusan::create(['nama' => 'Sistem Informasi']);
        Role::create(['nama' => 'mahasiswa']);

        // Melakukan register
        $response = $this->post(route('register'), [
            'nama' => 'Mochamad Rizki Pratama Suhernawan',
            'email' => 'rizki.pezzek@gmail.com',
            'nim' => '3218609',
            'kbb_id' => $kbb->id,
            'jurusan_id' => $jurusan->id,
            'jen_kel' => 'Laki-laki',
            'no_hp' => '082127096498',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '1999-07-01',
            'alamat' => 'Kp. Andir RT. 04 RW. 15 No. 124, Kec. Padalarang, Kab. Bandung Barat, Jawa Barat',
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);

        $response->assertSessionHas('flash_messages', ['type' => 'success', 'message' => trans('login.register_success')]);
    }
}
