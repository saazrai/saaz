<template>

    <Head>
        <title>Features | Saaz Academy</title>
        <meta name="description"
            content="Discover Saaz Academy's comprehensive features for online learning and professional development." />
    </Head>

    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <div class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 text-white py-24">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <h1 class="text-5xl font-bold mb-6">Powerful Learning Features</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Discover the comprehensive tools and features that make Saaz Academy
                    the perfect platform for your professional development journey.
                </p>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="max-w-6xl mx-auto px-6 py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Interactive Learning -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Interactive Learning</h3>
                    <p class="text-gray-600">
                        Engage with hands-on exercises, quizzes, and real-world projects
                        that reinforce your understanding and build practical skills.
                    </p>
                </div>

                <!-- Progress Tracking -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Progress Tracking</h3>
                    <p class="text-gray-600">
                        Monitor your learning journey with detailed analytics, completion rates,
                        and personalized recommendations for improvement.
                    </p>
                </div>

                <!-- Expert Instructors -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Expert Instructors</h3>
                    <p class="text-gray-600">
                        Learn from industry professionals with years of experience
                        and proven track records in their respective fields.
                    </p>
                </div>

                <!-- Mobile Learning -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a1 1 0 001-1V4a1 1 0 00-1-1H8a1 1 0 00-1 1v16a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Mobile Learning</h3>
                    <p class="text-gray-600">
                        Access your courses anytime, anywhere with our mobile-optimized
                        platform that works seamlessly across all devices.
                    </p>
                </div>

                <!-- Certificates -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Certificates</h3>
                    <p class="text-gray-600">
                        Earn industry-recognized certificates upon course completion
                        to showcase your new skills to employers and clients.
                    </p>
                </div>

                <!-- Community Support -->
                <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-4">Community Support</h3>
                    <p class="text-gray-600">
                        Connect with fellow learners, participate in discussions,
                        and get help from our supportive learning community.
                    </p>
                </div>
            </div>
        </div>

        <!-- Additional Features Section -->
        <div class="bg-white py-16">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-12">Why Choose Saaz Academy?</h2>
                <div class="grid md:grid-cols-2 gap-8 text-left">
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">✓ Lifetime Access</h3>
                        <p class="text-gray-600">Once enrolled, access your courses forever with free updates and new
                            content.</p>

                        <h3 class="text-lg font-semibold">✓ Downloadable Resources</h3>
                        <p class="text-gray-600">Get PDFs, code samples, and additional materials to support your
                            learning.</p>

                        <h3 class="text-lg font-semibold">✓ Multi-language Support</h3>
                        <p class="text-gray-600">Courses available in multiple languages to serve our global community.
                        </p>
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-lg font-semibold">✓ 30-Day Money Back</h3>
                        <p class="text-gray-600">Not satisfied? Get a full refund within 30 days, no questions asked.
                        </p>

                        <h3 class="text-lg font-semibold">✓ Regular Updates</h3>
                        <p class="text-gray-600">Stay current with industry trends through regularly updated course
                            content.</p>

                        <h3 class="text-lg font-semibold">✓ Career Support</h3>
                        <p class="text-gray-600">Access career guidance, job placement assistance, and networking
                            opportunities.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-16">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h2 class="text-3xl font-bold mb-6">Ready to Start Learning?</h2>
                <p class="text-xl text-blue-100 mb-8">
                    Join thousands of learners who have transformed their careers with Saaz Academy.
                </p>
                <Link :href="safeRoute('catalog.courses.index', '/catalog/courses')"
                    class="inline-block bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Browse Courses
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import Layout from '@/layouts/AppLayout.vue';
import { safeRoute } from '@/utils/route-helper';

defineOptions({
    layout: Layout,
});
</script>
