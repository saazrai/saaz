<template>
    <Head>
        <title>About Us | Saaz Academy</title>
        <meta name="description"
            content="Learn about Saaz Academy's mission to provide enterprise-grade diagnostic assessments and professional development solutions." />
    </Head>

    <div class="min-h-screen bg-gradient-dark">
        <!-- Hero Section with improved styling -->
        <div class="relative overflow-hidden">
            <!-- Animated background elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-500 rounded-full opacity-10 blur-3xl animate-pulse"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-500 rounded-full opacity-10 blur-3xl animate-pulse-slow"></div>
            </div>
            
            <div class="relative py-32 px-6">
                <div class="max-w-6xl mx-auto text-center">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white">
                        About <span class="text-gradient">Saaz Academy</span>
                    </h1>
                    <p class="text-xl md:text-2xl text-gray-300 max-w-3xl mx-auto">
                        Empowering organizations with enterprise diagnostic assessments through our SecureStart™ platform.
                    </p>
                </div>
            </div>
        </div>

        <!-- Mission Section with better visual hierarchy -->
        <div class="py-20 px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl font-bold mb-8 text-white">
                            Our <span class="text-gradient">Mission</span>
                        </h2>
                        <div class="space-y-6">
                            <p class="text-lg text-gray-300 leading-relaxed">
                                At Saaz Academy, we're dedicated to providing organizations with comprehensive diagnostic tools that help identify strengths, gaps, and opportunities for growth.
                            </p>
                            <p class="text-lg text-gray-300 leading-relaxed">
                                Our SecureStart™ platform delivers enterprise-grade assessments that enable data-driven decisions and strategic planning for professional development.
                            </p>
                            <p class="text-lg text-gray-300 leading-relaxed">
                                We believe in empowering teams with insights that drive meaningful improvements in skills, processes, and organizational effectiveness.
                            </p>
                        </div>
                    </div>
                    
                    <!-- Features card with glassmorphism effect -->
                    <div class="glass-card p-8">
                        <div class="space-y-8">
                            <div class="flex items-start space-x-4">
                                <div class="feature-icon-wrapper bg-blue-500/20">
                                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-2">Enterprise-Ready</h3>
                                    <p class="text-gray-400">Built for organizations of all sizes</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="feature-icon-wrapper bg-green-500/20">
                                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-2">Data-Driven Insights</h3>
                                    <p class="text-gray-400">Comprehensive analytics and reporting</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-4">
                                <div class="feature-icon-wrapper bg-purple-500/20">
                                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white mb-2">Secure & Compliant</h3>
                                    <p class="text-gray-400">Industry-standard security practices</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Values Section with modern card design -->
        <div class="py-20 px-6">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-4xl font-bold text-center mb-16 text-white">
                    Our Core <span class="text-gradient">Values</span>
                </h2>
                
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Excellence Card -->
                    <div class="value-card group">
                        <div class="value-icon-wrapper bg-linear-to-br from-blue-500/20 to-cyan-500/20 group-hover:from-blue-500/30 group-hover:to-cyan-500/30">
                            <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Excellence</h3>
                        <p class="text-gray-400 leading-relaxed">
                            We strive for excellence in every assessment, report, and interaction with our clients.
                        </p>
                    </div>
                    
                    <!-- Integrity Card -->
                    <div class="value-card group">
                        <div class="value-icon-wrapper bg-linear-to-br from-green-500/20 to-emerald-500/20 group-hover:from-green-500/30 group-hover:to-emerald-500/30">
                            <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Integrity</h3>
                        <p class="text-gray-400 leading-relaxed">
                            We maintain the highest standards of integrity in data handling, analysis, and recommendations.
                        </p>
                    </div>
                    
                    <!-- Innovation Card -->
                    <div class="value-card group">
                        <div class="value-icon-wrapper bg-linear-to-br from-purple-500/20 to-pink-500/20 group-hover:from-purple-500/30 group-hover:to-pink-500/30">
                            <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white mb-4">Innovation</h3>
                        <p class="text-gray-400 leading-relaxed">
                            We continuously innovate to provide cutting-edge diagnostic tools and insights.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section with stunning gradient -->
        <div class="relative py-24 px-6 overflow-hidden">
            <!-- Gradient background -->
            <div class="absolute inset-0 bg-linear-to-br from-blue-600/90 to-purple-600/90"></div>
            
            <!-- Pattern overlay -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 pattern-overlay"></div>
            </div>
            
            <div class="relative max-w-4xl mx-auto text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-white">
                    Ready to Transform Your Organization?
                </h2>
                <p class="text-xl text-white/90 mb-10 max-w-2xl mx-auto">
                    Discover how SecureStart™ can provide the insights you need for strategic growth.
                </p>
                <Link :href="safeRoute('assessments.diagnostics.index', '/diagnostics')"
                    class="inline-flex items-center px-8 py-4 text-lg font-semibold text-gray-900 bg-white rounded-full hover:bg-gray-100 transform hover:scale-105 transition-all duration-200 shadow-xl">
                    Get Started with SecureStart™
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { safeRoute } from '@/utils/route-helper';

