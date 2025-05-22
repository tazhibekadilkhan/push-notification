<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $name;
    protected static ?string $alias;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => static::$name ?? fake()->word,
            'alias' => static::$alias ?? fake()->word,
        ];
    }
}
