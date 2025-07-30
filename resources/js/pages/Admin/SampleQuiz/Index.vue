<template>
    <AdminLayout>
        <Head title="Sample Quiz Questions" />
        
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="text-2xl font-semibold">Sample Quiz Questions</h1>
                                <p class="text-gray-600 dark:text-gray-400 mt-1">
                                    Drag to reorder questions • Drag to trash to remove • {{ sampleQuestions.length }}/{{ stats.max_recommended }} questions
                                </p>
                            </div>
                            <div class="flex gap-3">
                                <button
                                    @click="showAddModal = true"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                                >
                                    Add Question
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="text-2xl font-bold text-blue-600">{{ sampleQuestions.length }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Sample Questions</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="text-2xl font-bold text-green-600">{{ total_diagnostic_items }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Total Diagnostic Items</div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm">
                        <div class="text-2xl font-bold text-orange-600">{{ stats.max_recommended - sampleQuestions.length }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Remaining Slots</div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="sampleQuestions.length === 0" class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No sample questions</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding your first sample quiz question.</p>
                    <div class="mt-6">
                        <button
                            @click="showAddModal = true"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                        >
                            Add First Question
                        </button>
                    </div>
                </div>

                <!-- Draggable Questions List -->
                <div v-else class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-medium">Questions (Drag to Reorder)</h2>
                            <div class="flex items-center gap-4">
                                <!-- Trash Zone -->
                                <div 
                                    ref="trashZone"
                                    :class="[
                                        'flex items-center gap-2 px-4 py-2 rounded-lg border-2 border-dashed transition-all',
                                        isDragOverTrash 
                                            ? 'border-red-500 bg-red-50 dark:bg-red-900/20 text-red-600' 
                                            : 'border-gray-300 dark:border-gray-600 text-gray-500'
                                    ]"
                                >
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    <span class="text-sm font-medium">Drop to Remove</span>
                                </div>
                            </div>
                        </div>

                        <!-- Sortable Questions -->
                        <div ref="sortableContainer" class="space-y-3">
                            <div
                                v-for="question in sampleQuestions"
                                :key="question.id"
                                :data-id="question.id"
                                class="group flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:border-gray-300 hover:shadow-sm transition-all cursor-move"
                            >
                                <!-- Drag Handle -->
                                <div class="flex items-center mr-4">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </div>

                                <!-- Question Number -->
                                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center text-sm font-medium mr-4">
                                    {{ question.display_order }}
                                </div>

                                <!-- Question Content -->
                                <div class="flex-grow min-w-0">
                                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                        {{ question.question.content }}
                                    </div>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded">
                                            {{ question.question.type }}
                                        </span>
                                        <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded">
                                            {{ question.question.domain }}
                                        </span>
                                        <span class="text-xs px-2 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 rounded">
                                            Level {{ question.question.difficulty_level }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center gap-2 ml-4">
                                    <button
                                        @click="viewQuestion(question)"
                                        class="text-blue-600 hover:text-blue-800 p-1"
                                        title="View Question"
                                    >
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Question Modal -->
        <Modal :show="showAddModal" @close="showAddModal = false" max-width="2xl">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Add Question to Sample Quiz</h2>
                
                <!-- Search -->
                <div class="mb-4 relative">
                    <input
                        v-model="searchQuery"
                        @input="searchItems"
                        type="text"
                        placeholder="Search diagnostic items..."
                        class="w-full px-3 py-2 pr-10 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                    >
                    <button
                        v-if="searchQuery"
                        @click="clearSearch"
                        type="button"
                        class="absolute right-2 top-1/2 -translate-y-1/2 p-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Search Results -->
                <div class="max-h-96 overflow-y-auto space-y-2">
                    <div
                        v-for="item in searchResults"
                        :key="item.id" 
                        class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700"
                    >
                        <div class="flex-grow min-w-0">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ item.content }}
                            </div>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs px-2 py-1 bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded font-mono">
                                    ID: {{ item.id }}
                                </span>
                                <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-400 rounded">
                                    {{ item.type }}
                                </span>
                                <span class="text-xs px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded">
                                    {{ item.domain }}
                                </span>
                            </div>
                        </div>
                        <button
                            @click="addQuestionToSample(item.id)"
                            :disabled="addingQuestionId === item.id"
                            :class="[
                                'ml-3 px-3 py-1 rounded text-sm font-medium transition-colors',
                                addingQuestionId === item.id
                                    ? 'bg-gray-400 cursor-not-allowed text-white'
                                    : 'bg-blue-600 hover:bg-blue-700 text-white'
                            ]"
                        >
                            {{ addingQuestionId === item.id ? 'Adding...' : 'Add' }}
                        </button>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button
                        @click="showAddModal = false"
                        class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                    >
                        Close
                    </button>
                </div>
            </div>
        </Modal>
    </AdminLayout>
