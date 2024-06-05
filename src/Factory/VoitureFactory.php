<?php

namespace App\Factory;

use App\Entity\Voiture;
use App\Repository\VoitureRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Voiture>
 *
 * @method        Voiture|Proxy                     create(array|callable $attributes = [])
 * @method static Voiture|Proxy                     createOne(array $attributes = [])
 * @method static Voiture|Proxy                     find(object|array|mixed $criteria)
 * @method static Voiture|Proxy                     findOrCreate(array $attributes)
 * @method static Voiture|Proxy                     first(string $sortedField = 'id')
 * @method static Voiture|Proxy                     last(string $sortedField = 'id')
 * @method static Voiture|Proxy                     random(array $attributes = [])
 * @method static Voiture|Proxy                     randomOrCreate(array $attributes = [])
 * @method static VoitureRepository|RepositoryProxy repository()
 * @method static Voiture[]|Proxy[]                 all()
 * @method static Voiture[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Voiture[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Voiture[]|Proxy[]                 findBy(array $attributes)
 * @method static Voiture[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Voiture[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class VoitureFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        $day_price = self::faker()->randomFloat(2, 10, 1000);
        $month_price = self::faker()->randomFloat(2, 10, 1000);
        return [
            'day_price' => $day_price,
            'description' => self::faker()->text(80),
            'month_price' => $month_price,
            'name' => self::faker()->text(30),
            'seat_count' => self::faker()->numberBetween(1, 12),
            'transmission' => self::faker()->randomElement(['automatic', 'manuel']),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Voiture $voiture): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Voiture::class;
    }
}
