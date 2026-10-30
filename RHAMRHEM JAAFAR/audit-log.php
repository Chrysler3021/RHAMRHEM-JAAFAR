<?php
/**
 * VendFlow - Audit Log
 * Pure Vanilla PHP UI matching PostHog Dashboard
 */

$pageTitle = 'Audit Log • VendFlow Dashboard';
$projectName = 'Metro Vending Co.';

// -----------------------------------------------------------------------------
// Mock Dataset for UI (12 Records)
// -----------------------------------------------------------------------------
$auditLogs = [
    [
        'timestamp' => 'Oct 28, 2026 10:59',
        'product'   => 'Chocolate Bar',
        'sku'       => 'SWT-CHO-01 (Candy & Chocolate)',
        'machine'   => 'Machine A — Office Building',
        'location'  => '2nd Floor Breakroom, Tech Towers',
        'previous'  => 8,
        'change'    => '+20',
        'resulting' => 28,
        'reason'    => 'Restock load',
        'note'      => 'Operator manual stock adjustment',
        'badge'     => 'badge-restock-green',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 28, 2026 10:59',
        'product'   => 'Bottled Water',
        'sku'       => 'DRK-WTR-02 (Bottled Water & Juices)',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'previous'  => 10,
        'change'    => '+20',
        'resulting' => 30,
        'reason'    => 'Restock load',
        'note'      => 'Operator manual stock adjustment',
        'badge'     => 'badge-restock-green',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 28, 2026 10:57',
        'product'   => 'Biscuits',
        'sku'       => 'SNK-BSC-01 (Chips & Snacks)',
        'machine'   => 'Machine A — Office Building',
        'location'  => '2nd Floor Breakroom, Tech Towers',
        'previous'  => 15,
        'change'    => '+7',
        'resulting' => 22,
        'reason'    => 'Restock load',
        'note'      => 'Operator manual stock adjustment',
        'badge'     => 'badge-restock-green',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 26, 2026 10:42',
        'product'   => 'Biscuits',
        'sku'       => 'SNK-BSC-01 (Chips & Snacks)',
        'machine'   => 'Machine A — Office Building',
        'location'  => '2nd Floor Breakroom, Tech Towers',
        'previous'  => 0,
        'change'    => '+15',
        'resulting' => 15,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 26, 2026 10:42',
        'product'   => 'Potato Chips',
        'sku'       => 'SNK-CHP-02 (Chips & Snacks)',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'previous'  => 0,
        'change'    => '+6',
        'resulting' => 6,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 26, 2026 10:42',
        'product'   => 'Chocolate Bar',
        'sku'       => 'SWT-CHO-02 (Candy & Chocolate)',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'previous'  => 0,
        'change'    => '+3',
        'resulting' => 3,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 26, 2026 10:42',
        'product'   => 'Bottled Water',
        'sku'       => 'DRK-WTR-02 (Bottled Water & Juices)',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'previous'  => 0,
        'change'    => '+10',
        'resulting' => 10,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 26, 2026 10:42',
        'product'   => 'Fruit Juice',
        'sku'       => 'DRK-JCE-01 (Bottled Water & Juices)',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'previous'  => 0,
        'change'    => '+7',
        'resulting' => 7,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 26, 2026 10:42',
        'product'   => 'Potato Chips',
        'sku'       => 'SNK-CHP-01 (Chips & Snacks)',
        'machine'   => 'Machine A — Office Building',
        'location'  => '2nd Floor Breakroom, Tech Towers',
        'previous'  => 0,
        'change'    => '+12',
        'resulting' => 12,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 26, 2026 10:42',
        'product'   => 'Chocolate Bar',
        'sku'       => 'SWT-CHO-01 (Candy & Chocolate)',
        'machine'   => 'Machine A — Office Building',
        'location'  => '2nd Floor Breakroom, Tech Towers',
        'previous'  => 0,
        'change'    => '+8',
        'resulting' => 8,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 25, 2026 14:15',
        'product'   => 'Cola Can',
        'sku'       => 'DRK-COLA-01 (Cold Drinks & Sodas)',
        'machine'   => 'Machine A — Office Building',
        'location'  => '2nd Floor Breakroom, Tech Towers',
        'previous'  => 0,
        'change'    => '+24',
        'resulting' => 24,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ],
    [
        'timestamp' => 'Oct 25, 2026 14:10',
        'product'   => 'Energy Drink',
        'sku'       => 'DRK-NRG-03 (Cold Drinks & Sodas)',
        'machine'   => 'Machine B — Campus Hall',
        'location'  => 'Student Union Center, Building C',
        'previous'  => 0,
        'change'    => '+18',
        'resulting' => 18,
        'reason'    => 'Initial stock',
        'note'      => 'Initial system stocking record',
        'badge'     => 'badge-initial-gray',
        'operator'  => 'Alex Morgan'
    ]
];

// -----------------------------------------------------------------------------
// Pagination (Limit by 10)
// -----------------------------------------------------------------------------
$perPage = 10;
$totalLogs = count($auditLogs);
$totalPages = (int)ceil($totalLogs / $perPage);

$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($currentPage < 1) $currentPage = 1;
if ($currentPage > $totalPages) $currentPage = $totalPages;

