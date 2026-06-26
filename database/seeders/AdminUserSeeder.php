<?php
declare(strict_types=1);
namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        User::create([
            'name' => 'Admin SportZ',
            'email' => 'admin@sportz.id',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);
    }
}
