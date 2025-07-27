<template>
    <AppLayout>
        <div class="container mx-auto p-4 max-w-6xl">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">SecureStart™ Diagnostic</h1>
                <p class="text-xl text-gray-600">Evaluate your expertise across 20 critical cybersecurity domains</p>
            </div>

            <!-- Assessment Overview -->
            <div class="bg-linear-to-r from-blue-50 to-indigo-50 rounded-lg p-8 mb-8 border border-blue-200">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">About This Assessment</h2>
                <div class="prose prose-lg text-gray-700 mb-6">
                    <p class="leading-relaxed mb-4">
                        SecureStart™ Diagnostic represents a breakthrough in information security evaluation, designed by cybersecurity experts and practitioners to provide unprecedented insights into your security knowledge and capabilities across 20 fundamental cybersecurity domains. This isn't just a test—it's a sophisticated security competency mapping tool that reveals how you understand, analyze, and respond to modern cybersecurity challenges.
                    </p>
                    <p class="leading-relaxed mb-4">
                        Each assessment item has been meticulously crafted through rigorous research and validation processes, drawing from industry standards like NIST, ISO 27001, and real-world security scenarios. The diagnostic employs adaptive questioning techniques, ensuring that every item contributes meaningfully to your overall security profile assessment.
                    </p>
                    <p class="leading-relaxed">
                        Upon completion, you'll receive a detailed analytical report that goes far beyond traditional scoring. Our advanced algorithms analyze your response patterns across security domains to generate actionable insights for your cybersecurity career development and professional growth.
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6 mt-8">
                    <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-100">
                        <div class="text-3xl font-bold text-green-600 mb-2">20</div>
                        <div class="text-sm font-medium text-gray-600">Security Domains</div>
                        <div class="text-xs text-gray-500 mt-1">Covering essential cybersecurity skills</div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-xs border border-gray-100">
                        <div class="text-3xl font-bold text-purple-600 mb-2">60-90</div>
                        <div class="text-sm font-medium text-gray-600">Minutes Duration</div>
                        <div class="text-xs text-gray-500 mt-1">Self-paced with pause capability</div>
                    </div>
                </div>
            </div>

            <!-- Knowledge Domains Section -->
            <div class="mb-10">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-semibold text-gray-900 mb-4">20 SecureStart™ Assessment Domains</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Each domain represents a critical area of cybersecurity knowledge and skill that contributes to professional success in information security. Your performance across these domains will reveal your unique security expertise profile.
                    </p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="domain in knowledgeDomains" :key="domain.id" 
                         class="bg-white p-6 rounded-xl shadow-xs border border-gray-200 hover:shadow-lg hover:border-gray-300 transition-all duration-200">
                        <div class="flex items-center mb-3">
                            <div class="w-4 h-4 rounded-full mr-3" :class="domain.color"></div>
                            <h3 class="font-bold text-gray-900 text-sm">{{ domain.name }}</h3>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed mb-3">{{ domain.description }}</p>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-blue-600 font-medium">Domain {{ domain.id }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Diagnostic Methodology</h3>
                    <div class="grid md:grid-cols-2 gap-6 text-sm text-gray-700">
                        <div>
                            <h4 class="font-medium mb-2">Industry-Aligned Content</h4>
                            <p>Assessment items based on NIST, ISO 27001, SANS, and other leading cybersecurity frameworks and real-world scenarios.</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-2">Comprehensive Coverage</h4>
                            <p>Balanced evaluation across technical, operational, and governance aspects of information security.</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-2">Expert Validated</h4>
                            <p>All content reviewed and validated by certified cybersecurity professionals and industry practitioners.</p>
                        </div>
                        <div>
                            <h4 class="font-medium mb-2">Career Relevance</h4>
                            <p>Assessment reflects current threat landscape and practical challenges faced by security professionals.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assessment Features -->
            <div class="grid md:grid-cols-2 gap-8 mb-10">
                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">What You'll Receive</h3>
                    </div>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Comprehensive Security Profile Analysis</strong>
                                <p class="text-sm text-gray-600">Detailed breakdown of your cybersecurity strengths and knowledge gaps across all 20 security domains</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Personalized Learning Roadmap</strong>
                                <p class="text-sm text-gray-600">Customized recommendations for cybersecurity training, certifications, and skill development paths</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Industry Benchmarking</strong>
                                <p class="text-sm text-gray-600">Performance comparison with cybersecurity professionals at similar career levels and specializations</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Career Pathway Alignment</strong>
                                <p class="text-sm text-gray-600">Analysis of how your profile aligns with various cybersecurity roles and specialization tracks</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 mr-3 mt-1">✓</span>
                            <div>
                                <strong>Professional Assessment Report</strong>
                                <p class="text-sm text-gray-600">Comprehensive PDF report suitable for professional development planning and career advancement</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-100">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Diagnostic Guidelines</h3>
                    </div>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Time Management</strong>
                                <p class="text-sm text-gray-600">Allocate 60-90 minutes in a quiet environment for optimal focus and accuracy</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Honest Responses</strong>
                                <p class="text-sm text-gray-600">Answer authentically to ensure results accurately reflect your current capabilities</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Flexible Completion</strong>
                                <p class="text-sm text-gray-600">Pause and resume functionality allows you to complete the diagnostic at your own pace</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Independent Work</strong>
                                <p class="text-sm text-gray-600">Complete the diagnostic independently without external resources for valid results</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <span class="text-blue-500 mr-3 mt-1">•</span>
                            <div>
                                <strong>Technical Requirements</strong>
                                <p class="text-sm text-gray-600">Stable internet connection and modern browser recommended for optimal experience</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Start Assessment Button -->
            <div class="text-center mb-12">
                <div class="bg-linear-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-4">Ready to Begin SecureStart™ Diagnostic?</h3>
                    <p class="text-lg mb-6 opacity-90">
                        Take the first step toward understanding your cybersecurity competency profile and advancing your information security career.
                    </p>
                    <Link 
                        :href="route('assessments.diagnostics.store')" 
                        method="post"
                        class="inline-flex items-center px-10 py-4 bg-white text-gray-900 text-lg font-bold rounded-full hover:bg-gray-100 transform hover:scale-105 transition-all duration-200 shadow-xl"
                    >
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Begin SecureStart™ Diagnostic
                    </Link>
                    <p class="text-sm mt-4 opacity-75">
                        Your cybersecurity career advancement starts here
                    </p>
                </div>
            </div>

            <h2 class="text-xl font-semibold mb-3">Previous Assessments</h2>

            <div v-if="props.diagnosticsHistory && props.diagnosticsHistory.length > 0" class="bg-white shadow-md rounded-lg overflow-hidden">
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
                        <tr v-for="diagnostic in props.diagnosticsHistory" :key="diagnostic.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ formatDate(diagnostic.created_at) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ diagnostic.status }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ diagnostic.score !== null ? diagnostic.score + '%' : 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ diagnostic.responses.length }} / {{ diagnostic.total_questions }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ formatTime(diagnostic.total_duration) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <Link v-if="diagnostic.status === 'completed'" :href="route('assessments.diagnostics.all-results')" class="text-blue-600 hover:text-blue-900 mr-3">Review</Link>
                                <Link v-if="diagnostic.status === 'in_progress' || diagnostic.status === 'paused'" :href="route('assessments.diagnostics.show', diagnostic.id)" class="text-green-600 hover:text-green-900">Resume</Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else class="text-gray-600 text-center mt-4">
                No previous assessments found.
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import moment from 'moment';
import AppLayout from "@/layouts/AppLayout.vue";

const props = defineProps({
    totalQuestions: {
        type: Number,
        default: 100,
    },
    diagnosticsHistory: Array
});

// 20 Cybersecurity Domains Data Structure
const knowledgeDomains = [
    {
        id: 1,
        name: "General Security Concepts",
        description: "CIA Triad, authenticity, non-repudiation, IAAA, and fundamental security controls",
        questionCount: 7,
        color: "bg-red-500"
    },
    {
        id: 2,
        name: "Information Security Governance",
        description: "Security roles, policies, frameworks, governance vs management, and security culture",
        questionCount: 8,
        color: "bg-blue-500"
    },
    {
        id: 3,
        name: "Legal, Regulatory & Compliance",
        description: "GDPR, HIPAA, PCI DSS, criminal/civil law, contracts, and intellectual property",
        questionCount: 7,
        color: "bg-purple-500"
    },
    {
        id: 4,
        name: "Privacy",
        description: "PII, ePHI, data subject rights, privacy by design, and cross-border transfers",
        questionCount: 12,
        color: "bg-pink-500"
    },
    {
        id: 5,
        name: "Risk Management",
        description: "Risk lifecycle, assessment, treatment, monitoring, and risk frameworks",
        questionCount: 11,
        color: "bg-orange-500"
    },
    {
        id: 6,
        name: "Security Audits & Assessments",
        description: "Audit phases, evidence gathering, gap analysis, pentesting, and SOC reports",
        questionCount: 12,
        color: "bg-yellow-500"
    },
    {
        id: 7,
        name: "Threat & Vulnerability Management",
        description: "Threat actors, MITRE ATT&CK, CVE, CVSS, vulnerability lifecycle, and hardening",
        questionCount: 15,
        color: "bg-red-600"
    },
    {
        id: 8,
        name: "Cryptography & Key Management",
        description: "Encryption, hashing, PKI, HSM, TPM, and quantum-resistant cryptography",
        questionCount: 9,
        color: "bg-indigo-500"
    },
    {
        id: 9,
        name: "Data Governance",
        description: "Data classification, retention, sanitization, DLP, and information rights management",
        questionCount: 7,
        color: "bg-teal-500"
    },
    {
        id: 10,
        name: "Access Control",
        description: "Authentication, MFA, SSO, access models, PAM, and identity provisioning",
        questionCount: 11,
        color: "bg-green-500"
    },
    {
        id: 11,
        name: "Network & Communication Security",
        description: "OSI/TCP model, protocols, firewalls, VPN, Wi-Fi security, and network attacks",
        questionCount: 10,
        color: "bg-cyan-500"
    },
    {
        id: 12,
        name: "Application Security & DevSecOps",
        description: "Secure SDLC, DevSecOps, OWASP Top 10, security testing, and API security",
        questionCount: 7,
        color: "bg-emerald-500"
    },
    {
        id: 13,
        name: "Cloud Security",
        description: "Service models, shared responsibility, CASB, SASE, containers, and cloud frameworks",
        questionCount: 10,
        color: "bg-sky-500"
    },
    {
        id: 14,
        name: "Endpoint, Mobile & IoT Security",
        description: "EPP/EDR, MDM, BYOD, IoT security, hardware root of trust, and ICS/SCADA",
        questionCount: 9,
        color: "bg-violet-500"
    },
    {
        id: 15,
        name: "Security Architecture & Design",
        description: "Security by design, Zero Trust, threat modeling, security models, and frameworks",
        questionCount: 15,
        color: "bg-purple-600"
    },
    {
        id: 16,
        name: "Security Awareness & Human Factors",
        description: "Social engineering, insider threats, training lifecycle, and HR security processes",
        questionCount: 13,
        color: "bg-rose-500"
    },
    {
        id: 17,
        name: "Physical & Environmental Security",
        description: "CPTED, perimeter security, PACS, surveillance, environmental controls, and fire safety",
        questionCount: 13,
        color: "bg-amber-500"
    },
    {
        id: 18,
        name: "Security Operations & Monitoring",
        description: "SOC operations, SIEM, IDS/IPS, SOAR, continuous monitoring, and threat hunting",
        questionCount: 11,
        color: "bg-lime-500"
    },
    {
        id: 19,
        name: "Incident Management & Forensics",
        description: "Incident response phases, forensics, evidence handling, and post-incident analysis",
        questionCount: 7,
        color: "bg-stone-500"
    },
    {
        id: 20,
        name: "Business Continuity & Disaster Recovery",
        description: "BIA, RTO/RPO, BCP/DRP, testing methods, alternate sites, and backup strategies",
        questionCount: 8,
        color: "bg-gray-500"
    }
];

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
</script>

<style scoped>
/* Add any specific styles for the table or layout here */
</style>
