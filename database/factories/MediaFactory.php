<?php

namespace Database\Factories;

use App\Enum\FileUploadDirectory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_name' => fake()->name(),
            'file_url' => fake()->imageUrl(),
            'size' => fake()->numberBetween(1000, 10000),
            'collection_name' => fake()->randomElement(FileUploadDirectory::cases())->value,
            'thumbnail_url' => fake()->imageUrl(),
        ];
    }

    public function withCollectionName(FileUploadDirectory $fileUploadDirectory)
    {

        return $this->state([
            'collection_name' => $fileUploadDirectory,
        ]);

    }
}
