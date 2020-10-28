<?php

namespace Database\Factories;

use App\Models\Landing;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LandingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Landing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return  [
            'hero_overtitle' => $this->faker->sentence(6),
            'hero_title'  => $this->faker->sentence(4),
            'hero_subtitle' => $this->faker->sentence(8),
            'hero_video' => 'http://clips.vorwaerts-gmbh.de/VfE_html5.mp4',
            'hero_banner' => $this->faker->imageUrl('1920', '1080', 'cats'),
            'newsletter_title' => $this->faker->sentence(5),
            'newsletter_text' => $this->faker->paragraph(1),
            'newsletter_image' => $this->faker->imageUrl('640', '360', 'cats'),
            'service1_title' => $this->faker->sentence(8),
            'service1_text' => $this->faker->paragraph(4),
            'service1_image' => $this->faker->imageUrl('600', '300', 'cats'),
            'service2_title' => $this->faker->sentence(8),
            'service2_text' => $this->faker->paragraph(4),
            'service2_image' => $this->faker->imageUrl('640', '360', 'cats'),
            'whoami_title' => $this->faker->sentence(6),
            'whoami_text' => $this->faker->paragraph(6),
            'whoami_image' => $this->faker->imageUrl('350', '600', 'cats'),
            'getstarted1_title' => $this->faker->sentence(6),
            'getstarted1_text' => $this->faker->paragraph(2),
            'getstarted2_title' => $this->faker->sentence(6),
            'getstarted2_text' => $this->faker->paragraph(2),
            'getstarted3_title' => $this->faker->sentence(6),
            'getstarted3_text' => $this->faker->paragraph(2),
            'contact_subtitle' => $this->faker->sentence(10),
            'contact_image' => $this->faker->imageUrl('1920', '1080', 'cats'),
        ];
    }
}
