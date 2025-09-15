<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ProjectSetup extends Command
{
    protected $signature = 'project:setup {--fresh : Run fresh migration instead of just migrate}';
    protected $description = 'Setup the complete project: migrations, storage link, and seed data with images';

    public function handle()
    {
        $this->info('🚀 Starting project setup...');

        // 1. Storage link
        $this->info('📁 Creating storage link...');
        try {
            Artisan::call('storage:link');
            $this->info('✅ Storage link created successfully!');
        } catch (\Exception $e) {
            $this->warn('⚠️  Storage link already exists or failed: ' . $e->getMessage());
        }

        // 2. Database migration
        if ($this->option('fresh')) {
            $this->info('🔄 Running fresh migrations...');
            Artisan::call('migrate:fresh');
        } else {
            $this->info('📋 Running migrations...');
            Artisan::call('migrate');
        }
        $this->info('✅ Database migrations completed!');

        // 3. Seed database (this will automatically setup images and seed courses)
        $this->info('🌱 Seeding database with course data and images...');
        Artisan::call('db:seed');
        $this->info('✅ Database seeding completed!');

        // 4. Show summary
        $this->newLine();
        $this->info('🎉 Project setup completed successfully!');
        $this->newLine();

        $coursesCount = DB::table('courses')->count();
        $this->line("📊 Total courses seeded: {$coursesCount}");

        $imagesPath = public_path('imagens-banners');
        $imageFiles = glob($imagesPath . '/*.png');
        $imagesCount = count($imageFiles);
        $this->line("🖼️  Images available: {$imagesCount}");

        $this->newLine();
        $this->info('Your Laravel application is ready! 🚀');
        $this->info('Course images are available at: /imagens-banners/');

        return Command::SUCCESS;
    }
}