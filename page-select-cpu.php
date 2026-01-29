<?php
/*
Template Name: Select CPU - BuildCores Style
*/
get_header();

$cacheFile = get_template_directory() . '/data/buildcores/cache/cpu-cache.json';

if (!file_exists($cacheFile)) {
    echo "<div style='padding:40px; text-align:center; color:#f44336; font-size:1.2em;'><h2>❌ Cache file not found!</h2></div>";
    get_footer();
    exit;
}

$rawCpuData = json_decode(file_get_contents($cacheFile), true);
if (!$rawCpuData || !is_array($rawCpuData)) {
    echo "<div style='padding:40px; text-align:center; color:#f44336; font-size:1.2em;'><h2>❌ Cache is empty!</h2></div>";
    get_footer();
    exit;
}

// Process data
$cpuDatabase = [];
$sockets = [];



$cpuImages = [
    // === GAMING CPUs ===
    '14900KS' => '14900ks.jpg',
    '14900K' => '14900k.jpg',
    '14900KF' => '14900kf.jpg',
    '9950X3D' => '9950x3d.jpg',
    '9800X3D' => '9800x3d.jpg',
    '9900X3D' => '9900x3d.jpg',
    '14700K' => '14700k.jpg',
    '14700KF' => '14700kf.jpg',
    '9950X' => '9950x.jpg',
    '285' => 'ultra285k.jpg',
    '9900X' => '9900x.jpg',
    '9700X' => '9700x.jpg',
    '7900X3D' => '7900x3d.jpg',
    '7800X3D' => '7800x3d.jpg',
    '13900' => '13900.jpg',
    '14600K' => '14600kf.jpg',
    '14600KF' => '14600kf.jpg',
    '12900F' => '12900kf.jpg',
    '7900X' => '7900x.jpg',
    '13700' => '13700.jpg',
    '7900' => '7900.jpg',
    '7700x' => '7700x.jpg',
    '13900F' => '13900f.jpg',
    '14700' => '14700.jpg',
    '12600K' => '12600.jpg',
    '9600X' => '9600x.jpg',
    '14600' => '14600.jpg',
    '12700' => '12700.jpg',
    '7600X' => '7600x.jpg',
    
    // === OFFICE CPUs ===
    '5950X' => '5950x.jpg',
    '265' => 'ultra265.jpg',
    '265F' => 'ultra265.jpg',
    '7700X' => '7700x.jpg',
    '13900KF' => '13900f.jpg',
    '13900K' => '13900k.jpg',
    '5900X' => '5900x.jpg',
    '13700F' => '13700.jpg',
    '12700K' => '12700k.jpg',
    '5900XT' => '5900xt.jpg',
    '13500' => '13500.jpg',
    '5800X' => '5800x.jpg',
    '12600KF' => '12600.jpg',
    '5700X' => '5700x.jpg',
    '13600K' => '13600k.jpg',
    '5950XT' => '5950xt.jpg',
    '12700F' => '12700f.jpg',
];

$gamingCpus = [
    'Intel Core i9-14900KS',
    'Intel Core i9-14900K',
    'Intel Core i9-14900KF',
    'AMD Ryzen 9 9950X3D',
    'AMD Ryzen 7 9800X3D',
    'AMD Ryzen 9 9900X3D',
    'Intel Core i7-14700K',
    'Intel Core i7-14700KF',
    'AMD Ryzen 9 9950X',
    'Intel Core Ultra 9 285',
    'AMD Ryzen 9 9900X',
    'AMD Ryzen 7 9700X',
    'AMD Ryzen 9 7900X3D',
    'AMD Ryzen 7 7800X3D',
    'Intel Core i9-13900',
    'Intel Core i5-14600K',
    'Intel Core i5-14600KF',
    'Intel Core i9-12900F',
    'AMD Ryzen 9 7900X',
    'Intel Core i7-13700',
    'AMD Ryzen 9 7900',
    'AMD Ryzen 7 7700',
    'Intel Core i9-13900F',
    'Intel Core i7-14700',
    'Intel Core i5-12600K',
    'AMD Ryzen 5 9600X',
    'Intel Core i5-14600',
    'Intel Core i7-12700',
    'AMD Ryzen 5 7600X',
];

$gamingKeywords = [
    'i9 14900KS', 'i9 14900K', 'i9 14900KF',
    'Ryzen 9 9950X3D', 'Ryzen 7 9800X3D', 'Ryzen 9 9900X3D',
    'i7 14700K', 'i7 14700KF', 'Ryzen 9 9950X',
    'Ultra 9 285', 'Ryzen 9 9900X', 'Ryzen 7 9700X',
    'Ryzen 9 7900X3D', 'Ryzen 7 7800X3D',
    'i9 13900', 'i5 14600K', 'i5 14600KF',
    'i9 12900F', 'Ryzen 9 7900X', 'i7 13700',
    'Ryzen 9 7900', 'Ryzen 7 7700',
    'i9 13900F', 'i7 14700', 'i5 12600K',
    'Ryzen 5 9600X', 'i5 14600', 'i7 12700', 'Ryzen 5 7600X',
];

$officeCpus = [
    'AMD Ryzen 9 9950X3D', 'AMD Ryzen 9 9950X',
    'Intel Core i9-14900K', 'Intel Core i9-13900',
    'Intel Core Ultra 9 285', 'AMD Ryzen 9 5950X',
    'AMD Ryzen 9 7900X3D', 'Intel Core i7-14700K',
    'Intel Core i7-13700', 'Intel Core i9-12900F',
    'Intel Core i7-12700F', 'Intel Core Ultra 7 265',
    'Intel Core Ultra 7 265F', 'AMD Ryzen 7 7700X',
    'Intel Core i9-13900F', 'Intel Core i9-13900KF',
    'AMD Ryzen 9 7900X', 'Intel Core i9-13900K',
    'AMD Ryzen 9 5900X', 'Intel Core i7-13700F',
    'Intel Core i7-12700K', 'AMD Ryzen 9 5900XT',
    'Intel Core i5-13500', 'AMD Ryzen 7 5800X',
    'Intel Core i7-12700', 'Intel Core i5-12600KF',
    'AMD Ryzen 7 5700X', 'Intel Core i5-13600K',
    'AMD Ryzen 9 5950XT',
];

