<?php


namespace Training\Tests\Helpers;


class DatabaseHelper
{

    public static function getConnection()
    {
        $pdo = new \PDO(sprintf('sqlite:%s', ROOT_DIR . '/training.db'));
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public static function createTableIfNotExists($table)
    {
        $pdo = self::getConnection();

        $path = ROOT_DIR . "/tests/Datasets/Tables/create.table.%s.sql";
        $ddl = file_get_contents(sprintf($path, $table));

        return $pdo->exec($ddl);
    }


    public static function listTables()
    {
        $pdo = self::getConnection();

        $sql = "SELECT name FROM sqlite_master WHERE type = 'table' ORDER BY name";

        $stmt = $pdo->query($sql);
        $tables = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tables[] = $row['name'];
        }

        return $tables;
    }

    public static function truncateTable($table)
    {
        $pdo = self::getConnection();

        $sql = sprintf("DELETE FROM %s", $table);

        return $pdo->exec($sql);
    }

}