#!/bin/bash

# Move V2 admin pages to .disabled extension
# These pages have dependencies not available in V1

cd resources/js/pages/Admin

# Analytics pages
find Analytics -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true

# Courses pages
find Courses -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true

# Products and commerce pages
mv Products.vue Products.vue.disabled 2>/dev/null || true
mv ProductTypes.vue ProductTypes.vue.disabled 2>/dev/null || true
mv Coupons.vue Coupons.vue.disabled 2>/dev/null || true
mv Vouchers.vue Vouchers.vue.disabled 2>/dev/null || true
find Vouchers -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find Orders -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true

# Study notes and lessons (not in V1)
find StudyNotes -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find Lessons -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true

# Other V2 features
find Instructors -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find Topics -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find LearnerProgress -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find CourseDifficultyProfiles -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find CourseLevels.vue -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find ExamSettings -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find ProficiencyLevels -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find BotMonitoring -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find Pulse -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true

# Diagnostic-related pages with missing dependencies
find Diagnostics -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find DiagnosticModes -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true
find Questions -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true

# Level indicators and other misc
mv LevelIndicators/Demo.vue LevelIndicators/Demo.vue.disabled 2>/dev/null || true
mv LiveMonitor.vue LiveMonitor.vue.disabled 2>/dev/null || true
mv LogViewer.vue LogViewer.vue.disabled 2>/dev/null || true
mv Blooms.vue Blooms.vue.disabled 2>/dev/null || true
mv Currencies.vue Currencies.vue.disabled 2>/dev/null || true
mv DifficultyLevels.vue DifficultyLevels.vue.disabled 2>/dev/null || true
mv UserRoles.vue UserRoles.vue.disabled 2>/dev/null || true
mv SystemSettings.vue SystemSettings.vue.disabled 2>/dev/null || true

# Domain pages with issues
find Domains -name "*.vue" -exec mv {} {}.disabled \; 2>/dev/null || true

echo "V2 admin pages disabled for V1 build"