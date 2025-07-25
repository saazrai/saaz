<?php

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

test('password policy enforces 12 character minimum', function () {
    $validator = Validator::make(['password' => 'Short1!'], [
        'password' => ['required', Password::defaults()],
    ]);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('password'))->toContain('at least 12 characters');
});

test('password policy requires mixed case', function () {
    $validator = Validator::make(['password' => 'alllowercase123!'], [
        'password' => ['required', Password::defaults()],
    ]);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('password'))->toContain('uppercase and one lowercase');
});

test('password policy requires numbers', function () {
    $validator = Validator::make(['password' => 'NoNumbersHere!'], [
        'password' => ['required', Password::defaults()],
    ]);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('password'))->toContain('at least one number');
});

test('password policy requires symbols', function () {
    $validator = Validator::make(['password' => 'NoSymbolsHere123'], [
        'password' => ['required', Password::defaults()],
    ]);

    expect($validator->fails())->toBeTrue();
    expect($validator->errors()->first('password'))->toContain('at least one symbol');
});

test('password policy accepts strong passwords', function () {
    $strongPasswords = [
        'MyS3cur3P@ssw0rd!',
        'C0mpl3x#Passw0rd',
        'Str0ng!P@ssw0rd123',
        'S3cur3P@ss!123',
    ];

    foreach ($strongPasswords as $password) {
        $validator = Validator::make(['password' => $password], [
            'password' => ['required', Password::defaults()],
        ]);

        expect($validator->passes())->toBeTrue("Password '{$password}' should be valid");
    }
});

test('password policy matches frontend requirements', function () {
    // Test exactly 12 characters with all complexity requirements
    $minCompliantPassword = 'MyS3cur3P@1!'; // 12 chars: mixed case, numbers, symbols

    $validator = Validator::make(['password' => $minCompliantPassword], [
        'password' => ['required', Password::defaults()],
    ]);

    expect($validator->passes())->toBeTrue('Minimum compliant password should pass');
});
