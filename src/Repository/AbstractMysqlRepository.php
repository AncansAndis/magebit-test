<?php
namespace Repository;

use PDO;

abstract class AbstractMysqlRepository
{
    abstract public function __construct(PDO $pdo);
}