$officeKeywords = [
    'Ryzen 9 9950X3D', 'Ryzen 9 9950X', 'i9 14900K', 'i9 13900', 'Ultra 9 285',
    'Ryzen 9 5950X', 'Ryzen 9 7900X3D', 'i7 14700K', 'i7 13700', 'i9 12900F',
    'i7 12700F', 'Ultra 7 265', 'Ultra 7 265F', 'Ryzen 7 7700X',
    'i9 13900F', 'i9 13900KF', 'Ryzen 9 7900X', 'i9 13900K', 'Ryzen 9 5900X',
    'i7 13700F', 'i7 12700K', 'Ryzen 9 5900XT', 'i5 13500', 'Ryzen 7 5800X',
    'i7 12700', 'i5 12600KF', 'Ryzen 7 5700X', 'i5 13600K', 'Ryzen 9 5950XT',
];



$CPU_PRICES = [
    // === BUDGET TIER ===
    '4100' => 306,          // AMD Ryzen 3 4100
    '3200G' => 317,         // AMD Ryzen 3 3200G
    '3400G' => 318,         // AMD Ryzen 5 3400G
    '4300G' => 441,         // AMD Ryzen 3 4300G
    '12100F' => 445,        // Intel Core i3 12100F
    '5300G' => 573,         // AMD Ryzen 3 5300G
    '12100' => 868,         // Intel Core i3 12100
    '12600KF' => 871,       // Intel Core i5 12600KF
    
    // === MID-BUDGET TIER ===
    '5500' => 440,          // AMD Ryzen 5 5500
    '12400F' => 582,        // Intel Core i5 12400F
    '5600' => 620,          // AMD Ryzen 5 5600
    '8400F' => 710,         // AMD Ryzen 5 8400F
    '5700' => 710,          // AMD Ryzen 7 5700
    '5600XT' => 780,        // AMD Ryzen 5 5600XT
    '225F' => 790,          // Intel Core Ultra 5 225F
    '5600X' => 800,         // AMD Ryzen 5 5600X
    '8500G' => 848,         // AMD Ryzen 5 8500G
    '245KF' => 913,         // Intel Core Ultra 5 245KF
    '7600X' => 930,         // AMD Ryzen 5 7600X
    '7600' => 930,          // AMD Ryzen 5 7600
    '8600G' => 1000,        // AMD Ryzen 5 8600G
    '245K' => 1000,         // Intel Core Ultra 5 245K
    '225' => 949,           // Intel Core Ultra 5 225
    '10400' => 974,         // Intel Core i5 10400
    
    // === MID-RANGE TIER ===
    '14400F' => 1100,       // Intel Core i5 14400F
    '9600' => 1110,         // AMD Ryzen 5 9600
    '5800X' => 1200,        // AMD Ryzen 7 5800X
    '7700X' => 1200,        // AMD Ryzen 7 7700X
    '9600X' => 1245,        // AMD Ryzen 5 9600X
    '7500X3D' => 1290,      // AMD Ryzen 5 7500X3D
    '8700F' => 1332,        // AMD Ryzen 7 8700F
    '8700G-PRO' => 1370,    // AMD Ryzen 7 PRO 8700G (Tray)
    '235' => 1400,          // Intel Core Ultra 5 235
    '12400' => 1089,        // Intel Core i5 12400
    '12600K' => 1108,       // Intel Core i5 12600K
    '5700G' => 1075,        // AMD Ryzen 7 5700G
    '5700X' => 1080,        // AMD Ryzen 7 5700X
    '14100' => 1183,        // Intel Core i3 14100
    '12700KF' => 1373,      // Intel Core i7 12700KF
    '3600X' => 1377,        // AMD Ryzen 5 3600X
    '12700F' => 1397,       // Intel Core i7 12700F
    '12700K' => 1566,       // Intel Core i7 12700K
    '13700F' => 1573,       // Intel Core i7 13700F
    '14400' => 1580,        // Intel Core i5 14400
    '7700' => 1450,         // AMD Ryzen 7 7700
    '5900XT' => 1661,       // AMD Ryzen 9 5900XT
    '12900KF' => 1694,      // Intel Core i9 12900KF
    '8700G' => 1620,        // AMD Ryzen 7 8700G
    '12900K' => 1772,       // Intel Core i9 12900K
    '265F' => 1773,         // Intel Core Ultra 7 265F
    '265' => 1860,          // Intel Core Ultra 7 265
    '14700K-REFRESH' => 1850, // Intel Core i7 14700K (Refresh)
    '12900F' => 1973,       // Intel Core i9 12900F
    '9900X' => 2030,        // AMD Ryzen 9 9900X
    '12900' => 2146,        // Intel Core i9 12900
    
    // === HIGH-END TIER ===
    '265KF' => 1470,        // Intel Core Ultra 7 265KF
    '265K' => 1640,         // Intel Core Ultra 7 265K
    '9700X' => 1660,        // AMD Ryzen 7 9700X
    '14700F' => 1708,       // Intel Core i7 14700F
    '14700K' => 1765,       // Intel Core i7 14700K
    '7900X' => 1780,        // AMD Ryzen 9 7900X
    '7800X3D' => 1900,      // AMD Ryzen 7 7800X3D
    '7900' => 1656,         // AMD Ryzen 9 7900
    '7900' => 2318,         // AMD Ryzen 9 7900 (alt price)
    '9900X3D' => 2875,      // AMD Ryzen 9 9900X3D
    
    // === TOP TIER / EXTREME ===
    '14900K' => 2350,       // Intel Core i9 14900K
    '9800X3D-TRAY' => 2350, // AMD Ryzen 7 9800X3D (Tray)
    '14900KS' => 2420,      // Intel Core i9 14900KS
    '9800X3D' => 2430,      // AMD Ryzen 7 9800X3D (Box)
    '285K' => 2700,         // Intel Core Ultra 9 285K
    '9950X' => 3010,        // AMD Ryzen 9 9950X
    '14900F' => 3004,       // Intel Core i9 14900F
    '285' => 3091,          // Intel Core Ultra 9 285
    '14900' => 3148,        // Intel Core i9 14900
    '13900KF' => 3488,      // Intel Core i9 13900KF
    '9950X3D' => 4067,      // AMD Ryzen 9 9950X3D
];


