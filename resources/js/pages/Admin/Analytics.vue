<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { Head, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/shadcn/ui/card'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/shadcn/ui/tabs'
import { Button } from '@/components/shadcn/ui/button'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/shadcn/ui/select'

// Dark mode state
const isDarkMode = ref(false)

// Load dark mode preference and watch for changes
onMounted(() => {
    const saved = localStorage.getItem('adminDarkMode')
    isDarkMode.value = saved === 'true'
    
    // Watch for localStorage changes (when dark mode is toggled from AdminLayout)
    const handleStorageChange = () => {
        const saved = localStorage.getItem('adminDarkMode')
        isDarkMode.value = saved === 'true'
    }
    
    window.addEventListener('storage', handleStorageChange)
    
    // Also watch for custom events from AdminLayout
    window.addEventListener('adminDarkModeChanged', handleStorageChange)
    
    // Cleanup on unmount
    return () => {
        window.removeEventListener('storage', handleStorageChange)
        window.removeEventListener('adminDarkModeChanged', handleStorageChange)
    }
})

// Props from backend
const props = defineProps({
    analytics: {
        type: Object,
        default: () => ({})
    },
    dateRange: {
        type: String,
        default: '30'
    },
    filters: {
        type: Object,
        default: () => ({
            dateRanges: [
                { value: '7', label: 'Last 7 days' },
                { value: '30', label: 'Last 30 days' },
                { value: '90', label: 'Last 90 days' },
                { value: '365', label: 'Last year' },
            ]
        })
    },
    error: {
        type: String,
        default: null
    },
})

// Reactive data
const selectedDateRange = ref(props.dateRange)
const isLoading = ref(false)

// Computed properties for easy access to analytics data
const overview = computed(() => props.analytics?.overview || {})
const userAnalytics = computed(() => props.analytics?.userAnalytics || {})
const courseAnalytics = computed(() => props.analytics?.courseAnalytics || {})
const revenueAnalytics = computed(() => props.analytics?.revenueAnalytics || {})
const engagementAnalytics = computed(() => props.analytics?.engagementAnalytics || {})
const performanceAnalytics = computed(() => props.analytics?.performanceAnalytics || {})

// Safe access to filters
const dateRangeOptions = computed(() => props.filters?.dateRanges || [
    { value: '7', label: 'Last 7 days' },
    { value: '30', label: 'Last 30 days' },
    { value: '90', label: 'Last 90 days' },
    { value: '365', label: 'Last year' },
])

// Methods
const updateDateRange = (newRange) => {
    selectedDateRange.value = newRange
    isLoading.value = true
    
    try {
        router.get(route('admin.analytics.dashboard'), { date_range: newRange }, {
            preserveState: true,
            onFinish: () => isLoading.value = false,
            onError: () => isLoading.value = false
        })
    } catch (error) {
        console.error('Error updating date range:', error)
        isLoading.value = false
    }
}

const exportData = (format) => {
    try {
        window.open(route('admin.analytics.export', { 
            date_range: selectedDateRange.value, 
            format: format 
        }))
    } catch (error) {
        console.error('Error exporting data:', error)
        alert('Export functionality is not available at the moment.')
    }
}

const formatNumber = (num) => {
    if (!num) return '0'
    return new Intl.NumberFormat().format(num)
}

const formatCurrency = (amount) => {
    if (!amount) return '$0'
    return new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    }).format(amount)
}

const formatPercentage = (value) => {
    if (!value) return '0%'
    return `${Math.round(value)}%`
}

const getGrowthIndicator = (current, previous) => {
    if (!previous || previous === 0) return { value: 0, isPositive: true }
    const growth = ((current - previous) / previous) * 100
    return {
        value: Math.abs(growth),
        isPositive: growth >= 0
    }
}
</script>

