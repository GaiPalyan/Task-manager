<?php

namespace Database\Factories;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class LabelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Label::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Arr::random(['bug', 'documentation', 'duplicate', 'enhancement', 'good first issue']),
            'description' => Arr::random(
                [
                    'Indicates an unexpected problem or unintended behavior',
                    'Indicates a need for improvements or additions to documentation',
                    'Indicates similar issues or pull requests',
                    'Indicates new feature requests',
                    'Indicates a good issue for first-time contributors',
                ]),
        ];
    }
}
