<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Carbon\Carbon;

class LogController extends Controller
{
    /**
     * Display log files and their contents
     */
    public function index(Request $request)
    {
        $this->authorize('view system logs');
        
        $logPath = storage_path('logs');
        $selectedFile = $request->get('file', 'security.log');
        $selectedDate = $request->get('date');
        $datePreset = $request->get('date_preset');
        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        
        // Get available log files
        $logFiles = $this->getLogFiles($logPath);
        
        // Get log entries for selected file with date filtering
        $logEntries = $this->getLogEntries($logPath, $selectedFile, $selectedDate, $dateFrom, $dateTo);
        
        return Inertia::render('Admin/System/Logs/Index', [
            'logFiles' => $logFiles,
            'selectedFile' => $selectedFile,
            'selectedDate' => $selectedDate,
            'entries' => $logEntries,
            'filters' => $request->only(['file', 'date', 'date_preset', 'date_from', 'date_to', 'level']),
        ]);
    }
    
    /**
     * Get list of available log files
     */
    private function getLogFiles(string $logPath): array
    {
        $files = [];
        
        if (!File::exists($logPath)) {
            return $files;
        }
        
        $logFiles = File::files($logPath);
        
        foreach ($logFiles as $file) {
            if (str_ends_with($file->getFilename(), '.log')) {
                $files[] = [
                    'name' => $file->getFilename(),
                    'size' => $this->formatBytes($file->getSize()),
                    'modified' => Carbon::createFromTimestamp($file->getMTime())->format('Y-m-d H:i:s'),
                ];
            }
        }
        
        // Sort by name
        usort($files, fn($a, $b) => strcmp($a['name'], $b['name']));
        
        return $files;
    }
    
    /**
     * Get log entries from file
     */
    private function getLogEntries(string $logPath, string $filename, ?string $date = null, ?string $dateFrom = null, ?string $dateTo = null): array
    {
        $entries = [];
        $filePath = $logPath . DIRECTORY_SEPARATOR . $filename;
        
        // For dated logs, adjust filename
        if ($date && !str_contains($filename, $date)) {
            $baseName = str_replace('.log', '', $filename);
            $filePath = $logPath . DIRECTORY_SEPARATOR . $baseName . '-' . $date . '.log';
        }
        
        if (!File::exists($filePath)) {
            return $entries;
        }
        
        try {
            $content = File::get($filePath);
            $lines = explode("\n", $content);
            
            // Parse log entries (Laravel format)
            $currentEntry = null;
            
            foreach ($lines as $line) {
                if (empty(trim($line))) continue;
                
                // Check if line starts with timestamp (new log entry)
                if (preg_match('/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\]/', $line, $matches)) {
                    // Save previous entry
                    if ($currentEntry) {
                        $entries[] = $currentEntry;
                    }
                    
                    // Parse new entry
                    $currentEntry = $this->parseLogLine($line);
                } else {
                    // Continuation of previous entry
                    if ($currentEntry) {
                        $currentEntry['message'] .= "\n" . $line;
                    }
                }
            }
            
            // Add last entry
            if ($currentEntry) {
                $entries[] = $currentEntry;
            }
            
            // Apply date range filtering if specified
            if ($dateFrom || $dateTo) {
                $entries = array_filter($entries, function ($entry) use ($dateFrom, $dateTo) {
                    $entryDate = substr($entry['timestamp'], 0, 10); // Extract YYYY-MM-DD
                    
                    if ($dateFrom && $entryDate < $dateFrom) {
                        return false;
                    }
                    
                    if ($dateTo && $entryDate > $dateTo) {
                        return false;
                    }
                    
                    return true;
                });
            }
            
            // Reverse to show newest first
            $entries = array_reverse($entries);
            
            // Limit to 100 most recent entries for performance
            return array_slice($entries, 0, 100);
            
        } catch (\Exception $e) {
            return [];
        }
    }
    
    /**
     * Parse individual log line
     */
    private function parseLogLine(string $line): array
    {
        // Laravel log format: [timestamp] environment.LEVEL: message context
        $pattern = '/^\[(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})\] (\w+)\.(\w+): (.+)$/';
        
        if (preg_match($pattern, $line, $matches)) {
            $message = $matches[4];
            $context = [];
            
            // Try to extract JSON context if exists
            if (preg_match('/^(.+?) (\{.+\})$/', $message, $contextMatches)) {
                $message = $contextMatches[1];
                try {
                    $context = json_decode($contextMatches[2], true) ?? [];
                } catch (\Exception $e) {
                    // Keep original message if JSON parsing fails
                }
            }
            
            return [
                'timestamp' => $matches[1],
                'environment' => $matches[2],
                'level' => $matches[3],
                'message' => trim($message),
                'context' => $context,
                'raw' => $line,
            ];
        }
        
        // Fallback for non-standard format
        return [
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'environment' => 'unknown',
            'level' => 'info',
            'message' => $line,
            'context' => [],
            'raw' => $line,
        ];
    }
    
    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, $precision) . ' ' . $units[$i];
    }
}
