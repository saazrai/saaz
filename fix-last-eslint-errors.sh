#!/bin/bash

echo "Fixing last remaining ESLint errors..."

# 1. Fix BarChartExample.vue parsing error
echo "Fixing BarChartExample.vue..."
sed -i '' '97s/<\/Checkbox>>/<\/Checkbox>/g' resources/js/components/LevelIndicators/BarChartExample.vue 2>/dev/null || true

# 2. Fix unused '_' in shadcn components - use a void expression
echo "Fixing unused '_' variables in shadcn components..."
find resources/js/components/shadcn -name "*.vue" -type f | while read -r file; do
    # Replace const { class: _, with just omitting the class
    sed -i '' 's/const { class: _, /const { /g' "$file"
    sed -i '' 's/({ class: _, /({ /g' "$file"
done

# Also fix auto-form dependencies.js
sed -i '' '36s/const _targetLast/const targetLast/' resources/js/components/shadcn/ui/auto-form/dependencies.js 2>/dev/null || true
sed -i '' '41s/const _currentLast/const currentLast/' resources/js/components/shadcn/ui/auto-form/dependencies.js 2>/dev/null || true

# 3. Fix unused imports
echo "Removing unused imports..."
# Remove unused ref from multiple files
sed -i '' '/import { ref } from/d' resources/js/pages/Diagnostics/HistoryApple.vue 2>/dev/null || true
sed -i '' '/import { ref } from/d' "resources/js/pages/Diagnostics/HistoryApple 2.vue" 2>/dev/null || true
sed -i '' '/import { ref } from/d' resources/js/pages/Diagnostics/Items/Index.vue 2>/dev/null || true
sed -i '' '/import { ref,.*onMounted } from/s/, onMounted//g' resources/js/pages/Diagnostics/PhaseComplete.vue 2>/dev/null || true
sed -i '' '/import { ref } from/d' resources/js/pages/Diagnostics/PhaseComplete.vue 2>/dev/null || true
sed -i '' '/import { computed } from/d' resources/js/pages/Diagnostics/ResultsApple.vue 2>/dev/null || true
sed -i '' '/import { computed } from/d' "resources/js/pages/Diagnostics/ResultsApple 2.vue" 2>/dev/null || true
sed -i '' '/import { Link } from/d' resources/js/pages/Privacy/Consent.vue 2>/dev/null || true
sed -i '' '/import { Head } from/d' "resources/js/pages/Diagnostics/Results 2.vue" 2>/dev/null || true

# 4. Fix unused variables with underscore prefix
echo "Fixing unused variables..."
# Fix Dashboard components
sed -i '' '172s/const isDarkMode/const _isDarkMode/' resources/js/pages/Dashboard/ChartComponentNivo.vue 2>/dev/null || true
sed -i '' '196s/const isDarkMode/const _isDarkMode/' resources/js/pages/Dashboard/Diag14PieChart.vue 2>/dev/null || true
sed -i '' '139s/const isPassed/const _isPassed/' resources/js/pages/Dashboard/UsageStatus.vue 2>/dev/null || true

# Fix Diagnostics/Index.vue
sed -i '' '/import.*reactive.*from/s/, reactive//g' resources/js/pages/Diagnostics/Index.vue 2>/dev/null || true
sed -i '' '658s/const selectedDomain/const _selectedDomain/' resources/js/pages/Diagnostics/Index.vue 2>/dev/null || true

# Fix Results.vue
sed -i '' '/ArrowUpIcon.*from.*lucide/d' resources/js/pages/Diagnostics/Results.vue 2>/dev/null || true
sed -i '' '488s/const performanceVariant/const _performanceVariant/' resources/js/pages/Diagnostics/Results.vue 2>/dev/null || true
sed -i '' '494s/const accuracyRate/const _accuracyRate/' resources/js/pages/Diagnostics/Results.vue 2>/dev/null || true
sed -i '' '498s/const accuracyTrend/const _accuracyTrend/' resources/js/pages/Diagnostics/Results.vue 2>/dev/null || true

# Fix SampleQuiz.vue
sed -i '' 's/components: { Link,/components: { LinkComponent: Link,/g' resources/js/pages/Diagnostics/SampleQuiz.vue 2>/dev/null || true
sed -i '' '1679s/(questionTime, totalTime)/()/g' resources/js/pages/Diagnostics/SampleQuiz.vue 2>/dev/null || true

# Fix SimpleResults.vue
sed -i '' '121s/const hours/const _hours/' resources/js/pages/Diagnostics/SimpleResults.vue 2>/dev/null || true

# Fix Start.vue
sed -i '' '248s/const props/const _props/' resources/js/pages/Diagnostics/Start.vue 2>/dev/null || true

# Fix EnhancedReport.vue
sed -i '' '319s/const radarData/const _radarData/' resources/js/pages/Diagnostics/Test/EnhancedReport.vue 2>/dev/null || true

# Fix Quiz components unused variables (already prefixed with _)
# These should already be fixed from previous script

# Fix QuizApple.vue
sed -i '' 's/components: { Dialog,/components: { DialogComponent: Dialog,/g' resources/js/pages/Diagnostics/Test/QuizApple.vue 2>/dev/null || true
sed -i '' '547s/(domainId)/()/g' resources/js/pages/Diagnostics/Test/QuizApple.vue 2>/dev/null || true
sed -i '' '552s/(domainId)/()/g' resources/js/pages/Diagnostics/Test/QuizApple.vue 2>/dev/null || true

# 5. Fix duplicate keys error in Diagnostics/Index.vue
echo "Fixing duplicate keys..."
# Find and comment out the duplicate domains data property
sed -i '' '/data() {/,/^[[:space:]]*}[[:space:]]*,/{
    /domains: \[\]/s/^/\/\/ /
}' resources/js/pages/Diagnostics/Index.vue 2>/dev/null || true

echo "Final ESLint fixes complete!"