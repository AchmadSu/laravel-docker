<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    // NOTE: THIS HAS TO RUN WITH LOOPING IN TERMINAL TO EXECUTE NORMALLY
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $maxNumber = $this->getMaxNumber();
        return [
            'name' => $this->faker->city(),
            'code' => 'city_' . $maxNumber,
            'country_id' => rand(1, 10)
        ];
    }

    public function getMaxNumber()
    {
        $result = City::selectRaw('MAX(RIGHT(code, 5)) as max_id')
            ->where('code', 'LIKE', '%city_%')
            ->value('max_id');
        $currentMax = $result != null ? (int)$result : 0;
        $newNumber = $currentMax + 1;

        return sprintf("%05d", $newNumber);
    }
}
