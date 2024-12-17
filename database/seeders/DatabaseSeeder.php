<?php

namespace Database\Seeders;

use App\Models\Approval;
use App\Models\Driver;
use App\Models\Mine;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Role;
use App\Models\Vehicle;
use App\Models\VehicleService;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRoleId = Uuid::uuid7();
        $approverRoleId = Uuid::uuid7();

        Role::insert([
            [
                'role_id' => $adminRoleId,
                'role_name' => 'Admin'
            ],
            [
                'role_id' => $approverRoleId,
                'role_name' => 'Approver'
            ]
        ]
        );

        User::insert([
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $adminRoleId,
                'fullname' => 'Admin 1',
                'email' => 'admin@gmail.com',
                'position' => 'Admin Sistem',
                'password' => Hash::make('pass123')
            ],
            [
                'user_id' => Uuid::uuid7(),
                'role_id' => $approverRoleId,
                'fullname' => 'Manager 1',
                'email' => 'manager@gmail.com',
                'position' => 'Manager',
                'password' => Hash::make('pass123')
            ]
        ]);

        Mine::insert([
            [
                'mine_name' => 'Batu Bara Jaya',
                'mine_location' => 'Kalimantan Selatan',
            ],
            [
                'mine_name' => 'Tambang Nikel Sejahtera',
                'mine_location' => 'Sulawesi Tenggara',
            ],
            [
                'mine_name' => 'Emas Makmur Sentosa',
                'mine_location' => 'Papua Barat',
            ],
            [
                'mine_name' => 'Granite Abadi',
                'mine_location' => 'Riau',
            ],
            [
                'mine_name' => 'Zinc Mineral Nusantara',
                'mine_location' => 'Jawa Timur',
            ],
            [
                'mine_name' => 'Kapur Lestari',
                'mine_location' => 'Sumatera Barat',
            ],
        ]);

        Driver::factory(30)->create();

        User::factory(25)->role('Approver')->create();

        Vehicle::factory(50)->create();

        Reservation::factory(200)->create();

        VehicleService::factory(10)->create();

        Approval::factory(400)->create();
    }
}
