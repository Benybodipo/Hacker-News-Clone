<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    private $types = [
        1 => 'job',
        2 => 'story',
        3 => 'comment',
        4 => 'poll',
        5 => 'pollopt',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->types as $id => $name) {
            Type::create([
                'name' => $name,
            ]);
        }
    }
}
