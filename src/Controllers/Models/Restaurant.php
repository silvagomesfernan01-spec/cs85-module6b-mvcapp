<?php

namespace App\Models;

/**
 * Restaurant Model
 *
 * Represents a single vegetarian/vegan-friendly restaurant and
 * provides the in-memory "database" of restaurants for this guide.
 */
class Restaurant
{
    public string $name;
    public string $neighborhood;
    public string $cuisine;
    public string $priceRange;   // "$", "$$", or "$$$"
    public string $dietType;     // "Vegan", "Vegetarian", or "Veg-Friendly"
    public string $description;

    public function __construct(
        string $name,
        string $neighborhood,
        string $cuisine,
        string $priceRange,
        string $dietType,
        string $description
    ) {
        $this->name = $name;
        $this->neighborhood = $neighborhood;
        $this->cuisine = $cuisine;
        $this->priceRange = $priceRange;
        $this->dietType = $dietType;
        $this->description = $description;
    }

    /**
     * Returns the full list of restaurants.
     *
     * @return Restaurant[]
     */
    public static function getAll(): array
    {
        return [
            new Restaurant(
                "Crossroads Kitchen",
                "Melrose",
                "Mediterranean",
                "$$$",
                "Vegan",
                "Upscale plant-based dining with a menu built around bold Mediterranean flavors."
            ),
            new Restaurant(
                "Sage Vegan Bistro",
                "Echo Park",
                "American Comfort",
                "$$",
                "Vegan",
                "Comfort-food classics like mac and cheese and burgers, fully plant-based."
            ),
            new Restaurant(
                "Real Food Daily",
                "West Hollywood",
                "American",
                "$$",
                "Vegan",
                "A longtime staple for organic, macrobiotic-inspired vegan meals."
            ),
            new Restaurant(
                "Shojin",
                "Little Tokyo",
                "Japanese",
                "$$",
                "Vegan",
                "Inventive vegan Japanese cuisine, including plant-based sushi rolls."
            ),
            new Restaurant(
                "Golden Road Brewing",
                "Atwater Village",
                "Pub Food",
                "$$",
                "Veg-Friendly",
                "Casual brewery with a solid rotating list of vegetarian pub food."
            ),
            new Restaurant(
                "Sanamluang Cafe",
                "East Hollywood",
                "Thai",
                "$",
                "Veg-Friendly",
                "Late-night Thai spot known for a large vegetarian section on the menu."
            ),
            new Restaurant(
                "Elf Cafe",
                "Echo Park",
                "Mediterranean",
                "$$",
                "Vegetarian",
                "Candlelit vegetarian restaurant with a wood-fired, wine-friendly menu."
            ),
            new Restaurant(
                "Fresh Corn Grill",
                "Playa del Rey",
                "Mexican",
                "$",
                "Veg-Friendly",
                "Casual counter-service spot with vegetarian tacos and bowls."
            ),
        ];
    }

    /**
     * Filters a list of restaurants by neighborhood and/or cuisine.
     *
     * @param Restaurant[] $restaurants
     */
    public static function filter(array $restaurants, string $neighborhood = '', string $cuisine = ''): array
    {
        return array_values(array_filter($restaurants, function (Restaurant $r) use ($neighborhood, $cuisine) {
            $matchesNeighborhood = $neighborhood === '' || strcasecmp($r->neighborhood, $neighborhood) === 0;
            $matchesCuisine = $cuisine === '' || strcasecmp($r->cuisine, $cuisine) === 0;
            return $matchesNeighborhood && $matchesCuisine;
        }));
    }

    /**
     * Returns the unique list of neighborhoods.
     *
     * @param Restaurant[] $restaurants
     */
    public static function getNeighborhoods(array $restaurants): array
    {
        $neighborhoods = array_map(fn(Restaurant $r) => $r->neighborhood, $restaurants);
        sort($neighborhoods);
        return array_unique($neighborhoods);
    }

    /**
     * Returns the unique list of cuisines.
     *
     * @param Restaurant[] $restaurants
     */
    public static function getCuisines(array $restaurants): array
    {
        $cuisines = array_map(fn(Restaurant $r) => $r->cuisine, $restaurants);
        sort($cuisines);
        return array_unique($cuisines);
    }
}