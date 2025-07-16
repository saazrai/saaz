#!/bin/bash

# Fix missing lang="ts" attribute in Vue files
echo "Adding lang=\"ts\" to script tags..."

# Function to add lang="ts" to script tags
add_lang_ts() {
    local file="$1"
    # Check if file has <script> without lang attribute
    if grep -q '<script>' "$file" && ! grep -q '<script lang=' "$file"; then
        # Replace <script> with <script lang="ts">
        sed -i '' 's/<script>/<script lang="ts">/g' "$file"
        echo "Fixed: $file"
    fi
}

# Find all Vue files and fix them
find resources/js -name "*.vue" -type f | while read -r file; do
    add_lang_ts "$file"
done

echo "Done adding lang=\"ts\" attributes"