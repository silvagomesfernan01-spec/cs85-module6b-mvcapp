<?php

namespace App\Controllers;

use App\Models\Restaurant;

/**
 * RestaurantController
 *
 * Handles the request for the restaurant guide page:
 *  - validates/sanitizes incoming filter input from $_GET
 *  - loads restaurant data from the Model
 *  - passes prepared data to the View for display
 */
class RestaurantController
{
    public function index(): void
    {
        // 1. Validate input -----------------------------------------
        // Only allow known-safe strings through; anything else is
        // treated as "no filter" rather than trusted as-is.
        $neighborhood = isset($_GET['neighborhood'])
            ? trim(strip_tags((string) $_GET['neighborhood']))
            : '';

        $cuisine = isset($_GET['cuisine'])
            ? trim(strip_tags((string) $_GET['cuisine']))
            : '';

        // Simple whitelist-style validation: reject anything that
        // isn't letters, spaces, or hyphens.
        if ($neighborhood !== '' && !preg_match('/^[A-Za-z\s\-]+$/', $neighborhood)) {
            $neighborhood = '';
        }
        if ($cuisine !== '' && !preg_match('/^[A-Za-z\s\-]+$/', $cuisine)) {
            $cuisine = '';
        }

        // 2. Load model data ------------------------------------------
        $allRestaurants = Restaurant::getAll();
        $neighborhoods = Restaurant::getNeighborhoods($allRestaurants);
        $cuisines = Restaurant::getCuisines($allRestaurants);

        $filteredRestaurants = Restaurant::filter($allRestaurants, $neighborhood, $cuisine);

        // 3. Pass data to the view -------------------------------------
        $viewData = [
            'restaurants'        => $filteredRestaurants,
            'neighborhoods'      => $neighborhoods,
            'cuisines'           => $cuisines,
            'selectedNeighborhood' => $neighborhood,
            'selectedCuisine'      => $cuisine,
            'totalCount'         => count($filteredRestaurants),
        ];

        $this->render('index', $viewData);
    }

    /**
     * Loads a view file and makes $data available to it as variables.
     */
    private function render(string $viewName, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../../views/' . $viewName . '.php';
    }
}