<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Products & Stock • VendFlow Route Ledger';
$projectName = 'Metro Vending Co.';

// Emptied for initial clean state as requested
$initialProducts = [];
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
                    <a href="audit-log.php" class="menu-item">
                        <div class="menu-left">
                            <span class="menu-icon">⏱️</span>
                            <span>Audit log / Activity</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="inventory.php" class="menu-item active">
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
             Main Canvas (Products & Stock Visual Catalog)
             =============================================================== -->
        <main class="main-canvas">

            <!-- Top Team Invitation Banner -->
            <div class="invite-banner" id="invite-banner">
                <div class="invite-left">
                    <span>ⓘ</span>
                    <span>Get more out of VendFlow by inviting your team for free</span>
                </div>
                <div class="invite-right">
                    <button class="btn-invite" onclick="alert('Invite link copied!')">+ Invite team members</button>
                    <button class="btn-dismiss" title="Dismiss" onclick="document.getElementById('invite-banner').style.display='none'">✕</button>
                </div>
            </div>

            <!-- Header Section -->
            <div class="dash-content-header">
                <div class="dash-title-group">
                    <h1>Products & stock</h1>
                    <p class="dash-subtitle">
                        Visual inventory catalog across all registered vending cabinets.
                    </p>
                </div>
                <div class="dash-action-group">
                    <button class="btn-dash-outline" onclick="alert('Add machine dialog will open here.')">Add machine</button>
                    <button class="btn-dash-primary" onclick="openAddProductModal()">+ Add product</button>
                </div>
            </div>

            <!-- Toolbar: Real-time Search + View Switcher -->
            <div class="catalog-toolbar" id="catalog-toolbar" style="display: none;">
                <div class="search-box-wrapper">
                    <span class="search-icon-inside">🔍</span>
                    <input 
                        type="text" 
                        class="catalog-search-input" 
                        placeholder="Search product name, SKU, or machine..." 
                        id="catalog-search"
                        onkeyup="filterProducts()"
                    >
                </div>

                <div class="view-switcher-group">
                    <button class="view-btn active" id="btn-view-grid" onclick="switchView('grid')">
                        <span>⊞</span> Grid
                    </button>
                    <button class="view-btn" id="btn-view-table" onclick="switchView('table')">
                        <span>☰</span> Table
                    </button>
                </div>
            </div>

            <!-- Category Filter Pills -->
            <div class="filter-pills-container" id="filter-pills" style="display: none;">
                <button class="filter-chip active" data-filter="all" onclick="setCategoryFilter('all', this)">
                    All items <span class="chip-count" id="count-all">0</span>
                </button>
                <button class="filter-chip" data-filter="drinks" onclick="setCategoryFilter('drinks', this)">
                    🥤 Drinks & Juices <span class="chip-count" id="count-drinks">0</span>
                </button>
                <button class="filter-chip" data-filter="candy" onclick="setCategoryFilter('candy', this)">
                    🍫 Chocolate & Candy <span class="chip-count" id="count-candy">0</span>
                </button>
                <button class="filter-chip" data-filter="snacks" onclick="setCategoryFilter('snacks', this)">
                    🥨 Chips & Cookies <span class="chip-count" id="count-snacks">0</span>
                </button>
                <button class="filter-chip chip-warning" data-filter="low-stock" onclick="setCategoryFilter('low-stock', this)">
                    ⚠️ Needs Restock <span class="chip-count" id="count-low">0</span>
                </button>
            </div>

            <!-- ===========================================================
                 EMPTY STATE (Default View)
                 =========================================================== -->
            <div class="empty-state-box" id="empty-state">
                <div class="empty-icon-wrap">📦</div>
                <h3 class="empty-title">No products in catalog yet</h3>
                <p class="empty-desc">
                    Your product and stock ledger is currently empty. Add your snacks, beverages, or specialty items with an image and initial units to start tracking inventory.
                </p>
                <button class="btn-dash-primary" style="padding: 0.65rem 1.4rem; font-size: 0.9rem;" onclick="openAddProductModal()">
                    + Add your first product
                </button>
            </div>

            <!-- ===========================================================
                 VIEW 1: Visual Product Cards Grid
                 =========================================================== -->
            <div class="product-card-grid" id="product-grid-view" style="display: none;">
                <!-- Dynamically populated when products are added -->
            </div>

            <!-- ===========================================================
                 VIEW 2: Modern Table View
                 =========================================================== -->
            <div class="posthog-table-card" id="product-table-view" style="display: none; margin-bottom: 2.5rem;">
                <div class="posthog-table-responsive">
                    <table class="posthog-data-table">
                        <thead>
                            <tr>
                                <th>Product & Image</th>
                                <th>SKU</th>
                                <th>Machine Placement</th>
                                <th style="width: 180px;">Stock / Par Level</th>
                                <th>Status</th>
                                <th>Vend Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- Dynamically populated -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Link back to Dashboard Home -->
            <div>
                <a href="dashboard.php" class="back-landing-link">
                    &larr; Back to Dispatch Overview
                </a>
            </div>

        </main>

    </div>

    <!-- ===================================================================
         Add Product Modal Window
         =================================================================== -->
    <div class="modal-overlay" id="add-product-modal" onclick="handleOverlayClick(event)">
        <div class="modal-container">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="modal-title">Add new product</div>
                <button class="modal-close-btn" onclick="closeAddProductModal()" title="Close">✕</button>
            </div>

            <!-- Modal Form -->
            <form id="new-product-form" onsubmit="handleProductSubmit(event)">
                <div class="modal-body">
                    
                    <!-- 1. Product Name -->
                    <div class="form-group-item">
                        <label class="form-label" for="prod-name">Product Name *</label>
                        <input 
                            type="text" 
                            id="prod-name" 
                            class="form-input-text" 
                            placeholder="e.g. Coca-Cola Original (330ml)" 
                            required
                        >
                    </div>

                    <!-- 2. Image Upload Box with Instant Preview -->
                    <div class="form-group-item">
                        <label class="form-label">Product Image *</label>
                        <div class="image-upload-zone" id="upload-zone" onclick="triggerFileInput()">
                            <input 
                                type="file" 
                                id="prod-image-file" 
                                accept="image/*" 
                                style="display: none;" 
                                onchange="handleImageSelect(event)"
                            >
                            <div class="upload-icon">📷</div>
                            <div class="upload-text">Click to upload product image</div>
                            <div class="upload-subtext">PNG, JPG, SVG or WebP (max 5MB)</div>

                            <!-- Preview Container -->
                            <div class="image-preview-box" id="image-preview-box">
                                <img src="" alt="Preview" id="preview-img-tag" class="preview-img">
                                <button type="button" class="remove-img-btn" onclick="removeSelectedImage(event)">✕ Change</button>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Units & Par in a 2-Column Grid -->
                    <div class="form-grid-2">
                        <div class="form-group-item">
                            <label class="form-label" for="prod-units">Initial Units *</label>
                            <input 
                                type="number" 
                                id="prod-units" 
                                class="form-input-text" 
                                min="0" 
                                value="12" 
                                placeholder="e.g. 12" 
                                required
                            >
                        </div>
                        <div class="form-group-item">
                            <label class="form-label" for="prod-par">Par Capacity</label>
                            <input 
                                type="number" 
                                id="prod-par" 
                                class="form-input-text" 
                                min="1" 
                                value="15" 
                                placeholder="e.g. 15"
                            >
                        </div>
                    </div>

                    <!-- 4. Category & Machine Placement -->
                    <div class="form-grid-2">
                        <div class="form-group-item">
                            <label class="form-label" for="prod-category">Category</label>
                            <select id="prod-category" class="form-input-text">
                                <option value="drinks">Cold Drinks & Sodas</option>
                                <option value="candy">Candy & Chocolate</option>
                                <option value="snacks">Chips & Snacks</option>
                                <option value="water">Bottled Water & Juices</option>
                            </select>
                        </div>
                        <div class="form-group-item">
                            <label class="form-label" for="prod-machine">Machine Placement</label>
                            <select id="prod-machine" class="form-input-text">
                                <option value="Machine A — Office Building">Machine A — Office Building</option>
                                <option value="Machine B — Campus Hall">Machine B — Campus Hall</option>
                            </select>
                        </div>
                    </div>

                    <!-- 5. Retail Price -->
                    <div class="form-group-item">
                        <label class="form-label" for="prod-price">Vend / Retail Price ($)</label>
                        <input 
                            type="number" 
                            id="prod-price" 
                            class="form-input-text" 
                            step="0.05" 
                            value="1.75" 
                            placeholder="1.75"
                        >
                    </div>

                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" onclick="closeAddProductModal()">Cancel</button>
                    <button type="submit" class="btn-modal-save">+ Add product</button>
                </div>
            </form>

        </div>
    </div>

    <!-- ===================================================================
         Client Controller Script
         =================================================================== -->
    <script>
        let productList = [];
        let selectedImageDataUrl = '';
        let currentCategory = 'all';

        // Modal Controls
        function openAddProductModal() {
            document.getElementById('add-product-modal').classList.add('open');
            document.getElementById('prod-name').focus();
        }

        function closeAddProductModal() {
            document.getElementById('add-product-modal').classList.remove('open');
            document.getElementById('new-product-form').reset();
            removeSelectedImage();
        }

        function handleOverlayClick(e) {
            if (e.target.id === 'add-product-modal') {
                closeAddProductModal();
            }
        }

        // Image Upload & Preview Handling
        function triggerFileInput() {
            document.getElementById('prod-image-file').click();
        }

        function handleImageSelect(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    selectedImageDataUrl = evt.target.result;
                    document.getElementById('preview-img-tag').src = selectedImageDataUrl;
                    document.getElementById('image-preview-box').style.display = 'flex';
                };
                reader.readAsDataURL(file);
            }
        }

        function removeSelectedImage(e) {
            if (e) e.stopPropagation();
            selectedImageDataUrl = '';
            document.getElementById('prod-image-file').value = '';
            document.getElementById('preview-img-tag').src = '';
            document.getElementById('image-preview-box').style.display = 'none';
        }

        // Handle Add Product Submission
        function handleProductSubmit(e) {
            e.preventDefault();

            const name = document.getElementById('prod-name').value.trim();
            const units = parseInt(document.getElementById('prod-units').value, 10) || 0;
            const par = parseInt(document.getElementById('prod-par').value, 10) || 12;
            const category = document.getElementById('prod-category').value;
            const categoryText = document.getElementById('prod-category').options[document.getElementById('prod-category').selectedIndex].text;
            const machine = document.getElementById('prod-machine').value;
            const price = parseFloat(document.getElementById('prod-price').value) || 1.50;
            const image = selectedImageDataUrl || 'assets/images/products/cola.svg';

            const newProduct = {
                id: Date.now(),
                name: name,
                sku: 'SKU-' + Math.floor(1000 + Math.random() * 9000),
                category: categoryText,
                category_id: category,
                machine: machine,
                units: units,
                par: par,
                price: price,
                image: image,
                isLow: (units < par)
            };

            productList.unshift(newProduct);
            closeAddProductModal();
            renderProducts();
        }

        // Render Cards and Tables
        function renderProducts() {
            const emptyState = document.getElementById('empty-state');
            const toolbar = document.getElementById('catalog-toolbar');
            const filterPills = document.getElementById('filter-pills');
            const gridView = document.getElementById('product-grid-view');
            const tableBody = document.getElementById('table-body');

            if (productList.length === 0) {
                emptyState.style.display = 'flex';
                toolbar.style.display = 'none';
                filterPills.style.display = 'none';
                gridView.style.display = 'none';
                document.getElementById('product-table-view').style.display = 'none';
                return;
            }

            emptyState.style.display = 'none';
            toolbar.style.display = 'flex';
            filterPills.style.display = 'flex';
            gridView.style.display = 'grid';

            // Update Counts
            document.getElementById('count-all').textContent = productList.length;
            document.getElementById('count-drinks').textContent = productList.filter(p => p.category_id === 'drinks' || p.category_id === 'water').length;
            document.getElementById('count-candy').textContent = productList.filter(p => p.category_id === 'candy').length;
            document.getElementById('count-snacks').textContent = productList.filter(p => p.category_id === 'snacks').length;
            document.getElementById('count-low').textContent = productList.filter(p => p.isLow).length;

            // Render Grid Cards
            gridView.innerHTML = '';
            tableBody.innerHTML = '';

            productList.forEach(p => {
                const percent = Math.min(100, Math.round((p.units / p.par) * 100));
                const fillColorClass = p.isLow ? (percent <= 30 ? 'fill-critical' : 'fill-warning') : 'fill-nominal';

                // Grid Card
                const card = document.createElement('div');
                card.className = 'product-item-card';
                card.setAttribute('data-name', p.name.toLowerCase());
                card.setAttribute('data-category', p.category_id);
                card.setAttribute('data-low', p.isLow ? '1' : '0');

                card.innerHTML = `
                    <div class="card-media-box bg-soda">
                        <span class="card-category-tag">${p.category}</span>
                        <span class="card-price-badge">$${p.price.toFixed(2)}</span>
                        <img src="${p.image}" alt="${p.name}" class="product-thumb-svg">
                    </div>
                    <div class="card-body-content">
                        <div class="card-product-title">${p.name}</div>
                        <div class="card-product-sku-row">
                            <span>SKU: <strong>${p.sku}</strong></span>
                            <span style="color:#10b981; font-weight:700;">${p.units} units initial</span>
                        </div>
                        <div class="card-machine-loc">
                            <span>📍</span>
                            <span>${p.machine}</span>
                        </div>
                        <div class="stock-bar-group">
                            <div class="stock-bar-labels">
                                <span class="stock-count-highlight">${p.units} of ${p.par} capacity</span>
                                <span>${p.isLow ? '<span style="color:#dc2626; font-weight:700;">Needs +' + (p.par - p.units) + '</span>' : '<span style="color:#16a34a; font-weight:700;">Stocked</span>'}</span>
                            </div>
                            <div class="stock-progress-track">
                                <div class="stock-progress-fill ${fillColorClass}" style="width: ${percent}%;"></div>
                            </div>
                        </div>
                        <div class="card-action-bar">
                            <button class="btn-card-restock ${p.isLow ? 'warning' : ''}" onclick="quickAdjustStock(${p.id}, 1)">
                                + Add Unit
                            </button>
                            <button class="btn-card-adjust" onclick="quickAdjustStock(${p.id}, -1)">
                                - Dispense
                            </button>
                        </div>
                    </div>
                `;
                gridView.appendChild(card);

                // Table Row
                const row = document.createElement('tr');
                row.className = 'table-row-item';
                row.setAttribute('data-name', p.name.toLowerCase());
                row.setAttribute('data-category', p.category_id);
                row.setAttribute('data-low', p.isLow ? '1' : '0');

                row.innerHTML = `
                    <td>
                        <div class="product-row-flex">
                            <div class="table-mini-thumb bg-soda">
                                <img src="${p.image}" alt="" style="max-height: 28px;">
                            </div>
                            <div>
                                <div class="cell-product-name">${p.name}</div>
                                <div class="cell-product-sku">${p.category}</div>
                            </div>
                        </div>
                    </td>
                    <td><code>${p.sku}</code></td>
                    <td><div class="cell-machine-name" style="font-size:0.82rem;">${p.machine}</div></td>
                    <td>
                        <div style="font-size: 0.76rem; font-weight:700; margin-bottom: 4px;">${p.units} / ${p.par} units</div>
                        <div class="stock-progress-track">
                            <div class="stock-progress-fill ${fillColorClass}" style="width: ${percent}%;"></div>
                        </div>
                    </td>
                    <td>${p.isLow ? '<span class="badge-below-par">Below par</span>' : '<span class="badge-active-green">At par</span>'}</td>
                    <td><div style="font-weight:700;">$${p.price.toFixed(2)}</div></td>
                    <td>
                        <button class="btn-log-restock" onclick="quickAdjustStock(${p.id}, 1)">+1 Stock</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function quickAdjustStock(id, delta) {
            const p = productList.find(item => item.id === id);
            if (p) {
                p.units = Math.max(0, p.units + delta);
                p.isLow = (p.units < p.par);
                renderProducts();
            }
        }

        // View Switcher (Grid vs Table)
        function switchView(view) {
            const gridView = document.getElementById('product-grid-view');
            const tableView = document.getElementById('product-table-view');
            const btnGrid = document.getElementById('btn-view-grid');
            const btnTable = document.getElementById('btn-view-table');

            if (view === 'grid') {
                gridView.style.display = 'grid';
                tableView.style.display = 'none';
                btnGrid.classList.add('active');
                btnTable.classList.remove('active');
            } else {
                gridView.style.display = 'none';
                tableView.style.display = 'block';
                btnGrid.classList.remove('active');
                btnTable.classList.add('active');
            }
        }

        // Category Filter
        function setCategoryFilter(cat, btn) {
            currentCategory = cat;
            document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
            btn.classList.add('active');
            filterProducts();
        }

        // Live Search Filter
        function filterProducts() {
            const query = (document.getElementById('catalog-search').value || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.product-item-card');
            const rows = document.querySelectorAll('.table-row-item');

            function matches(el) {
                const name = el.getAttribute('data-name') || '';
                const category = el.getAttribute('data-category') || '';
                const isLow = el.getAttribute('data-low') === '1';

                const matchesQuery = !query || name.includes(query);
                
                let matchesCat = false;
                if (currentCategory === 'all') matchesCat = true;
                else if (currentCategory === 'low-stock') matchesCat = isLow;
                else matchesCat = (category === currentCategory);

                return matchesQuery && matchesCat;
            }

            cards.forEach(card => card.style.display = matches(card) ? 'flex' : 'none');
            rows.forEach(row => row.style.display = matches(row) ? '' : 'none');
        }

        // Initial setup
        document.addEventListener('DOMContentLoaded', () => {
            renderProducts();
        });

        // Close on Esc key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeAddProductModal();
        });
    </script>

</body>
</html>
