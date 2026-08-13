<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MigrateSqliteCommand extends Command
{
    protected $signature = 'migrate:sqlite';
    protected $description = 'Run migrations only for SQLite database';

    public function handle()
    {
        $this->call('migrate', [
            '--database' => 'sqlite',
            '--path' => 'database/migrations_sqlite',
        ]);
    }
}
