<?php
$logPath = "C:\\Users\\faqih\\.gemini\\antigravity\\brain\\57d42217-6dda-4202-a7e1-9e227d4a05db\\.system_generated\\logs\\overview.txt";
$lines = file($logPath);

$targetStep = 164; // The step where the user requested Dark Mode
$latestFiles = [];

foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (!$data) continue;
    
    if (isset($data['step_index']) && $data['step_index'] >= $targetStep) {
        // We stop checking file modifications once we reach the dark mode request
        break;
    }
    
    // Check for write_to_file calls
    if (isset($data['tool_calls'])) {
        foreach ($data['tool_calls'] as $toolCall) {
            if ($toolCall['name'] === 'write_to_file') {
                $args = $toolCall['args'];
                if (isset($args['TargetFile']) && isset($args['CodeContent'])) {
                    // Normalize path
                    $path = str_replace('\\\\', '\\', $args['TargetFile']);
                    $path = trim($path, '"');
                    $latestFiles[$path] = $args['CodeContent'];
                }
            }
        }
    }
}

// Now write out these latest files
foreach ($latestFiles as $path => $content) {
    if (strpos($path, 'admin.blade.php') !== false || strpos($path, 'user.blade.php') !== false) {
        echo "Restoring $path...\n";
        file_put_contents($path, $content);
    }
}
echo "Done!\n";
