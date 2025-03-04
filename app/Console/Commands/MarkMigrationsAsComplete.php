<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MarkMigrationsAsComplete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:mark-complete {migration?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark pending migrations as complete without running them';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $pendingMigrations = [
            '2023_12_01_000001_create_order_items_table',
            '2025_03_02_092502_create_orders_table',
            '2025_03_02_092503_create_order_items_table',
            '2025_03_03_061605_add_contact_number_to_orders_table'
        ];

        $migration = $this->argument('migration');
        
        // Get the last batch number
        $lastBatch = DB::table('migrations')->max('batch') ?? 0;
        
        if ($migration) {
            if (in_array($migration, $pendingMigrations)) {
                $this->markMigrationAsComplete($migration, $lastBatch + 1);
                $this->info("Migration {$migration} marked as complete.");
            } else {
                $this->error("Migration {$migration} is not in the pending list.");
                return 1;
            }
        } else {
            // Mark all pending migrations as complete
            foreach ($pendingMigrations as $pendingMigration) {
                $this->markMigrationAsComplete($pendingMigration, $lastBatch + 1);
            }
            
            $this->info("All pending migrations marked as complete.");
        }
        
        return 0;
    }
    
    /**
     * Mark a migration as complete by inserting it into the migrations table.
     *
     * @param string $migration
     * @param int $batch
     * @return void
     */
    protected function markMigrationAsComplete($migration, $batch)
    {
        // Check if the migration already exists in the migrations table
        $exists = DB::table('migrations')
            ->where('migration', $migration)
            ->exists();
            
        if (!$exists) {
            DB::table('migrations')->insert([
                'migration' => $migration,
                'batch' => $batch
            ]);
            
            $this->line("<info>Marked:</info> {$migration}");
        } else {
            $this->line("<comment>Already exists:</comment> {$migration}");
        }
    }
} 