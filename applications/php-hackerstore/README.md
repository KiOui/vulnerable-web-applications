# Hackerstore

## Description
Hackerstore is a small PHP shopping site where users can register, browse products, and manage a cart. The lab focuses on how mistakes in transaction and quantity handling can undermine an otherwise functional store.

## Vulnerability Focus
Business-logic validation: cart quantities and totals are not safely constrained.

## Technology
PHP with Apache HTTP Server and MySQL.

## Solution
1. Register an account and log in; note your budget.
2. Add a product to the cart and open the cart page.
3. Intercept the *update quantity* request (`update_quantity.php`) with Burp.
4. Set `quantity` to a **negative** value, e.g. `-10`, and forward it.
5. The cart total goes negative, which inflates your budget; use it to buy the flag item.

**Root cause:** [`update_quantity.php`](webstore/www/update_quantity.php) has its `if ($quantity <= 0) $quantity = 1;` guard commented out, and [`cart.php`](webstore/www/cart.php) sums `price * quantity` with no lower bound. (Login/queries themselves correctly use PDO prepared statements — this is not SQLi.)

## Run and Test
From this directory, start the local test environment:

```sh
docker compose -f test/docker-compose.yml up --build
```

Open <http://localhost> while the containers are running. Stop them with:

```sh
docker compose -f test/docker-compose.yml down
```

## Defensive Takeaway
Validate quantity bounds on the server, and calculate prices and totals from trusted server-side data.
