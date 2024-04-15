<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

#[AsCommand(
    'app:create-super-admin-user',
    'Create an administrator for the system, also this user is the first user and it will be used for "start" application'
)]
class CreateSuperAdminUser extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {

        $this->components->alert('Create a new administrator user');

        $user = new User();
        $user->first_name = $this->askFirstName();
        $user->last_name = $this->askLastName();
        $user->mobile = $this->askMobileNumber();
        $user->date_of_birth = $this->askDateOfBirth();
        $user->username = $this->askUsername();
        $user->password = $this->askPassword();
        $user->email = $this->askEmail();
        $user->superadmin = true;

        $user->save();

        $this->components->task('User created successfully.');
    }

    protected function askFirstName(): string
    {
        return text(
            'Type your first name',
            sprintf('E.g. %s', fake()->firstName()),
            required: true,
        );
    }
    protected function askLastName(): string
    {
        return text(
            'Type your last name.',
            sprintf('E.g. %s', fake()->lastName()),
            required: true,
        );
    }

    protected function askPassword(): string
    {
         return password(
            'Type your account password.',
            'E.g. type a strong password',
            true,
        );
    }

    protected function askMobileNumber(): ?string
    {
        return text(
            'Type your mobile number.',
            'E.g. +351 21 343 2148',
            '',
            false,
        ) ?: null;
    }

    protected function askDateOfBirth(): ?string
    {
        return text(
            'Type your date of birth.',
            'E.g. 04/10/1991',
            '',
            false,
            validate: function ($result): ?string {
                try {
                    $result === '' || Carbon::createFromFormat('m/d/Y', $result);
                    return null;
                } catch (InvalidFormatException) {
                    return 'Type a valid date format (as mm/dd/yyyy)';
                }
            }
        ) ?: null;
    }

    protected function askUsername(): string
    {
        return text(
            'Type your desirable username.',
            sprintf('E.g %s', fake()->userName()),
            required: true,
        );
    }

    protected function askEmail(): string
    {
        return text(
            'Type your desirable email.',
            sprintf('E.g %s', fake()->email()),
            required: true,
        );
    }
}
