<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->superadmin()
            ->count(50)
            ->sequence(
                fn (Sequence $sequence): array => [
                    'last_logged_in' =>  random_int(0, 10) > 3 ? Carbon::now() : null,
                    'date_of_birth' => random_int(0, 10) > 5 ? Carbon::now()->subDays(random_int(365, 10000)) : null,
                ]
            )
            ->create();

        User::factory()
            ->notSuperadmin()
            ->count(2)
            ->create();
    }
}
