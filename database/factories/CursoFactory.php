<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    protected $model = Curso::class;

    public function definition()
    {
        $categories = [
            'Tecnologia',
            'Design',
            'Marketing',
            'Negócios',
            'Desenvolvimento Pessoal',
            'Idiomas',
            'Saúde',
            'Arte',
            'Música',
            'Culinária'
        ];

        $owners = [
            'Ana Silva',
            'Carlos Oliveira',
            'Maria Santos',
            'João Pereira',
            'Fernanda Costa',
            'Roberto Lima',
            'Juliana Alves',
            'Pedro Rodrigues',
            'Camila Ferreira',
            'André Sousa'
        ];

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'categories' => $this->faker->randomElements($categories, $this->faker->numberBetween(1, 2)),
            'owner' => $this->faker->randomElement($owners),
            'image' => 'https://picsum.photos/300/200?random=' . $this->faker->numberBetween(1, 1000),
            'banner' => 'https://picsum.photos/800/400?random=' . $this->faker->numberBetween(1, 1000),
        ];
    }
}