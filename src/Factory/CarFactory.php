<?php

namespace App\Factory;

use App\Entity\Car;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

final class CarFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'day_price' => self::faker()->randomFloat(2, 10, 1000),
            'description' => self::faker()->text(80),
            'month_price' => self::faker()->randomFloat(2, 10, 1000),
            'name' => self::faker()->text(30),
            'seat_count' => self::faker()->numberBetween(1, 12),
            'transmission' => self::faker()->randomElement(['automatic', 'manuel']),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Car::class;
    }
}
