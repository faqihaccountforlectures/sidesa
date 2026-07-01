<?php
$logPath = "C:\\Users\\faqih\\.gemini\\antigravity\\brain\\57d42217-6dda-4202-a7e1-9e227d4a05db\\.system_generated\\logs\\overview.txt";
$lines = file($logPath);

$firstAdmin = "";
$firstUser = "";

foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (!$data) continue;
    
    // Stop at the dark mode request
    if (isset($data['step_index']) && $data['step_index'] >= 164) {
        break;
    }
    
    if (isset($data['tool_calls'])) {
        foreach ($data['tool_calls'] as $toolCall) {
            if ($toolCall['name'] === 'write_to_file') {
                $args = $toolCall['args'];
                if (isset($args['TargetFile']) && isset($args['CodeContent'])) {
                    $path = $args['TargetFile'];
                    if (strpos($path, 'admin.blade.php') !== false && empty($firstAdmin)) {
                        $firstAdmin = $args['CodeContent'];
                    }
                    if (strpos($path, 'layouts\\\\user.blade.php') !== false && empty($firstUser)) {
                        $firstUser = $args['CodeContent'];
                    }
                }
            }
        }
    }
}

if ($firstAdmin) file_put_contents('d:/desa_3/resources/views/layouts/admin.blade.php', $firstAdmin);
if ($firstUser) file_put_contents('d:/desa_3/resources/views/layouts/user.blade.php', $firstUser);

echo "Done restoring base layouts!\n";