$offset = ($currentPage - 1) * $perPage;
$paginatedLogs = array_slice($auditLogs, $offset, $perPage);

$startResult = $offset + 1;
$endResult   = min($offset + $perPage, $totalLogs);
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
                    <a href="dashboard.php" class="menu-item">
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
                    <a href="audit-log.php" class="menu-item active">
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
             Main Canvas (Audit Log View)
             =============================================================== -->
        <main class="main-canvas">

            <!-- Top Team Invitation Banner -->
            <div class="invite-banner" id="invite-banner">
                <div class="invite-left">
                    <span>ⓘ</span>
                    <span>Get more out of PostHog by inviting your team for free</span>
                </div>
                <div class="invite-right">
                    <button class="btn-invite" onclick="alert('Invite link copied to clipboard!')">+ Invite team members</button>
                    <button class="btn-dismiss" title="Dismiss" onclick="document.getElementById('invite-banner').style.display='none'">✕</button>
                </div>
            </div>

            <!-- Page Title & Actions Header -->
            <div class="dash-content-header">
                <div class="dash-title-group">
                    <h1>Adjustment audit log (<?= $totalLogs ?>)</h1>
                    <p class="dash-subtitle">
                        Chronological record of every manual restock, sales tally, spoilage removal, and count audit.
                    </p>
                </div>
                <div class="dash-action-group">
                    <button class="btn-dash-outline" onclick="alert('Add machine dialog will open here.')">Add machine</button>
                    <button class="btn-dash-primary" onclick="alert('Add product dialog will open here.')">+ Add product</button>
                </div>
            </div>

            <!-- PostHog Table Card -->
            <div class="posthog-table-card">
                <div class="posthog-table-responsive">
                    <table class="posthog-data-table">
                        <thead>
                            <tr>
                                <th>Timestamp</th>
                                <th>Product & SKU</th>
                                <th>Machine</th>
                                <th>Previous</th>
                                <th>Change</th>
                                <th>Resulting</th>
                                <th>Reason & note</th>
                                <th>Operator</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paginatedLogs as $log): ?>
                                <tr>
                                    <!-- Timestamp -->
                                    <td class="cell-timestamp">
                                        <?= htmlspecialchars($log['timestamp']) ?>
                                    </td>

                                    <!-- Product & SKU -->
                                    <td>
                                        <div class="cell-product-name">
                                            <?= htmlspecialchars($log['product']) ?>
                                        </div>
                                        <div class="cell-product-sku">
                                            <?= htmlspecialchars($log['sku']) ?>
                                        </div>
                                    </td>

                                    <!-- Machine -->
                                    <td>
                                        <div class="cell-machine-name">
                                            <?= htmlspecialchars($log['machine']) ?>
                                        </div>
                                        <div class="cell-machine-loc">
                                            <?= htmlspecialchars($log['location']) ?>
                                        </div>
                                    </td>

                                    <!-- Previous -->
                                    <td class="cell-number">
                                        <?= (int)$log['previous'] ?>
                                    </td>

                                    <!-- Change -->
                                    <td class="<?= str_starts_with($log['change'], '+') ? 'change-positive' : 'change-negative' ?>">
                                        <?= htmlspecialchars($log['change']) ?>
                                    </td>

                                    <!-- Resulting -->
                                    <td class="cell-number" style="font-weight: 700;">
                                        <?= (int)$log['resulting'] ?>
                                    </td>

                                    <!-- Reason & note -->
                                    <td>
                                        <span class="badge-pill <?= htmlspecialchars($log['badge']) ?>">
                                            <?= htmlspecialchars($log['reason']) ?>
                                        </span>
                                        <div class="cell-note">
                                            <?= htmlspecialchars($log['note']) ?>
                                        </div>
                                    </td>

                                    <!-- Operator -->
                                    <td class="cell-operator">
                                        <?= htmlspecialchars($log['operator']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- PostHog Pagination (Limit by 10) -->
                <div class="posthog-pagination">
                    <div>
                        Showing <strong><?= $startResult ?></strong> to <strong><?= $endResult ?></strong> of <strong><?= $totalLogs ?></strong> entries
                    </div>

                    <div class="pagination-pages">
                        <!-- Previous Button -->
                        <?php if ($currentPage > 1): ?>
                            <a href="?page=<?= $currentPage - 1 ?>" class="page-link-btn">&larr; Previous</a>
                        <?php else: ?>
                            <span class="page-link-btn disabled">&larr; Previous</span>
                        <?php endif; ?>

                        <!-- Page Numbers -->
                        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                            <a href="?page=<?= $p ?>" class="page-link-btn <?= $p === $currentPage ? 'active' : '' ?>">
                                <?= $p ?>
                            </a>
                        <?php endfor; ?>

                        <!-- Next Button -->
                        <?php if ($currentPage < $totalPages): ?>
                            <a href="?page=<?= $currentPage + 1 ?>" class="page-link-btn">Next &rarr;</a>
                        <?php else: ?>
                            <span class="page-link-btn disabled">Next &rarr;</span>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Back navigation link -->
            <div style="margin-top: 1.75rem;">
                <a href="dashboard.php" class="back-landing-link">
                    &larr; Back to Dashboard Home
                </a>
            </div>

        </main>

    </div>

</body>
</html>
