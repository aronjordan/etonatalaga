<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users List</title>
  <style>
    body {
      font-family: "Segoe UI", Tahoma, sans-serif;
      background: #eef1f5;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }

    .container {
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.08);
      width: 100%;
      max-width: 1000px;
    }

    h1 {
      text-align: center;
      color: #2d3748;
      margin-bottom: 25px;
      font-size: 24px;
      font-weight: 600;
    }

    /* Search bar */
    .search-form {
      display: flex;
      margin-bottom: 25px;
      border: 1px solid #ccc;
      border-radius: 8px;
      overflow: hidden;
      background: #f9fafb;
    }

    .search-form input {
      flex: 1;
      border: none;
      padding: 12px 15px;
      font-size: 14px;
      background: transparent;
      outline: none;
    }

    .search-form button {
      background: #2563eb;
      border: none;
      color: #fff;
      padding: 0 22px;
      cursor: pointer;
      font-weight: 500;
      transition: background 0.3s;
    }

    .search-form button:hover {
      background: #1d4ed8;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 25px;
      font-size: 15px;
    }

    th, td {
      border-bottom: 1px solid #e2e8f0;
      padding: 14px;
      text-align: center;
    }

    th {
      background: #f8fafc;
      font-weight: 600;
      color: #374151;
    }

    tr:hover {
      background: #f9fbfc;
    }

    /* Buttons/Links */
    .action-link {
      color: #2563eb;
      font-weight: 500;
      margin: 0 6px;
      text-decoration: none;
    }

    .action-link:hover {
      text-decoration: underline;
    }

    .delete-link {
      color: #dc2626;
    }

    /* Pagination */
    .pagination {
      display: flex;
      justify-content: center;
      gap: 6px;
      margin: 15px 0 25px;
      flex-wrap: wrap;
    }

    .pagination a,
    .pagination span {
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      border: 1px solid #d1d5db;
      font-size: 14px;
      color: #374151;
      transition: all 0.2s ease;
    }

    .pagination a:hover {
      background: #f1f5f9;
    }

    .pagination span {
      background: #2563eb;
      color: #fff;
      font-weight: 600;
      border-color: #2563eb;
    }

    /* Create Button */
    .create-btn {
      display: inline-block;
      padding: 12px 20px;
      text-align: center;
      background: #2563eb;
      color: #fff;
      font-size: 15px;
      border-radius: 8px;
      text-decoration: none;
      transition: background 0.3s;
      font-weight: 500;
    }

    .create-btn:hover {
      background: #1d4ed8;
    }

    /* Center create button */
    .create-container {
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Welcome, <?= htmlspecialchars($user_name) ?>!</h1>

  
    <h2>Students List</h2>

    <!-- Search -->
    <form action="<?= site_url('/'); ?>" method="get" class="search-form">
      <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
      <input type="text" name="q" placeholder="Search records..." value="<?= html_escape($q); ?>">
      <button type="submit">Search</button>
    </form>

    <!-- Users Table -->
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Lastname</th>
          <th>Firstname</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach(html_escape($users) as $user): ?>
          <tr>
            <td><?=($user['id']);?></td>
            <td><?=($user['last_name']);?></td>
            <td><?=($user['first_name']);?></td>
            <td><?=($user['email']);?></td>
            <td>
              <a href="<?=site_url('update/'.$user['id']);?>" class="action-link">Update</a>
              |
              <a href="<?=site_url('delete/'.$user['id']);?>" onclick="return confirm('Are you sure you want to delete this record?');" class="action-link delete-link">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
      <?php if (isset($page)): ?>
        <?= str_replace(
            ['<a ', '<strong>', '</strong>'],
            [
                '<a class="page-link" ',
                '<span class="current-page">',
                '</span>'
            ],
            $page
        ); ?>
      <?php endif; ?>
    </div>

    <!-- Create Button -->
    <div class="create-container">
      <a href="<?=site_url('/create')?>" class="create-btn">+ Create New User</a>
    </div>
    <a href="<?= site_url('logout') ?>" 
     style="background-color: #e74c3c; color: white; padding: 8px 14px; border-radius: 5px; text-decoration: none;">
     Logout
  </a>
  </div>
  <div>
    
  </div>
</body>
</html>
