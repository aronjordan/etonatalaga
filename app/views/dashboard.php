<h1>Welcome, <?= htmlspecialchars($user_name) ?></h1>

<p>You are now logged in!</p>
<a href="<?= site_url('auth/logout') ?>">Logout</a>
