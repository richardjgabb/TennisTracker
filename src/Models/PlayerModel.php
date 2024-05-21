<?php

namespace App\Models;

use App\Entities\PlayerEntity;
use PDO;

class PlayerModel
{
    private PDO $db;

    public function __construct (PDO $db)
    {
        $this->db = $db;
    }

    public function getPlayerById(int $id)
    {
        $query = $this->db->prepare(
            "SELECT `id`, `username`, `email` FROM `users` WHERE `id` = :id");
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->fetch();
    }
}