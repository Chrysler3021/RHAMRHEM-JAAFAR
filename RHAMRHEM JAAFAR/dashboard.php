<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Dispatch Overview • VendFlow Route Ledger';
$projectName = 'Metro Vending Co.';
$userName = 'Alex Morgan';

// Pick-list mock data
$pickList = [
    [
        'product'   => 'Chocolate Bar',
        'sku'       => 'SWT-CHO-02',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'stock'     => 3,
        'par'       => 8,
        'load'      => '+5'
    ],
    [
        'product'   => 'Cola',
        'sku'       => 'DRK-SDA-01',
        'machine'   => 'Machine A — Office Building',
        'location'  => '2nd Floor Breakroom, Tech Towers',
        'stock'     => 4,
        'par'       => 12,
        'load'      => '+8'
    ],
    [
        'product'   => 'Potato Chips',
        'sku'       => 'SNK-CHP-02',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'stock'     => 6,
        'par'       => 10,
        'load'      => '+4'
    ],
    [
        'product'   => 'Fruit Juice',
        'sku'       => 'DRK-JCE-01',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'stock'     => 7,
        'par'       => 10,
        'load'      => '+3'
    ]
];

// Recent stock adjustments mock data
$recentAdjustments = [
    [
        'timestamp' => 'Oct 28, 10:59',
        'product'   => 'Chocolate Bar',
        'sku'       => 'SWT-CHO-01',
        'machine'   => 'Machine A — Office Building',
        'previous'  => 8,
        'delta'     => '+20',
        'new_count' => 28,
        'reason'    => 'Restock load',
        'note'      => 'Operator manual stock adjustment'
    ],
    [
        'timestamp' => 'Oct 28, 10:59',
        'product'   => 'Bottled Water',
        'sku'       => 'DRK-WTR-02',
        'machine'   => 'Machine B — Campus Hall',
        'previous'  => 10,
        'delta'     => '+20',
        'new_count' => 30,
        'reason'    => 'Restock load',
        'note'      => 'Operator manual stock adjustment'
    ],
    [
        'timestamp' => 'Oct 28, 10:57',
        'product'   => 'Biscuits',
        'sku'       => 'SNK-BSC-01',
        'machine'   => 'Machine A — Office Building',
        'previous'  => 15,
        'delta'     => '+7',
        'new_count' => 22,
        'reason'    => 'Restock load',
        'note'      => 'Operator manual stock adjustment'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body class="dashboard-body">

    <!-- Thin Top Purple Accent Stripe -->
    <div class="top-accent-bar"></div>

    <div class="dashboard-wrapper">
        
        <!-- ===============================================================
             Left Sidebar (PostHog Dashboard Layout)
             =============================================================== -->
        <aside class="sidebar">
            
            <!-- Project Selector Dropdown -->
            <div class="project-selector" title="Switch Project">
                <div class="project-badge">
                    <span class="badge-avatar">H</span>
                    <span><?= htmlspecialchars($projectName) ?></span>
                    <span style="font-size: 0.7rem; color: var(--text-muted);">▼</span>
                </div>
                <span class="kbd-shortcut">Ctrl K</span>
            </div>

            <!-- Subnav Quick Switcher: Apps, Files, Chat -->
            <div class="sidebar-subnav">
                <button class="subnav-btn active" title="Apps">
                    <span>🗂️</span> Apps
                </button>
                <button class="subnav-btn" title="Files">
                    <span>📁</span> Files
                </button>
                <button class="subnav-btn" title="Chat">
                    <span>💬</span> Chat
                </button>
            </div>

            <!-- Primary Navigation Menu -->
            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.php" class="menu-item active">
                        <div class="menu-left">
                            <span class="menu-icon">🚚</span>
                            <span>Dispatch overview</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#self-driving" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon">🚗</span>
                            <span>Self-driving</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="audit-log.php" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon">⏱️</span>
                            <span>Audit log / Activity</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="inventory.php" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon">📦</span>
                            <span>Products & stock</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#people" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon">👥</span>
                            <span>People and groups</span>
                        </div>
                    </a>
                </li>

                <!-- Section: Starred Placeholders -->
                <li class="menu-section-header">
                    <span>Starred</span>
                    <span style="font-size: 0.7rem;">▼</span>
                </li>

                <li>
                    <a href="#product-analytics" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon" style="color:#3b82f6;">📊</span>
                            <span>Product analytics</span>
                        </div>
                        <span class="menu-action-icon">+</span>
                    </a>
                </li>
                <li>
                    <a href="#dashboards" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon" style="color:#f59e0b;">⏱️</span>
                            <span>Dashboards</span>
                        </div>
                        <span class="menu-action-icon">+</span>
                    </a>
                </li>
                <li>
                    <a href="#web-analytics" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon" style="color:#10b981;">🌐</span>
                            <span>Web analytics</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#error-tracking" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon" style="color:#ef4444;">⚠️</span>
                            <span>Error tracking</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#session-replay" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon" style="color:#f59e0b;">⏺️</span>
                            <span>Session replay</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#mcp-analytics" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon" style="color:#a855f7;">✨</span>
                            <span>MCP analytics</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#support" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon" style="color:#ec4899;">🎯</span>
                            <span>Support</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#all-products" class="menu-item" style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.25rem;">
                        <div class="menu-left">
                            <span>See all products</span>
                        </div>
                        <span style="font-size: 0.8rem;">›</span>
                    </a>
                </li>
            </ul>

            <!-- Bottom Sidebar Settings & Notifications -->
            <div class="sidebar-bottom">
                <a href="#notifications" class="menu-item">
                    <div class="menu-left">
                        <span class="menu-icon">🔔</span>
                        <span>Notifications</span>
                    </div>
                    <span style="font-size: 0.8rem;">›</span>
                </a>
                <a href="#settings" class="menu-item">
                    <div class="menu-left">
                        <span class="menu-icon">⚙️</span>
                        <span>Settings</span>
                    </div>
                </a>
                <a href="#more" class="menu-item">
                    <div class="menu-left">
                        <span class="menu-icon">☰</span>
                        <span>More</span>
                    </div>
                    <span style="font-size: 0.7rem;">▲</span>
                </a>
            </div>

        </aside>

        <!-- ===============================================================
             Main Canvas (Dispatch Overview)
             =============================================================== -->
        <main class="main-canvas">

            <!-- Top Team Invitation Banner -->
            <div class="invite-banner" id="invite-banner">
                <div class="invite-left">
                    <span>ⓘ</span>
                    <span>Get more out of VendFlow by inviting your team for free</span>
                </div>
                <div class="invite-right">
                    <button class="btn-invite" onclick="alert('Invite link copied to clipboard!')">+ Invite team members</button>
                    <button class="btn-dismiss" title="Dismiss" onclick="document.getElementById('invite-banner').style.display='none'">✕</button>
                </div>
            </div>

            <!-- Page Title & Actions Header -->
            <div class="dash-content-header">
                <div class="dash-title-group">
                    <h1>Dispatch overview</h1>
                    <p class="dash-subtitle">
                        Real-time fleet inventory, restock alerts, and machine health telemetry.
                    </p>
                </div>
                <div class="dash-action-group">
                    <button class="btn-dash-outline" onclick="alert('Add machine dialog will open here.')">Add machine</button>
                    <button class="btn-dash-primary" onclick="alert('Add product dialog will open here.')">+ Add product</button>
                </div>
            </div>

            <!-- ===========================================================
                 Top 4 KPI Metrics
                 =========================================================== -->
            <div class="overview-kpi-grid">
                
                <div class="kpi-card">
                    <span class="kpi-label">Items at or below par</span>
                    <div class="kpi-value amber">4 SKUs</div>
                    <span class="kpi-subtext">Ready for route pick-list</span>
                </div>

                <div class="kpi-card">
                    <span class="kpi-label">Registered machines</span>
                    <div class="kpi-value">2</div>
                    <span class="kpi-subtext">Physical cabinet locations</span>
                </div>

                <div class="kpi-card">
                    <span class="kpi-label">Cataloged SKUs</span>
                    <div class="kpi-value">9</div>
                    <span class="kpi-subtext">Snack & beverage slots</span>
                </div>

                <div class="kpi-card">
                    <span class="kpi-label">Total stocked units</span>
                    <div class="kpi-value">132</div>
                    <span class="kpi-subtext">Retail value <strong>$212.60</strong></span>
                </div>

            </div>

            <!-- ===========================================================
                 Middle Grid: Restock Pick-List & Machine Fleet
                 =========================================================== -->
            <div class="overview-split-grid">
                
                <!-- Left: Restock Pick-List Table -->
                <div class="overview-card-box">
                    <div class="overview-card-header">
                        <div>
                            <div class="overview-card-title">Restock pick-list</div>
                            <div class="overview-card-desc">SKUs where recorded units have reached or dropped below par</div>
                        </div>
                        <a href="audit-log.php" class="card-header-link">Open full pick-list (4) &rarr;</a>
                    </div>

                    <div class="posthog-table-responsive" style="margin-top: 0.5rem;">
                        <table class="posthog-data-table">
                            <thead>
                                <tr>
                                    <th>Product & SKU</th>
                                    <th>Machine</th>
                                    <th>Stock / Par</th>
                                    <th>Load</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pickList as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="cell-product-name"><?= htmlspecialchars($item['product']) ?></div>
                                            <div class="cell-product-sku"><?= htmlspecialchars($item['sku']) ?></div>
                                        </td>
                                        <td>
                                            <div class="cell-machine-name" style="font-size: 0.8rem;"><?= htmlspecialchars($item['machine']) ?></div>
                                            <div class="cell-machine-loc"><?= htmlspecialchars($item['location']) ?></div>
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: #b45309;">
                                                <?= (int)$item['stock'] ?> / <?= (int)$item['par'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-load-green"><?= htmlspecialchars($item['load']) ?></span>
                                        </td>
                                        <td>
                                            <button class="btn-log-restock" onclick="alert('Restock logged for <?= htmlspecialchars($item['product']) ?>!')">Log restock</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right: Machine Fleet List -->
                <div class="overview-card-box">
                    <div class="overview-card-header">
                        <div>
                            <div class="overview-card-title">Machine fleet</div>
                            <div class="overview-card-desc">Stocked capacity by placement location</div>
                        </div>
                        <a href="audit-log.php" class="card-header-link">Manage machines &rarr;</a>
                    </div>

                    <div class="machine-fleet-list">
                        
                        <!-- Machine A -->
                        <div class="machine-fleet-card">
                            <div class="machine-card-top">
                                <div>
                                    <div class="cell-machine-name">Machine A — Office Building</div>
                                    <div class="cell-machine-loc">2nd Floor Breakroom, Tech Towers</div>
                                </div>
                                <span class="badge-active-green">Active</span>
                            </div>
                            <div class="machine-card-bottom">
                                <span>5 SKUs, 86 units</span>
                                <span class="badge-below-par">1 below par</span>
                            </div>
                        </div>

                        <!-- Machine B -->
                        <div class="machine-fleet-card">
                            <div class="machine-card-top">
                                <div>
                                    <div class="cell-machine-name">Machine B — Campus Hall</div>
                                    <div class="cell-machine-loc">Student Union Center, Building C</div>
                                </div>
                                <span class="badge-active-green">Active</span>
                            </div>
                            <div class="machine-card-bottom">
                                <span>4 SKUs, 46 units</span>
                                <span class="badge-below-par">3 below par</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- ===========================================================
                 Bottom Section: Recent Stock Adjustments Table
                 =========================================================== -->
            <div class="overview-card-box" style="margin-bottom: 2rem;">
                <div class="overview-card-header">
                    <div>
                        <div class="overview-card-title">Recent stock adjustments</div>
                        <div class="overview-card-desc">Latest manual restocks, sales tallies, and physical counts</div>
                    </div>
                    <a href="audit-log.php" class="card-header-link">Full audit log &rarr;</a>
                </div>

                <div class="posthog-table-responsive">
                    <table class="posthog-data-table">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Product</th>
                                <th>Machine</th>
                                <th>Previous</th>
                                <th>Delta</th>
                                <th>New count</th>
                                <th>Reason & note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentAdjustments as $adj): ?>
                                <tr>
                                    <td class="cell-timestamp"><?= htmlspecialchars($adj['timestamp']) ?></td>
                                    <td>
                                        <div class="cell-product-name"><?= htmlspecialchars($adj['product']) ?></div>
                                        <div class="cell-product-sku"><?= htmlspecialchars($adj['sku']) ?></div>
                                    </td>
                                    <td>
                                        <div class="cell-machine-name" style="font-size: 0.8rem;"><?= htmlspecialchars($adj['machine']) ?></div>
                                    </td>
                                    <td class="cell-number"><?= (int)$adj['previous'] ?></td>
                                    <td class="change-positive"><?= htmlspecialchars($adj['delta']) ?></td>
                                    <td class="cell-number" style="font-weight: 700;"><?= (int)$adj['new_count'] ?></td>
                                    <td>
                                        <span class="badge-pill badge-restock-green"><?= htmlspecialchars($adj['reason']) ?></span>
                                        <div class="cell-note"><?= htmlspecialchars($adj['note']) ?></div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Footer link back to Landing Page -->
            <div>
                <a href="index.php" class="back-landing-link">
                    &larr; Switch back to Landing Page WebOS
                </a>
            </div>

        </main>

    </div>

</body>
</html>
