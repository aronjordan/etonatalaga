<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, sans-serif;
      background: #eef1f5;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .signup-container {
      background: #fff;
      padding: 40px 35px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    h2 {
      color: #2d3748;
      margin-bottom: 20px;
      font-size: 24px;
      font-weight: 600;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    input {
      padding: 12px 15px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: border 0.3s;
    }

    input:focus {
      border-color: #2563eb;
      box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
    }

    button {
      background: #2563eb;
      color: #fff;
      border: none;
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 16px;
      font-weight: 500;
      transition: background 0.3s;
    }

    button:hover {
      background: #1d4ed8;
    }

    .login-link, .logout-link {
      display: inline-block;
      margin-top: 15px;
      font-size: 14px;
      color: #2563eb;
      text-decoration: none;
      transition: color 0.2s;
    }

    .login-link:hover, .logout-link:hover {
      text-decoration: underline;
      color: #1d4ed8;
    }

    .error {
      color: #dc2626;
      font-size: 14px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="signup-container">
    <h2>Sign Up</h2>

    <?php if(isset($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if(isset($errors)): ?>
      <?php foreach($errors as $err): ?>
        <p class="error"><?= htmlspecialchars($err) ?></p>
      <?php endforeach; ?>
    <?php endif; ?>

    <form method="post" action="<?= site_url('signup') ?>">
      <input type="text" name="firstname" placeholder="First Name" required>
      <input type="text" name="lastname" placeholder="Last Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Create Account</button>
    </form>

    <a href="<?= site_url('login') ?>" class="login-link">Already have an account? Login</a>

    <?php if(isset($_SESSION['user_name'])): ?>
      <br>
      <a href="<?= site_url('logout') ?>" class="logout-link">Logout</a>
    <?php endif; ?>
  </div>

</body>
</html>
