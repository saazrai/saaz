#!/bin/bash

echo "Adding dark mode support to Features page..."

# Update all bg-white to include dark:bg-gray-800
sed -i '' 's/bg-white rounded-xl/bg-white dark:bg-gray-800 rounded-xl/g' resources/js/pages/Features.vue

# Update icon backgrounds
sed -i '' 's/bg-green-100 rounded-lg/bg-green-100 dark:bg-green-900 rounded-lg/g' resources/js/pages/Features.vue
sed -i '' 's/bg-purple-100 rounded-lg/bg-purple-100 dark:bg-purple-900 rounded-lg/g' resources/js/pages/Features.vue
sed -i '' 's/bg-yellow-100 rounded-lg/bg-yellow-100 dark:bg-yellow-900 rounded-lg/g' resources/js/pages/Features.vue
sed -i '' 's/bg-red-100 rounded-lg/bg-red-100 dark:bg-red-900 rounded-lg/g' resources/js/pages/Features.vue
sed -i '' 's/bg-indigo-100 rounded-lg/bg-indigo-100 dark:bg-indigo-900 rounded-lg/g' resources/js/pages/Features.vue

# Update icon colors
sed -i '' 's/text-green-600"/text-green-600 dark:text-green-400"/g' resources/js/pages/Features.vue
sed -i '' 's/text-purple-600"/text-purple-600 dark:text-purple-400"/g' resources/js/pages/Features.vue
sed -i '' 's/text-yellow-600"/text-yellow-600 dark:text-yellow-400"/g' resources/js/pages/Features.vue
sed -i '' 's/text-red-600"/text-red-600 dark:text-red-400"/g' resources/js/pages/Features.vue
sed -i '' 's/text-indigo-600"/text-indigo-600 dark:text-indigo-400"/g' resources/js/pages/Features.vue

# Update text colors
sed -i '' 's/<h3 class="text-xl font-semibold mb-4">/<h3 class="text-xl font-semibold mb-4 dark:text-white">/g' resources/js/pages/Features.vue
sed -i '' 's/<p class="text-gray-600">/<p class="text-gray-600 dark:text-gray-300">/g' resources/js/pages/Features.vue

# Update section backgrounds
sed -i '' 's/bg-gray-100"/bg-gray-100 dark:bg-gray-800"/g' resources/js/pages/Features.vue
sed -i '' 's/text-gray-700"/text-gray-700 dark:text-gray-200"/g' resources/js/pages/Features.vue

# Update CTA section
sed -i '' 's/bg-gradient-to-r from-blue-900 to-blue-700/bg-gradient-to-r from-blue-900 to-blue-700 dark:from-blue-950 dark:to-blue-800/g' resources/js/pages/Features.vue

echo "Dark mode support added to Features page!"