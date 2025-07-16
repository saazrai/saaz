#!/bin/bash

echo "Fixing unused variables..."

# Fix unused '_' in destructuring patterns
find resources/js/components/shadcn -name "*.vue" -type f | while read -r file; do
    # Replace ({ _, ... }) patterns with ({ ...rest })
    sed -i '' 's/const { \(class: [^,]*\), \.\.\.\([^}]*\) } = /const { \1, ...\2 } = /g' "$file"
    # Replace (_, other) patterns
    sed -i '' 's/(\s*_,/(/g' "$file"
    # Replace ({ _, other }) patterns  
    sed -i '' 's/{ _,/{ /g' "$file"
done

# Fix specific issues in components
# Dropdown.vue - remove widthClass
sed -i '' '/const widthClass = /d' resources/js/components/Dropdown.vue

# Type5.vue - fix unused index in v-for
sed -i '' 's/v-for="(option, index) in availableOptions"/v-for="option in availableOptions"/g' resources/js/components/QuizTypes/Type5.vue

# Type5Review.vue - remove unused shuffle import
sed -i '' "s/import { shuffle } from 'lodash';//g" resources/js/components/QuizTypes/Type5Review.vue

# Fix useTheme.js - remove unused import
sed -i '' "s/, initializeTheme//g" resources/js/composables/useTheme.js

# Fix AdminLayout unused variables
sed -i '' 's/, ChevronRight } from/, } from/g' resources/js/layouts/AdminLayout.vue

echo "Fixed common unused variable issues"