function getCpuPrice($cpuName) {
    global $CPU_PRICES;
    
    if (empty($cpuName)) {
        return 0;
    }
    
    // FIXED REGEX: Extract 14900K, 9800X3D, 245KF, etc.
    // Matches: 4-5 digits + optional (KS, KF, K, F, X, XT, X3D, G)
    preg_match('/\b(\d{4,5}(?:KS|KF|K|F|X(?:3D)?|XT|G)?)\b/i', $cpuName, $matches);
    
    if (!isset($matches[1])) {
        error_log('DEBUG: No model found in: ' . $cpuName);
        return 0;
    }
    
    $model = strtoupper($matches[1]); // Normalize case
    error_log('DEBUG: Extracted model: ' . $model . ' from: ' . $cpuName);
    
    // Direct match
    if (isset($CPU_PRICES[$model])) {
        $price = $CPU_PRICES[$model];
        error_log('DEBUG: ✅ FOUND direct: ' . $model . ' = ' . $price);
        return $price;
    }
    
    // Try case-insensitive
    foreach ($CPU_PRICES as $key => $price) {
        if (strtoupper($key) === $model) {
            error_log('DEBUG: ✅ FOUND case-insensitive: ' . $key . ' = ' . $price);
            return $price;
        }
    }
    
    error_log('DEBUG: ❌ NOT FOUND: ' . $model);
    return 0;
}

function debugCpuPrices() {
    global $CPU_PRICES;
    echo "\n<script>\n";
    echo "console.log('%c🔍 CPU_PRICES DEBUG - All ' + Object.keys(" . json_encode($CPU_PRICES) . ").length + ' CPUs', 'color:green; font-size:14px; font-weight:bold');\n";
    echo "console.table(" . json_encode($CPU_PRICES) . ");\n";
    echo "</script>\n";
}


function debugCpuLookup($cpuName) {
    global $CPU_PRICES;
    echo "\n<script>\n";
    echo "console.group('%c🔍 DEBUG Lookup', 'color:blue');\n";
    echo "console.log('Input:', '" . addslashes($cpuName) . "');\n";
    
    preg_match('/\b(\d{4,5}(?:KS|KF|K|F|X(?:3D)?|XT|G)?)\b/i', $cpuName, $matches);
    
    if (isset($matches[1])) {
        $model = strtoupper($matches[1]);
        echo "console.log('Extracted:', '" . $model . "');\n";
        
        if (isset($CPU_PRICES[$model])) {
            echo "console.log('%c✅ FOUND', 'color:green; font-weight:bold');\n";
            echo "console.log('Price:', " . $CPU_PRICES[$model] . " + ' LEI');\n";
        } else {
            echo "console.log('%c❌ NOT FOUND', 'color:red; font-weight:bold');\n";
            echo "console.log('Available:', Object.keys(" . json_encode($CPU_PRICES) . "));\n";
        }
    } else {
        echo "console.log('%c❌ REGEX FAILED', 'color:red; font-weight:bold');\n";
    }
    
    echo "console.groupEnd();\n";
    echo "</script>\n";
}


function getCpuImagePath($cpuName, $manufacturer) {
    global $cpuImages;
    foreach ($cpuImages as $keyword => $imageName) {
        if (stripos($cpuName, $keyword) !== false) {
            return get_template_directory_uri() . '/assets/cpuimages/' . $imageName;
        }
    }
    if (stripos($manufacturer, 'intel') !== false) {
        return get_template_directory_uri() . '/assets/cpuimages/intel.jpg';
    } else {
        return get_template_directory_uri() . '/assets/cpuimages/amd.jpg';
    }
}

function isFeatured($name, $keywords) {
    foreach ($keywords as $keyword) {
        if (stripos($name, $keyword) !== false) return true;
    }
    return false;
}

foreach ($rawCpuData as $cpu) {
    $cores = (int)($cpu['cores']['total'] ?? 0);
    $threads = (int)($cpu['cores']['threads'] ?? 0);
    $base_freq = (float)($cpu['clocks']['performance']['base'] ?? 0);
    $boost_freq = (float)($cpu['clocks']['performance']['boost'] ?? 0);
    $tdp = (int)($cpu['specifications']['tdp'] ?? 0);
    $name = $cpu['metadata']['name'] ?? '';
    $manufacturer = strtolower($cpu['metadata']['manufacturer'] ?? 'unknown');
    $socket = strtoupper($cpu['socket'] ?? $cpu['metadata']['socket'] ?? 'UNKNOWN');
    
    $skipKeywords = [
        'Xeon', 'Core i5 4', 'Core i7 4', 'Core i3 4', 'Core i9 4',
        'Intel 7900X',
        'Core i5 5', 'Core i7 5', 'Core i3 5',
        'Core i5 6', 'Core i7 6', 'Core i3 6',
        'Core i5 7', 'Core i7 7', 'Core i3 7',
        'Core i5 8', 'Core i7 8', 'Core i3 8',
        'Core i5 9', 'Core i7 9', 'Core i3 9', 'Core i9 9',
        'Core i3 10', 'Core i5 10', 'Core i7 10','Core i9 10',
        'Core i3 11', 'Core i5 11', 'Core i7 11','Core i9 11',
        'Pentium 4', 'Celeron',
        'ryzen 3 1', 'ryzen 5 1', 'ryzen 7 1',
        'ryzen 3 2', 'ryzen 5 2', 'ryzen 7 2',
        'ryzen 3 3', 'ryzen 5 3', 'ryzen 7 3',
        'ryzen 3 4', 'ryzen 5 4', 'ryzen 7 4',
        'fx-', 'phenom', 'athlon ii', 'athlon x2',
        'AMD A', 'AMD E',
    ];

    $skip = false;
    foreach ($skipKeywords as $keyword) {
        if (stripos($name, $keyword) !== false) {
            $skip = true;
            break;
        }
    }

    if (empty($name) || $cores == 0 || $skip) continue;
   
    if ($cores >= 20) $color = '#FF1744';
    elseif ($cores >= 16) $color = '#E91E63';
    elseif ($cores >= 12) $color = '#9C27B0';
    elseif ($cores >= 8) $color = '#2196F3';
    elseif ($cores >= 6) $color = '#4CAF50';
    else $color = '#757575';
    
    $isGaming = false;
    $isOffice = false;
    foreach ($gamingCpus as $keyword) {
        if (stripos($name, $keyword) !== false) { $isGaming = true; break; }
    }
    foreach ($officeCpus as $keyword) {
        if (stripos($name, $keyword) !== false) { $isOffice = true; break; }
    }
    
    $cpuDatabase[] = [
        'name' => $name,
        'cores' => $cores,
        'threads' => $threads,
        'base_freq' => $base_freq,
        'boost_freq' => $boost_freq,
        'tdp' => $tdp,
        'socket' => $socket,
        'manufacturer' => $manufacturer,
        'color' => $color,
        'featured_gaming' => isFeatured($name, $gamingKeywords),
        'featured_office' => isFeatured($name, $officeKeywords),
    ];
    
    if (!in_array($socket, $sockets)) {
        $sockets[] = $socket;
    }
}

