<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\TestConnectionService;
use Illuminate\Console\Command;

class TestConnectionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-connections';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test Connections';

    /**
     * Execute the console command.
     */
    public function handle(TestConnectionService $service): void
    {
        foreach ($service->testPredefinedConnections() as $type => $connections) {
            $this->info("Testing {$type} connections...");
            foreach ($connections as $connection => $status) {
                $this->info("- {$type} connection {$connection} is " . ($status ? 'OK' : 'FAILED'));
            }
        }
    }
}
