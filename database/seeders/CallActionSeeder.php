<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CallActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CALL_ACTION = [
            ['name' => 'Clinic Appointment', 'value' => 'Clinic Appointment', 'module' => Modules::MAIN, 'field' => DropDownFields::CALL_ACTION],
            ['name' => 'Diagnostic Tests', 'value' => 'Diagnostic Tests', 'module' => Modules::MAIN, 'field' => DropDownFields::CALL_ACTION],
            ['name' => 'Inquiry', 'value' => 'Inquiry', 'module' => Modules::MAIN, 'field' => DropDownFields::CALL_ACTION],
        ];


        foreach ($CALL_ACTION as $value) {
            Constant::updateOrCreate($value);
        }

        $this->command->info('CALL_ACTION Seeded successfully!');
    }
}
