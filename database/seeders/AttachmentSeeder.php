<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ATTACHMENT_TYPE = [
            ['name' => 'ID Card Picture', 'value' => 'id_card_picture', 'module' => Modules::Patient, 'field' => DropDownFields::ATTACHMENT_TYPE],
            ['name' => 'Sick fund paper', 'value' => 'sick_fund_paper', 'module' => Modules::Patient, 'field' => DropDownFields::ATTACHMENT_TYPE],
            ['name' => 'Internal Appointment', 'value' => 'internal_appointment', 'module' => Modules::Patient, 'field' => DropDownFields::ATTACHMENT_TYPE],
            ['name' => 'External Appointment', 'value' => 'external_appointment', 'module' => Modules::Patient, 'field' => DropDownFields::ATTACHMENT_TYPE],
        ];
        foreach ($ATTACHMENT_TYPE as $value) {
            Constant::updateOrCreate($value);
        }


        $this->command->info('ATTACHMENT_TYPE Seeded successfully!');
    }
}