defineOptions({
    layout: AppLayout,
});
</script>

<style scoped>
/* Dark gradient background */
.bg-gradient-dark {
    background: linear-gradient(to bottom, #0f0f23, #1a1a2e);
}

/* Text gradient effect */
.text-gradient {
    background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Glassmorphism card */
.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
}

/* Value cards with hover effect */
.value-card {
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    transition: all 0.3s ease;
}

.value-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-5px);
}

/* Icon wrappers */
.feature-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.value-icon-wrapper {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

/* Animation utilities */
@keyframes pulse-slow {
    0%, 100% {
        opacity: 0.1;
    }
    50% {
        opacity: 0.2;
    }
}

.animate-pulse-slow {
    animation: pulse-slow 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Responsive grid adjustments */
@media (max-width: 1024px) {
    .lg\:grid-cols-3 {
        grid-template-columns: 1fr;
    }
    
    .lg\:grid-cols-2 {
        grid-template-columns: 1fr;
    }
}

/* Spacing utilities */
.space-y-6 > * + * {
    margin-top: 1.5rem;
}

.space-y-8 > * + * {
    margin-top: 2rem;
}

.space-x-4 > * + * {
    margin-left: 1rem;
}

/* Grid utilities */
.grid {
    display: grid;
}

.gap-8 {
    gap: 2rem;
}

.gap-16 {
    gap: 4rem;
}

/* Flexbox utilities */
.flex {
    display: flex;
}

.inline-flex {
    display: inline-flex;
}

.items-center {
    align-items: center;
}

.items-start {
    align-items: flex-start;
}

.justify-center {
    justify-content: center;
}

/* Position utilities */
.relative {
    position: relative;
}

.absolute {
    position: absolute;
}

.inset-0 {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

/* Size utilities */
.w-5 { width: 1.25rem; }
.h-5 { height: 1.25rem; }
.w-6 { width: 1.5rem; }
.h-6 { height: 1.5rem; }
.w-8 { width: 2rem; }
.h-8 { height: 2rem; }
.w-80 { width: 20rem; }
.h-80 { height: 20rem; }

/* Text utilities */
.text-center { text-align: center; }
.text-white { color: white; }
.text-gray-300 { color: #d1d5db; }
.text-gray-400 { color: #9ca3af; }
.text-gray-900 { color: #111827; }
.font-bold { font-weight: 700; }
.font-semibold { font-weight: 600; }
.leading-relaxed { line-height: 1.625; }

/* Text sizes */
.text-lg { font-size: 1.125rem; }
.text-xl { font-size: 1.25rem; }
.text-2xl { font-size: 1.5rem; }
.text-4xl { font-size: 2.25rem; }
.text-5xl { font-size: 3rem; }
.text-6xl { font-size: 3.75rem; }

/* Margin utilities */
.mb-2 { margin-bottom: 0.5rem; }
.mb-4 { margin-bottom: 1rem; }
.mb-6 { margin-bottom: 1.5rem; }
.mb-8 { margin-bottom: 2rem; }
.mb-10 { margin-bottom: 2.5rem; }
.mb-16 { margin-bottom: 4rem; }
.ml-2 { margin-left: 0.5rem; }
.mx-auto { margin-left: auto; margin-right: auto; }

/* Padding utilities */
.p-8 { padding: 2rem; }
.px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
.px-8 { padding-left: 2rem; padding-right: 2rem; }
.py-4 { padding-top: 1rem; padding-bottom: 1rem; }
.py-20 { padding-top: 5rem; padding-bottom: 5rem; }
.py-24 { padding-top: 6rem; padding-bottom: 6rem; }
.py-32 { padding-top: 8rem; padding-bottom: 8rem; }

/* Max width utilities */
.max-w-2xl { max-width: 42rem; }
.max-w-3xl { max-width: 48rem; }
.max-w-4xl { max-width: 56rem; }
.max-w-6xl { max-width: 72rem; }
.max-w-7xl { max-width: 80rem; }

/* Border radius utilities */
.rounded-full { border-radius: 9999px; }
.rounded-2xl { border-radius: 1rem; }

/* Effects */
.shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }
.blur-3xl { filter: blur(64px); }

/* Transform utilities */
.transform { transform: translateZ(0); }
.hover\:scale-105:hover { transform: scale(1.05); }

/* Transition utilities */
.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

.duration-200 {
    transition-duration: 200ms;
}

/* Overflow utilities */
.overflow-hidden { overflow: hidden; }

/* Opacity utilities */
.opacity-10 { opacity: 0.1; }
.opacity-90 { opacity: 0.9; }

/* Background utilities */
.bg-white { background-color: white; }
.bg-blue-500 { background-color: #3b82f6; }
.bg-purple-500 { background-color: #8b5cf6; }
.bg-blue-400 { background-color: #60a5fa; }
.bg-green-400 { background-color: #4ade80; }
.bg-purple-400 { background-color: #c084fc; }

/* Hover utilities */
.hover\:bg-gray-100:hover { background-color: #f3f4f6; }

/* Responsive text sizes */
@media (min-width: 768px) {
    .md\:text-2xl { font-size: 1.5rem; }
    .md\:text-5xl { font-size: 3rem; }
    .md\:text-6xl { font-size: 3.75rem; }
}

/* Mobile adjustments */
@media (max-width: 768px) {
    .value-card {
        margin-bottom: 1.5rem;
    }
    
    .py-32 {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }
}

/* Background gradient utilities */
.bg-linear-to-br {
    background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
}

.from-blue-500\/20 { --tw-gradient-from: rgba(59, 130, 246, 0.2); }
.to-cyan-500\/20 { --tw-gradient-to: rgba(6, 182, 212, 0.2); }
.from-green-500\/20 { --tw-gradient-from: rgba(34, 197, 94, 0.2); }
.to-emerald-500\/20 { --tw-gradient-to: rgba(16, 185, 129, 0.2); }
.from-purple-500\/20 { --tw-gradient-from: rgba(139, 92, 246, 0.2); }
.to-pink-500\/20 { --tw-gradient-to: rgba(236, 72, 153, 0.2); }
.from-blue-600\/90 { --tw-gradient-from: rgba(37, 99, 235, 0.9); }
.to-purple-600\/90 { --tw-gradient-to: rgba(124, 58, 237, 0.9); }

/* Hover gradient states */
.group:hover .group-hover\:from-blue-500\/30 { --tw-gradient-from: rgba(59, 130, 246, 0.3); }
.group:hover .group-hover\:to-cyan-500\/30 { --tw-gradient-to: rgba(6, 182, 212, 0.3); }
.group:hover .group-hover\:from-green-500\/30 { --tw-gradient-from: rgba(34, 197, 94, 0.3); }
.group:hover .group-hover\:to-emerald-500\/30 { --tw-gradient-to: rgba(16, 185, 129, 0.3); }
.group:hover .group-hover\:from-purple-500\/30 { --tw-gradient-from: rgba(139, 92, 246, 0.3); }
.group:hover .group-hover\:to-pink-500\/30 { --tw-gradient-to: rgba(236, 72, 153, 0.3); }

/* Position utilities for background elements */
.-top-40 { top: -10rem; }
.-right-40 { right: -10rem; }
.-bottom-40 { bottom: -10rem; }
.-left-40 { left: -10rem; }

/* Text color with opacity */
.text-white\/90 { color: rgba(255, 255, 255, 0.9); }
</style>