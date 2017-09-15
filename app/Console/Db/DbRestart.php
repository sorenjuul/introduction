<?php

namespace App\Console\Db;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PDO;
use RuntimeException;

class DbRestart extends \Illuminate\Console\Command
{
    protected $signature = 'db:restart';
    protected $description = 'Restart database aka. drop, migrate and seed';

    public function fire()
    {
        if (App::environment('production')) {
            throw new RuntimeException('Do NOT run in production!');
        }

        $conn = DB::connection();

        //$colname = 'Tables_in_' . $database_config['database'];
        $tablesStatement = $conn->getPdo()->query('SHOW TABLES');

        $droplist = [];

        while ($row = $tablesStatement->fetch(PDO::FETCH_NUM)) {
            $droplist[] = $row[0];
        }


        if (count($droplist) > 0) {
            $droplist = implode(', ', $droplist);
            $conn->statement('SET FOREIGN_KEY_CHECKS = 0');
            $conn->statement('DROP TABLE '.$droplist);
            $conn->statement('SET FOREIGN_KEY_CHECKS = 1');
        }

        $this->call('migrate');
        $this->call('db:seed');
    }
}