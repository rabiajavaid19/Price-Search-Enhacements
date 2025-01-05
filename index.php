<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Search</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Search Businesses by Price</h1>
        <form id="searchForm" class="row g-3" action="price_search.php" method="get">
            <div class="col-md-6">
                <label for="min_price" class="form-label">Min Price (RS):</label>
                <input type="number" class="form-control" id="min_price" name="min_price" placeholder="Enter min price" required>
            </div>
            <div class="col-md-6">
                <label for="max_price" class="form-label">Max Price (RS):</label>
                <input type="number" class="form-control" id="max_price" name="max_price" placeholder="Enter max price" required>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <div class="mt-4" id="results">
            <!-- Results will be displayed here -->
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript to fetch and display results -->
    <script>
        const form = document.getElementById('searchForm');
        const resultsDiv = document.getElementById('results');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const queryString = new URLSearchParams(formData).toString();

            const response = await fetch(`price_search.php?${queryString}`);
            const data = await response.json();

            resultsDiv.innerHTML = `
                <h3>Search Results:</h3>
                <ul class="list-group">
                    ${data.map(b => `<li class="list-group-item">
                        <strong>${b.name}</strong> (${b.location}) - ${b.service_name}: RS ${b.price}
                    </li>`).join('')}
                </ul>`;
        });
    </script>
</body>
</html>
