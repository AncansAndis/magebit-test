<?php
namespace Factory\Repository;

use PDO;

class MysqlRepositoryFactory
{
    /**
     * @param $className
     * @return mixed
     */
    public function create($className)
    {
        $instance = $className;
        return new $instance(
            new PDO(DB_CONN, DB_USER, DB_PASSWORD)
        );
    }
}
