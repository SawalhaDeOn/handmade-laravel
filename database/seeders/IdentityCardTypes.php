<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IdentityCardTypes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $IDENTITY_TYPE = [
            ['name' => 'Palestinian ID', 'value' => '1', 'module' => Modules::MAIN, 'field' => DropDownFields::IDENTITY_TYPE],
            ['name' => 'Israeli ID', 'value' => '2', 'module' => Modules::MAIN, 'field' => DropDownFields::IDENTITY_TYPE],

            ['name' => 'Send To Leads', 'value' => 'Send To Leads', 'module' => Modules::TAWK, 'field' => DropDownFields::status],
            ['name' => 'Call', 'value' => 'Call', 'module' => Modules::TAWK, 'field' => DropDownFields::status],
            ['name' => 'Chat', 'value' => 'Chat', 'module' => Modules::TAWK, 'field' => DropDownFields::status],



            ['name' => 'processing', 'value' => 'processing', 'module' => Modules::LEAD, 'field' => DropDownFields::status],
            ['name' => 'completed', 'value' => 'completed', 'module' => Modules::LEAD, 'field' => DropDownFields::status],
            ['name' => 'Request to Register', 'value' => 'Request to Register', 'module' => Modules::LEAD, 'field' => DropDownFields::type],
            ['name' => 'Request to Rent', 'value' => 'Request to Rent', 'module' => Modules::LEAD, 'field' => DropDownFields::type],


            ['name' => 'data completed', 'value' => 'processing', 'module' => Modules::CLIENT, 'field' => DropDownFields::status],
            ['name' => 'data loss', 'value' => 'completed', 'module' => Modules::CLIENT, 'field' => DropDownFields::status],
            ['name' => 'From Webstie', 'value' => 'Request to Register', 'module' => Modules::CLIENT, 'field' => DropDownFields::type],
            ['name' => 'From CallCenter', 'value' => 'Request to Rent', 'module' => Modules::CLIENT, 'field' => DropDownFields::type],

            ['name' => 'Gold', 'value' => 'Gold', 'module' => Modules::CLIENT, 'field' => DropDownFields::category],
            ['name' => 'Normal', 'value' => 'Normal', 'module' => Modules::CLIENT, 'field' => DropDownFields::category],


        ];

        foreach ($IDENTITY_TYPE as $value) {
            Constant::updateOrCreate($value);
        }

        $this->command->info('IDENTITY_TYPE Seeded successfully!');
    }
}
