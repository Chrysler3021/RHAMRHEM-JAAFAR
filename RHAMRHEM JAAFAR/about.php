<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'About VendFlow • Modern Vending Telemetry';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="padding-top: 2rem;">
    <div class="container">
        
        <div class="hero-pill" style="margin-bottom: 1rem;">
            <span>⚡ Open Architecture</span>
        </div>

        <h1 class="hero-title" style="text-align: left; margin-bottom: 1.5rem;">
            Built for operators who want <span class="highlight-text">pure control</span>
        </h1>

        <div class="bento-grid" style="margin-top: 2rem;">
            <div class="bento-card col-8">
                <div>
                    <div class="card-icon-wrap icon-orange">🎯</div>
                    <h3 class="card-h3">Our Mission</h3>
                    <p class="card-p">
                        Traditional vending telemetry software is bloated, charges high recurring SaaS fees per machine, and locks your data inside walled gardens. 
                        VendFlow was built to be transparent, lightweight, and fast — running on standard, pure vanilla PHP and MySQL.
                    </p>
                </div>
            </div>

            <div class="bento-card col-4">
                <div>
                    <div class="card-icon-wrap icon-green">🛡️</div>
                    <h3 class="card-h3">No Bloatware</h3>
                    <p class="card-p">
                        Zero external JavaScript framework dependencies, zero heavy composer packages. Loads in milliseconds.
                    </p>
                </div>
            </div>

            <div class="bento-card col-6">
                <div>
                    <div class="card-icon-wrap icon-blue">📦</div>
                    <h3 class="card-h3">Smart Inventory Tracking</h3>
                    <p class="card-p">
                        Keeps tabs on every snack, beverage, and specialty item across all your machines. Set minimum restock triggers and never lose a sale to empty spirals.
                    </p>
                </div>
            </div>

            <div class="bento-card col-6">
                <div>
                    <div class="card-icon-wrap icon-yellow">🚚</div>
                    <h3 class="card-h3">Efficient Restocking</h3>
                    <p class="card-p">
                        Generate pick lists before leaving the warehouse. Drivers pack exactly what's needed, reducing transit weight and eliminating wasted route miles.
                    </p>
                </div>
            </div>
        </div>

        <div style="margin-top: 3rem; text-align: center;">
            <a href="index.php" class="btn btn-secondary btn-lg">&larr; Back to Home</a>
            <a href="contact.php" class="btn btn-primary btn-lg" style="margin-left: 1rem;">Contact Team &rarr;</a>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
