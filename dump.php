<?php
$logPath = "C:\\Users\\faqih\\.gemini\\antigravity\\brain\\57d42217-6dda-4202-a7e1-9e227d4a05db\\.system_generated\\logs\\overview.txt";
$lines = file($logPath);

$adminCount = 0;
$userCount = 0;

foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (!$data) continue;
    
    if (isset($data['tool_calls'])) {
        foreach ($data['tool_calls'] as $toolCall) {
            if ($toolCall['name'] === 'write_to_file') {
                $args = $toolCall['args'];
                if (isset($args['TargetFile']) && isset($args['CodeContent'])) {
                    $path = $args['TargetFile'];
                    if (strpos($path, 'admin.blade.php') !== false) {
                        $adminCount++;
                        file_put_contents("d:/desa_3/admin_backup_$adminCount.php", $args['CodeContent']);
                    }
                    if (strpos($path, 'layouts\\\\user.blade.php') !== false) {
                        $userCount++;
                        file_put_contents("d:/desa_3/user_backup_$userCount.php", $args['CodeContent']);
                    }
                }
            }
        }
    }
}
echo "Dumped $adminCount admins and $userCount users\n";