</template>

<script setup lang="ts">
import { ref, onMounted, nextTick } from 'vue'
import { Head, router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import Modal from '@/components/Modal.vue'
import Sortable from 'sortablejs'

// @ts-expect-error - route is available globally via Ziggy
const route = window.route

const props = defineProps({
    sample_questions: Array,
    total_diagnostic_items: Number,
    stats: Object,
})

// Reactive data
const sampleQuestions = ref([...props.sample_questions])
const showAddModal = ref(false)
const searchQuery = ref('')
const searchResults = ref([])
const isDragOverTrash = ref(false)
const sortableContainer = ref(null)
const trashZone = ref(null)
const addingQuestionId = ref(null) // Track which question is being added

// Initialize drag and drop
onMounted(() => {
    initializeSortable()
})

const initializeSortable = async () => {
    await nextTick()
    
    if (!sortableContainer.value) return

    Sortable.create(sortableContainer.value, {
        animation: 150,
        handle: '.cursor-move',
        ghostClass: 'opacity-50',
        dragClass: 'rotate-3',
        
        onStart: () => {
            // Setup trash zone drop
            setupTrashDrop()
        },
        
        onEnd: async () => {
            // Cleanup trash zone
            cleanupTrashDrop()
            
            // Update display orders
            await updateDisplayOrders()
        }
    })
}

const setupTrashDrop = () => {
    const trashEl = trashZone.value
    if (!trashEl) return

    trashEl.addEventListener('dragenter', handleTrashDragEnter)
    trashEl.addEventListener('dragover', handleTrashDragOver)
    trashEl.addEventListener('dragleave', handleTrashDragLeave)
    trashEl.addEventListener('drop', handleTrashDrop)
}

const cleanupTrashDrop = () => {
    const trashEl = trashZone.value
    if (!trashEl) return

    trashEl.removeEventListener('dragenter', handleTrashDragEnter)
    trashEl.removeEventListener('dragover', handleTrashDragOver)
    trashEl.removeEventListener('dragleave', handleTrashDragLeave)
    trashEl.removeEventListener('drop', handleTrashDrop)
    
    isDragOverTrash.value = false
}

const handleTrashDragEnter = (e) => {
    e.preventDefault()
    isDragOverTrash.value = true
}

const handleTrashDragOver = (e) => {
    e.preventDefault()
}

const handleTrashDragLeave = (e) => {
    // Only set to false if leaving the trash zone completely
    if (!trashZone.value.contains(e.relatedTarget)) {
        isDragOverTrash.value = false
    }
}

const handleTrashDrop = async (e) => {
    e.preventDefault()
    isDragOverTrash.value = false
    
    // Get the dragged question ID
    const draggedElement = document.querySelector('.sortable-chosen')
    if (!draggedElement) return
    
    const questionId = draggedElement.getAttribute('data-id')
    if (questionId) {
        await removeQuestion(parseInt(questionId))
    }
}

const updateDisplayOrders = async () => {
    const questionElements = sortableContainer.value.children
    const updatedQuestions = []
    
    Array.from(questionElements).forEach((element, index) => {
        const questionId = parseInt(element.getAttribute('data-id'))
        const question = sampleQuestions.value.find(q => q.id === questionId)
        
        if (question) {
            question.display_order = index + 1
            updatedQuestions.push({
                id: questionId,
                display_order: index + 1
            })
        }
    })
    
    try {
        const response = await fetch(route('admin.sample-quiz.reorder'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            },
            body: JSON.stringify({
                questions: updatedQuestions
            })
        })

        const result = await response.json()

        if (!result.success) {
            console.error('Failed to reorder questions:', result.message)
            window.location.reload()
        }
        // If successful, the visual changes are already applied
    } catch (error) {
        console.error('Failed to reorder questions:', error)
        window.location.reload()
    }
}

