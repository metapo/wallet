<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);

        try {
            DB::beginTransaction();
            $admin = User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@local.dev'
            ]);

            $admin->assignRole($role);
            DB::commit();
            $this->command->info('Admin user created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->error('Failed to create user. Please try again.');
        }
    }
}
