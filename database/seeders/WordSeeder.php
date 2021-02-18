<?php

namespace Database\Seeders;

use App\Models\Word;
use Illuminate\Database\Seeder;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = file_get_contents(database_path('seeders/keywords.txt'));
        $datas = explode(PHP_EOL, $content);
        $datas = array_unique($datas);
        foreach ($datas as $v) {
            Word::firstOrCreate(['name' => $v], ['name' => $v]);
        }
        //dump($datas);
    }
}
