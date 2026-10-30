/**
 * VendFlow PostHog WebOS UI Controller
 * Pure Vanilla JavaScript
 */

function toggleModal(show) {
    const modal = document.getElementById('main-modal-window');
    const reopenPill = document.getElementById('reopen-pill');
    const homeBtn = document.getElementById('btn-icon-home');

    if (!modal) return;

    if (show) {
        modal.classList.remove('hidden');
        if (reopenPill) reopenPill.classList.add('hidden');
        if (homeBtn) homeBtn.classList.add('active');
    } else {
        modal.classList.add('hidden');
        if (reopenPill) reopenPill.classList.remove('hidden');
        if (homeBtn) homeBtn.classList.remove('active');
    }
}

function toggleMaximize() {
    const modal = document.getElementById('main-modal-window');
    if (!modal) return;

    if (modal.style.maxWidth === '96%') {
        modal.style.maxWidth = '960px';
        modal.style.borderRadius = '20px';
    } else {
        modal.style.maxWidth = '96%';
        modal.style.borderRadius = '12px';
    }
}

function switchTab(tabKey) {
    // Buttons
    const buttons = {
        'ask': document.getElementById('tab-btn-ask'),
        'telemetry': document.getElementById('tab-btn-telemetry'),
        'ship': document.getElementById('tab-btn-ship')
    };

    // Panels
    const panels = {
        'ask': document.getElementById('panel-ask'),
        'telemetry': document.getElementById('panel-telemetry'),
        'ship': document.getElementById('panel-ship')
    };

    Object.keys(buttons).forEach(k => {
        if (buttons[k]) buttons[k].classList.remove('active');
        if (panels[k]) panels[k].style.display = 'none';
    });

    if (buttons[tabKey]) buttons[tabKey].classList.add('active');
    if (panels[tabKey]) panels[tabKey].style.display = 'grid';
}

function openTab(tabId) {
    toggleModal(true);
    if (tabId === 'tab-telemetry') {
        switchTab('telemetry');
    } else if (tabId === 'tab-ask') {
        switchTab('ask');
    }
}

function emptyTrash() {
    const trash = document.getElementById('trash-icon');
    if (trash) {
        trash.textContent = '✨';
        setTimeout(() => {
            trash.textContent = '🗑️';
            alert('Trash is clean! No corrupted telemetry or orphaned stock records.');
        }, 300);
    }
}

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    // ESC closes window
    if (e.key === 'Escape') {
        toggleModal(false);
    }
    // 'h' or 'H' opens window when not typing in an input
    if ((e.key === 'h' || e.key === 'H') && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
        toggleModal(true);
    }
});
