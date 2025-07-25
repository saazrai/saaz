<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DiagnosticHelp extends Command
{
    protected $signature = 'diagnostic:help';

    protected $description = 'Show help for all diagnostic commands';

    public function handle()
    {
        $this->info('DIAGNOSTIC ANALYSIS COMMANDS');
        $this->line('A suite of commands to analyze diagnostic assessments and understand adaptive testing behavior.');

        $this->newLine();
        $this->info('AVAILABLE COMMANDS:');

        $commands = [
            [
                'command' => 'diagnostic:list',
                'description' => 'List recent diagnostics with basic statistics',
            ],
            [
                'command' => 'diagnostic:list --topics',
                'description' => 'Show topics and question counts by domain',
            ],
            [
                'command' => 'diagnostic:topics',
                'description' => 'Show topics and question counts (dedicated command)',
            ],
            [
                'command' => 'diagnostic:pool',
                'description' => 'Show question pool statistics by domain and bloom level',
            ],
            [
                'command' => 'diagnostic:summary <id>',
                'description' => 'Get a detailed summary of why a diagnostic took many questions',
            ],
            [
                'command' => 'diagnostic:analyze <id>',
                'description' => 'Advanced analysis with bloom level progression (if configured)',
            ],
            [
                'command' => 'diagnostic:help',
                'description' => 'Show this help message',
            ],
        ];

        foreach ($commands as $cmd) {
            $this->line(sprintf('  %-25s %s', $cmd['command'], $cmd['description']));
        }

        $this->newLine();
        $this->info('COMMON USAGE:');

        $this->newLine();
        $this->line('1. First, list all diagnostics to find the ID you want to analyze:');
        $this->line('   php artisan diagnostic:list');

        $this->newLine();
        $this->line('2. Then analyze a specific diagnostic (e.g., ID 1):');
        $this->line('   php artisan diagnostic:summary 1');

        $this->newLine();
        $this->line('3. For help on any specific command:');
        $this->line('   php artisan diagnostic:list --help');
        $this->line('   php artisan diagnostic:summary --help');

        $this->newLine();
        $this->info('UNDERSTANDING THE RESULTS:');

        $this->newLine();
        $this->line('• Confidence %: How confident the system is in its assessment of knowledge level');
        $this->line('• Completion %: Progress through the estimated total questions needed');
        $this->line('• Accuracy %: Percentage of correct answers');
        $this->line('• Question Count: Total questions answered (max is typically 100)');

        $this->newLine();
        $this->info('WHY ASSESSMENTS TAKE MANY QUESTIONS:');

        $this->newLine();
        $this->line('• Mixed performance (40-70% accuracy) prevents early termination');
        $this->line('• High variance in accuracy between question chunks');
        $this->line('• Multiple domains being tested require minimum coverage');
        $this->line('• Consecutive incorrect answers trigger difficulty recalibration');
        $this->line('• Multi-phase assessments require minimum questions per phase');

        $this->newLine();
        $this->info('TIPS:');
        $this->line('• Diagnostics with >80 questions may indicate algorithm issues');
        $this->line('• Stable performance (consistent accuracy) leads to faster completion');
        $this->line('• Focus on specific domains to reduce assessment length');

        return 0;
    }
}
