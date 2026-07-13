<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Veg-Friendly LA | Vegetarian &amp; Vegan Restaurant Guide</title>
    <style>
        :root {
            --green: #2f5233;
            --green-light: #6b9b6e;
            --cream: #faf6ee;
            --text: #2a2a2a;
        }
        * { box-sizing: border-box; }
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
            background: var(--cream);
            color: var(--text);
            margin: 0;
            padding: 0 20px 60px;
        }
        header {
            background: var(--green);
            color: #fff;
            padding: 32px 20px;
            text-align: center;
            margin: 0 -20px 32px;
        }
        header h1 { margin: 0 0 6px; font-size: 1.8rem; }
        header p { margin: 0; opacity: 0.85; font-size: 0.95rem; }

        form.filters {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin-bottom: 8px;
        }
        form.filters select, form.filters button {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
        }
        form.filters button {
            background: var(--green);
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form.filters button:hover { background: var(--green-light); }

        .result-count {
            text-align: center;
            color: #666;
            margin: 6px 0 28px;
            font-size: 0.9rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            max-width: 1100px;
            margin: 0 auto;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            padding: 18px 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.08);
            border-top: 4px solid var(--green-light);
        }
        .card h2 { margin: 0 0 6px; font-size: 1.15rem; }
        .card .meta {
            font-size: 0.85rem;
            color: #555;
            margin-bottom: 10px;
        }
        .tag {
            display: inline-block;
            background: var(--green);
            color: #fff;
            font-size: 0.72rem;
            padding: 2px 8px;
            border-radius: 999px;
            margin-right: 6px;
        }
        .card p.desc { font-size: 0.9rem; line-height: 1.4; margin: 0; }

        .empty {
            text-align: center;
            color: #777;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <h1>Veg-Friendly LA</h1>
    <p>A vegetarian &amp; vegan restaurant guide to Los Angeles</p>
</header>

<form class="filters" method="get" action="">
    <select name="neighborhood">
        <option value="">All Neighborhoods</option>
        <?php foreach ($neighborhoods as $n): ?>
            <option value="<?= htmlspecialchars($n) ?>" <?= $selectedNeighborhood === $n ? 'selected' : '' ?>>
                <?= htmlspecialchars($n) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="cuisine">
        <option value="">All Cuisines</option>
        <?php foreach ($cuisines as $c): ?>
            <option value="<?= htmlspecialchars($c) ?>" <?= $selectedCuisine === $c ? 'selected' : '' ?>>
                <?= htmlspecialchars($c) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Filter</button>
</form>

<p class="result-count">
    Showing <?= (int) $totalCount ?> restaurant<?= $totalCount === 1 ? '' : 's' ?>
</p>

<?php if (empty($restaurants)): ?>
    <p class="empty">No restaurants match those filters. Try clearing one of them.</p>
<?php else: ?>
    <div class="grid">
        <?php foreach ($restaurants as $restaurant): ?>
            <div class="card">
                <h2><?= htmlspecialchars($restaurant->name) ?></h2>
                <div class="meta">
                    <?= htmlspecialchars($restaurant->neighborhood) ?> &middot;
                    <?= htmlspecialchars($restaurant->cuisine) ?> &middot;
                    <?= htmlspecialchars($restaurant->priceRange) ?>
                </div>
                <span class="tag"><?= htmlspecialchars($restaurant->dietType) ?></span>
                <p class="desc"><?= htmlspecialchars($restaurant->description) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

</body>
</html>
