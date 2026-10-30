<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'VendFlow • The Open Platform for Vending Operations';

// Fetch live database context
$db = getDBConnection();
$dbConnected = ($db !== null);

$sampleMachines = [];
$sampleProducts = [];

if ($dbConnected) {
    try {
        $stmtM = $db->query("SELECT name, location, status FROM machines LIMIT 3");
        $sampleMachines = $stmtM->fetchAll();

        $stmtP = $db->query("SELECT name, category, quantity, sell_price FROM products LIMIT 4");
        $sampleProducts = $stmtP->fetchAll();
    } catch (PDOException $e) {
        error_log("DB Query notice: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="posthog-desktop">

    <div class="desktop-tint-overlay"></div>

    <!-- ===================================================================
         Top Navigation Bar
         =================================================================== -->
    <header class="posthog-topbar">
        <div class="topbar-left">
            <a href="index.php" class="topbar-logo">
                <span class="topbar-logo-icon">⚡</span>
                <span>VendFlow</span>
            </a>
            <ul class="topbar-menu">
                <li><a href="dashboard.php" style="color: #f54e00; font-weight: 700;">Dashboard ↗</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="about.php">Docs</a></li>
                <li><a href="contact.php">Pricing</a></li>
                <li><a href="about.php">Company</a></li>
            </ul>
        </div>
        <div class="topbar-right">
            <a href="dashboard.php" class="btn-start-free">Open Dashboard &rarr;</a>
            <button class="topbar-icon-btn" title="Search (Cmd+K)" onclick="toggleModal(true)">🔍</button>
            <button class="topbar-icon-btn" title="Community Chat">💬</button>
            <button class="topbar-icon-btn" title="User Profile">👤</button>
        </div>
    </header>

    <!-- ===================================================================
         Left Desktop Icons (PostHog Side Navigation)
         =================================================================== -->
    <aside class="desktop-icons-col icons-left">
        <button class="desktop-icon-btn active" id="btn-icon-home" onclick="toggleModal(true)" title="Home Window">
            <div class="icon-svg-box">🏠</div>
            <span class="icon-label">Home</span>
        </button>
        <button class="desktop-icon-btn" onclick="openTab('tab-telemetry')" title="Live Telemetry">
            <div class="icon-svg-box">🚗</div>
            <span class="icon-label">Fleet</span>
        </button>
        <button class="desktop-icon-btn" onclick="openTab('tab-telemetry')" title="Stock Context">
            <div class="icon-svg-box">🔄</div>
            <span class="icon-label">Inventory</span>
        </button>
        <a href="contact.php" class="desktop-icon-btn" title="Pricing">
            <div class="icon-svg-box">💵</div>
            <span class="icon-label">Pricing</span>
        </a>
        <a href="about.php" class="desktop-icon-btn" title="Documentation">
            <div class="icon-svg-box">📑</div>
            <span class="icon-label">Docs</span>
        </a>
        <button class="desktop-icon-btn" onclick="openTab('tab-ask')" title="Interactive Demo">
            <div class="icon-svg-box">🎬</div>
            <span class="icon-label">Demo</span>
        </button>
        <a href="contact.php" class="desktop-icon-btn" title="Support">
            <div class="icon-svg-box">👤</div>
            <span class="icon-label">Talk to a human</span>
        </a>
    </aside>

    <!-- ===================================================================
         Right Desktop Icons (PostHog Style)
         =================================================================== -->
    <aside class="desktop-icons-col icons-right">
        <a href="about.php" class="desktop-icon-btn" title="About Us">
            <div class="icon-svg-box">📰</div>
            <span class="icon-label">About us</span>
        </a>
        <button class="desktop-icon-btn" onclick="alert('VendFlow v2.4: Real-time telemetry, MDB v4 protocol support, automated restock pick lists.')" title="Changelog">
            <div class="icon-svg-box">📦</div>
            <span class="icon-label">Changelog</span>
        </button>
        <a href="about.php" class="desktop-icon-btn" title="Company Handbook">
            <div class="icon-svg-box">📖</div>
            <span class="icon-label">Handbook</span>
        </a>
        <button class="desktop-icon-btn" onclick="toggleModal(true)" title="Hardware & Parts">
            <div class="icon-svg-box">🛒</div>
            <span class="icon-label">Store</span>
        </button>
        <a href="about.php" class="desktop-icon-btn" title="Careers">
            <div class="icon-svg-box">👥</div>
            <span class="icon-label">Careers</span>
        </a>
        <button class="desktop-icon-btn" onclick="emptyTrash()" title="Trash">
            <div class="icon-svg-box" id="trash-icon">🗑️</div>
            <span class="icon-label">Trash</span>
        </button>
    </aside>

    <!-- ===================================================================
         Desktop Workspace Area with Center Modal Window
         =================================================================== -->
    <main class="desktop-workspace">

        <!-- Center PostHog Window Modal -->
        <div class="posthog-modal-window" id="main-modal-window">
            
            <!-- Window Control Header Bar (Maximize & Close Button X) -->
            <div class="window-header">
                <button class="window-control-btn" title="Maximize Window" onclick="toggleMaximize()">◻</button>
                <button class="window-control-btn close-btn" title="Close / Minimize Window" onclick="toggleModal(false)">✕</button>
            </div>

            <!-- Window Content -->
            <div class="window-content">

                <!-- Brand Logo inside modal -->
                <div class="window-brand-title">
                    <span class="topbar-logo-icon">⚡</span>
                    <span>VendFlow</span>
                </div>

                <!-- Hero Section Inside Window -->
                <div class="window-hero-layout">
                    
                    <!-- Left Hero Copy -->
                    <div class="hero-main-col">
                        <h1>
                            Your fleet's <span class="pill-context-layer">context layer</span>
                        </h1>
                        <p class="hero-lead">
                            VendFlow ingests and stores your <span class="highlight-span">analytics, inventory, sales, and error data</span> so you and your <span class="underline-span">drivers</span> can query and act on it.
                        </p>
                        <p class="hero-social-proof">
                            Join 500+ vending operators scaling fleets with VendFlow.
                        </p>
                    </div>

                    <!-- Right Setup For Free Card -->
                    <div class="setup-free-card">
                        <div class="setup-card-title">
                            Set up <span style="display:inline-flex; align-items:center; color:#f54e00;">⚡ VendFlow</span> for free
                        </div>
                        <ul class="setup-check-list">
                            <li><span class="green-check">✓</span> 97% of operators pay us $0</li>
                            <li><span class="green-check">✓</span> No credit card required</li>
                            <li><span class="green-check">✓</span> Setup wizard connects MDB in 5 minutes</li>
                        </ul>
                        <div class="setup-buttons">
                            <a href="dashboard.php" class="btn-get-started">Get started</a>
                            <a href="dashboard.php" class="btn-install-ai">Open Dashboard</a>
                        </div>
                    </div>

                </div>

                <!-- =======================================================
                     PostHog Tabbed Sub-Section
                     ======================================================= -->
                <div class="window-tabs-container">
                    
                    <div class="window-tabs-nav">
                        <button class="window-tab-btn active" id="tab-btn-ask" onclick="switchTab('ask')">
                            Ask VendFlow anything
                        </button>
                        <button class="window-tab-btn" id="tab-btn-telemetry" onclick="switchTab('telemetry')">
                            Give drivers route context
                        </button>
                        <button class="window-tab-btn" id="tab-btn-ship" onclick="switchTab('ship')">
                            Ship with VendFlow
                        </button>
                    </div>

                    <!-- Tab 1: Ask VendFlow anything -->
                    <div class="window-tab-content-panel" id="panel-ask">
                        
                        <!-- Left Side: Interactive Query Simulation -->
                        <div class="tab-ai-box">
                            <div class="ai-box-header">
                                <span>⚡ VendFlow AI Telemetry</span>
                                <span style="color:#10b981;">● <?= $dbConnected ? 'Live MySQL Data' : 'Sample Feed' ?></span>
                            </div>

                            <div class="ai-query-bubble">
                                "Which machines need restocking before tomorrow morning?"
                            </div>

                            <div style="font-size: 0.8rem; color: #4b5563; margin-bottom: 0.65rem;">
                                Analyzing telemetry across all connected machines:
                            </div>

                            <ul class="ai-checklist">
                                <li>
                                    <div class="ai-item-left">
                                        <span>🏢</span>
                                        <span>Machine A &bull; Tech Tower</span>
                                    </div>
                                    <span style="color:#f59e0b; font-weight:700;">Cola at 4 units &bull; Low</span>
                                </li>
                                <li>
                                    <div class="ai-item-left">
                                        <span>🎓</span>
                                        <span>Machine B &bull; Campus Center</span>
                                    </div>
                                    <span style="color:#10b981; font-weight:700;">Stock 88% &bull; Nominal</span>
                                </li>
                                <li>
                                    <div class="ai-item-left">
                                        <span>💳</span>
                                        <span>Cashless Reader (Nayax/MDB)</span>
                                    </div>
                                    <span style="color:#10b981; font-weight:700;">Connected (0 errors)</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Right Side: Explanation -->
                        <div class="tab-info-col">
                            <h3>Ask VendFlow anything</h3>
                            <p>
                                VendFlow is the single place to ingest, store, and query your vending machines and inventory data. Telemetry, cashless drops, coin jams, and restock logs, stitched together on-the-fly to answer any operational question you have.
                            </p>
                            <p style="font-size: 0.85rem; color: #6b7280;">
                                Query directly via pure vanilla PHP & MySQL with zero external vendor fees.
                            </p>
                            <a href="contact.php" class="btn-mini-cta">Get started &ndash; free</a>
                        </div>

                    </div>

                    <!-- Tab 2: Give drivers route context -->
                    <div class="window-tab-content-panel" id="panel-telemetry" style="display: none;">
                        
                        <div class="tab-ai-box">
                            <div class="ai-box-header">
                                <span>🚚 Optimized Tote Packing List</span>
                                <span>Station Alpha</span>
                            </div>

                            <div class="ai-query-bubble">
                                Pack tote #14 for Machine A: 16x Cold Drinks, 8x Chips
                            </div>

                            <ul class="ai-checklist">
                                <?php if (!empty($sampleProducts)): ?>
                                    <?php foreach ($sampleProducts as $p): ?>
                                        <li>
                                            <div class="ai-item-left">
                                                <span>📦</span>
                                                <span><?= htmlspecialchars($p['name']) ?></span>
                                            </div>
                                            <span style="font-weight:700;">$<?= number_format((float)$p['sell_price'], 2) ?> &bull; <?= (int)$p['quantity'] ?> left</span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li><span>Cola Can (330ml)</span><span style="color:#ef4444;">Restock +24</span></li>
                                    <li><span>Bottled Water</span><span style="color:#10b981;">Nominal</span></li>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <div class="tab-info-col">
                            <h3>Driver Route Dispatch</h3>
                            <p>
                                Never load warehouse vans with guesswork. VendFlow tells drivers exactly what items need packing into each tote before they hit the road, cutting trip times by over 40%.
                            </p>
                            <a href="contact.php" class="btn-mini-cta">Explore Route Planner</a>
                        </div>

                    </div>

                    <!-- Tab 3: Ship with VendFlow -->
                    <div class="window-tab-content-panel" id="panel-ship" style="display: none;">
                        
                        <div class="tab-ai-box">
                            <div class="ai-box-header">
                                <span>⚡ Vanilla PHP Architecture</span>
                                <span>Zero Bloat</span>
                            </div>

                            <div class="ai-query-bubble">
                                Open source database schema in MySQL
                            </div>

                            <div style="background:#18181b; color:#a1a1aa; padding: 0.8rem; border-radius: 6px; font-family: monospace; font-size: 0.78rem;">
                                <span style="color:#38bdf8;">SELECT</span> m.name, COUNT(p.id) <br>
                                <span style="color:#38bdf8;">FROM</span> machines m <br>
                                <span style="color:#38bdf8;">JOIN</span> products p ON m.id = p.machine_id <br>
                                <span style="color:#38bdf8;">WHERE</span> p.quantity &lt; p.min_threshold;
                            </div>
                        </div>

                        <div class="tab-info-col">
                            <h3>Pure Control, No Lock-in</h3>
                            <p>
                                Run it entirely on your own local server or cloud host. Powered by vanilla PHP 8.2 and MySQL with PDO prepared statements.
                            </p>
                            <a href="sql/schema.sql" download class="btn-mini-cta">Download schema.sql</a>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- Floating Pill to Reopen Window when X is pressed -->
        <div class="reopen-pill-bar hidden" id="reopen-pill" onclick="toggleModal(true)">
            <span>⚡ Open VendFlow Window</span>
            <span style="font-size: 0.75rem; background: rgba(255,255,255,0.2); padding: 2px 6px; border-radius: 4px;">Click or press 'Home'</span>
        </div>

    </main>

    <script src="assets/js/main.js"></script>
</body>
</html>
