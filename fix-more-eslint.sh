#!/bin/bash

# Fix missing lang="ts" in specific components
echo "Adding lang=\"ts\" to remaining components..."

# Simple components
files=(
    "resources/js/components/Checkbox.vue"
    "resources/js/components/ConfirmationDialog.vue"
    "resources/js/components/CookieConsentBanner.vue"
    "resources/js/components/Dropdown.vue"
    "resources/js/components/FlashMessage.vue"
    "resources/js/components/InputError.vue"
    "resources/js/components/InputLabel.vue"
    "resources/js/components/Modal.vue"
    "resources/js/components/NavigationLoader.vue"
    "resources/js/components/TextInput.vue"
    "resources/js/layouts/AdminLayout.vue"
    "resources/js/pages/About.vue"
    "resources/js/pages/Contact.vue"
    "resources/js/pages/FAQ.vue"
    "resources/js/pages/Features.vue"
    "resources/js/pages/Help.vue"
    "resources/js/pages/Index.vue"
    "resources/js/pages/auth/Login.vue"
)

for file in "${files[@]}"; do
    if [ -f "$file" ]; then
        sed -i '' 's/<script>/<script lang="ts">/g' "$file"
        echo "Fixed: $file"
    fi
done

# Fix shadcn components (all at once)
find resources/js/components/shadcn -name "*.vue" -type f | while read -r file; do
    if grep -q '<script>' "$file"; then
        sed -i '' 's/<script>/<script lang="ts">/g' "$file"
        echo "Fixed: $file"
    fi
done

# Fix remaining pages
find resources/js/pages -name "*.vue" -type f | while read -r file; do
    if grep -q '<script>' "$file" && ! grep -q '<script lang=' "$file"; then
        sed -i '' 's/<script>/<script lang="ts">/g' "$file"
        echo "Fixed: $file"
    fi
done

echo "Done adding lang attributes"