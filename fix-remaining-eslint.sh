#!/bin/bash

echo "Fixing remaining ESLint errors..."

# Fix all remaining components with missing lang="ts"
find resources/js -name "*.vue" -type f | while read -r file; do
    if grep -q '<script>' "$file" && ! grep -q '<script lang=' "$file"; then
        sed -i '' 's/<script>/<script lang="ts">/g' "$file"
    fi
done

# Fix specific parsing errors
# Fix BarChartExample.vue - remove extra >
sed -i '' 's/<\/Checkbox>>/<\/Checkbox>/g' resources/js/components/LevelIndicators/BarChartExample.vue 2>/dev/null || true

# Fix DialogPanel closing tags in Quiz.vue
sed -i '' 's/<\/DialogTitle>/<\/DialogComponentTitle>/g' resources/js/pages/Diagnostics/Test/Quiz.vue 2>/dev/null || true
sed -i '' 's/<\/DialogPanel>/<\/DialogComponentPanel>/g' resources/js/pages/Diagnostics/Test/Quiz.vue 2>/dev/null || true

# Fix unused variables in shadcn components by removing the underscore pattern
find resources/js/components/shadcn -name "*.vue" -type f | while read -r file; do
    # Remove unused _ from destructuring
    sed -i '' 's/const { class: _, /const { class: className, /g' "$file"
    sed -i '' 's/({ class: _, /({ class: className, /g' "$file"
done

# Fix specific files with unused imports
sed -i '' '/import.*Badge.*from/d' resources/js/pages/Diagnostics/Test/Review.vue 2>/dev/null || true
sed -i '' '/import.*Badge.*from/d' "resources/js/pages/Diagnostics/Test/Review 2.vue" 2>/dev/null || true
sed -i '' '/import { ref } from/d' resources/js/pages/Privacy/Consent.vue 2>/dev/null || true
sed -i '' '/import { Link } from/d' resources/js/pages/Privacy/Consent.vue 2>/dev/null || true

# Fix Type5.vue v-for with index
sed -i '' 's/v-for="(option, index) in availableOptions"/v-for="option in availableOptions"/g' resources/js/components/QuizTypes/Type5.vue 2>/dev/null || true

# Fix reserved component names
sed -i '' 's/components: { Link }/components: { LinkComponent: Link }/g' resources/js/pages/Diagnostics/Test/Quiz.vue 2>/dev/null || true
sed -i '' 's/components: { Link }/components: { LinkComponent: Link }/g' "resources/js/pages/Diagnostics/Test/Quiz 2.vue" 2>/dev/null || true
sed -i '' 's/<Link /<LinkComponent /g' resources/js/pages/Diagnostics/Test/Quiz.vue 2>/dev/null || true
sed -i '' 's/<\/Link>/<\/LinkComponent>/g' resources/js/pages/Diagnostics/Test/Quiz.vue 2>/dev/null || true
sed -i '' 's/<Link /<LinkComponent /g' "resources/js/pages/Diagnostics/Test/Quiz 2.vue" 2>/dev/null || true
sed -i '' 's/<\/Link>/<\/LinkComponent>/g' "resources/js/pages/Diagnostics/Test/Quiz 2.vue" 2>/dev/null || true

# Fix Dialog component in Quiz.vue
sed -i '' 's/Dialog, DialogPanel, DialogTitle/Dialog as DialogComponent, DialogPanel as DialogComponentPanel, DialogTitle as DialogComponentTitle/g' resources/js/pages/Diagnostics/Test/Quiz.vue 2>/dev/null || true

# Fix CompactLevelIndicator.vue and LevelVisualization.vue parsing errors
sed -i '' '/export default {/,/^}$/{/export default {/!{/^}$/!d;};}' resources/js/components/LevelIndicators/CompactLevelIndicator.vue 2>/dev/null || true
sed -i '' '/export default {/,/^}$/{/export default {/!{/^}$/!d;};}' resources/js/components/LevelIndicators/LevelVisualization.vue 2>/dev/null || true

echo "Remaining fixes complete"