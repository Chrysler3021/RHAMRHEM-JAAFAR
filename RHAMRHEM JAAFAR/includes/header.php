<?php
/**
 * Shared Header Template - VendFlow / PostHog Style
 */
$pageTitle = $pageTitle ?? 'VendFlow • The Open Platform for Vending Operations';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
    <header class="site-header">
        <div class="container nav-wrapper">
            <div class="brand-group">
                <a href="index.php" class="brand-logo">
                    <span class="brand-icon">⚡</span>
                    VendFlow
                </a>
                <span class="badge-version">v2.4 Live</span>
            </div>

            <nav class="main-nav">
                <ul>
                    <li><a href="index.php#features" class="nav-link">Product</a></li>
                    <li><a href="index.php#machines" class="nav-link">Machines</a></li>
                    <li><a href="index.php#inventory" class="nav-link">Telemetry</a></li>
                    <li><a href="about.php" class="nav-link">Company</a></li>
                    <li><a href="contact.php" class="nav-link">Pricing & Demo</a></li>
                </ul>
            </nav>

            <div class="nav-actions">
                <a href="contact.php" class="btn btn-secondary">Sign In</a>
                <a href="contact.php" class="btn btn-primary">Start Free</a>
            </div>
        </div>
    </header>

    <main class="main-content">
