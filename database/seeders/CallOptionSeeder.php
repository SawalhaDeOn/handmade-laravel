<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CallOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CALL_OPTION_TYPE = [
            ['name' => 'External Appointment', 'value' => 'External Appointment', 'module' => Modules::CALL, 'field' => DropDownFields::CALL_OPTION_TYPE],
            ['name' => 'Internal Appointment', 'value' => 'Internal Appointment', 'module' => Modules::CALL, 'field' => DropDownFields::CALL_OPTION_TYPE],
            ['name' => 'Complain', 'value' => 'Complain', 'module' => Modules::CALL, 'field' => DropDownFields::CALL_OPTION_TYPE],
            ['name' => 'Inquiry', 'value' => 'Inquiry', 'module' => Modules::CALL, 'field' => DropDownFields::CALL_OPTION_TYPE],
        ];

        foreach ($CALL_OPTION_TYPE as $value) {
            Constant::updateOrCreate($value);
        }

        $this->command->info('CALL_OPTION_TYPE Seeded successfully!');
    }
}
