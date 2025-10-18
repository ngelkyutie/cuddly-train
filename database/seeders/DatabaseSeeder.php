<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database safely.
     */
    public function run(): void
    {
        // Helper function to check if a column exists and email doesn't exist
        $safeInsert = function(array $data) {
            $table = (new User())->getTable();

            // Skip if email already exists
            if (isset($data['email']) && User::where('email', $data['email'])->exists()) {
                return null;
            }

            $filteredData = [];
            foreach ($data as $column => $value) {
                if (Schema::hasColumn($table, $column)) {
                    $filteredData[$column] = $value;
                }
            }

            return User::create($filteredData);
        };

        // Patient account
        $safeInsert([
            'name' => 'User 1',
            'email' => 'patient@example.com',
            'username' => 'patient01',
            'password' => Hash::make('User'),
            'role' => 'patient',
            'phone' => '09171234567',
            'address' => '123 Test Street, Manila',
            'date_of_birth' => '1995-01-01',
        ]);

        // Staff account
        $safeInsert([
            'name' => 'Staff 1',
            'email' => 'staff@example.com',
            'username' => 'staff01',
            'password' => Hash::make('Staff'),
            'role' => 'staff',
            'phone' => '09172345678',
            'address' => '456 Staff Lane, Manila',
            'date_of_birth' => '1990-05-20',
        ]);

        // Admin account
        $safeInsert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'username' => 'admin01',
            'password' => Hash::make('Admin'),
            'role' => 'dentist',
            'phone' => '09173456789',
            'address' => '789 Admin Ave, Manila',
            'date_of_birth' => '1985-01-01',
        ]);
    }
}
