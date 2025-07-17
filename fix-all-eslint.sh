#!/bin/bash

echo "Comprehensive ESLint fixes..."

# Fix all shadcn components with unused '_' parameters
echo "Fixing shadcn components..."
find resources/js/components/shadcn -name "*.vue" -type f | while read -r file; do
    # Fix patterns like: const { class: _, ...props } = 
    sed -i '' 's/const { class: _, \.\.\.\([^}]*\) } =/const { class: className, ...\1 } =/g' "$file"
    # Fix patterns like: ({ _, ...props })
    sed -i '' 's/({ _, \.\.\.\([^}]*\) })/({ ...\1 })/g' "$file"
done

# Fix specific unused variable patterns
echo "Fixing specific patterns..."

# Fix login/register pages unused imports
sed -i '' '/import Checkbox/d' resources/js/pages/auth/Login.vue
sed -i '' '/import PrimaryButton/d' resources/js/pages/auth/Login.vue
sed -i '' '/import PrimaryButton/d' resources/js/pages/auth/Register.vue

# Fix computed import in Profile.vue
sed -i '' 's/, computed//g' resources/js/pages/settings/Profile.vue

# Fix LevelIndicators
sed -i '' '/const props = defineProps/d' resources/js/components/LevelIndicators/CompactLevelIndicator.vue
sed -i '' 's/, computed//g' resources/js/components/LevelIndicators/LevelVisualization.vue
sed -i '' '/const props = defineProps/d' resources/js/components/LevelIndicators/LevelVisualization.vue

# Fix Type5.vue v-for index
sed -i '' 's/v-for="(option, index) in availableOptions"/v-for="option in availableOptions"/g' resources/js/components/QuizTypes/Type5.vue

# Fix reserved component names
sed -i '' 's/components: { Dialog,/components: { DialogComponent: Dialog,/g' resources/js/pages/Diagnostics/Test/Quiz.vue
sed -i '' 's/<Dialog/<DialogComponent/g' resources/js/pages/Diagnostics/Test/Quiz.vue
sed -i '' 's/<\/Dialog>/<\/DialogComponent>/g' resources/js/pages/Diagnostics/Test/Quiz.vue

# Fix Props definitions in shadcn
sed -i '' 's/defineProps(Props)/defineProps<Props>()/g' resources/js/components/shadcn/ui/context-menu/ContextMenuShortcut.vue
sed -i '' 's/defineProps(Props)/defineProps<Props>()/g' resources/js/components/shadcn/ui/menubar/MenubarShortcut.vue
sed -i '' 's/defineProps(Props)/defineProps<Props>()/g' resources/js/components/shadcn/ui/sheet/SheetClose.vue
sed -i '' 's/defineProps(Props)/defineProps<Props>()/g' resources/js/components/shadcn/ui/sheet/SheetFooter.vue
sed -i '' 's/defineProps(Props)/defineProps<Props>()/g' resources/js/components/shadcn/ui/sheet/SheetTrigger.vue

# Fix Admin layout unused variables
sed -i '' 's/import { ChevronRight } from/import { } from/g' resources/js/layouts/AdminLayout.vue || true
sed -i '' '/const safeRoute = /d' resources/js/layouts/AdminLayout.vue || true
sed -i '' '/const systemAlerts = /d' resources/js/layouts/AdminLayout.vue || true
sed -i '' '/const currentUrl = /d' resources/js/layouts/AdminLayout.vue || true

echo "Done with comprehensive fixes"