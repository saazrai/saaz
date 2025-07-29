<?php

use App\Models\QuestionType;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can create question type with required fields', function () {
    $questionType = QuestionType::create([
        'name' => 'Multiple Choice',
        'code' => 'MC',
        'description' => 'Multiple choice questions with single correct answer',
        'is_active' => true,
    ]);

    expect($questionType)
        ->name->toBe('Multiple Choice')
        ->code->toBe('MC')
        ->description->toBe('Multiple choice questions with single correct answer')
        ->is_active->toBeTrue();
});

test('question type fillable fields are correct', function () {
    $questionType = new QuestionType;

    expect($questionType->getFillable())->toBe([
        'name',
        'code',
        'description',
        'is_active',
    ]);
});

test('question type extends base model', function () {
    $questionType = new QuestionType;

    expect($questionType)->toBeInstanceOf(\App\Models\BaseModel::class);
});

test('can filter active question types', function () {
    QuestionType::create([
        'name' => 'Active Type',
        'code' => 'AT',
        'description' => 'Active question type',
        'is_active' => true,
    ]);

    QuestionType::create([
        'name' => 'Inactive Type',
        'code' => 'IT',
        'description' => 'Inactive question type',
        'is_active' => false,
    ]);

    $activeTypes = QuestionType::active()->get();

    expect($activeTypes)->toHaveCount(1);
    expect($activeTypes->first()->name)->toBe('Active Type');
});

test('can order question types by created_at desc by default', function () {
    $firstType = QuestionType::create([
        'name' => 'First Type',
        'code' => 'FT',
        'description' => 'First question type',
        'is_active' => true,
    ]);

    // Add a small delay to ensure different timestamps
    sleep(1);

    $secondType = QuestionType::create([
        'name' => 'Second Type',
        'code' => 'ST',
        'description' => 'Second question type',
        'is_active' => true,
    ]);

    $orderedTypes = QuestionType::ordered()->get();

    // Since BaseModel orders by created_at desc, the second (newer) should be first
    expect($orderedTypes->first()->id)->toBe($secondType->id);
    expect($orderedTypes->last()->id)->toBe($firstType->id);
});

test('safe update only updates fillable attributes', function () {
    $questionType = QuestionType::create([
        'name' => 'Original Name',
        'code' => 'ON',
        'description' => 'Original description',
        'is_active' => true,
    ]);

    $result = $questionType->safeUpdate([
        'name' => 'Updated Name',
        'code' => 'UN',
        'id' => 999, // This should be ignored (not fillable)
        'created_at' => now()->addDay(), // This should be ignored (not fillable)
    ]);

    expect($result)->toBeTrue();
    expect($questionType->fresh())
        ->name->toBe('Updated Name')
        ->code->toBe('UN')
        ->id->not->toBe(999) // Should remain original
        ->created_at->not->toEqual(now()->addDay()); // Should remain original
});

test('is fillable method works correctly', function () {
    $questionType = new QuestionType;

    expect($questionType->isFillable('name'))->toBeTrue();
    expect($questionType->isFillable('code'))->toBeTrue();
    expect($questionType->isFillable('description'))->toBeTrue();
    expect($questionType->isFillable('is_active'))->toBeTrue();
    
    expect($questionType->isFillable('id'))->toBeFalse();
    expect($questionType->isFillable('created_at'))->toBeFalse();
    expect($questionType->isFillable('updated_at'))->toBeFalse();
});

test('to array method hides sensitive fields automatically', function () {
    $questionType = QuestionType::create([
        'name' => 'Test Type',
        'code' => 'TT',
        'description' => 'Test description',
        'is_active' => true,
    ]);

    $array = $questionType->toArray();

    // Should not contain any sensitive fields (though this model doesn't have many)
    expect($array)->not->toHaveKey('password');
    expect($array)->not->toHaveKey('api_key');
    expect($array)->not->toHaveKey('secret_key');
    
    // Should contain the expected fields
    expect($array)->toHaveKey('name');
    expect($array)->toHaveKey('code');
    expect($array)->toHaveKey('description');
    expect($array)->toHaveKey('is_active');
});