const removeQuestion = async (questionId) => {
    const question = sampleQuestions.value.find(q => q.id === questionId)
    if (!question) return

    if (!confirm(`Remove "${question.question.content.substring(0, 50)}..." from sample quiz?`)) {
        return
    }

    try {
        const response = await fetch(route('admin.sample-quiz.destroy', question.id), {
            method: 'DELETE',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            }
        })

        const result = await response.json()

        if (result.success) {
            // Remove from local array and renumber
            const index = sampleQuestions.value.findIndex(q => q.id === questionId)
            if (index !== -1) {
                sampleQuestions.value.splice(index, 1)
                // Renumber remaining questions
                sampleQuestions.value.forEach((q, i) => {
                    q.display_order = i + 1
                })
            }

            // If search modal is open and has results, refresh the search to include the removed question
            if (showAddModal.value && searchQuery.value.length >= 2) {
                searchItems()
            }
        } else {
            alert(result.message || 'Failed to remove question')
        }
    } catch (error) {
        console.error('Failed to remove question:', error)
        alert('Failed to remove question. Please try again.')
    }
}

const clearSearch = () => {
    searchQuery.value = ''
    searchResults.value = []
}

const searchItems = async () => {
    if (searchQuery.value.length < 2) {
        searchResults.value = []
        return
    }

    try {
        const response = await fetch(route('admin.sample-quiz.search-items') + '?' + new URLSearchParams({
            search: searchQuery.value
        }), {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        const results = await response.json()
        
        // Filter out questions that are already in the sample quiz
        const existingIds = sampleQuestions.value.map(q => q.diagnostic_item_id)
        searchResults.value = results.filter(item => !existingIds.includes(item.id))
    } catch (error) {
        console.error('Search failed:', error)
        searchResults.value = []
    }
}

const addQuestionToSample = async (diagnosticItemId) => {
    // Set loading state
    addingQuestionId.value = diagnosticItemId
    
    try {
        const response = await fetch(route('admin.sample-quiz.store'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
            },
            body: JSON.stringify({
                diagnostic_item_id: diagnosticItemId
            })
        })

        const result = await response.json()

        if (result.success) {
            // Add to local sample questions array
            sampleQuestions.value.push(result.question)
            
            // Remove from search results so it can't be added again
            searchResults.value = searchResults.value.filter(item => item.id !== diagnosticItemId)
            
            // Show success message (optional)
            console.log('Question added successfully')
        } else {
            // Handle error (question already exists, etc.)
            alert(result.message || 'Failed to add question')
        }
    } catch (error) {
        console.error('Failed to add question:', error)
        alert('Failed to add question. Please try again.')
    } finally {
        // Clear loading state
        addingQuestionId.value = null
    }
}

const viewQuestion = (question) => {
    // Navigate to diagnostic item view
    router.visit(route('admin.diagnostics.items.show', question.diagnostic_item_id))
}
</script>

<style scoped>
.rotate-3 {
    transform: rotate(3deg);
}
</style>