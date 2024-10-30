<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Seeder;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ALHAYAT_BRANCHES = [
            ['name' => 'Kufor Aqab', 'value' => '295', 'module' => Modules::Patient, 'field' => DropDownFields::ALHAYAT_BRANCHES],
            ['name' => 'Shufat', 'value' => '35', 'module' => Modules::Patient, 'field' => DropDownFields::ALHAYAT_BRANCHES],
            ['name' => 'Ras El- Amoud', 'value' => '31', 'module' => Modules::Patient, 'field' => DropDownFields::ALHAYAT_BRANCHES],
            ['name' => 'heikh Jarrah', 'value' => '146', 'module' => Modules::Patient, 'field' => DropDownFields::ALHAYAT_BRANCHES],
            ['name' => 'Bab El-Sahera', 'value' => '14', 'module' => Modules::Patient, 'field' => DropDownFields::ALHAYAT_BRANCHES],
            ['name' => 'Beit Hanina', 'value' => '145', 'module' => Modules::Patient, 'field' => DropDownFields::ALHAYAT_BRANCHES],
        ];

        foreach ($ALHAYAT_BRANCHES as $value) {
            Constant::updateOrCreate($value);
        }

        $this->command->info('ALHAYAT_BRANCHES Seeded successfully!');
    }
}
