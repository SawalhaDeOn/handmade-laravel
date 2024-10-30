<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $QUESTIONNAIRE_TYPE = [
            ['name' => 'Questionnaire 1', 'value' => '1', 'module' => Modules::Patient, 'field' => DropDownFields::QUESTIONNAIRE_TYPE],
            ['name' => 'Questionnaire 2', 'value' => '1', 'module' => Modules::Patient, 'field' => DropDownFields::QUESTIONNAIRE_TYPE],
        ];

        foreach ($QUESTIONNAIRE_TYPE as $value) {
            Constant::updateOrCreate($value);
        }


        $this->command->info('QUESTIONNAIRE_TYPE Seeded successfully!');
    }
}