$minTdp = min(array_column($cpuDatabase, 'tdp'));
$maxTdp = max(array_column($cpuDatabase, 'tdp'));
$minCores = min(array_column($cpuDatabase, 'cores'));
$maxCores = max(array_column($cpuDatabase, 'cores'));

foreach ($cpuDatabase as &$cpu) {
    $cpu['price'] = getCpuPrice($cpu['name']);
}
unset($cpu);

// ===== GET SORT PREFERENCE =====
$sortBy = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'price-asc';

// ===== SEPARATE INTO INTEL & AMD =====
$intelCpus = array_values(array_filter($cpuDatabase, fn($c) => strpos($c['manufacturer'], 'intel') !== false));
$amdCpus = array_values(array_filter($cpuDatabase, fn($c) => strpos($c['manufacturer'], 'amd') !== false));

// ===== SORT EACH GROUP =====
// ===== SORT EACH GROUP (prices first, N/A last) =====
$sortFunc = function($a, $b) use ($sortBy) {
    // Dacă A nu are preț și B are preț → B merge mai sus
    if ($a['price'] == 0 && $b['price'] > 0) return 1;
    if ($a['price'] > 0 && $b['price'] == 0) return -1;
    // Dacă amândouă nu au preț → rămân în ordine
    if ($a['price'] == 0 && $b['price'] == 0) return 0;
    
    // AMBELE au preț → sortează normal
    if ($sortBy === 'price-desc') {
        return $b['price'] - $a['price'];
    } elseif ($sortBy === 'cores-desc') {
        return $b['cores'] - $a['cores'];
    } elseif ($sortBy === 'name-asc') {
        return strcmp($a['name'], $b['name']);
    } else { // price-asc (default)
        return $a['price'] - $b['price'];
    }
};

