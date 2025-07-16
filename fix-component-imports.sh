#!/bin/bash

echo "Fixing incorrect component imports (Components -> components)..."

# Find all files with incorrect imports and fix them
find resources/js -type f \( -name "*.vue" -o -name "*.ts" -o -name "*.js" \) | while read -r file; do
    # Check if file contains '@/Components/'
    if grep -q '@/Components/' "$file"; then
        echo "Fixing imports in: $file"
        # Replace @/Components/ with @/components/
        sed -i '' 's|@/Components/|@/components/|g' "$file"
    fi
done

echo "Component import fixes complete!"