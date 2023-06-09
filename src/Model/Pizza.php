<?php
declare(strict_types=1);

namespace App\Model;

class Pizza
{
    private ?int $pizzaId;
    private string $name;
    private string $description;
    private string $cost;


    public function __construct
    (
        ?int    $pizzaId,
        string  $name,
        string  $description,
        string  $cost
    )
    {
        $this->pizzaId = $pizzaId;
        $this->name = $name;
        $this->description = $description;
        $this->cost = $cost;
    }

    public function getPizzaId(): ?int
    {
        return $this->pizzaId;
    }

    public function getPizzaName(): string
    {
        return $this->name;
    }

    public function getPizzaDescription(): string
    {
        return $this->description;
    }

    public function getPizzaCost(): string
    {
        return $this->cost;
    }
}
