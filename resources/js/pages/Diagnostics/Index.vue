<template>
    <div>
        <Head>
            <title>SecureStart™ Diagnostic - Cybersecurity Skills Assessment | Saaz Academy</title>
            <meta name="description" content="Evaluate your cybersecurity expertise across 20 critical domains with our comprehensive diagnostic assessment. Get personalized learning recommendations and career insights." />
            <meta name="keywords" content="cybersecurity assessment, security skills test, CISSP preparation, security diagnostic, cybersecurity certification" />
        </Head>
        
        <div class="container mx-auto p-4 max-w-6xl">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">SecureStart™ Diagnostic</h1>
                <p class="text-xl text-gray-600 dark:text-gray-300">Evaluate your expertise across 20 critical cybersecurity domains</p>
                
                <!-- Quick Start Apple UI/UX Test Button -->
                <div class="mt-6">
                    <button 
                        @click="startDiagnostic('standard')"
                        class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-full hover:from-blue-700 hover:to-purple-700 transition-all transform hover:scale-105 shadow-lg"
                    >
                        🚀 Start Apple-Style Assessment (V1 Enhanced)
                    </button>
                </div>
            </div>

            <!-- Assessment Overview -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-800 rounded-lg p-8 mb-8 border border-blue-200 dark:border-gray-700">
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-6">About This Assessment</h2>
                <div class="prose prose-lg text-gray-700 dark:text-gray-300 mb-6">
                    <p class="leading-relaxed">
                        SecureStart™ Diagnostic provides comprehensive insights into your cybersecurity knowledge across 20 fundamental domains. Crafted by industry experts using NIST, ISO 27001, and real-world scenarios, this assessment delivers personalized analytics to guide your professional development.
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6 mt-8">
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-600">
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-2">20</div>
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Security Domains</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Covering essential cybersecurity skills</div>
                    </div>
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-600">
                        <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">60-90</div>
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Minutes Duration</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Self-paced with pause capability</div>
                    </div>
                </div>
            </div>

            <!-- Interactive Domain Exploration Section -->
            <div class="mb-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-semibold text-gray-900 dark:text-white mb-4">Explore the 20 SecureStart™ Assessment Domains</h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                        Click on any domain to discover what makes it essential for cybersecurity professionals. Each domain represents critical knowledge areas that drive career success in information security.
                    </p>
                </div>

                <!-- Domain Categories -->
                <div class="mb-8">
                    <div class="flex flex-wrap justify-center gap-4">
                        <button 
                            v-for="category in domainCategories" 
                            :key="category.id"
                            @click="selectedCategory = category.id"
                            :class="[
                                'px-4 py-2 rounded-lg font-medium transition-all duration-200',
                                selectedCategory === category.id 
                                    ? 'bg-blue-600 text-white shadow-md' 
                                    : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
                            ]"
                        >
                            {{ category.name }} ({{ category.count }})
                        </button>
                    </div>
                </div>
                
                <!-- Loading State -->
                <div v-if="loadingDomains" class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div v-for="i in 8" :key="i" class="animate-pulse">
                        <div class="bg-gray-200 dark:bg-gray-700 h-24 rounded-xl"></div>
                    </div>
                </div>

                <!-- Interactive Domain Grid -->
                <div v-else class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div v-for="domain in filteredDomains" :key="domain.id" 
                         @click="openDomainModal(domain)"
                         :class="[
                             'cursor-pointer p-4 rounded-xl shadow-sm border transition-all duration-200',
                             'bg-white dark:bg-gray-800 border-gray-200 dark:border-gray-700 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600'
                         ]">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center flex-1 min-w-0">
                                <div class="w-3 h-3 rounded-full mr-3 flex-shrink-0" :class="domain.colorClass"></div>
                                <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-sm leading-tight">{{ domain.name }}</h3>
                            </div>
                            <div class="ml-2 flex-shrink-0">
                                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Question Count Badge -->
                        <div class="mt-2 flex items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ domain.questionCount }} questions</span>
                            <div class="ml-auto flex items-center space-x-1">
                                <span class="text-xs text-gray-400">{{ domain.weight_percentage }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Diagnostic Methodology</h3>
                    <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-700 dark:text-gray-300">
                        <div>
                            <h4 class="font-medium mb-2 dark:text-gray-200">Industry-Aligned Content</h4>
                            <p>Assessment items based on NIST, ISO 27001, SANS, and other leading cybersecurity frameworks and real-world scenarios.</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-2 dark:text-gray-200">Comprehensive Coverage</h4>
                            <p>Balanced evaluation across technical, operational, and governance aspects of information security.</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-2 dark:text-gray-200">Expert Validated</h4>
                            <p>All content reviewed and validated by certified cybersecurity professionals and industry practitioners.</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-2 dark:text-gray-200">Career Relevance</h4>
                            <p>Assessment reflects current threat landscape and practical challenges faced by security professionals.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assessment Features -->
            <div class="grid md:grid-cols-2 gap-8 mb-10">
                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">What You'll Receive</h3>
                    </div>
                    <ul class="space-y-4 text-gray-700 dark:text-gray-300">
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Comprehensive Security Profile Analysis</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Detailed breakdown of your cybersecurity strengths and knowledge gaps across all 20 security domains</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Personalized Learning Roadmap</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Customized recommendations for cybersecurity training, certifications, and skill development paths</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Industry Benchmarking</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Performance comparison with cybersecurity professionals at similar career levels and specializations</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Career Pathway Alignment</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Analysis of how your profile aligns with various cybersecurity roles and specialization tracks</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Professional Assessment Report</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Comprehensive PDF report suitable for professional development planning and career advancement</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Diagnostic Guidelines</h3>
                    </div>
                    <ul class="space-y-4 text-gray-700 dark:text-gray-300">
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Time Management</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Allocate 60-90 minutes in a quiet environment for optimal focus and accuracy</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Honest Responses</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Answer authentically to ensure results accurately reflect your current capabilities</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Flexible Completion</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Pause and resume functionality allows you to complete the diagnostic at your own pace</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Independent Work</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Complete the diagnostic independently without external resources for valid results</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Technical Requirements</strong>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Stable internet connection and modern browser recommended for optimal experience</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Diagnostic Mode Selection -->
            <div class="mb-12">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-semibold text-gray-900 mb-4">Choose Your Diagnostic Mode</h3>
                    <p class="text-lg text-gray-600">Select the assessment depth that best fits your time and evaluation needs</p>
                </div>
                
                <div class="grid md:grid-cols-4 gap-6 mb-8">
                    <!-- Dynamic Diagnostic Modes -->
                    <div v-for="mode in diagnosticModes" :key="mode.slug" 
                         class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow relative"
                         :class="mode.badge_text ? 'border-2' : 'border border-gray-200'"
                         :style="{ borderColor: mode.badge_text ? getColorValue(mode.color_scheme, '300') : '' }">
                        
                        <div v-if="mode.badge_text" class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                            <span class="text-white text-xs font-bold px-3 py-1 rounded-full"
                                  :style="{ backgroundColor: getColorValue(mode.color_scheme, '500') }">
                                {{ mode.badge_text }}
                            </span>
                        </div>
                        
                        <div class="text-center mb-4">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                                 :style="{ backgroundColor: getColorValue(mode.color_scheme, '100') }">
                                <svg class="w-8 h-8" :style="{ color: getColorValue(mode.color_scheme, '600') }" 
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          :d="getIconPath(mode.icon)"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">{{ mode.name }}</h4>
                            <div class="text-3xl font-bold mb-2" :style="{ color: getColorValue(mode.color_scheme, '600') }">
                                {{ mode.question_count }} Questions
                            </div>
                            <div class="text-sm text-gray-600 mb-2">{{ mode.duration_minutes }} minutes</div>
                            <p class="text-xs text-gray-500 mb-4">{{ mode.description }}</p>
                        </div>
                        
                        <div v-if="mode.features && mode.features.display_features" class="space-y-2 mb-6">
                            <p v-for="(feature, index) in mode.features.display_features" :key="index" class="text-sm text-gray-700 flex items-start">
                                <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ feature }}
                            </p>
                        </div>
                        
                        <div v-if="isAuthenticated">
                            <div v-if="mode.can_retake">
                                <button 
                                    @click="startDiagnostic(mode.slug)"
                                    class="w-full px-6 py-3 text-white font-semibold rounded-lg transition-colors"
                                    :style="{ 
                                        backgroundColor: getColorValue(mode.color_scheme, '600'),
                                        ':hover': { backgroundColor: getColorValue(mode.color_scheme, '700') }
                                    }"
                                    @mouseover="$event.target.style.backgroundColor = getColorValue(mode.color_scheme, '700')"
                                    @mouseout="$event.target.style.backgroundColor = getColorValue(mode.color_scheme, '600')"
                                >
                                    Start {{ mode.name }}
                                </button>
                            </div>
                            <div v-else class="text-center">
                                <div class="bg-gray-100 rounded-lg p-3 mb-2">
                                    <p class="text-sm text-gray-600">Available in:</p>
                                    <p class="text-lg font-semibold text-gray-800">
                                        {{ formatTimeRemaining(mode.time_until_retake) }}
                                    </p>
                                </div>
                                <p class="text-xs text-gray-500">Cooldown period active</p>
                            </div>
                        </div>
                        <div v-else>
                            <Link 
                                :href="typeof route !== 'undefined' ? route('register') : '/register'" 
                                class="block w-full px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition-colors text-center"
                            >
                                Sign Up to Start
                            </Link>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-sm text-gray-600">
                        <strong>Not sure which to choose?</strong> We recommend the Standard Diagnostic for most users. 
                        It provides comprehensive insights while respecting your time investment.
                    </p>
                </div>
            </div>


            <!-- Social Proof Section -->
            <div class="mb-12">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-semibold text-gray-900 dark:text-white mb-4">Built for Cybersecurity Professionals</h3>
                    <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                        Designed to provide accurate assessment and personalized learning paths for your cybersecurity career development
                    </p>
                </div>

                <!-- Assessment Features Section -->
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="text-center">
                        <div class="text-4xl mb-2">📊</div>
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Comprehensive Assessment</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Across all security domains</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-2">🔒</div>
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Professional Focus</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Industry-aligned content</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-2">🚀</div>
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Career Development</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Personalized growth paths</div>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl mb-2">⭐</div>
                        <div class="text-sm font-medium text-gray-600 dark:text-gray-300">Quality Content</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Expert-crafted assessments</div>
                    </div>
                </div>

                <!-- Testimonials Section -->
                <div class="mb-12">
                    <h4 class="text-2xl font-semibold text-gray-900 dark:text-white text-center mb-8">What Security Professionals Say</h4>
                    <div class="grid md:grid-cols-3 gap-8">
                        <!-- Testimonial 1 -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="mb-4">
                                <div class="flex text-yellow-400 mb-2">
                                    <svg v-for="i in 5" :key="i" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                                    "SecureStart™ Diagnostic gave me the confidence to pursue CISSP certification. The detailed analysis helped me identify exactly which domains to focus on."
                                </p>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">SM</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">Sarah Martinez</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Senior Security Analyst</div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="mb-4">
                                <div class="flex text-yellow-400 mb-2">
                                    <svg v-for="i in 5" :key="i" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                                    "The adaptive testing saved me hours of study time by focusing on my weak areas. I passed my Security+ on the first attempt!"
                                </p>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-green-600 dark:text-green-400 font-semibold text-sm">JC</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">James Chen</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">IT Security Specialist</div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700">
                            <div class="mb-4">
                                <div class="flex text-yellow-400 mb-2">
                                    <svg v-for="i in 5" :key="i" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed">
                                    "Finally, an assessment that reflects real-world cybersecurity challenges. The personalized report was incredibly valuable for my career planning."
                                </p>
                            </div>
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-purple-600 dark:text-purple-400 font-semibold text-sm">AR</span>
                                </div>
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">Aisha Rahman</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">CISO, Tech Startup</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges Section -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-8 text-center">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Aligned with Industry Standards</h4>
                    <div class="flex flex-wrap justify-center items-center gap-8">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">NIST Framework</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">ISO 27001</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">(ISC)² CBK</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-orange-600 dark:text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-gray-700 dark:text-gray-300">SANS Training</span>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-4">
                        Our assessments align with globally recognized cybersecurity frameworks and standards
                    </p>
                </div>
            </div>

            <!-- Previous Assessments Section - Only for authenticated users -->
            <div v-if="isAuthenticated">
                <h2 class="text-xl font-semibold mb-3">Previous Assessments</h2>

                <div v-if="diagnosticsHistory.length > 0" class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Answered</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
                            <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="diagnostic in diagnosticsHistory" :key="diagnostic.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ formatDate(diagnostic.created_at) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ diagnostic.status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ diagnostic.score !== null ? diagnostic.score + '%' : 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ diagnostic.responses.length }} / {{ diagnostic.total_questions }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ formatTime(diagnostic.total_duration) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link v-if="diagnostic.status === 'completed'" :href="typeof route !== 'undefined' ? route('assessments.diagnostics.results', { diagnostic: diagnostic.id }) : `/assessments/diagnostics/${diagnostic.id}/results`" class="text-blue-600 hover:text-blue-900 mr-3">Review</Link>
                                <Link v-if="diagnostic.status === 'in_progress' || diagnostic.status === 'paused'" :href="typeof route !== 'undefined' ? route('assessments.diagnostics.show', { diagnostic: diagnostic.id }) : `/assessments/diagnostics/${diagnostic.id}`" class="text-green-600 hover:text-green-900">Resume</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div v-else class="text-gray-600 dark:text-gray-400 text-center mt-4">
                    No previous assessments found.
                </div>
            </div>
        </div>

        <!-- Domain Details Modal using Headless UI -->
        <TransitionRoot appear :show="showDomainModal" as="template">
            <Dialog as="div" @close="closeDomainModal" class="relative z-50">
                <TransitionChild
                    as="template"
                    enter="duration-300 ease-out"
                    enter-from="opacity-0"
                    enter-to="opacity-100"
                    leave="duration-200 ease-in"
                    leave-from="opacity-100"
                    leave-to="opacity-0"
                >
                    <div class="fixed inset-0 bg-black bg-opacity-25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100"
                            leave-to="opacity-0 scale-95"
                        >
                            <DialogPanel class="w-full max-w-2xl transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 p-6 text-left align-middle shadow-xl transition-all">
                                <div v-if="selectedDomainDetails">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <DialogTitle as="h3" class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                                {{ selectedDomainDetails.name }}
                                            </DialogTitle>
                                            <div class="flex items-center space-x-3 mb-3">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" :class="{
                                                    'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200': selectedDomainDetails.category === 'foundational',
                                                    'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200': selectedDomainDetails.category === 'technical',
                                                    'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200': selectedDomainDetails.category === 'managerial'
                                                }">
                                                    {{ selectedDomainDetails.category }}
                                                </span>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ selectedDomainDetails.code }} • {{ selectedDomainDetails.weight_percentage }}% weight
                                                </span>
                                            </div>
                                        </div>
                                        <button @click="closeDomainModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed mb-6">
                                        {{ selectedDomainDetails.description }}
                                    </p>

                                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 mb-6">
                                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Learning Objectives</h4>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            {{ selectedDomainDetails.learning_objectives }}
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                                </svg>
                                                <h5 class="font-medium text-gray-900 dark:text-white">Assessment Details</h5>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ selectedDomainDetails.questionCount }} questions covering Bloom levels {{ selectedDomainDetails.min_bloom_level || 1 }}-{{ selectedDomainDetails.max_bloom_level || 6 }}
                                            </p>
                                        </div>
                                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                            <div class="flex items-center mb-2">
                                                <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h5 class="font-medium text-gray-900 dark:text-white">Priority Level</h5>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Priority {{ selectedDomainDetails.priority_order }} of 20 domains
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button
                                            type="button"
                                            @click="closeDomainModal"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-100 dark:bg-blue-900 px-4 py-2 text-sm font-medium text-blue-900 dark:text-blue-100 hover:bg-blue-200 dark:hover:bg-blue-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                        >
                                            Got it!
                                        </button>
                                    </div>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup lang="ts">
