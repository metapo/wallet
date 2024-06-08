<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'user']);

        try {
            DB::beginTransaction();
            $user = User::factory()->create([
                'name' => 'user1',
                'email' => 'user1@local.dev'
            ]);

            $user->assignRole($role);
            DB::commit();
            $this->command->info('user created successfully!');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->error('Failed to create user. Please try again.');
        }
    }
}