usort($intelCpus, $sortFunc);
usort($amdCpus, $sortFunc);
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPU Selector - BuildCores Style</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            background: #0f1419;
            color: #e2e8f0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
        }
        
        .main-wrapper {
            max-width: 1600px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            gap: 20px;
            flex-wrap: wrap;
        }
        
        .back-link {
            color: #cbd5e0;
            text-decoration: none;
            font-size: 1em;
        }
        
        .title {
            font-size: 1.5em;
            color: #e2e8f0;
            font-weight: 600;
        }
        
        .top-controls {
            display: flex;
            gap: 16px;
            align-items: center;
            width: 100%;
        }
        
        .search-input {
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #e2e8f0;
            width: 250px;
            font-size: 0.95em;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #21C55D;
        }
        
        .sort-select {
            padding: 10px 16px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #e2e8f0;
            font-size: 0.95em;
            cursor: pointer;
        }
        
        .desktop-sort { display: block; }
        .mobile-sort { display: none; }
        .mobile-controls { display: none; }
        
        .content {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 24px;
        }
        
        .sidebar {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 20px;
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        
        .filter-group { margin-bottom: 24px; }
        
        .filter-title {
            font-size: 0.9em;
            color: #cbd5e0;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
        }
        
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        
        .checkbox-item input { cursor: pointer; }
        
        .checkbox-item label {
            cursor: pointer;
            font-size: 0.9em;
            flex: 1;
        }
        
        .checkbox-item input:checked + label {
            color: #21C55D;
            font-weight: 600;
        }
        
        .slider-labels {
            display: flex;
            justify-content: space-between;
            font-size: 0.85em;
            color: #a0aec0;
            margin-bottom: 8px;
        }
        
        .range-slider-container {
            position: relative;
            height: 30px;
            margin-top: 12px;
        }
        
        .range-slider {
            position: absolute;
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: rgba(255, 255, 255, 0.1);
            outline: none;
            -webkit-appearance: none;
            appearance: none;
            pointer-events: none;
            top: 12px;
        }
        
        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #21C55D;
            cursor: pointer;
            pointer-events: auto;
            box-shadow: 0 0 10px rgba(33, 197, 93, 0.5);
            z-index: 5;
        }
        
        .range-slider::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #21C55D;
            cursor: pointer;
            border: none;
            box-shadow: 0 0 10px rgba(33, 197, 93, 0.5);
            pointer-events: auto;
            z-index: 5;
        }
        
        #coreMin { z-index: 6; }
        #tdpMin { z-index: 6; }
        
        .expand-btn {
            padding: 4px 12px;
            background: rgba(33, 197, 93, 0.2);
            border: 1px solid rgba(33, 197, 93, 0.4);
            color: #21C55D;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.75em;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .expand-btn:hover {
            background: rgba(33, 197, 93, 0.3);
            border-color: #21C55D;
        }
        
        .expand-btn.expanded {
            background: #21C55D;
            color: #0f1419;
        }
        
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 16px;
        }
        
        .product-card {
            background: rgba(45, 55, 72, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
        }
        
        .product-card:hover {
            transform: translateY(-4px);
            border-color: rgba(33, 197, 93, 0.5);
            background: rgba(45, 55, 72, 0.7);
            box-shadow: 0 12px 30px rgba(33, 197, 93, 0.15);
        }
        
        .product-image {
            width: 100%;
            aspect-ratio: 1 / 1;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
            border-radius: 6px;
        }
        
        .product-info {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-name {
            font-size: 0.9em;
            font-weight: 600;
            margin-bottom: 12px;
            color: #f7fafc;
            line-height: 1.2;
            min-height: 40px;
        }
        
        .spec-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.8em;
            margin-bottom: 4px;
            color: #a0aec0;
        }
        
        .spec-label {
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .spec-value {
            color: #21C55D;
            font-weight: 600;
        }
        
        .add-btn {
            background: linear-gradient(135deg, #2196F3 0%, #1D4ED8 100%);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: auto;
            font-size: 1em;
            width: 100%;
        }
        
        .add-btn:hover {
            background: #1769aa;
            transform: translateY(-2px);
        }
        
        .add-btn.amd {
            background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        }
        
        .add-btn.amd:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);
            background: linear-gradient(135deg, #F97316 0%, #EA580C 100%);
        }
        
        .section-title {
            font-size: 1.1em;
            font-weight: 600;
            color: #e2e8f0;
            margin-bottom: 16px;
            padding-top: 16px;
        }
        .premium-price {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px;
    background: linear-gradient(135deg, #FFFFFF 0%, #FEF3C7 100%);
    border: 2px solid #F59E0B;
    border-radius: 12px;
    margin-top: 16px;
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.15);
    transition: all 0.3s ease;
}

.premium-price:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(245, 158, 11, 0.25);
    border-color: #F97316;
}

.premium-price-tag {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #F59E0B 0%, #F97316 100%);
    border-radius: 12px;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.premium-price-number {
    font-size: 26px;
    font-weight: 900;
    color: white;
    text-align: center;
    line-height: 1.1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.premium-price-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
    flex-grow: 1;
}

.premium-price-label {
    font-size: 11px;
    font-weight: 700;
    color: #92400E;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.premium-price-currency {
    font-size: 13px;
    font-weight: 600;
    color: #F59E0B;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.premium-price-note {
    font-size: 11px;
    color: #92400E;
    opacity: 0.7;
    font-style: italic;
}

/* N/A Style */
.premium-price.na {
    background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
    border-color: #D1D5DB;
}

.premium-price.na .premium-price-tag {
    background: linear-gradient(135deg, #9CA3AF 0%, #6B7280 100%);
}

.premium-price.na .premium-price-number {
    font-size: 16px;
}

@media (max-width: 480px) {
    .premium-price {
        gap: 10px;
        padding: 12px;
    }
    
    .premium-price-tag {
        width: 70px;
        height: 70px;
    }
    
    .premium-price-number {
        font-size: 22px;
    }
}

        .featured-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 10px 16px;
            border-radius: 12px;
            font-size: 0.85em;
            font-weight: 800;
            z-index: 20;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(20px);
            border: 2px solid;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-family: 'Arial', sans-serif;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            animation: badgeFloat 2.5s ease-in-out infinite;
            transition: all 0.3s;
        }
        
        .featured-badge:hover { transform: scale(1.1); }
        
        .featured-badge.gaming {
            background: linear-gradient(135deg, #FF1744 0%, #FF5252 100%);
            color: white;
            border-color: #FF1744;
            box-shadow: 0 0 20px rgba(255, 23, 68, 0.6), 0 8px 32px rgba(255, 23, 68, 0.3), inset 0 0 20px rgba(255, 255, 255, 0.2);
            text-shadow: 0 0 10px rgba(255, 23, 68, 0.8);
        }
        
        .featured-badge.office {
            background: linear-gradient(135deg, #21C55D 0%, #4CAF50 100%);
            color: white;
            border-color: #21C55D;
            box-shadow: 0 0 20px rgba(33, 197, 93, 0.6), 0 8px 32px rgba(33, 197, 93, 0.3), inset 0 0 20px rgba(255, 255, 255, 0.2);
            text-shadow: 0 0 10px rgba(33, 197, 93, 0.8);
        }
        
        .product-card.featured-gaming {
            border: 2px solid #FF1744 !important;
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.9) 0%, rgba(255, 23, 68, 0.08) 100%);
        }
        
        .product-card.featured-gaming:hover {
            box-shadow: 0 0 40px rgba(255, 23, 68, 0.5), 0 0 80px rgba(255, 23, 68, 0.2), inset 0 0 20px rgba(255, 23, 68, 0.1);
            transform: translateY(-8px);
            border-color: #FF5252;
        }
        
        .product-card.featured-office {
            border: 2px solid #21C55D !important;
            background: linear-gradient(135deg, rgba(45, 55, 72, 0.9) 0%, rgba(33, 197, 93, 0.08) 100%);
        }
        
        .product-card.featured-office:hover {
            box-shadow: 0 0 40px rgba(33, 197, 93, 0.5), 0 0 80px rgba(33, 197, 93, 0.2), inset 0 0 20px rgba(33, 197, 93, 0.1);
            transform: translateY(-8px);
            border-color: #4CAF50;
        }
        
        .featured-description {
            padding: 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 12px;
            font-size: 0.85em;
            line-height: 1.5;
            color: #cbd5e0;
            border-radius: 8px;
            background: rgba(0, 0, 0, 0.2);
        }
        
        .featured-description.gaming {
            background: rgba(255, 23, 68, 0.1);
            border-top-color: rgba(255, 23, 68, 0.3);
            color: #FFB3BA;
        }
        
        .featured-description.office {
            background: rgba(33, 197, 93, 0.1);
            border-top-color: rgba(33, 197, 93, 0.3);
            color: #B8F3BA;
        }
        
        .filters-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            display: none;
        }
        
        .filters-overlay.active { display: block; }
        
        @keyframes badgeFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-4px); }
        }
        
        @media (min-width: 769px) {
            .top-controls { flex-wrap: nowrap; gap: 16px; }
            .search-input { flex: 1; width: auto; }
            .desktop-sort { display: block; }
            .mobile-sort { display: none; }
            .mobile-controls { display: none; }
            .filter-btn { display: none; }
            .sidebar { position: static; top: auto; width: 280px; }
            .filters-overlay { display: none !important; }
            .content { grid-template-columns: 280px 1fr; }
        }
        
        @media (max-width: 768px) {
            .main-wrapper { padding: 12px; }
            .top-bar { margin-bottom: 16px; }
            .top-controls {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
                width: 100%;
                flex-wrap: wrap;
            }
            .mobile-controls { display: contents; }
            .filter-btn {
                grid-column: 1;
                padding: 10px 12px;
                background: #0066cc;
                color: white;
                border: none;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                font-size: 13px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 6px;
                transition: all 0.2s ease;
            }
            .filter-btn:active {
                background: #0052a3;
                transform: scale(0.95);
            }
            .mobile-sort {
                grid-column: 2;
                display: block;
                padding: 10px 12px;
                background: rgba(100, 100, 100, 0.2);
                border: 1px solid #666;
                color: #ccc;
                border-radius: 6px;
                font-size: 13px;
                cursor: pointer;
            }
            .search-input {
                grid-column: 1 / -1;
                width: 100%;
                padding: 10px 12px;
                font-size: 13px;
                box-sizing: border-box;
            }
            .desktop-sort { display: none; }
            .content { grid-template-columns: 1fr; }
            .sidebar {
                position: fixed;
                right: -100%;
                top: 0;
                width: 85%;
                max-width: 300px;
                height: 100vh;
                background: #1a1f2e;
                border-left: 2px solid #0066cc;
                z-index: 1001;
                padding: 16px;
                overflow-y: auto;
                transition: right 0.3s ease;
                border-radius: 0;
            }
            .sidebar.active { right: 0; }
            .products { grid-template-columns: 1fr; gap: 12px; }
            .product-image { aspect-ratio: 0.5 / 1; height: 160px; margin: 0; border-radius: 8px 0 0 8px; }
        }
        
        @media (max-width: 480px) {
            .top-controls { gap: 6px; }
            .products { grid-template-columns: 1fr; gap: 10px; }
            .sidebar { width: 90%; }
            .product-image { aspect-ratio: 0.5 / 1; height: 160px; margin: 0; border-radius: 8px 0 0 8px; }
        }
    </style>
