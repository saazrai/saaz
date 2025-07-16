<template>
    <div class="min-h-screen bg-gray-900 transition-colors duration-300">
        <Head>
            <title>Saaz Academy - Master Cybersecurity & Advance Your Career</title>
            <meta name="description" content="Learn cybersecurity from industry experts. Personalized learning paths, real-world simulations, and comprehensive certification preparation." />
        </Head>

        <!-- HERO SECTION -->
        <section class="relative overflow-hidden">
            <!-- Animated Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
                <div class="absolute inset-0">
                    <!-- Animated gradient orbs -->
                    <div class="absolute top-0 -left-4 w-96 h-96 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob"></div>
                    <div class="absolute -top-4 -right-4 w-96 h-96 bg-gradient-to-r from-purple-500/20 to-pink-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000"></div>
                    <div class="absolute -bottom-8 left-20 w-96 h-96 bg-gradient-to-r from-pink-500/20 to-blue-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-4000"></div>
                    
                    <!-- Grid pattern overlay -->
                    <div class="absolute inset-0 opacity-10" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;)"></div>
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-20">
                <div class="text-center">
                    <!-- Animated Badge -->
                    <div class="inline-flex items-center px-4 py-2 mb-8 bg-blue-900/30 backdrop-blur-sm border border-blue-800 rounded-full animate-fade-in-up">
                        <span class="relative flex h-3 w-3 mr-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                        </span>
                        <span class="text-sm font-medium text-blue-200">
                            Professional Cybersecurity Training
                        </span>
                    </div>

                    <!-- Main Heading with Gradient Animation -->
                    <h1 class="text-5xl md:text-7xl font-bold tracking-tight mb-8 animate-fade-in-up animation-delay-200">
                        <span class="block text-white mb-2">
                            Master Cybersecurity
                        </span>
                        <span class="block bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent bg-300% animate-gradient">
                            Advance Your Career
                        </span>
                    </h1>

                    <!-- Subheading -->
                    <p class="max-w-3xl mx-auto text-xl md:text-2xl text-gray-300 mb-12 leading-relaxed animate-fade-in-up animation-delay-400">
                        Professional cybersecurity assessment platform with 
                        <span class="font-semibold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">enterprise-grade diagnostics</span>, 
                        compliance tools, and comprehensive reporting for security professionals.
                    </p>

                    <!-- CTA Buttons with Hover Effects -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16 animate-fade-in-up animation-delay-600">
                        <Link
                            :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                            class="group relative px-8 py-4 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold text-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-purple-700 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                            <span class="relative flex items-center">
                                Start Free Assessment
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                        </Link>
                        <Link
                            :href="typeof route !== 'undefined' ? route('info.features') : '/features'"
                            class="group px-8 py-4 rounded-2xl border-2 border-gray-600 text-gray-300 font-semibold text-lg hover:border-purple-400 hover:text-purple-400 transition-all duration-300 bg-gray-800/50 backdrop-blur-sm"
                        >
                            <span class="flex items-center">
                                View Features
                                <svg class="w-5 h-5 ml-2 opacity-0 group-hover:opacity-100 transform translate-x-0 group-hover:translate-x-1 transition-all duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </span>
                        </Link>
                    </div>

                    <!-- Animated Stats -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto animate-fade-in-up animation-delay-800">
                        <div class="text-center group">
                            <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform">
                                <svg class="w-12 h-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                            <div class="text-gray-400 text-sm md:text-base font-medium">Expert Content</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform">
                                <svg class="w-12 h-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="text-gray-400 text-sm md:text-base font-medium">Compliance</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-pink-600 to-blue-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform">
                                <svg class="w-12 h-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                </svg>
                            </div>
                            <div class="text-gray-400 text-sm md:text-base font-medium">Assessment</div>
                        </div>
                        <div class="text-center group">
                            <div class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent mb-2 group-hover:scale-110 transition-transform">
                                <svg class="w-12 h-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z" />
                                </svg>
                            </div>
                            <div class="text-gray-400 text-sm md:text-base font-medium">Support</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
                <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </section>

        <!-- FEATURES SECTION -->
        <section class="py-24 bg-gray-800/50 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Why Industry Leaders Choose Us
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Experience the future of cybersecurity education with our innovative platform
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                        <div class="relative p-8 bg-gray-800 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-4">
                                Comprehensive Analytics
                            </h3>
                            <p class="text-gray-300 leading-relaxed">
                                Detailed performance metrics and skill gap analysis for security professionals
                            </p>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                        <div class="relative p-8 bg-gray-800 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-4">
                                Enterprise Security
                            </h3>
                            <p class="text-gray-300 leading-relaxed">
                                GDPR, SOX, HIPAA compliance tools with audit logging and privacy management
                            </p>
                        </div>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-600 to-blue-600 rounded-3xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                        <div class="relative p-8 bg-gray-800 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-14 h-14 bg-gradient-to-r from-pink-500 to-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-4">
                                Professional Reports
                            </h3>
                            <p class="text-gray-300 leading-relaxed">
                                Detailed assessment reports with actionable insights and recommendations
                            </p>
                        </div>
                    </div>

                    <!-- Feature Card 4 -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-green-600 to-blue-600 rounded-3xl blur-xl opacity-20 group-hover:opacity-30 transition-opacity duration-300"></div>
                        <div class="relative p-8 bg-gray-800 rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-blue-500 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A8.998 8.998 0 1112 2.246a9 9 0 019 11.009zM12 12v6m0 0l-3-3m3 3l3-3" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-white mb-4">
                                Real-Time Results
                            </h3>
                            <p class="text-gray-300 leading-relaxed">
                                Instant feedback and performance tracking during assessments
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- DIAGNOSTIC FOCUS SECTION -->
        <section class="py-24 bg-gray-900 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Enterprise Diagnostic Platform
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        Professional cybersecurity assessment and compliance tools
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    <!-- CISSP Diagnostic Card -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl opacity-75 blur-xl group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl overflow-hidden">
                            <!-- Badge -->
                            <div class="absolute top-4 right-4 px-3 py-1 bg-yellow-500 text-gray-900 text-sm font-bold rounded-full">
                                Core Feature
                            </div>
                            
                            <!-- Content -->
                            <div class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-3xl font-bold text-white mb-2">CISSP Diagnostic</h3>
                                    <p class="text-gray-400">Comprehensive Assessment Platform</p>
                                </div>
                                
                                <div class="space-y-4 mb-8">
                                    <div class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Real-time Assessment</span>
                                    </div>
                                    <div class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Detailed Analytics</span>
                                    </div>
                                    <div class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Professional Reports</span>
                                    </div>
                                </div>
                                
                                <Link
                                    :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                                    class="block w-full text-center bg-white text-gray-900 font-bold py-3 rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105"
                                >
                                    Start Diagnostic
                                </Link>
                            </div>
                        </div>
                    </div>

                    <!-- Enterprise Compliance Card -->
                    <div class="group relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 rounded-3xl opacity-75 blur-xl group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl overflow-hidden">
                            <!-- Badge -->
                            <div class="absolute top-4 right-4 px-3 py-1 bg-purple-500 text-white text-sm font-bold rounded-full">
                                Enterprise
                            </div>
                            
                            <!-- Content -->
                            <div class="p-8">
                                <div class="mb-8">
                                    <h3 class="text-3xl font-bold text-white mb-2">Compliance</h3>
                                    <p class="text-gray-400">GDPR, SOX, HIPAA Ready</p>
                                </div>
                                
                                <div class="space-y-4 mb-8">
                                    <div class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Privacy Management</span>
                                    </div>
                                    <div class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Audit Logging</span>
                                    </div>
                                    <div class="flex items-center text-gray-300">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span>Enterprise Security</span>
                                    </div>
                                </div>
                                
                                <Link
                                    :href="typeof route !== 'undefined' ? route('privacy.settings') : '/privacy/settings'"
                                    class="block w-full text-center bg-white text-gray-900 font-bold py-3 rounded-xl hover:bg-gray-100 transition-all duration-300 transform hover:scale-105"
                                >
                                    View Privacy
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TESTIMONIALS -->
        <section class="py-24 bg-gray-800/50 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-20">
                    <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                        Success Stories
                    </h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                        See what our learners have to say about their experience
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="relative">
                        <div class="absolute top-0 left-0 text-8xl text-blue-800 opacity-50 font-serif">
                            "
                        </div>
                        <div class="relative bg-gray-800 p-8 rounded-3xl shadow-lg">
                            <div class="flex mb-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" v-for="i in 5" :key="i">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-300 mb-6 italic">
                                The diagnostic assessment provided clear insights into my security knowledge gaps. The detailed reports helped me understand exactly where to focus.
                            </p>
                            <div class="flex items-center">
                                <img class="w-12 h-12 rounded-full mr-4" src="https://ui-avatars.com/api/?name=Sarah+Johnson&background=3B82F6&color=fff" alt="Sarah Johnson">
                                <div>
                                    <div class="font-semibold text-white">Sarah Johnson</div>
                                    <div class="text-gray-400 text-sm">Security Professional</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="relative">
                        <div class="absolute top-0 left-0 text-8xl text-purple-800 opacity-50 font-serif">
                            "
                        </div>
                        <div class="relative bg-gray-800 p-8 rounded-3xl shadow-lg">
                            <div class="flex mb-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" v-for="i in 5" :key="i">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-300 mb-6 italic">
                                The enterprise compliance features are exactly what we needed. Audit logging and privacy management tools save us significant time.
                            </p>
                            <div class="flex items-center">
                                <img class="w-12 h-12 rounded-full mr-4" src="https://ui-avatars.com/api/?name=Michael+Chen&background=A855F7&color=fff" alt="Michael Chen">
                                <div>
                                    <div class="font-semibold text-white">Michael Chen</div>
                                    <div class="text-gray-400 text-sm">Cloud Security Specialist</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="relative">
                        <div class="absolute top-0 left-0 text-8xl text-green-800 opacity-50 font-serif">
                            "
                        </div>
                        <div class="relative bg-gray-800 p-8 rounded-3xl shadow-lg">
                            <div class="flex mb-4">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" v-for="i in 5" :key="i">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-300 mb-6 italic">
                                The diagnostic assessments give me confidence in my preparation. The detailed reporting shows exactly where I need to focus.
                            </p>
                            <div class="flex items-center">
                                <img class="w-12 h-12 rounded-full mr-4" src="https://ui-avatars.com/api/?name=Emily+Rodriguez&background=10B981&color=fff" alt="Emily Rodriguez">
                                <div>
                                    <div class="font-semibold text-white">Emily Rodriguez</div>
                                    <div class="text-gray-400 text-sm">Security Analyst</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FINAL CTA -->
        <section class="relative py-24 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600"></div>
            <div class="absolute inset-0 opacity-10" style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFFFFF' fill-opacity='0.3'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;)"></div>
            
            <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6">
                    Ready to Level Up Your Career?
                </h2>
                <p class="text-xl text-blue-100 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Start your cybersecurity journey today with professional diagnostics and enterprise compliance tools
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <Link
                        :href="typeof route !== 'undefined' ? route('register') : '/register'"
                        class="group px-8 py-4 bg-white text-purple-600 font-bold rounded-2xl hover:bg-gray-100 transition-all duration-300 text-lg shadow-lg transform hover:scale-105"
                    >
                        <span class="flex items-center">
                            Start Free Today
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </Link>
                    <Link
                        :href="typeof route !== 'undefined' ? route('assessments.diagnostics.index') : '/diagnostics'"
                        class="px-8 py-4 border-2 border-white text-white font-semibold rounded-2xl hover:bg-white hover:text-purple-600 transition-all duration-300 text-lg"
                    >
                        Take Free Assessment
                    </Link>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup lang="ts">
import { Link, Head } from "@inertiajs/vue3";
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean
});

defineOptions({ layout: AppLayout });
</script>

<style scoped>
/* Blob animation */
@keyframes blob {
    0% {
        transform: translate(0px, 0px) scale(1);
    }
    33% {
        transform: translate(30px, -50px) scale(1.1);
    }
    66% {
        transform: translate(-20px, 20px) scale(0.9);
    }
    100% {
        transform: translate(0px, 0px) scale(1);
    }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Gradient animation */
@keyframes gradient {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

.animate-gradient {
    background-size: 300%;
    animation: gradient 6s ease infinite;
}

/* Fade in animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out forwards;
}

.animation-delay-200 {
    animation-delay: 0.2s;
    opacity: 0;
}

.animation-delay-400 {
    animation-delay: 0.4s;
    opacity: 0;
}

.animation-delay-600 {
    animation-delay: 0.6s;
    opacity: 0;
}

.animation-delay-800 {
    animation-delay: 0.8s;
    opacity: 0;
}

/* Background size utility */
.bg-300\% {
    background-size: 300%;
}
</style>