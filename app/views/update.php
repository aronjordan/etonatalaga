<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Student</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;

      
    }

    .container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
      font-size: 22px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #555;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      transition: 0.3s;
    }

    input:focus {
      border-color: #4a90e2;
      outline: none;
      box-shadow: 0 0 5px rgba(74, 144, 226, 0.4);
    }

    button {
      width: 100%;
      padding: 12px;
      background: #4a90e2;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background: #357abd;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 15px;
      text-decoration: none;
      color: #4a90e2;
      font-size: 14px;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Update Student</h1>
    <form action="<?= site_url('update/' . $user['id']); ?>" method="post">
      <label for="firstname">First Name</label>
      <input type="text" id="firstname" name="firstname" value="<?= $user['first_name']; ?>" required>

      <label for="lastname">Last Name</label>
      <input type="text" id="lastname" name="lastname" value="<?= $user['last_name']; ?>" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= $user['email']; ?>" required>

      <button type="submit">Update Student</button>
    </form>
    <a href="<?= site_url('/'); ?>" class="back-link">← Back to Student List</a>
  </div>
</body>
</html>
