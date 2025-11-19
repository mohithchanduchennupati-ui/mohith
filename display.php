<?php
require __DIR__ . '/db.php';
$stmt = $pdo->query('SELECT * FROM students ORDER BY created_at DESC');
$rows = $stmt->fetchAll();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>All Students</title>
<style>
body{font-family:Arial;background:#f7f7f7;padding:20px;}
.container{max-width:900px;margin:0 auto;background:#fff;padding:18px;border-radius:8px;box-shadow:0 6px 18px rgba(0,0,0,0.06);}
table{width:100%;border-collapse:collapse;margin-top:12px;}
th,td{padding:10px;border-bottom:1px solid #eee;text-align:left;}
th{background:#f4f6fb;}
.actions{margin-top:12px;}
.btn{display:inline-block;padding:8px 12px;border-radius:6px;text-decoration:none;color:#fff;}
.btn.primary{background:#007bff;}
.btn.secondary{background:#6c757d;}
</style>
</head>
<body>
<div class="container">
<h2>Registered Students</h2>
<?php if (!empty($_GET['added'])): ?>
    <div style="padding:10px;border-radius:6px;background:#d4edda;color:#155724;margin-bottom:12px;">Student registered successfully.</div>
<?php endif; ?>
<div class="actions">
<a class="btn primary" href="student.html">Add New</a>
</div>
<?php if (count($rows) === 0): ?>
    <p>No students registered yet.</p>
<?php else: ?>
    <table>
        <thead><tr><th>#</th><th>Name</th><th>Roll</th><th>Department</th><th>Email</th><th>Registered</th></tr></thead>
        <tbody>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?php echo htmlspecialchars($r['id']); ?></td>
                <td><?php echo htmlspecialchars($r['name']); ?></td>
                <td><?php echo htmlspecialchars($r['roll']); ?></td>
                <td><?php echo htmlspecialchars($r['department']); ?></td>
                <td><?php echo htmlspecialchars($r['email']); ?></td>
                <td><?php echo htmlspecialchars($r['created_at']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>
</body>
</html>