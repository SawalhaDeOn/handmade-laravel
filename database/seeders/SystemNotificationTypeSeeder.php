<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SystemNotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SYSTEM_NOTIFICATION_TYPE = [
            ['name' => 'Firebase', 'value' => 'Firebase', 'module' => Modules::MAIN, 'field' => DropDownFields::SYSTEM_NOTIFICATION_TYPE],
            ['name' => 'Email', 'value' => 'Email', 'module' => Modules::MAIN, 'field' => DropDownFields::SYSTEM_NOTIFICATION_TYPE],
        ];

        foreach ($SYSTEM_NOTIFICATION_TYPE as $value) {
            Constant::updateOrCreate($value);
        }

        $this->command->info('SYSTEM_NOTIFICATION_TYPE Seeded successfully!');
    }
}