<template>
    <Head title="Analytics Dashboard" />

    <AdminLayout>
        <div class="container mx-auto px-4 py-8">
            <!-- Analytics Dashboard Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Analytics Dashboard</h1>
                    <p class="text-gray-600 dark:text-gray-300">Deep insights into your academy's performance</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-4 mt-4 md:mt-0">
                    <!-- Date Range Selector -->
                    <Select :value="selectedDateRange" @update:value="updateDateRange">
                        <SelectTrigger class="w-48">
                            <SelectValue placeholder="Select date range" />
                        </SelectTrigger>
                        <SelectContent>
                            <SelectItem v-for="range in dateRangeOptions" :key="range.value" :value="range.value">
                                {{ range.label }}
                            </SelectItem>
                        </SelectContent>
                    </Select>
                    
                    <!-- Export Buttons -->
                    <div class="flex gap-2">
                        <Button variant="outline" @click="exportData('csv')" size="sm">
                            Export CSV
                        </Button>
                        <Button variant="outline" @click="exportData('excel')" size="sm">
                            Export Excel
                        </Button>
                    </div>
                </div>
            </div>

            <!-- Error State -->
            <div v-if="error" :class="[
                'border rounded-lg p-4 mb-8',
                isDarkMode 
                    ? 'bg-red-900/20 border-red-800 text-red-200' 
                    : 'bg-red-50 border-red-200 text-red-800'
            ]">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg :class="['h-5 w-5', isDarkMode ? 'text-red-400' : 'text-red-400']" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 :class="['text-sm font-medium', isDarkMode ? 'text-red-300' : 'text-red-800']">Error Loading Analytics</h3>
                        <div :class="['mt-2 text-sm', isDarkMode ? 'text-red-400' : 'text-red-700']">
                            <p>{{ error }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading State -->
            <div v-if="isLoading" class="flex justify-center items-center py-12">
                <div :class="[
                    'animate-spin rounded-full h-8 w-8 border-b-2',
                    isDarkMode ? 'border-blue-400' : 'border-blue-600'
                ]"></div>
            </div>

            <div v-else-if="!error">
                <!-- Key Metrics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                        <CardHeader>
                            <CardTitle :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : '']">Total Users</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div :class="['text-3xl font-bold', isDarkMode ? 'text-white' : '']">{{ formatNumber(overview.totalUsers) }}</div>
                            <div class="flex items-center mt-2">
                                <span :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">New: {{ formatNumber(overview.newUsers) }}</span>
                                <span v-if="overview.newUsersPrevious" 
                                      :class="getGrowthIndicator(overview.newUsers, overview.newUsersPrevious).isPositive ? 'text-green-600' : 'text-red-600'"
                                      class="text-xs ml-2">
                                    {{ getGrowthIndicator(overview.newUsers, overview.newUsersPrevious).isPositive ? '+' : '-' }}{{ formatPercentage(getGrowthIndicator(overview.newUsers, overview.newUsersPrevious).value) }}
                                </span>
                            </div>
                        </CardContent>
                    </Card>

                    <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                        <CardHeader>
                            <CardTitle :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : '']">Active Users</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div :class="['text-3xl font-bold', isDarkMode ? 'text-white' : '']">{{ formatNumber(overview.activeUsers) }}</div>
                            <p :class="['text-sm mt-2', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Currently engaged learners</p>
                        </CardContent>
                    </Card>

                    <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                        <CardHeader>
                            <CardTitle :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : '']">Total Revenue</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div :class="['text-3xl font-bold', isDarkMode ? 'text-white' : '']">{{ formatCurrency(overview.totalRevenue) }}</div>
                            <div class="flex items-center mt-2">
                                <span :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">AOV: {{ formatCurrency(overview.averageOrderValue) }}</span>
                                <span v-if="overview.totalRevenuePrevious" 
                                      :class="getGrowthIndicator(overview.totalRevenue, overview.totalRevenuePrevious).isPositive ? 'text-green-600' : 'text-red-600'"
                                      class="text-xs ml-2">
                                    {{ getGrowthIndicator(overview.totalRevenue, overview.totalRevenuePrevious).isPositive ? '+' : '-' }}{{ formatPercentage(getGrowthIndicator(overview.totalRevenue, overview.totalRevenuePrevious).value) }}
                                </span>
                            </div>
                        </CardContent>
                    </Card>

                    <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                        <CardHeader>
                            <CardTitle :class="['text-sm font-medium', isDarkMode ? 'text-gray-300' : '']">Conversion Rate</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div :class="['text-3xl font-bold', isDarkMode ? 'text-white' : '']">{{ formatPercentage(overview.conversionRate) }}</div>
                            <p :class="['text-sm mt-2', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Visitor to customer</p>
                        </CardContent>
                    </Card>
                </div>

                <!-- Detailed Analytics Tabs -->
                <Tabs default-value="users" class="space-y-6">
                    <TabsList :class="['grid w-full grid-cols-5', isDarkMode ? 'bg-gray-800 border-gray-700' : '']">
                        <TabsTrigger value="users" :class="isDarkMode ? 'data-[state=active]:bg-gray-700 data-[state=active]:text-white text-gray-300' : ''">Users</TabsTrigger>
                        <TabsTrigger value="courses" :class="isDarkMode ? 'data-[state=active]:bg-gray-700 data-[state=active]:text-white text-gray-300' : ''">Courses</TabsTrigger>
                        <TabsTrigger value="revenue" :class="isDarkMode ? 'data-[state=active]:bg-gray-700 data-[state=active]:text-white text-gray-300' : ''">Revenue</TabsTrigger>
                        <TabsTrigger value="engagement" :class="isDarkMode ? 'data-[state=active]:bg-gray-700 data-[state=active]:text-white text-gray-300' : ''">Engagement</TabsTrigger>
                        <TabsTrigger value="performance" :class="isDarkMode ? 'data-[state=active]:bg-gray-700 data-[state=active]:text-white text-gray-300' : ''">Performance</TabsTrigger>
                    </TabsList>

                    <!-- Users Analytics -->
                    <TabsContent value="users" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- User Growth Chart -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">User Growth</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div v-if="userAnalytics.userGrowth && userAnalytics.userGrowth.length" class="space-y-2">
                                        <div v-for="item in userAnalytics.userGrowth.slice(-10)" :key="item.date" 
                                             :class="['flex justify-between items-center p-2 rounded', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                            <span :class="['text-sm', isDarkMode ? 'text-gray-300' : '']">{{ item.date }}</span>
                                            <span :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ item.users }} new users</span>
                                        </div>
                                    </div>
                                    <div v-else :class="['text-center py-8', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                                        No user growth data available
                                    </div>
                                </CardContent>
                            </Card>

                            <!-- User Engagement -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">User Engagement</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div :class="['text-center p-4 rounded-lg', isDarkMode ? 'bg-blue-900/30' : 'bg-blue-50']">
                                            <div :class="['text-2xl font-bold', isDarkMode ? 'text-blue-400' : 'text-blue-600']">{{ Math.round(userAnalytics.userEngagement?.averageSessionDuration || 0) }}</div>
                                            <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">Avg Session (min)</div>
                                        </div>
                                        <div :class="['text-center p-4 rounded-lg', isDarkMode ? 'bg-green-900/30' : 'bg-green-50']">
                                            <div :class="['text-2xl font-bold', isDarkMode ? 'text-green-400' : 'text-green-600']">{{ Math.round(userAnalytics.userEngagement?.sessionsPerUser || 0) }}</div>
                                            <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">Sessions/User</div>
                                        </div>
                                        <div :class="['text-center p-4 rounded-lg', isDarkMode ? 'bg-purple-900/30' : 'bg-purple-50']">
                                            <div :class="['text-2xl font-bold', isDarkMode ? 'text-purple-400' : 'text-purple-600']">{{ formatNumber(userAnalytics.userEngagement?.dailyActiveUsers || 0) }}</div>
                                            <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">Daily Active</div>
                                        </div>
                                        <div :class="['text-center p-4 rounded-lg', isDarkMode ? 'bg-orange-900/30' : 'bg-orange-50']">
                                            <div :class="['text-2xl font-bold', isDarkMode ? 'text-orange-400' : 'text-orange-600']">{{ formatNumber(userAnalytics.userEngagement?.monthlyActiveUsers || 0) }}</div>
                                            <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">Monthly Active</div>
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>
                        </div>

                        <!-- Top Users -->
                        <Card v-if="userAnalytics.topUsers && userAnalytics.topUsers.length" :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                            <CardHeader>
                                <CardTitle :class="isDarkMode ? 'text-white' : ''">Top Performing Users</CardTitle>
                            </CardHeader>
                            <CardContent>
                                <div class="space-y-3">
                                    <div v-for="user in userAnalytics.topUsers.slice(0, 5)" :key="user.id" 
                                         :class="['flex items-center justify-between p-3 rounded-lg', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                        <div>
                                            <p :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ user.name }}</p>
                                            <p :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">{{ user.session_count }} sessions • {{ Math.round(user.total_minutes || 0) }} minutes</p>
                                        </div>
                                        <div class="text-right">
                                            <div :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ Math.round(user.avg_score || 0) }}%</div>
                                            <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Avg Score</div>
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </TabsContent>

                    <!-- Courses Analytics -->
                    <TabsContent value="courses" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Top Courses -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Top Performing Courses</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div v-if="courseAnalytics.topCourses && courseAnalytics.topCourses.length" class="space-y-3">
                                        <div v-for="course in courseAnalytics.topCourses.slice(0, 5)" :key="course.id" 
                                             :class="['flex items-center justify-between p-3 rounded-lg', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                            <div>
                                                <p :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ course.name }}</p>
                                                <p :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">{{ course.enrolled_students }} students</p>
                                            </div>
                                            <div class="text-right">
                                                <div :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ formatCurrency(course.revenue || 0) }}</div>
                                                <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Revenue</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else :class="['text-center py-8', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                                        No course data available
                                    </div>
                                </CardContent>
                            </Card>

                            <!-- Course Completion Rates -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Course Completion Rates</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div v-if="courseAnalytics.courseCompletion && courseAnalytics.courseCompletion.length" class="space-y-3">
                                        <div v-for="course in courseAnalytics.courseCompletion.slice(0, 5)" :key="course.name" 
                                             :class="['flex items-center justify-between p-3 rounded-lg', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                            <div>
                                                <p :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ course.name }}</p>
                                                <p :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">{{ course.total_enrollments }} enrollments</p>
                                            </div>
                                            <div class="text-right">
                                                <div :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ Math.round(course.completion_rate || 0) }}%</div>
                                                <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Completion</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else :class="['text-center py-8', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                                        No completion data available
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </TabsContent>

                    <!-- Revenue Analytics -->
                    <TabsContent value="revenue" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Revenue Over Time -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Revenue Trend</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div v-if="revenueAnalytics.revenueOverTime && revenueAnalytics.revenueOverTime.length" class="space-y-2">
                                        <div v-for="item in revenueAnalytics.revenueOverTime.slice(-10)" :key="item.date" 
                                             :class="['flex justify-between items-center p-2 rounded', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                            <span :class="['text-sm', isDarkMode ? 'text-gray-300' : '']">{{ item.date }}</span>
                                            <span :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ formatCurrency(item.revenue) }}</span>
                                        </div>
                                    </div>
                                    <div v-else :class="['text-center py-8', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                                        No revenue data available
                                    </div>
                                </CardContent>
                            </Card>

                            <!-- Revenue by Product -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Revenue by Product</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div v-if="revenueAnalytics.revenueByProduct && revenueAnalytics.revenueByProduct.length" class="space-y-3">
                                        <div v-for="product in revenueAnalytics.revenueByProduct.slice(0, 5)" :key="product.name" 
                                             :class="['flex items-center justify-between p-3 rounded-lg', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                            <div>
                                                <p :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ product.name }}</p>
                                                <p :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">{{ product.sales_count }} sales</p>
                                            </div>
                                            <div class="text-right">
                                                <div :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ formatCurrency(product.revenue || 0) }}</div>
                                                <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-500']">Total Revenue</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else :class="['text-center py-8', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                                        No product revenue data available
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </TabsContent>

                    <!-- Engagement Analytics -->
                    <TabsContent value="engagement" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Session Analytics -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Session Analytics</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div :class="['text-center p-4 rounded-lg', isDarkMode ? 'bg-blue-900/30' : 'bg-blue-50']">
                                            <div :class="['text-2xl font-bold', isDarkMode ? 'text-blue-400' : 'text-blue-600']">{{ formatNumber(engagementAnalytics.sessionData?.totalSessions || 0) }}</div>
                                            <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">Total Sessions</div>
                                        </div>
                                        <div :class="['text-center p-4 rounded-lg', isDarkMode ? 'bg-green-900/30' : 'bg-green-50']">
                                            <div :class="['text-2xl font-bold', isDarkMode ? 'text-green-400' : 'text-green-600']">{{ Math.round(engagementAnalytics.sessionData?.averageDuration || 0) }}</div>
                                            <div :class="['text-sm', isDarkMode ? 'text-gray-400' : 'text-gray-600']">Avg Duration (min)</div>
                                        </div>
                                    </div>
                                </CardContent>
                            </Card>

                            <!-- Peak Hours -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Peak Activity Hours</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div v-if="engagementAnalytics.peakHours && engagementAnalytics.peakHours.length" class="space-y-2">
                                        <div v-for="hour in engagementAnalytics.peakHours.slice(0, 8)" :key="hour.hour" 
                                             :class="['flex justify-between items-center p-2 rounded', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                            <span :class="['text-sm', isDarkMode ? 'text-gray-300' : '']">{{ hour.hour }}:00</span>
                                            <span :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ hour.sessions }} sessions</span>
                                        </div>
                                    </div>
                                    <div v-else :class="['text-center py-8', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                                        No peak hours data available
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </TabsContent>

                    <!-- Performance Analytics -->
                    <TabsContent value="performance" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <!-- Assessment Scores -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Assessment Performance</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div class="text-center p-6">
                                        <div :class="['text-4xl font-bold mb-2', isDarkMode ? 'text-blue-400' : 'text-blue-600']">
                                            {{ Math.round(performanceAnalytics.assessmentScores?.averageScore || 0) }}%
                                        </div>
                                        <div :class="isDarkMode ? 'text-gray-400' : 'text-gray-600'">Average Score</div>
                                    </div>
                                </CardContent>
                            </Card>

                            <!-- Score Distribution -->
                            <Card :class="isDarkMode ? 'bg-gray-800 border-gray-700' : ''">
                                <CardHeader>
                                    <CardTitle :class="isDarkMode ? 'text-white' : ''">Score Distribution</CardTitle>
                                </CardHeader>
                                <CardContent>
                                    <div v-if="performanceAnalytics.assessmentScores?.scoreDistribution && performanceAnalytics.assessmentScores.scoreDistribution.length" class="space-y-3">
                                        <div v-for="range in performanceAnalytics.assessmentScores.scoreDistribution" :key="range.score_range" 
                                             :class="['flex items-center justify-between p-3 rounded-lg', isDarkMode ? 'bg-gray-700' : 'bg-gray-50']">
                                            <span :class="['font-medium', isDarkMode ? 'text-white' : '']">{{ range.score_range }}%</span>
                                            <span :class="isDarkMode ? 'text-gray-400' : 'text-gray-600'">{{ range.count }} students</span>
                                        </div>
                                    </div>
                                    <div v-else :class="['text-center py-8', isDarkMode ? 'text-gray-400' : 'text-gray-500']">
                                        No score distribution data available
                                    </div>
                                </CardContent>
                            </Card>
                        </div>
                    </TabsContent>
                </Tabs>
            </div>
        </div>
    </AdminLayout>
</template>