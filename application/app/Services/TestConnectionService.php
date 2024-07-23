<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Database\DatabaseManager;
use Illuminate\Redis\RedisManager;

final class TestConnectionService
{
    public const DATABASE_CONNECTIONS = ['mysql', 'mariadb', 'pgsql', 'sqlite'];
    public const REDIS_CONNECTIONS = ['default', 'cache'];

    public function __construct(
        private DatabaseManager $databaseManager,
        private RedisManager $redisManager
    )
    {
    }

    /**
     * @return array<string, array<string, bool>>
     */
    public function testPredefinedConnections(): array
    {
        return [
            'database' => $this->testDatabaseConnections(self::DATABASE_CONNECTIONS),
            'redis' => $this->testRedisConnections(self::REDIS_CONNECTIONS),
        ];
    }

    /**
     * @param list<string> $connections
     * @return array<string, bool>
     */
    public function testDatabaseConnections(array $connections): array
    {
        $result = [];

        foreach ($connections as $connection) {
            try {
                $this->databaseManager->connection($connection)->getPdo();
                $result[$connection] = true;
            } catch (\Throwable $e) {
                $result[$connection] = false;
            }
        }

        return $result;
    }

    public function testRedisConnections(array $connections): array
    {
        $result = [];

        foreach ($connections as $connection) {
            try {
                $this->redisManager->connection($connection)->ping();
                $result[$connection] = true;
            } catch (\Throwable $e) {
                var_dump($e->getMessage());
                $result[$connection] = false;
            }
        }

        return $result;
    }
}
