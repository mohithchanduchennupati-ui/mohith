<?php
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: student.html');
    exit;
}

$name = trim($_POST['name'] ?? '');
$roll = trim($_POST['roll'] ?? '');
$department = trim($_POST['department'] ?? '');
$email = trim($_POST['email'] ?? '');

$errors = [];
if ($name === '') $errors[] = 'Name is required.';
if ($roll === '') $errors[] = 'Roll number is required.';
if ($department === '') $errors[] = 'Department is required.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';

if (!empty($errors)) {
    echo '<!doctype html><html><head><meta charset="utf-8"><title>Submission errors</title></head><body>';
    echo '<h3>Submission errors</h3><ul>';
    foreach ($errors as $e) {
        echo '<li>' . htmlspecialchars($e) . '</li>';
    }
    echo '</ul><p><a href="student.html">Back to form</a></p></body></html>';
    exit;
}

try {
    $stmt = $pdo->prepare('INSERT INTO students (name, roll, department, email) VALUES (:name, :roll, :dept, :email)');
    $stmt->execute([':name'=>$name, ':roll'=>$roll, ':dept'=>$department, ':email'=>$email]);
} catch (PDOException $e) {
    echo 'Insert failed: ' . htmlspecialchars($e->getMessage());
    exit;
}
// Redirect to listing with success flag
header('Location: display.php?added=1');
exit;