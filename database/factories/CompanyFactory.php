<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $industries = [
            'Technology',
            'E-commerce & Technology',
            'Automotive & Energy',
            'Social Media & Technology',
            'Entertainment & Streaming',
            'Beverages',
            'Electronics',
            'Automotive',
            'Sportswear & Equipment',
            'Food & Beverage',
        ];

        $locations = [
            'Beaverton, Oregon, USA',
            'Cupertino, California, USA',
            'Redmond, Washington, USA',
            'Mountain View, California, USA',
            'Seattle, Washington, USA',
            'Austin, Texas, USA',
            'Menlo Park, California, USA',
            'Los Gatos, California, USA',
            'Atlanta, Georgia, USA',
            'Suwon, South Korea',
            'Toyota City, Japan',
            'Herzogenaurach, Germany',
        ];

        $companyName = fake()->company();
        $domain = strtolower(str_replace([' ', '&', ',', '.', "'"], '', $companyName));
        
        // Generate valid Unsplash image IDs (9-10 digits)
        $imageIds = [
            '1542291026-7eec264c27ff',
            '1606107557195-0e29a4b5b4aa',
            '1605348532760-6753d2c43329',
            '1611472173362-3f53dbd65d80',
            '1621768351445-3f5a3f4bf5c3',
            '1633419461186-7d40a38105ec',
            '1617704548623-340376564e68',
            '1573804633927-bfcbcd909acd',
            '1529612700005-e35377bf1415',
            '1523474253046-8cd2748b5fd2',
            '1582480152925-e5447a7dc8ac',
            '1560958089-b8a1929cea89',
            '1617788138017-80ad40651399',
            '1633471134217-9a6d8b6d2f43',
            '1611162617474-5b21e879e113',
            '1574375927938-d5a98e8ffe85',
            '1522869635100-9f4c5e86aa37',
            '1554866585-cd94860890b7',
            '1629203851122-3726ecdf080e',
            '1610792516307-ea5acd9c3b00',
            '1585060544812-6b45742d762f',
            '1623679716441-4e97e2186b9e',
            '1621007947382-bb3c3994e3fb',
            '1556906781-9a412961c28c',
            '1615719413546-198b25453f85',
            '1559056199-641a0ac8b55e',
        ];
        
        return [
            'name' => $companyName,
            'description' => fake()->paragraph(3),
            'logo' => 'https://ui-avatars.com/api/?name=' . urlencode($companyName) . '&size=200&background=random&bold=true',
            'industry' => fake()->randomElement($industries),
            'website' => 'https://www.' . $domain . '.com',
            'location' => fake()->randomElement($locations),
            'founded_year' => fake()->numberBetween(1850, now()->year),
            'employee_count' => fake()->numberBetween(100, 2000000),
            'images' => [
                'https://images.unsplash.com/photo-' . fake()->randomElement($imageIds) . '?w=1200&h=600&fit=crop',
                'https://images.unsplash.com/photo-' . fake()->randomElement($imageIds) . '?w=1200&h=600&fit=crop',
            ],
        ];
    }

    /**
     * Indicate that the company is a technology company.
     */
    public function technology(): static
    {
        return $this->state(fn (array $attributes) => [
            'industry' => 'Technology',
        ]);
    }

    /**
     * Indicate that the company is a sportswear company.
     */
    public function sportswear(): static
    {
        return $this->state(fn (array $attributes) => [
            'industry' => 'Sportswear & Equipment',
        ]);
    }
}

