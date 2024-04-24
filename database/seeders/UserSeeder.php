<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Random\RandomException;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     */
    public function run(): void
    {
        User::factory()
            ->superadmin()
            ->count(50)
            ->sequence(
                fn (Sequence $sequence): array => [
                    'last_logged_in' =>  random_int(0, 10) > 3 ? Carbon::now()->subDays(random_int(0, 365)) : null,
                    'date_of_birth' => random_int(0, 10) > 5 ? Carbon::now()->subDays(random_int(365, 10000)) : null,
                    'created_at' => Carbon::now()->subDays(random_int(0, 365)),
                    'deleted_at' => random_int(0, 10) > 3 ? Carbon::now()->subDays(random_int(0, 365)) : null,
                ]
            )->createQuietly();

        User::factory()
            ->notSuperadmin()
            ->count(2)
            ->create();
    }
}
