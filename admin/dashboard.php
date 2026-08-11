<?php
session_start();
require_once '../includes/config.php';

// Check if logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}

// Fetch stats
$stats = [];
$result = $conn->query("SELECT COUNT(*) as total FROM contacts");
$stats['contacts'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM contacts WHERE status = 'new'");
$stats['new_contacts'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM subscribers WHERE status = 'active'");
$stats['subscribers'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM case_studies WHERE status = 'published'");
$stats['case_studies'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM posts WHERE status = 'published'");
$stats['posts'] = $result->fetch_assoc()['total'];

// Recent contacts
$recent_contacts = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC LIMIT 10");

// Recent subscribers
$recent_subscribers = $conn->query("SELECT * FROM subscribers ORDER BY subscribed_at DESC LIMIT 10");

$admin_name = $_SESSION['admin_name'] ?? $_SESSION['admin_username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Wales & Webs</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <style>
    :root {
      --bg: #050508; --bg-card: #111118; --border: rgba(255,255,255,0.06);
      --green: #10b981; --purple: #8b5cf6; --text: #fff; --text-sec: #a1a1aa; --text-muted: #71717a;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); }

    /* Layout */
    .admin-layout { display: flex; min-height: 100vh; }
    .sidebar {
      width: 260px; background: var(--bg-card); border-right: 1px solid var(--border);
      position: fixed; height: 100vh; overflow-y: auto;
    }
    .sidebar-header {
      padding: 24px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; gap: 10px;
    }
    .logo-icon {
      width: 36px; height: 36px; background: linear-gradient(135deg, var(--green), #059669);
      border-radius: 10px; display: flex; align-items: center; justify-content: center;
      font-weight: 800; color: #fff;
    }
    .nav-section { padding: 16px 0; }
    .nav-section-title {
      padding: 0 24px; font-size: 0.7rem; text-transform: uppercase;
      letter-spacing: 0.1em; color: var(--text-muted); margin-bottom: 8px;
    }
    .nav-item {
      display: flex; align-items: center; gap: 12px;
      padding: 10px 24px; color: var(--text-sec); font-size: 0.9rem;
      transition: all 0.2s; cursor: pointer; text-decoration: none;
    }
    .nav-item:hover, .nav-item.active {
      background: rgba(16, 185, 129, 0.05); color: var(--green);
      border-right: 2px solid var(--green);
    }
    .main-content { flex: 1; margin-left: 260px; }

    /* Header */
    .top-header {
      height: 64px; background: rgba(5,5,8,0.8); backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--border); padding: 0 32px;
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100;
    }
    .search-box {
      display: flex; align-items: center; gap: 10px;
      background: rgba(255,255,255,0.03); border: 1px solid var(--border);
      border-radius: 10px; padding: 8px 16px; width: 300px;
    }
    .search-box input {
      background: none; border: none; color: var(--text); outline: none; font-size: 0.9rem; width: 100%;
    }
    .header-actions { display: flex; align-items: center; gap: 16px; }
    .header-btn {
      width: 36px; height: 36px; border-radius: 10px;
      background: rgba(255,255,255,0.03); border: 1px solid var(--border);
      display: flex; align-items: center; justify-content: center;
      color: var(--text-sec); cursor: pointer; transition: all 0.2s;
    }
    .header-btn:hover { background: rgba(255,255,255,0.06); color: var(--text); }
    .user-pill {
      display: flex; align-items: center; gap: 10px;
      padding: 6px 14px; background: rgba(255,255,255,0.03);
      border: 1px solid var(--border); border-radius: 100px;
    }
    .user-avatar {
      width: 28px; height: 28px; border-radius: 50%;
      background: linear-gradient(135deg, var(--green), var(--purple));
      display: flex; align-items: center; justify-content: center;
      font-size: 0.75rem; font-weight: 700;
    }
    .user-name { font-size: 0.85rem; font-weight: 500; }

    /* Content */
    .content { padding: 32px; }
    .page-title { font-size: 1.5rem; margin-bottom: 4px; }
    .page-subtitle { color: var(--text-muted); font-size: 0.875rem; margin-bottom: 32px; }

    /* Stats Cards */
    .stats-grid {
      display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 32px;
    }
    .stat-card {
      background: var(--bg-card); border: 1px solid var(--border);
      border-radius: 12px; padding: 24px; transition: all 0.3s;
    }
    .stat-card:hover { border-color: rgba(255,255,255,0.1); }
    .stat-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 16px; }
    .stat-icon {
      width: 44px; height: 44px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center; font-size: 1.25rem;
    }
    .stat-icon.green { background: rgba(16,185,129,0.1); }
    .stat-icon.purple { background: rgba(139,92,246,0.1); }
    .stat-icon.blue { background: rgba(59,130,246,0.1); }
    .stat-icon.orange { background: rgba(245,158,11,0.1); }
    .stat-trend {
      font-size: 0.75rem; font-weight: 600; padding: 4px 8px;
      border-radius: 6px; background: rgba(16,185,129,0.1); color: var(--green);
    }
    .stat-value { font-size: 1.75rem; font-weight: 700; font-family: 'JetBrains Mono', monospace; }
    .stat-label { font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; }

    /* Tables */
    .card {
      background: var(--bg-card); border: 1px solid var(--border);
      border-radius: 12px; overflow: hidden;
    }
    .card-header {
      padding: 20px 24px; border-bottom: 1px solid var(--border);
      display: flex; justify-content: space-between; align-items: center;
    }
    .card-title { font-size: 1rem; font-weight: 600; }
    .card-body { padding: 0; }
    table { width: 100%; border-collapse: collapse; }
    th {
      text-align: left; padding: 12px 24px; font-size: 0.75rem;
      text-transform: uppercase; letter-spacing: 0.05em;
      color: var(--text-muted); font-weight: 600; border-bottom: 1px solid var(--border);
    }
    td { padding: 14px 24px; font-size: 0.875rem; color: var(--text-sec); border-bottom: 1px solid rgba(255,255,255,0.03); }
    tr:hover td { background: rgba(255,255,255,0.02); }
    .badge {
      display: inline-flex; padding: 4px 10px; border-radius: 100px;
      font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;
    }
    .badge-new { background: rgba(16,185,129,0.1); color: var(--green); }
    .badge-read { background: rgba(59,130,246,0.1); color: var(--blue); }
    .badge-replied { background: rgba(139,92,246,0.1); color: var(--purple); }
    .badge-closed { background: rgba(113,113,122,0.1); color: var(--text-muted); }

    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 24px; }

    @media (max-width: 1024px) {
      .sidebar { transform: translateX(-100%); }
      .main-content { margin-left: 0; }
      .stats-grid { grid-template-columns: repeat(2, 1fr); }
      .two-col { grid-template-columns: 1fr; }
    }
    @media (max-width: 768px) {
      .stats-grid { grid-template-columns: 1fr; }
      .search-box { display: none; }
    }
  </style>
</head>
<body>
  <div class="admin-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <div class="logo-icon">W</div>
        <span style="font-weight:700;">Wales & Webs</span>
      </div>

      <div class="nav-section">
        <div class="nav-section-title">Main</div>
        <a href="dashboard.php" class="nav-item active">&#128202; Dashboard</a>
        <a href="#" class="nav-item">&#128100; Clients</a>
        <a href="#" class="nav-item">&#128193; Projects</a>
        <a href="#" class="nav-item">&#128172; Leads & CRM</a>
      </div>

      <div class="nav-section">
        <div class="nav-section-title">Content</div>
        <a href="#" class="nav-item">&#128221; Case Studies</a>
        <a href="#" class="nav-item">&#128240; Blog Posts</a>
        <a href="#" class="nav-item">&#128247; Media Library</a>
      </div>

      <div class="nav-section">
        <div class="nav-section-title">System</div>
        <a href="#" class="nav-item">&#9881; Settings</a>
        <a href="#" class="nav-item">&#128101; Team</a>
        <a href="logout.php" class="nav-item">&#128682; Logout</a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
      <header class="top-header">
        <div class="search-box">
          <span>&#128269;</span>
          <input type="text" placeholder="Search anything...">
        </div>
        <div class="header-actions">
          <button class="header-btn">&#128276;</button>
          <button class="header-btn">&#9993;</button>
          <div class="user-pill">
            <div class="user-avatar"><?php echo strtoupper(substr($admin_name, 0, 1)); ?></div>
            <span class="user-name"><?php echo htmlspecialchars($admin_name); ?></span>
          </div>
        </div>
      </header>

      <div class="content">
        <h1 class="page-title">Dashboard Overview</h1>
        <p class="page-subtitle">Welcome back! Here's what's happening with your business.</p>

        <!-- Stats -->
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon green">&#128100;</div>
              <span class="stat-trend">+12%</span>
            </div>
            <div class="stat-value"><?php echo $stats['contacts']; ?></div>
            <div class="stat-label">Total Contacts</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon purple">&#9993;</div>
              <span class="stat-trend" style="background:rgba(239,68,68,0.1);color:#ef4444;">-5%</span>
            </div>
            <div class="stat-value"><?php echo $stats['new_contacts']; ?></div>
            <div class="stat-label">New Leads</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon blue">&#128101;</div>
              <span class="stat-trend">+8%</span>
            </div>
            <div class="stat-value"><?php echo $stats['subscribers']; ?></div>
            <div class="stat-label">Subscribers</div>
          </div>

          <div class="stat-card">
            <div class="stat-header">
              <div class="stat-icon orange">&#128221;</div>
              <span class="stat-trend">+3%</span>
            </div>
            <div class="stat-value"><?php echo $stats['case_studies'] + $stats['posts']; ?></div>
            <div class="stat-label">Published Content</div>
          </div>
        </div>

        <!-- Two Column Layout -->
        <div class="two-col">
          <!-- Recent Contacts -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Contacts</h3>
              <a href="#" style="font-size:0.8rem;color:var(--green);font-weight:600;">View All &rarr;</a>
            </div>
            <div class="card-body">
              <table>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($contact = $recent_contacts->fetch_assoc()): ?>
                  <tr>
                    <td style="color:var(--text);font-weight:500;"><?php echo htmlspecialchars($contact['name']); ?></td>
                    <td><?php echo htmlspecialchars($contact['email']); ?></td>
                    <td><span class="badge badge-<?php echo $contact['status']; ?>"><?php echo ucfirst($contact['status']); ?></span></td>
                    <td><?php echo date('M d, Y', strtotime($contact['created_at'])); ?></td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Recent Subscribers -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recent Subscribers</h3>
              <a href="#" style="font-size:0.8rem;color:var(--green);font-weight:600;">View All &rarr;</a>
            </div>
            <div class="card-body">
              <table>
                <thead>
                  <tr>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($sub = $recent_subscribers->fetch_assoc()): ?>
                  <tr>
                    <td style="color:var(--text);font-weight:500;"><?php echo htmlspecialchars($sub['email']); ?></td>
                    <td><?php echo htmlspecialchars($sub['name'] ?: '-'); ?></td>
                    <td><span class="badge badge-new"><?php echo ucfirst($sub['status']); ?></span></td>
                    <td><?php echo date('M d, Y', strtotime($sub['subscribed_at'])); ?></td>
                  </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
