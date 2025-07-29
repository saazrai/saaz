#!/bin/bash

# Build validation script that catches case-sensitive import issues
echo "🔍 Running build validation..."

# Run the build
if npm run build; then
    echo "✅ Build successful - no case-sensitive import issues detected"
    # Clean up build files
    rm -rf public/build
    exit 0
else
    echo "❌ Build failed - please check for case-sensitive import issues"
    echo "💡 Common issues:"
    echo "   - @/Components vs @/components"
    echo "   - @/Layouts vs @/layouts"
    echo "   - @/Pages vs @/pages"
    exit 1
fi