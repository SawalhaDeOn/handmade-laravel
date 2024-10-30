<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomSmsMessage extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SHORT_MESSAGE_TEMPLATE = [
            ['name' => 'السيد\ة <patient> اهلا بانضمامك لعيادة', 'value' => 'Welcoming', 'module' => Modules::MAIN, 'field' => DropDownFields::SHORT_MESSAGE_TEMPLATE],
            ['name' => 'السيد\ة <patient> اهلا بانضمامك لعيادة ', 'value' => 'Greeting', 'module' => Modules::MAIN, 'field' => DropDownFields::SHORT_MESSAGE_TEMPLATE],
            ['name' => 'السيد\ة <patient> كل عام و انت بخير نتمنى لك العمر المديد', 'value' => 'Birthday', 'module' => Modules::MAIN, 'field' => DropDownFields::SHORT_MESSAGE_TEMPLATE],
            ['name' => 'اعضاء ميئوحيدت الكرام نود ابلاغكم بخدمة جديد ', 'value' => 'New Service', 'module' => Modules::MAIN, 'field' => DropDownFields::SHORT_MESSAGE_TEMPLATE],
        ];

        foreach ($SHORT_MESSAGE_TEMPLATE as $value) {
            Constant::updateOrCreate($value);
        }

        $this->command->info('SHORT_MESSAGE_TEMPLATE Seeded successfully!');
    }
}
