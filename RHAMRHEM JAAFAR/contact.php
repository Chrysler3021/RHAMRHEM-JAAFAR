<?php
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'Contact & Demo • VendFlow';

$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!verifyCSRFToken($token)) {
        $errors[] = 'Invalid CSRF token. Please try again.';
    }

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name)) {
        $errors[] = 'Name is required.';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.';
    }
    if (empty($message)) {
        $errors[] = 'Message cannot be empty.';
    }

    if (empty($errors)) {
        $db = getDBConnection();
        if ($db) {
            try {
                $stmt = $db->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
                $stmt->execute([
                    ':name'    => $name,
                    ':email'   => $email,
                    ':message' => $message,
                ]);
                setFlashMessage('success', 'Thank you! Your request has been recorded. We will be in touch shortly.');
                redirect('contact.php');
            } catch (PDOException $e) {
                $errors[] = 'Database error: ' . $e->getMessage();
            }
        } else {
            setFlashMessage('success', 'Message received! (Demo mode)');
            redirect('contact.php');
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="section" style="padding-top: 2rem;">
    <div class="container" style="max-width: 760px;">
        
        <div class="hero-pill" style="margin-bottom: 1rem;">
            <span>📬 Get In Touch</span>
        </div>

        <h1 class="hero-title" style="text-align: left; font-size: 2.5rem; margin-bottom: 0.75rem;">
            Talk with the <span class="highlight-text">VendFlow team</span>
        </h1>
        <p style="color: var(--text-secondary); margin-bottom: 2rem; font-size: 1.05rem;">
            Have questions about integrating your machines, setting up MDB telemetry, or custom routes? Send us a message below.
        </p>

        <?php displayFlashMessage(); ?>

        <?php if (!empty($errors)): ?>
            <div style="background: #fee2e2; border: 2px solid var(--border-dark); border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; box-shadow: var(--shadow-hard);">
                <ul style="padding-left: 1.25rem; color: #991b1b; font-weight: 600;">
                    <?php foreach ($errors as $error): ?>
                        <li><?= sanitize($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div style="background: #ffffff; border: 2px solid var(--border-dark); border-radius: var(--radius-lg); box-shadow: var(--shadow-hard-xl); padding: 2.5rem;">
            <form method="POST" action="contact.php">
                <input type="hidden" name="csrf_token" value="<?= getCSRFToken() ?>">

                <div style="margin-bottom: 1.25rem;">
                    <label for="name" style="display: block; font-weight: 700; margin-bottom: 0.4rem;">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" style="width: 100%; padding: 0.75rem; border: 2px solid var(--border-dark); border-radius: 8px; font-size: 1rem;" placeholder="e.g. John Doe" required>
                </div>

                <div style="margin-bottom: 1.25rem;">
                    <label for="email" style="display: block; font-weight: 700; margin-bottom: 0.4rem;">Work Email</label>
                    <input type="email" id="email" name="email" class="form-control" style="width: 100%; padding: 0.75rem; border: 2px solid var(--border-dark); border-radius: 8px; font-size: 1rem;" placeholder="e.g. operator@vendflow.com" required>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="message" style="display: block; font-weight: 700; margin-bottom: 0.4rem;">Tell us about your vending fleet</label>
                    <textarea id="message" name="message" rows="5" class="form-control" style="width: 100%; padding: 0.75rem; border: 2px solid var(--border-dark); border-radius: 8px; font-size: 1rem; resize: vertical;" placeholder="How many machines do you operate? What hardware or telemetry do you use?" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                    <span>Send Inquiry</span>
                    <span>&rarr;</span>
                </button>
            </form>
        </div>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