import { Link, router, usePage, Head } from '@inertiajs/vue3';
import { computed, ref, onMounted } from 'vue';
import moment from 'moment';
import AppLayout from "@/layouts/AppLayout.vue";
import { Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue';

const props = defineProps({
    diagnosticModes: {
        type: Array,
        default: () => []
    },
    diagnosticsHistory: {
        type: Array,
        default: () => []
    },
    isAuthenticated: {
        type: Boolean,
        default: false
    },
    domains: {
        type: Array,
        default: () => []
    },
});

// Use the shared auth data from Inertia
const page = usePage();
const isAuthenticated = computed(() => props.isAuthenticated || !!page.props.auth?.user);

// Removed email capture functionality - backend route 'diagnostics.capture-email' was not implemented

// Interactive domain exploration state
const selectedCategory = ref('all');
// const _selectedDomain = ref(null);
const showDomainModal = ref(false);
const selectedDomainDetails = ref(null);
const loadingDomains = ref(true);
const domains = ref([]);

// Layout is now handled by defineOptions at the bottom of the file

// Process domains from props
onMounted(() => {
    if (props.domains && props.domains.length > 0) {
        domains.value = props.domains.map(domain => ({
            ...domain,
            questionCount: 5, // Each domain gets 5 questions
            colorClass: getColorClass(domain.color),
            keyTopics: [], // Will be populated if needed
            careerApplications: [], // Will be populated if needed
            industryRelevance: domain.learning_objectives || domain.description
        }));
    }
    loadingDomains.value = false;
});

// Helper function to convert hex color to Tailwind class
const getColorClass = (hexColor) => {
    const colorMap = {
        '#3B82F6': 'bg-blue-500',
        '#10B981': 'bg-emerald-500', 
        '#8B5CF6': 'bg-purple-500',
        '#EC4899': 'bg-pink-500',
        '#F59E0B': 'bg-amber-500',
        '#6366F1': 'bg-indigo-500',
        '#EF4444': 'bg-red-500',
        '#14B8A6': 'bg-teal-500',
        '#0EA5E9': 'bg-sky-500',
        '#84CC16': 'bg-lime-500',
        '#06B6D4': 'bg-cyan-500',
        '#7C3AED': 'bg-violet-500',
        '#2563EB': 'bg-blue-600',
        '#DC2626': 'bg-red-600',
        '#059669': 'bg-emerald-600',
        '#F97316': 'bg-orange-500',
        '#64748B': 'bg-slate-500',
        '#0891B2': 'bg-cyan-600',
        '#BE123C': 'bg-rose-700',
        '#0F766E': 'bg-teal-700'
    };
    return colorMap[hexColor] || 'bg-gray-500';
};

// Open domain details modal
const openDomainModal = (domain) => {
    selectedDomainDetails.value = domain;
    showDomainModal.value = true;
};

// Close domain details modal  
const closeDomainModal = () => {
    showDomainModal.value = false;
    selectedDomainDetails.value = null;
};


// Computed property for filtering domains by category
const filteredDomains = computed(() => {
    if (loadingDomains.value) return [];
    if (selectedCategory.value === 'all') {
        return domains.value;
    }
    return domains.value.filter(domain => domain.category === selectedCategory.value);
});

// Update domain categories count dynamically
const domainCategories = computed(() => {
    if (loadingDomains.value) return [
        { id: 'all', name: 'All Domains', count: 0 },
        { id: 'foundational', name: 'Foundational', count: 0 },
        { id: 'technical', name: 'Technical Security', count: 0 },
        { id: 'managerial', name: 'Managerial', count: 0 }
    ];
    
    const foundational = domains.value.filter(d => d.category === 'foundational').length;
    const technical = domains.value.filter(d => d.category === 'technical').length;
    const managerial = domains.value.filter(d => d.category === 'managerial').length;
    
    return [
        { id: 'all', name: 'All Domains', count: domains.value.length },
        { id: 'foundational', name: 'Foundational', count: foundational },
        { id: 'technical', name: 'Technical Security', count: technical },
        { id: 'managerial', name: 'Managerial', count: managerial }
    ];
});

const formatDate = (date) => {
    return moment(date).format('YYYY-MM-DD HH:mm');
};

const formatTime = (seconds) => {
    if (seconds === null || seconds === undefined) {
        return 'N/A';
    }
    const h = Math.floor(seconds / 3600).toString().padStart(2, '0');
    const m = Math.floor((seconds % 3600) / 60).toString().padStart(2, '0');
    const s = Math.floor(seconds % 60).toString().padStart(2, '0');
    return `${h}:${m}:${s}`;
};

const startDiagnostic = (mode) => {
    // Go directly to Apple UI/UX QuizApple component
    router.visit(typeof route !== 'undefined' ? route('assessments.diagnostics.begin') : `/assessments/diagnostics/begin`, {
        method: 'post',
        data: { mode: mode }
    });
};

// Helper methods for dynamic UI
const getColorValue = (colorScheme, shade) => {
    const colors = {
        orange: {
            '100': '#fed7aa',
            '300': '#fdba74',
            '500': '#f97316',
            '600': '#ea580c',
            '700': '#c2410c'
        },
        green: {
            '100': '#bbf7d0',
            '300': '#86efac',
            '500': '#22c55e',
            '600': '#16a34a',
            '700': '#15803d'
        },
        blue: {
            '100': '#dbeafe',
            '300': '#93c5fd',
            '500': '#3b82f6',
            '600': '#2563eb',
            '700': '#1d4ed8'
        },
        purple: {
            '100': '#e9d5ff',
            '300': '#c084fc',
            '500': '#a855f7',
            '600': '#9333ea',
            '700': '#7e22ce'
        }
    };
    
    return colors[colorScheme]?.[shade] || colors.blue[shade];
};

const getIconPath = (iconName) => {
    const icons = {
        'beaker': 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
        'lightning-bolt': 'M13 10V3L4 14h7v7l9-11h-7z',
        'check-circle': 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'clipboard-list': 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'
    };
    
    return icons[iconName] || icons['check-circle'];
};

const formatTimeRemaining = (timeData) => {
    if (!timeData) return '';
    return timeData.formatted || `${timeData.hours}h ${timeData.minutes}m`;
};

// Removed email capture functionality - backend route was not implemented

// Set the layout for this page
defineOptions({
    layout: AppLayout
});
</script>

<style scoped>
/* Add any specific styles for the table or layout here */
</style>
