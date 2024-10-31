<?php

namespace Database\Seeders;

use App\Enums\DropDownFields;
use App\Enums\Modules;
use App\Models\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmsNotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SMS_NOTIFICATION_TYPE = [
            ['name' => 'SMS', 'value' => 'SMS', 'module' => Modules::MAIN, 'field' => DropDownFields::SMS_NOTIFICATION_TYPE],
        ];

        foreach ($SMS_NOTIFICATION_TYPE as $value) {
            Constant::updateOrCreate($value);
        }

        $this->command->info('SMS_NOTIFICATION_TYPE Seeded successfully!');
    }
}
