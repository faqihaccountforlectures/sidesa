<?php
$logPath = "C:\\Users\\faqih\\.gemini\\antigravity\\brain\\57d42217-6dda-4202-a7e1-9e227d4a05db\\.system_generated\\logs\\overview.txt";
$lines = file($logPath);

$viewCount = 0;

foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (!$data) continue;
    
    // Stop at dark mode request
    if (isset($data['step_index']) && $data['step_index'] >= 164) {
        break;
    }
    
    if (isset($data['tool_results'])) {
        foreach ($data['tool_results'] as $res) {
            if ($res['name'] === 'view_file' && isset($res['output'])) {
                if (strpos($res['output'], 'layouts/admin.blade.php') !== false || strpos($res['output'], 'layouts\admin.blade.php') !== false) {
                    $viewCount++;
                    file_put_contents("d:/desa_3/view_admin_$viewCount.txt", $res['output']);
                }
                if (strpos($res['output'], 'layouts/user.blade.php') !== false || strpos($res['output'], 'layouts\user.blade.php') !== false) {
                    file_put_contents("d:/desa_3/view_user_$viewCount.txt", $res['output']);
                }
            }
        }
    }
}
echo "Dumped view_file results: $viewCount\n";
