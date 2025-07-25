#!/bin/bash

# Run all domain seeders
for i in {3..20}; do
    seeder=$(ls database/seeders/Diagnostics/D${i}*.php 2>/dev/null | head -1)
    if [ -f "$seeder" ]; then
        className=$(basename "$seeder" .php)
        echo "Running $className..."
        php artisan db:seed --class="Database\\Seeders\\Diagnostics\\$className"
    fi
done

echo "All seeders completed!"