<?php

namespace Database\Seeders;

use App\Models\HardwareCategory;
use App\Models\HardwareItem;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SosInventorySeeder extends Seeder
{
    public function run(): void
    {
        $staff = User::query()->firstOrCreate(
            ['email' => 'staff@sos.edu'],
            [
                'name' => 'SOS Staff',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'is_staff' => true,
            ]
        );

        $categories = [
            ['name' => 'Networking', 'slug' => 'networking'],
            ['name' => 'Laptops', 'slug' => 'laptops'],
            ['name' => 'Desktops', 'slug' => 'desktops'],
            ['name' => 'Printers', 'slug' => 'printers'],
        ];

        foreach ($categories as $categoryData) {
            $category = HardwareCategory::query()->firstOrCreate(
                ['slug' => $categoryData['slug']],
                ['name' => $categoryData['name']]
            );

            HardwareItem::query()->firstOrCreate(
                ['asset_tag' => strtoupper($category->slug).'-001'],
                [
                    'hardware_category_id' => $category->id,
                    'name' => $category->name.' Item 1',
                    'serial_number' => strtoupper($category->slug).'SN001',
                    'status' => 'available',
                    'location' => 'ICT Lab',
                ]
            );

            HardwareItem::query()->firstOrCreate(
                ['asset_tag' => strtoupper($category->slug).'-002'],
                [
                    'hardware_category_id' => $category->id,
                    'name' => $category->name.' Item 2',
                    'serial_number' => strtoupper($category->slug).'SN002',
                    'status' => 'assigned',
                    'location' => 'ICT Store',
                    'assigned_to_user_id' => $staff->id,
                ]
            );
        }
    }
}

