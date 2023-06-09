<?php

declare(strict_types=1);

namespace App\Database;

use App\Model\Pizza;

class PizzaTable {

    private \PDO $connection;

    public function __construct(\PDO $connection) {
        $this->connection = $connection;
    }

    /**
     * getAllPizzas
     *
     * @return Pizza[]
     */
    public function getAllPizzas(): array
    {
        $query = <<< SQL
            SELECT
                id, pizza_name, pizza_description, pizza_cost
            FROM pizza
        SQL;

        $statement = $this->connection->query($query);
        $pizzas = [];
        foreach ($statement->fetchAll(\PDO::FETCH_ASSOC) as $row) {
            $pizzas[] = $this->createPizzaFromRow($row);
        }

        return $pizzas;
    }

    public function find(int $id): ?Pizza {
        $query = "SELECT id, pizza_name, pizza_description, pizza_cost FROM pizza WHERE id = $id";
        $statement = $this->connection->query($query);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            return $this->createPizzaFromRow($row);
        }
        return null;
    }

    private function createPizzaFromRow(array $row): Pizza {
        return new Pizza (
            (int)$row['id'],
            $row['pizza_name'],
            $row['pizza_description'],
            $row['pizza_cost']
        );
    }

    public function add(Pizza $pizza): int {
        $query = <<<SQL
        INSERT INTO pizza (pizza_name, pizza_description, pizza_cost)
        VALUES (:pizza_name, :pizza_description, :pizza_cost)
        SQL;
        $statement = $this->connection->prepare($query);
        $statement->execute([
            ':pizza_name' => $pizza->getPizzaName(),
            ':pizza_description' => $pizza->getPizzaDescription(),
            ':pizza_cost' => $pizza->getPizzaCost(),
        ]);
        return (int)$this->connection->lastInsertId();
    }

    public function delete(int $pizzaId): void
    {
        $query = <<<SQL
        DELETE FROM pizza WHERE id = :pizza_id
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute([
            ':pizza_id' => $pizzaId
        ]);
    }
}
