<?php
$logPath = "C:\\Users\\faqih\\.gemini\\antigravity\\brain\\57d42217-6dda-4202-a7e1-9e227d4a05db\\.system_generated\\logs\\overview.txt";
$lines = file($logPath);

$targetFiles = [
    'd:\desa_3\resources\views\layouts\admin.blade.php' => '',
    'd:\desa_3\resources\views\layouts\user.blade.php' => '',
    'd:\desa_3\resources\views\admin\dashboard.blade.php' => '',
    'd:\desa_3\resources\views\user\dashboard.blade.php' => '',
    'd:\desa_3\resources\views\user\profil.blade.php' => '',
    'd:\desa_3\resources\views\admin\pengaduan.blade.php' => '',
    'd:\desa_3\resources\views\admin\pengaduan-show.blade.php' => '',
    'd:\desa_3\resources\views\admin\agenda\index.blade.php' => '',
    'd:\desa_3\resources\views\admin\agenda\create.blade.php' => '',
    'd:\desa_3\resources\views\admin\agenda\edit.blade.php' => '',
    'd:\desa_3\resources\views\admin\berita\index.blade.php' => ''
];

$fileContents = [];

foreach ($lines as $line) {
    $data = json_decode($line, true);
    if (!$data) continue;
    
    // Stop at the dark mode request
    if (isset($data['step_index']) && $data['step_index'] >= 164) {
        break;
    }
    
    // Track file contents
    if (isset($data['tool_calls'])) {
        foreach ($data['tool_calls'] as $toolCall) {
            $args = $toolCall['args'];
            $path = '';
            
            if (isset($args['TargetFile'])) {
                $path = str_replace('\\\\', '\\', trim($args['TargetFile'], '"'));
            } else if (isset($args['AbsolutePath'])) {
                $path = str_replace('\\\\', '\\', trim($args['AbsolutePath'], '"'));
            }
            
            if (array_key_exists($path, $targetFiles)) {
                if ($toolCall['name'] === 'write_to_file') {
                    $fileContents[$path] = $args['CodeContent'];
                } elseif ($toolCall['name'] === 'multi_replace_file_content') {
                    // Apply replacements
                    $content = isset($fileContents[$path]) ? $fileContents[$path] : file_get_contents($path);
                    if ($content) {
                        $lines = explode("\n", $content);
                        // Very naive replacement simulation, actual restore from disk is better
                    }
                }
            }
        }
    }
    
    // Check tool_results (e.g. from view_file)
    if (isset($data['tool_results'])) {
        foreach ($data['tool_results'] as $res) {
            if ($res['name'] === 'view_file' && isset($res['output'])) {
                // Not ideal, but we can rely on git if we have to. Wait, it's untracked.
            }
        }
    }
}

// Write the files that we found from write_to_file
foreach ($fileContents as $path => $content) {
    echo "Restoring $path\n";
    file_put_contents($path, $content);
}

// Since admin.blade.php and user.blade.php had "multi_replace_file_content" in step 139-150...
// We can just use git checkout to restore all tracked files. Oh wait, layouts are untracked.
// Let's just create a backup of the current state and then use regex to reverse the dark mode changes.