</head>
<body>
    <div class="cpu-filters-wrapper">
        <div class="filters-overlay" id="filtersOverlay"></div>
    </div>

    <div class="main-wrapper">
        <div class="top-bar">
            <div style="display: flex; align-items: center; gap: 20px;">
                <a href="/configurator" class="back-link">← Înapoi</a>
                <div class="title">Selectează CPU</div>
            </div>
            <div class="top-controls">
                <div class="mobile-controls">
                    <button class="filter-btn" id="filterToggleBtn">
                        <span class="icon">☰</span> Filter
                    </button>
                    <select class="sort-select mobile-sort" id="sortBy">
                        <option value="">↑↓ Sort</option>
                        <option value="cores-desc">Cores (↓)</option>
                        <option value="cores-asc">Cores (↑)</option>
                        <option value="name">Name A-Z</option>
                        <option value="price-asc">Price (↑)</option>
                        <option value="price-desc">Price (↓)</option>
                    </select>
                </div>
                <input type="text" class="search-input" id="search" placeholder="🔍 Search" />
            </div>
        </div>

        <div class="content">
            <div class="sidebar">
                <div class="filter-group">
                    <div class="filter-title">Category</div>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="cat-gaming" value="gaming" class="category-filter" checked>
                            <label for="cat-gaming">🎮 Gaming</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="cat-office" value="office" class="category-filter" checked>
                            <label for="cat-office">💼 Productivity</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="cat-all" value="all" class="category-filter" checked>
                            <label for="cat-all">📊 All CPUs</label>
                        </div>
                    </div>
                </div>

                <div class="filter-group">
                    <div class="filter-title">Price</div>
                    <div class="slider-labels">
                        <span>$22.99</span>
                        <span>$4782.99</span>
                    </div>
                </div>

                <div class="filter-group">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <div class="filter-title" style="margin: 0;">Socket</div>
                        <button id="expandSocketBtn" class="expand-btn" onclick="toggleSocketExpand()">+ More</button>
                    </div>
                    
                    <div class="checkbox-group" id="mainSockets">
                        <div class="checkbox-item">
                            <input type="checkbox" id="socket-am5" value="AM5" class="socket-filter">
                            <label for="socket-am5">AM5</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="socket-am4" value="AM4" class="socket-filter">
                            <label for="socket-am4">AM4</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="socket-lga1700" value="LGA1700" class="socket-filter">
                            <label for="socket-lga1700">LGA1700</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="socket-lga1200" value="LGA1200" class="socket-filter">
                            <label for="socket-lga1200">LGA1200</label>
                        </div>
                    </div>
                    
                    <div class="checkbox-group" id="moreSockets" style="display: none; margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(255,255,255,0.1);">
                        <?php 
                        $mainSockets = ['AM5', 'AM4', 'LGA1700', 'LGA1200'];
                        $otherSockets = array_filter(array_unique(array_column($cpuDatabase, 'socket')), 
                                                      fn($s) => !in_array($s, $mainSockets));
                        sort($otherSockets);
                        ?>
                        <?php foreach ($otherSockets as $socket): ?>
                        <div class="checkbox-item">
                            <input type="checkbox" id="socket-<?php echo strtolower(str_replace(' ', '-', $socket)); ?>" 
                                   value="<?php echo $socket; ?>" class="socket-filter">
                            <label for="socket-<?php echo strtolower(str_replace(' ', '-', $socket)); ?>">
                                <?php echo $socket; ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="filter-group">
                    <div class="filter-title">Core Count</div>
                    <div class="slider-labels">
                        <span id="coreMinValue"><?php echo $minCores; ?></span>
                        <span>-</span>
                        <span id="coreMaxValue"><?php echo $maxCores; ?></span>
                    </div>
                    <div class="range-slider-container">
                        <input type="range" min="<?php echo $minCores; ?>" max="<?php echo $maxCores; ?>" 
                               value="<?php echo $minCores; ?>" class="range-slider" id="coreMin">
                        <input type="range" min="<?php echo $minCores; ?>" max="<?php echo $maxCores; ?>" 
                               value="<?php echo $maxCores; ?>" class="range-slider" id="coreMax">
                    </div>
                </div>

                <div class="filter-group">
                    <div class="filter-title">TDP</div>
                    <div class="slider-labels">
                        <span id="tdpMinValue"><?php echo $minTdp; ?></span>
                        <span>-</span>
                        <span id="tdpMaxValue"><?php echo $maxTdp; ?></span>
                    </div>
                    <div class="range-slider-container">
                        <input type="range" min="<?php echo $minTdp; ?>" max="<?php echo $maxTdp; ?>" 
                               value="<?php echo $minTdp; ?>" class="range-slider" id="tdpMin">
                        <input type="range" min="<?php echo $minTdp; ?>" max="<?php echo $maxTdp; ?>" 
                               value="<?php echo $maxTdp; ?>" class="range-slider" id="tdpMax">
                    </div>
                </div>

                <div class="filter-group">
                    <div class="filter-title">Manufacturer</div>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="mfg-intel" value="intel" class="mfg-filter" checked>
                            <label for="mfg-intel">Intel</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" id="mfg-amd" value="amd" class="mfg-filter" checked>
                            <label for="mfg-amd">AMD</label>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <!-- INTEL SECTION -->
                <div class="section-title">Intel (<?php echo count($intelCpus); ?>)</div>
                <div class="products intel-grid" id="intelProducts">
                    <?php foreach ($intelCpus as $cpu): ?>
                    <div class="product-card" 
                    <?php 
    $price = getCpuPrice($cpu['name']);
    echo 'data-price="' . $price . '"';
