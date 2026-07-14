# 🥗 Veg-Friendly LA — Module 6A MVC Project

A small PHP MVC app that guides users to vegetarian, vegan, and veg-friendly restaurants around Los Angeles, filterable by neighborhood and cuisine.

## 📖 About

- **Model** (`src/Models/Restaurant.php`) — restaurant data + filtering logic
- **View** (`views/index.php`) — filter form and restaurant card grid, no business logic
- **Controller** (`src/Controllers/RestaurantController.php`) — validates `$_GET` input, loads the Model, passes data to the View
- **Front controller** (`public/index.php`) — the entry point that wires it all together

## ⚙️ Setup

1. Clone/unzip into your `cs85` folder
2. Run `composer dump-autoload` to generate the PSR-4 autoloader
3. Serve the `public/` folder:
cd public
php -S localhost:8000
Or point Herd's document root at `public/`
4. Visit the site and filter by neighborhood/cuisine

## 🤖 AI Code Review

**Function reviewed:** `Restaurant::filter()`

**Prompt:** *"Write a PHP function that filters an array of Restaurant objects by neighborhood and cuisine, both optional."*

**What worked:** Core loop logic was correct — empty filters matched everything, both conditions combined with AND.

**What didn't:** No type hints, `==` was case-sensitive (broke on `"echo park"` vs `"Echo Park"`), and it was a standalone function instead of a namespaced static method on the Model.

**Fix:** Moved it into `Restaurant` as a typed static method, swapped `==` for `strcasecmp()`, and used `array_filter()` + `array_values()` for clean reindexing.

## 💭 Reflection

I chose this topic because finding vegetarian/vegan spots in LA is something I actually do — it made it easier to design around a real user's needs.

The hardest part was resisting the urge to put logic in the View. It's tempting to check `$_GET` right in the HTML, but MVC means the Controller owns that decision, and the View just displays what it's given.

Building this taught me that MVC is really about *where decisions live*: the Model stays storage-agnostic, the Controller is the only layer touching request data, and the View stays "dumb." Reviewing the AI's draft reinforced this — it wasn't wrong, just unshaped by the project's actual structure until I fit it in.
