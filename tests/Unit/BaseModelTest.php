<?php

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

// Create a test model for testing BaseModel functionality
class TestModel extends BaseModel
{
    protected $table = 'test_models';
    
    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'sort_order',
        'status',
    ];
}

// Mock the test_models table schema for testing
beforeEach(function () {
    Schema::create('test_models', function ($table) {
        $table->id();
        $table->string('name');
        $table->string('slug')->nullable();
        $table->boolean('is_active')->default(true);
        $table->integer('sort_order')->nullable();
        $table->enum('status', ['active', 'inactive'])->default('active');
        $table->string('password')->nullable(); // For testing hidden attributes
        $table->string('api_key')->nullable(); // For testing toArray() filtering
        $table->timestamps();
    });
});

afterEach(function () {
    Schema::dropIfExists('test_models');
});

test('base model has correct guarded attributes', function () {
    $model = new TestModel;

    expect($model->getGuarded())->toBe(['id', 'created_at', 'updated_at']);
});

test('base model has correct hidden attributes', function () {
    $model = new TestModel;

    expect($model->getHidden())->toContain('password');
    expect($model->getHidden())->toContain('remember_token');
    expect($model->getHidden())->toContain('two_factor_secret');
    expect($model->getHidden())->toContain('two_factor_recovery_codes');
});

test('base model has correct default casts', function () {
    $model = new TestModel;

    expect($model->getCasts())->toHaveKey('created_at');
    expect($model->getCasts())->toHaveKey('updated_at');
    expect($model->getCasts()['created_at'])->toBe('datetime');
    expect($model->getCasts()['updated_at'])->toBe('datetime');
});

test('get route key name returns slug if available', function () {
    $model = new TestModel;
    
    expect($model->getRouteKeyName())->toBe('slug');
});

test('get route key name returns default if no slug', function () {  
    $model = new class extends BaseModel {
        protected $fillable = ['name'];
    };
    
    expect($model->getRouteKeyName())->toBe('id');
});

test('active scope filters by is_active column', function () {
    $activeModel = TestModel::create([
        'name' => 'Active Model',
        'is_active' => true,
    ]);

    $inactiveModel = TestModel::create([
        'name' => 'Inactive Model',
        'is_active' => false,
    ]);

    $activeModels = TestModel::active()->get();

    expect($activeModels)->toHaveCount(1);
    expect($activeModels->first()->id)->toBe($activeModel->id);
});

test('active scope filters by status column when available', function () {
    $model = new class extends BaseModel {
        protected $table = 'test_models';
        protected $fillable = ['name', 'status'];
    };

    $activeModel = $model::create([
        'name' => 'Active Model',
        'status' => 'active',
    ]);

    $inactiveModel = $model::create([
        'name' => 'Inactive Model', 
        'status' => 'inactive',
    ]);

    $activeModels = $model::active()->get();

    expect($activeModels)->toHaveCount(1);
    expect($activeModels->first()->id)->toBe($activeModel->id);
});

test('ordered scope orders by sort_order if available', function () {
    $secondModel = TestModel::create([
        'name' => 'Second Model',
        'sort_order' => 2,
    ]);

    $firstModel = TestModel::create([
        'name' => 'First Model',
        'sort_order' => 1,
    ]);

    $orderedModels = TestModel::ordered()->get();

    expect($orderedModels->first()->id)->toBe($firstModel->id);
    expect($orderedModels->last()->id)->toBe($secondModel->id);
});

test('ordered scope falls back to created_at desc when no order column', function () {
    $model = new class extends BaseModel {
        protected $table = 'test_models';
        protected $fillable = ['name'];
    };

    $firstModel = $model::create(['name' => 'First Model']);
    // Add a small delay to ensure different timestamps
    sleep(1);
    $secondModel = $model::create(['name' => 'Second Model']);

    $orderedModels = $model::ordered()->get();

    expect($orderedModels->first()->id)->toBe($secondModel->id);
    expect($orderedModels->last()->id)->toBe($firstModel->id);
});

test('to array removes sensitive fields automatically', function () {
    $model = TestModel::create([
        'name' => 'Test Model',
        'password' => 'secret123',
        'api_key' => 'api_secret_key',
    ]);

    $array = $model->toArray();

    expect($array)->not->toHaveKey('password');
    expect($array)->not->toHaveKey('api_key');
    expect($array)->not->toHaveKey('api_secret');
    expect($array)->not->toHaveKey('secret_key');
    expect($array)->not->toHaveKey('private_key');
    expect($array)->not->toHaveKey('access_token');
    expect($array)->not->toHaveKey('refresh_token');
    expect($array)->not->toHaveKey('webhook_secret');
    expect($array)->not->toHaveKey('encryption_key');
    expect($array)->not->toHaveKey('salt');
    
    expect($array)->toHaveKey('name');
    expect($array['name'])->toBe('Test Model');
});

test('safe update only updates fillable attributes', function () {
    $model = TestModel::create([
        'name' => 'Original Name',
        'is_active' => 1, // Use 1 instead of true for consistent casting
    ]);

    $result = $model->safeUpdate([
        'name' => 'Updated Name',
        'is_active' => 0, // Use 0 instead of false for consistent casting
        'id' => 999, // Not fillable, should be ignored
        'created_at' => now()->addDay(), // Not fillable, should be ignored
        'non_existent_field' => 'value', // Not fillable, should be ignored
    ]);

    expect($result)->toBeTrue();
    
    $model->refresh();
    expect($model->name)->toBe('Updated Name');
    expect($model->is_active)->toBe(0); // Check against 0 instead of false
    expect($model->id)->not->toBe(999);
});

test('is fillable method correctly identifies fillable attributes', function () {
    $model = new TestModel;

    expect($model->isFillable('name'))->toBeTrue();
    expect($model->isFillable('slug'))->toBeTrue();
    expect($model->isFillable('is_active'))->toBeTrue();
    expect($model->isFillable('sort_order'))->toBeTrue();
    expect($model->isFillable('status'))->toBeTrue();
    
    expect($model->isFillable('id'))->toBeFalse();
    expect($model->isFillable('created_at'))->toBeFalse();
    expect($model->isFillable('updated_at'))->toBeFalse();
    expect($model->isFillable('non_existent_field'))->toBeFalse();
});

test('model uses timestamps by default', function () {
    $model = new TestModel;

    expect($model->usesTimestamps())->toBeTrue();
});

test('model includes has factory trait', function () {
    $model = new TestModel;

    expect(in_array(HasFactory::class, class_uses_recursive($model)))->toBeTrue();
});