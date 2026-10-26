<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $sharedPassword = app()->environment('local') && config('demo.auth_enabled')
            ? config('demo.shared_password')
            : null;
        $demoPasswordHash = $sharedPassword ? Hash::make($sharedPassword) : null;

        $counts = [
            User::ROLE_SUBSCRIBER => 30,
            User::ROLE_EDITOR => 8,
            User::ROLE_MODERATOR => 5,
        ];

        foreach ($counts as $role => $count) {
            for ($number = 1; $number <= $count; $number++) {
                $email = sprintf('%s.%02d@example.test', $role, $number);

                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => sprintf('Demo %s %02d', ucfirst($role), $number),
                        'role' => $role,
                        'password' => $demoPasswordHash
                            ? $demoPasswordHash
                            : Hash::make(Str::random(64)),
                        'email_verified_at' => null,
                    ],
                );

                $user->forceFill(['is_demo' => true])->save();
            }
        }

        $owner = User::query()->where('role', User::ROLE_ADMIN)->first();

        if ($owner) {
            // Keep a later email change when this seeder is run again.
            $owner->forceFill([
                'name' => 'QngChan',
                'is_demo' => true,
            ]);
            if ($demoPasswordHash) {
                $owner->password = $demoPasswordHash;
            }
            $owner->save();
        } else {
            $owner = User::updateOrCreate(
                ['email' => 'qngchan@example.test'],
                [
                    'name' => 'QngChan',
                    'role' => User::ROLE_ADMIN,
                    'password' => $demoPasswordHash
                        ? $demoPasswordHash
                        : Hash::make(Str::random(64)),
                    'email_verified_at' => null,
                ],
            );

            $owner->forceFill(['is_demo' => true])->save();
        }
    }
}
