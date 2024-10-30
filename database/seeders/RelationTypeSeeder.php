<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Seeder;

class RelationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $RELATION_TYPE = [
        //     ['name' => 'Spouse', 'value' => 'Spouse', 'module' => Modules::Patient, 'field' => DropDownFields::RELATION_TYPE],
        //     ['name' => 'Parent', 'value' => 'Parent', 'module' => Modules::Patient, 'field' => DropDownFields::RELATION_TYPE],
        //     ['name' => 'Child', 'value' => 'Child', 'module' => Modules::Patient, 'field' => DropDownFields::RELATION_TYPE],
        //     ['name' => 'Sibling', 'value' => 'Sibling', 'module' => Modules::Patient, 'field' => DropDownFields::RELATION_TYPE],
        //     ['name' => 'Friend', 'value' => 'Friend', 'module' => Modules::Patient, 'field' => DropDownFields::RELATION_TYPE],
        //     ['name' => 'Other', 'value' => 'Other', 'module' => Modules::Patient, 'field' => DropDownFields::RELATION_TYPE],
        // ];

        // foreach ($RELATION_TYPE as $value) {
        //     Constant::updateOrCreate($value);
        // }

        // $this->command->info('RELATION_TYPE Seeded successfully!');
    }
}
