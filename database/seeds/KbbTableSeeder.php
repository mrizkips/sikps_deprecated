<?php

use App\Models\Kbb;
use Illuminate\Database\Seeder;

class KbbTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kbb = [
            'Bandung',
            'Balaraja',
            'Ciamis',
            'Cianjur',
            'Kediri',
            'Tasikmalaya',
            'Purwokerto',
        ];

        foreach ($kbb as $data) {
            Kbb::create(['nama' => $data]);
        }
    }
}
