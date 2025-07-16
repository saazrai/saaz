<?php

// Script to analyze Bloom distribution in diagnostic seeder files
$seedersDir = __DIR__ . '/database/seeders/Diagnostics';
$results = [];

// Get all seeder files
$files = glob($seedersDir . '/*.php');
sort($files);

foreach ($files as $file) {
    $filename = basename($file);
    $content = file_get_contents($file);
    
    // Extract domain name from class name
    preg_match('/class\s+(\w+)\s+extends/', $content, $matches);
    $className = $matches[1] ?? 'Unknown';
    
    // Count total questions by looking for 'bloom_level' => pattern
    preg_match_all("/'bloom_level'\s*=>\s*(\d+)/", $content, $bloomMatches);
    $bloomLevels = array_map('intval', $bloomMatches[1]);
    
    // Count questions by bloom level
    $bloomCounts = [
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0
    ];
    
    foreach ($bloomLevels as $level) {
        if (isset($bloomCounts[$level])) {
            $bloomCounts[$level]++;
        }
    }
    
    $totalQuestions = array_sum($bloomCounts);
    
    // Extract domain number from filename
    preg_match('/D(\d+)/', $filename, $domainMatch);
    $domainNumber = $domainMatch[1] ?? '?';
    
    $results[] = [
        'domain' => "D{$domainNumber}",
        'class' => $className,
        'total' => $totalQuestions,
        'bloom_1' => $bloomCounts[1],
        'bloom_2' => $bloomCounts[2],
        'bloom_3' => $bloomCounts[3],
        'bloom_4' => $bloomCounts[4],
        'bloom_5' => $bloomCounts[5],
        'status' => ($totalQuestions === 50 && 
                    $bloomCounts[1] === 7 && 
                    $bloomCounts[2] === 10 && 
                    $bloomCounts[3] === 16 && 
                    $bloomCounts[4] === 10 && 
                    $bloomCounts[5] === 7) ? '✅ Complete' : '❌ Needs work'
    ];
}

// Display results
echo "DIAGNOSTIC DOMAIN BLOOM DISTRIBUTION ANALYSIS\n";
echo "Target Distribution: 7, 10, 16, 10, 7 = 50 total questions\n";
echo str_repeat("=", 80) . "\n";

printf("%-4s %-35s %-5s %-3s %-3s %-3s %-3s %-3s %-15s\n", 
       "Dom", "Class", "Total", "L1", "L2", "L3", "L4", "L5", "Status");
echo str_repeat("-", 80) . "\n";

foreach ($results as $result) {
    printf("%-4s %-35s %-5d %-3d %-3d %-3d %-3d %-3d %-15s\n",
           $result['domain'],
           substr($result['class'], 0, 35),
           $result['total'],
           $result['bloom_1'],
           $result['bloom_2'],
           $result['bloom_3'],
           $result['bloom_4'],
           $result['bloom_5'],
           $result['status']
    );
}

echo str_repeat("=", 80) . "\n";

// Summary statistics
$completeCount = count(array_filter($results, fn($r) => $r['status'] === '✅ Complete'));
$totalDomains = count($results);
$needsWorkCount = $totalDomains - $completeCount;

echo "SUMMARY:\n";
echo "Total Domains: {$totalDomains}\n";
echo "Complete (50 questions, proper Bloom distribution): {$completeCount}\n";
echo "Needs Work: {$needsWorkCount}\n";

if ($needsWorkCount > 0) {
    echo "\nDOMAINS NEEDING ATTENTION:\n";
    foreach ($results as $result) {
        if ($result['status'] === '❌ Needs work') {
            $totalDiff = $result['total'] - 50;
            $bloomDiffs = [
                $result['bloom_1'] - 7,
                $result['bloom_2'] - 10,
                $result['bloom_3'] - 16,
                $result['bloom_4'] - 10,
                $result['bloom_5'] - 7
            ];
            
            echo "  {$result['domain']}: Total={$result['total']} (";
            echo ($totalDiff > 0 ? "+" : "") . $totalDiff . "), ";
            echo "Bloom=[" . implode(', ', array_map(fn($d) => ($d >= 0 ? '+' : '') . $d, $bloomDiffs)) . "]\n";
        }
    }
}

?>