?>
                         data-cpu="<?php echo htmlspecialchars($cpu['name']); ?>"
                         data-cores="<?php echo $cpu['cores']; ?>"
                         data-tdp="<?php echo $cpu['tdp']; ?>"
                         data-socket="<?php echo $cpu['socket']; ?>"
                        data-price="<?php echo getCpuPrice($cpu['name']); ?>"
       
                        data-mfg="intel"
                         data-featured="<?php echo $cpu['featured_gaming'] ? 'gaming' : ($cpu['featured_office'] ? 'office' : 'none'); ?>"
                         class="<?php echo $cpu['featured_gaming'] ? 'featured-gaming' : ($cpu['featured_office'] ? 'featured-office' : ''); ?>">
                        
                        <?php if ($cpu['featured_gaming'] || $cpu['featured_office']): ?>
                        <div class="featured-badge <?php echo $cpu['featured_gaming'] ? 'gaming' : 'office'; ?>">
                            <?php echo $cpu['featured_gaming'] ? '🎮 GAMING BEAST' : '💼 PRODUCTIVITY'; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="product-image">
                            <?php $imagePath = getCpuImagePath($cpu['name'], $cpu['manufacturer']); ?>
                            <img src="<?php echo $imagePath; ?>" 
                                 alt="<?php echo htmlspecialchars($cpu['name']); ?>" 
                                 loading="lazy"
                                 style="width: 100%; height: 100%; object-fit: contain; border-radius: 8px;">
                        </div>

                        <div class="product-info">
                            <div class="product-name"><?php echo $cpu['name']; ?></div>
                            
                            <?php if ($cpu['featured_gaming']): ?>
                            
                            <?php elseif ($cpu['featured_office']): ?>
                                
                            <?php endif; ?>
                            
                            <div class="spec-row">
                                <span class="spec-label">Socket</span>
                                <span class="spec-value"><?php echo $cpu['socket']; ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Cores</span>
                                <span class="spec-value"><?php echo $cpu['cores']; ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Boost</span>
                                <span class="spec-value"><?php echo $cpu['boost_freq']; ?> GHz</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">TDP</span>
                                <span class="spec-value"><?php echo $cpu['tdp']; ?>W</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Price</span>
                                 <span class="spec-value" style="color: #F59E0B; font-weight: 700;">
        <?php 
            $p = getCpuPrice($cpu['name']);
            echo $p > 0 ? number_format($p, 0, '', '.') . ' LEI' : 'N/A';
        ?>
    </span>
                            </div>
                            <button class="add-btn" onclick="selectCpu('<?php echo htmlspecialchars($cpu['name']); ?>')">+ Add to build</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- AMD SECTION -->
                <div class="section-title">AMD (<?php echo count($amdCpus); ?>)</div>
                <div class="products amd-grid" id="amdProducts">
                    <?php foreach ($amdCpus as $cpu): ?>
                    <div class="product-card" 
                         data-cpu="<?php echo htmlspecialchars($cpu['name']); ?>"
                         data-cores="<?php echo $cpu['cores']; ?>"
                         data-tdp="<?php echo $cpu['tdp']; ?>"
                         data-socket="<?php echo $cpu['socket']; ?>"
                         data-price="<?php echo getCpuPrice($cpu['name']); ?>"
               
                         data-mfg="amd"
                         data-featured="<?php echo $cpu['featured_gaming'] ? 'gaming' : ($cpu['featured_office'] ? 'office' : 'none'); ?>"
                         class="<?php echo $cpu['featured_gaming'] ? 'featured-gaming' : ($cpu['featured_office'] ? 'featured-office' : ''); ?>">
                        
                        <?php if ($cpu['featured_gaming'] || $cpu['featured_office']): ?>
                        <div class="featured-badge <?php echo $cpu['featured_gaming'] ? 'gaming' : 'office'; ?>">
                            <?php echo $cpu['featured_gaming'] ? '🎮 GAMING BEAST' : '💼 PRODUCTIVITY'; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="product-image">
                            <?php $imagePath = getCpuImagePath($cpu['name'], $cpu['manufacturer']); ?>
                            <img src="<?php echo $imagePath; ?>" 
                                 alt="<?php echo htmlspecialchars($cpu['name']); ?>" 
                                 loading="lazy"
                                 style="width: 100%; height: 100%; object-fit: contain; border-radius: 8px;">
                        </div>

                        <div class="product-info">
                            <div class="product-name"><?php echo $cpu['name']; ?></div>
                            
                            <?php if ($cpu['featured_gaming']): ?>
                               
                            <?php elseif ($cpu['featured_office']): ?>

                            <?php endif; ?>
                            
                            <div class="spec-row">
                                <span class="spec-label">Socket</span>
                                <span class="spec-value"><?php echo $cpu['socket']; ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Cores</span>
                                <span class="spec-value"><?php echo $cpu['cores']; ?></span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Boost</span>
                                <span class="spec-value"><?php echo $cpu['boost_freq']; ?> GHz</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">TDP</span>
                                <span class="spec-value"><?php echo $cpu['tdp']; ?>W</span>
                            </div>
                            <div class="spec-row">
                                <span class="spec-label">Price</span>
                                <span class="spec-value" style="color: #F59E0B; font-weight: 700;">
        <?php 
            $p = getCpuPrice($cpu['name']);
            echo $p > 0 ? number_format($p, 0, '', '.') . ' LEI' : 'N/A';
        ?>
    </span>
                            </div>
                            <button class="add-btn amd" onclick="selectCpu('<?php echo htmlspecialchars($cpu['name']); ?>')">+ Add to build</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ELEMENT REFERENCES
        const searchInput = document.getElementById('search');
        const sortSelect = document.getElementById('sortBy');
        const coreMin = document.getElementById('coreMin');
        const coreMax = document.getElementById('coreMax');
        const coreMinValue = document.getElementById('coreMinValue');
        const coreMaxValue = document.getElementById('coreMaxValue');
        const tdpMin = document.getElementById('tdpMin');
        const tdpMax = document.getElementById('tdpMax');
        const tdpMinValue = document.getElementById('tdpMinValue');
        const tdpMaxValue = document.getElementById('tdpMaxValue');
        const socketFilters = document.querySelectorAll('.socket-filter');
        const mfgFilters = document.querySelectorAll('.mfg-filter');
        const allCards = document.querySelectorAll('.product-card');

        function updateDisplay() {
            const query = searchInput.value.toLowerCase();
            const minCores = parseInt(coreMin.value);
            const maxCores = parseInt(coreMax.value);
            const minTdp = parseInt(tdpMin.value);
            const maxTdp = parseInt(tdpMax.value);
            const selectedSockets = Array.from(socketFilters).filter(c => c.checked).map(c => c.value);
            const selectedMfg = Array.from(mfgFilters).filter(c => c.checked).map(c => c.value);
            const selectedCategories = Array.from(document.querySelectorAll('.category-filter')).filter(c => c.checked).map(c => c.value);

            allCards.forEach(card => {
                const name = card.dataset.cpu.toLowerCase();
                const cores = parseInt(card.dataset.cores);
                const tdp = parseInt(card.dataset.tdp);
                const socket = card.dataset.socket;
                const mfg = card.dataset.mfg;
                const featured = card.dataset.featured;

                const matchSearch = name.includes(query);
                const matchCores = cores >= minCores && cores <= maxCores;
                const matchTdp = tdp >= minTdp && tdp <= maxTdp;
                const matchSocket = selectedSockets.length === 0 || selectedSockets.includes(socket);
                const matchMfg = selectedMfg.includes(mfg);

                let matchCategory = true;
                if (selectedCategories.length === 0) {
                    matchCategory = false;
                } else if (selectedCategories.includes('all')) {
                    matchCategory = true;
                } else {
                    if (selectedCategories.includes('gaming') && featured === 'gaming') matchCategory = true;
                    if (selectedCategories.includes('office') && featured === 'office') matchCategory = true;
                    if (selectedCategories.includes('gaming') && featured === 'none') matchCategory = false;
                    if (selectedCategories.includes('office') && featured === 'none') matchCategory = false;
                }

                card.style.display = (matchSearch && matchCores && matchTdp && matchSocket && matchMfg && matchCategory) ? 'block' : 'none';
            });
        }

        function updateCoreSlider() {
            let min = parseInt(coreMin.value);
            let max = parseInt(coreMax.value);
            if (min > max) [min, max] = [max, min];
            coreMin.value = min;
            coreMax.value = max;
            coreMinValue.textContent = min;
            coreMaxValue.textContent = max;
            updateDisplay();
        }

        function updateTdpSlider() {
            let min = parseInt(tdpMin.value);
            let max = parseInt(tdpMax.value);
            if (min > max) [min, max] = [max, min];
            tdpMin.value = min;
            tdpMax.value = max;
            tdpMinValue.textContent = min;
            tdpMaxValue.textContent = max + 'W';
            updateDisplay();
        }
        
        function selectCpu(cpuName) {
            const urlParams = new URLSearchParams(window.location.search);
            const card = document.querySelector(`[data-cpu="${cpuName}"]`);
            
            if (!card) {
                console.error('CPU card not found');
                return;
            }
            
            const tdp = card.dataset.tdp;
            const socket = card.dataset.socket;
            const price = card.dataset.price || 0;
            
            const newParams = new URLSearchParams(urlParams);
            newParams.set('cpu', encodeURIComponent(cpuName));
            newParams.set('cpu_tdp', tdp);
            newParams.set('cpu_socket', socket);
            newParams.set('cpuprice', price);
            
            window.location.href = '<?php echo home_url('/configurator/'); ?>?' + newParams.toString();
        }

        function toggleSocketExpand() {
            const moreSockets = document.getElementById('moreSockets');
            const expandBtn = document.getElementById('expandSocketBtn');
            if (moreSockets.style.display === 'none') {
                moreSockets.style.display = 'block';
                expandBtn.textContent = '- Less';
                expandBtn.classList.add('expanded');
            } else {
                moreSockets.style.display = 'none';
                expandBtn.textContent = '+ More';
                expandBtn.classList.remove('expanded');
            }
        }

        // EVENT LISTENERS
        searchInput.addEventListener('input', updateDisplay);
        sortSelect.addEventListener('change', updateDisplay);
        coreMin.addEventListener('input', updateCoreSlider);
        coreMax.addEventListener('input', updateCoreSlider);
        tdpMin.addEventListener('input', updateTdpSlider);
        tdpMax.addEventListener('input', updateTdpSlider);

        const categoryFilters = document.querySelectorAll('.category-filter');
        categoryFilters.forEach(filter => filter.addEventListener('change', updateDisplay));
        socketFilters.forEach(filter => filter.addEventListener('change', updateDisplay));
        mfgFilters.forEach(filter => filter.addEventListener('change', updateDisplay));

        const filterToggle = document.getElementById('filterToggleBtn');
        const filtersOverlay = document.getElementById('filtersOverlay');
        const sidebar = document.querySelector('.sidebar');

        filterToggle?.addEventListener('click', () => {
            sidebar.classList.add('active');
            filtersOverlay.classList.add('active');
        });

        filtersOverlay?.addEventListener('click', () => {
            sidebar.classList.remove('active');
            filtersOverlay.classList.remove('active');
        });
    </script>
</body>
</html>

<?php debugCpuPrices(); ?>
<?php get_footer(); ?>
