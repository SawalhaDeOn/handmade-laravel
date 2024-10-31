<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CallDebitActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CALL_PATIENT_ACTION = [
            ['name' => 'Patient Action 1', 'value' => 'Patient Action 1', 'module' => Modules::MAIN, 'field' => DropDownFields::CALL_PATIENT_ACTION],
            ['name' => 'Patient Action 2', 'value' => 'Patient Action 2', 'module' => Modules::MAIN, 'field' => DropDownFields::CALL_PATIENT_ACTION],
        ];

        foreach ($CALL_PATIENT_ACTION as $value) {
            Constant::updateOrCreate($value);
        }
        $this->command->info('CALL_PATIENT_ACTION Seeded successfully!');
    }
}
