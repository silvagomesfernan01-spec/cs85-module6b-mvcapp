
🥗 Veg-Friendly LA — Module 6A MVC Project
A small PHP MVC app that guides users to vegetarian, vegan, and veg-friendly restaurants around Los Angeles, filterable by neighborhood and cuisine.

📖 About
Model (src/Models/Restaurant.php) — restaurant data + filtering logic
View (views/index.php) — filter form and restaurant card grid, no business logic
Controller (src/Controllers/RestaurantController.php) — validates $_GET input, loads the Model, passes data to the View
Front controller (public/index.php) — the entry point that wires it all together
⚙️ Setup
Clone/unzip into your cs85 folder
Run composer dump-autoload to generate the PSR-4 autoloader
Serve the public/ folder: cd public php -S localhost:8000 Or point Herd's document root at public/
Visit the site and filter by neighborhood/cuisine
