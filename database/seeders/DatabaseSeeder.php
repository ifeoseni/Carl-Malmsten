<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use App\Models\ServiceCard;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin login comes from .env (ADMIN_EMAIL / ADMIN_PASSWORD); change it from Admin > Profile.
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@carlmalmsten.test')],
            ['name' => env('ADMIN_NAME', 'Carl'), 'password' => Hash::make(env('ADMIN_PASSWORD', 'ChangeMe!2026'))]
        );

        if (MenuItem::count() === 0) {
            foreach ([
                ['header', 'Services', false],
                ['header', 'Approach', false],
                ['header', 'Book a Session', true],
                ['footer', 'Privacy Policy', false],
                ['footer', 'Terms & Conditions', false],
            ] as $i => [$location, $label, $button]) {
                MenuItem::create(['location' => $location, 'label' => $label, 'url' => '#', 'is_button' => $button, 'order' => $i + 1]);
            }
        }

        if (ServiceCard::count() === 0) {
            foreach ([
                ['Individual Work', "Clarity, direction, and
grounded change", 'images/icon-individual.png'],
                ['Couples Work', "Understanding patterns.
Strengthening Connection.", 'images/icon-couples.png'],
                ["Men's Work", "Responsibility, presence,
and direction.", 'images/icon-mens.png'],
            ] as $i => [$title, $text, $icon]) {
                ServiceCard::create(['title' => $title, 'description' => $text, 'icon' => $icon, 'url' => '#', 'order' => $i + 1]);
            }
        }
    }
}
