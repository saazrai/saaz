<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticSubtopic;
use Illuminate\Database\Seeder;

abstract class BaseDiagnosticSeeder extends Seeder
{
    protected string $domainName;
    
    abstract protected function getQuestions(): array;
    
    public function run(): void
    {
        // Clear existing items for this domain to prevent duplicates
        DiagnosticItem::whereHas('subtopic.topic.domain', function($query) {
            $query->where('name', $this->domainName);
        })->forceDelete();
        
        // Get subtopics for this domain
        $subtopics = DiagnosticSubtopic::whereHas('topic.domain', function($query) {
            $query->where('name', $this->domainName);
        })->get()->keyBy('name');
        
        $questions = $this->getQuestions();
        
        foreach ($questions as $questionData) {
            // Get subtopic ID - use either specific subtopic name or default to "Core Concepts"
            $subtopicName = $questionData['subtopic'] ?? (isset($questionData['topic']) ? $questionData['topic'] . ' - Core Concepts' : 'Core Concepts');
            $subtopicId = $subtopics[$subtopicName]->id ?? null;
            
            // If specific subtopic not found, try to find the first subtopic for this topic
            if (!$subtopicId && isset($questionData['topic'])) {
                $topicName = $questionData['topic'];
                $fallbackSubtopic = $subtopics->filter(function($subtopic, $name) use ($topicName) {
                    return str_contains($name, $topicName);
                })->first();
                
                if ($fallbackSubtopic) {
                    $subtopicId = $fallbackSubtopic->id;
                } else {
                    // Last resort: use any subtopic (first one)
                    $subtopicId = $subtopics->first()->id ?? null;
                }
            }
            
            if (!$subtopicId) {
                $this->command->warn("No subtopic found for domain '{$this->domainName}' - question skipped");
                continue;
            }
            
            // Handle different question types
            $options = $questionData['options'] ?? null;
            
            // For True/False questions (type_id = 2), generate default options if not provided
            if (($questionData['type_id'] ?? 1) == 2 && !$options) {
                $options = ['True', 'False'];
            }
            
            // Convert correct answer letter to option text if needed
            $correctOption = isset($questionData['correct_answer']) 
                ? $options[ord($questionData['correct_answer']) - ord('A')]
                : ($questionData['correct_options'][0] ?? '');
            
            // Generate justifications if not provided
            $justifications = $questionData['justifications'] ?? $this->generateDefaultJustifications(
                $options ?? [], 
                $questionData['correct_answer'] ?? 'A'
            );
            
            // Map difficulty to numeric level
            $difficultyMap = [
                'easy' => 1,
                'medium' => 3,
                'hard' => 5,
                'expert' => 6
            ];
            
            DiagnosticItem::create([
                'subtopic_id' => $subtopicId,
                'type_id' => $questionData['type_id'] ?? 1,
                'dimension' => $questionData['dimension'] ?? 'Technical',
                'content' => $questionData['question'] ?? $questionData['content'],
                'options' => $options,
                'correct_options' => isset($questionData['correct_answer']) 
                    ? [$correctOption]
                    : ($questionData['correct_options'] ?? [$correctOption]),
                'justifications' => $justifications,
                'difficulty_level' => isset($questionData['difficulty']) 
                    ? ($difficultyMap[$questionData['difficulty']] ?? 3)
                    : ($questionData['difficulty_level'] ?? 3),
                'bloom_level' => $questionData['bloom_level'] ?? 1,
                'irt_a' => $questionData['irt_a'] ?? 1.0,
                'irt_b' => $questionData['irt_b'] ?? 0.0,
                'irt_c' => $questionData['irt_c'] ?? 0.25,
                'status' => $questionData['status'] ?? 'published'
            ]);
        }
        
        $questionCount = count($questions);
        $this->command->info("{$this->domainName} questions seeded successfully! ({$questionCount} questions)");
    }
    
    /**
     * Generate default justifications for questions
     */
    protected function generateDefaultJustifications(array $options, string $correctAnswer): array
    {
        $justifications = [];
        foreach ($options as $idx => $option) {
            $isCorrect = (chr(ord('A') + $idx) === $correctAnswer);
            $justifications[] = $isCorrect ? "Correct - This is the right answer" : "Incorrect - This is not the best answer";
        }
        return $justifications;
    }
}