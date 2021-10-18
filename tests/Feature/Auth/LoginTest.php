<?php

namespace Tests\Feature\Auth;

use App\Models\Mahasiswa;
use App\Models\Role;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RolesTableSeeder;
use UsersTableSeeder;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test menampilkan halaman login.
     *
     * @return void
     */
    public function testMenampilkanHalamanLogin()
    {
        $response = $this->get(route('login'));
        $response->assertStatus(200);
    }

    /**
     * Test login admin.
     *
     * @return void
     */
    public function testLoginSebagaiAdmin()
    {
        // Preparing data
        $role = Role::where('nama', 'admin')->firstOrCreate(['nama' => 'admin']);
        $user = factory(User::class)->create([
            'password' => Hash::make('123456'),
            'role_id' => $role->id,
        ]);

        // Melakukan login
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123456',
        ]);

        // Check auth guard
        $this->assertEquals(true, Auth::guard('admin')->check());
        $this->refreshTestDatabase();
    }

    /**
     * Test login baak.
     *
     * @return void
     */
    public function testLoginSebagaiBaak()
    {
        // Preparing data
        $role = Role::where('nama', 'baak')->firstOrCreate(['nama' => 'baak']);
        $user = factory(User::class)->create([
            'password' => Hash::make('123456'),
            'role_id' => $role->id,
        ]);

        // Melakukan login
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123456',
        ]);

        // Check auth guard
        $this->assertEquals(true, Auth::guard('baak')->check());
    }

    /**
     * Test login keuangan.
     *
     * @return void
     */
    public function testLoginSebagaiKeuangan()
    {
        // Preparing data
        $role = Role::where('nama', 'keuangan')->firstOrCreate(['nama' => 'keuangan']);
        $user = factory(User::class)->create([
            'password' => Hash::make('123456'),
            'role_id' => $role->id,
        ]);

        // Melakukan login
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123456',
        ]);

        // Check auth guard
        $this->assertEquals(true, Auth::guard('keuangan')->check());
    }

    /**
     * Test login mahasiswa.
     *
     * @return void
     */
    public function testLoginSebagaiMahasiswa()
    {
        // Preparing data
        $role = Role::where('nama', 'mahasiswa')->firstOrCreate(['nama' => 'mahasiswa']);
        $user = factory(User::class)->create([
            'password' => Hash::make('123456'),
            'role_id' => $role->id,
        ]);

        // Melakukan login
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123456',
        ]);

        // Check auth guard
        $this->assertEquals(true, Auth::guard('mahasiswa')->check());
    }

    /**
     * Test login dosen.
     *
     * @return void
     */
    public function testLoginSebagaiDosen()
    {
        // Preparing data
        $role = Role::where('nama', 'dosen')->firstOrCreate(['nama' => 'dosen']);
        $user = factory(User::class)->create([
            'password' => Hash::make('123456'),
            'role_id' => $role->id,
        ]);

        // Melakukan login
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => '123456',
        ]);

        // Check auth guard
        $this->assertEquals(true, Auth::guard('dosen')->check());
    }
}
