#!/bin/bash

echo "Final ESLint fixes..."

# Fix Type5.vue - remove index from v-for
sed -i '' 's/v-for="(option, index) in availableOptions"/v-for="option in availableOptions"/g' resources/js/components/QuizTypes/Type5.vue

# Fix Type5Review.vue - remove unused shuffle
sed -i '' '/^import { shuffle } from/d' resources/js/components/QuizTypes/Type5Review.vue

# Fix all shadcn components - replace className with actual usage
find resources/js/components/shadcn -name "*.vue" -type f | while read -r file; do
    # Replace className with _ since it's not used
    sed -i '' 's/{ class: className,/{ class: _,/g' "$file"
done

# Fix auto-form dependencies.js
sed -i '' 's/const _targetLast = /const /g' resources/js/components/shadcn/ui/auto-form/dependencies.js
sed -i '' 's/const _currentLast = /const /g' resources/js/components/shadcn/ui/auto-form/dependencies.js

# Fix AdminLayout.vue
sed -i '' '/import.*ChevronRight/d' resources/js/layouts/AdminLayout.vue
sed -i '' 's/catch (e)/catch/g' resources/js/layouts/AdminLayout.vue
sed -i '' 's/v-for="(alert, index) in alerts"/v-for="alert in alerts"/g' resources/js/layouts/AdminLayout.vue

# Fix unused imports in pages
sed -i '' '/import.*Head.*from/d' resources/js/pages/Diagnostics/Dashboard.vue
sed -i '' '/import.*Head.*from/d' resources/js/pages/Diagnostics/Results.vue
sed -i '' '/import.*Head.*from/d' resources/js/pages/Diagnostics/Test/Report.vue
sed -i '' '/import.*Head.*from/d' resources/js/pages/Diagnostics/Test/Results.vue
sed -i '' '/import.*Head.*from/d' resources/js/pages/Diagnostics/Test/EnhancedReport.vue
sed -i '' '/import.*Badge.*from/d' resources/js/pages/Diagnostics/Test/Review.vue
sed -i '' '/import.*Badge.*from/d' resources/js/pages/Diagnostics/Test/Review\\ 2.vue

# Fix unused variables in components
sed -i '' 's/, side } = props/, } = props/g' resources/js/components/shadcn/ui/sheet/SheetContent.vue
sed -i '' 's/const { tooltip, /const { /g' resources/js/components/shadcn/ui/sidebar/SidebarMenuButton.vue
sed -i '' '/import.*Primitive.*from/d' resources/js/components/shadcn/ui/sidebar/SidebarGroupContent.vue

# Fix toggle-group unused destructured vars
sed -i '' 's/, variant, size } = props/, } = props/g' resources/js/components/shadcn/ui/toggle-group/ToggleGroupItem.vue
sed -i '' 's/, size, variant } = props/, } = props/g' resources/js/components/shadcn/ui/toggle/Toggle.vue

# Fix useTheme.js
sed -i '' 's/import { initializeTheme, applyTheme/import { applyTheme/g' resources/js/composables/useTheme.js

# Fix reserved component names
sed -i '' 's/name: "Link"/name: "LinkComponent"/g' resources/js/pages/Diagnostics/SampleQuiz.vue
sed -i '' 's/name: "Link"/name: "LinkComponent"/g' resources/js/pages/Diagnostics/Test/Quiz.vue
sed -i '' 's/name: "Link"/name: "LinkComponent"/g' resources/js/pages/Diagnostics/Test/Quiz\\ 2.vue

# Fix parsing error in BarChartExample.vue
sed -i '' 's/<\/Checkbox>>/<\/Checkbox>/g' resources/js/components/LevelIndicators/BarChartExample.vue

echo "Final fixes complete"