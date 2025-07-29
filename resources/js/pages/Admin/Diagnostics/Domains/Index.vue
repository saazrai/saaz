<template>
  <AdminLayout pageTitle="Domain Management">
    <div class="space-y-6">
      <!-- Header -->
      <div class="flex justify-between items-center">
        <div>
          <p :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-500']">
            Manage domains, topics, and subtopics for diagnostic assessments
          </p>
        </div>
        <button
          @click="openAddDomainDialog"
          :class="[
            'flex items-center gap-2 px-4 py-2 rounded-lg transition-colors text-sm font-medium',
            isDark ? 'bg-blue-600 hover:bg-blue-700 text-white' : 'bg-blue-600 hover:bg-blue-700 text-white'
          ]"
        >
          <Plus class="h-4 w-4" />
          Add Domain
        </button>
      </div>

      <!-- Search and Filter -->
      <div class="flex gap-4">
        <div class="flex-1">
          <input
            v-model="searchQuery"
            placeholder="Search domains, topics, or subtopics..."
            :class="[
              'w-full px-3 py-2 rounded-lg transition-colors',
              isDark ? 'bg-gray-800 border-gray-700 text-white placeholder-gray-400' : 'bg-white border-gray-300 text-gray-900 placeholder-gray-500',
              'border focus:outline-none focus:ring-2 focus:ring-blue-500'
            ]"
          />
        </div>
        <select
          v-model="filterCategory"
          :class="[
            'w-48 px-3 py-2 rounded-lg transition-colors cursor-pointer',
            isDark ? 'bg-gray-800 border-gray-700 text-white' : 'bg-white border-gray-300 text-gray-900',
            'border focus:outline-none focus:ring-2 focus:ring-blue-500'
          ]"
        >
          <option value="all">All Categories</option>
          <option value="foundational">Foundational</option>
          <option value="technical">Technical</option>
          <option value="managerial">Managerial</option>
        </select>
      </div>

      <!-- Domain List -->
      <div class="rounded-lg">
        <div class="p-4">
          <div v-if="filteredHierarchy.length === 0" class="text-center py-8">
            <p :class="[isDark ? 'text-gray-400' : 'text-gray-500']">
              No domains found matching your criteria.
            </p>
          </div>
          
          <div v-else class="space-y-2">
            <div v-for="domain in filteredHierarchy" :key="domain.id">
              <!-- Domain -->
              <div :class="[
                'rounded-lg p-4 transition-all cursor-pointer',
                isDark ? 'bg-gray-800 hover:bg-gray-700' : 'bg-white hover:bg-gray-50'
              ]">
                <div class="flex items-start justify-between">
                  <div class="flex items-start gap-3 flex-1" @click="toggleDomain(domain.id)">
                    <button
                      class="mt-1 transition-transform"
                      :class="{ 'rotate-90': expandedDomains.has(domain.id) }"
                    >
                      <ChevronRight :class="['h-4 w-4', isDark ? 'text-gray-400' : 'text-gray-500']" />
                    </button>
                    
                    <div class="flex-1">
                      <div class="flex items-center gap-3">
                        <h3 :class="['font-semibold', isDark ? 'text-white' : 'text-gray-900']">
                          {{ domain.name }}
                        </h3>
                        <span v-if="domain.is_active" :class="['inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', isDark ? 'bg-green-900/30 text-green-400' : 'bg-green-100 text-green-800']">
                          Active
                        </span>
                        <span v-else :class="['inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', isDark ? 'bg-gray-800 text-gray-500' : 'bg-gray-200 text-gray-600']">
                          Inactive
                        </span>
                        <span :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-500']">
                          {{ domain.topics_count }} topics • {{ domain.total_questions }} questions
                        </span>
                      </div>
                      <p v-if="domain.description" :class="['text-sm mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                        {{ domain.description }}
                      </p>
                    </div>
                  </div>
                  
                  <div class="flex items-center gap-2">
                    <button
                      @click.stop="editDomain(domain)"
                      :class="[
                        'p-2 rounded-lg transition-colors',
                        isDark ? 'hover:bg-gray-700 text-gray-400 hover:text-white' : 'hover:bg-gray-200 text-gray-600 hover:text-gray-900'
                      ]"
                    >
                      <Edit2 class="h-4 w-4" />
                    </button>
                    <button
                      @click.stop="deleteDomain(domain)"
                      :class="[
                        'p-2 rounded-lg transition-colors',
                        isDark ? 'hover:bg-gray-700 text-gray-400 hover:text-red-400' : 'hover:bg-gray-200 text-gray-600 hover:text-red-600'
                      ]"
                    >
                      <Trash2 class="h-4 w-4" />
                    </button>
                  </div>
                </div>

                <!-- Topics -->
                <div v-if="expandedDomains.has(domain.id)" class="mt-4 ml-7 space-y-2">
                  <div v-for="topic in domain.topics" :key="topic.id">
                    <div :class="[
                      'rounded-lg p-3',
                      isDark ? 'bg-gray-700/50' : 'bg-white'
                    ]">
                      <div class="flex items-start justify-between">
                        <div class="flex items-start gap-3 flex-1">
                          <button
                            @click="toggleTopic(topic.id)"
                            class="mt-0.5 transition-transform"
                            :class="{ 'rotate-90': expandedTopics.has(topic.id) }"
                          >
                            <ChevronRight :class="['h-3 w-3', isDark ? 'text-gray-400' : 'text-gray-500']" />
                          </button>
                          
                          <div class="flex-1">
                            <div class="flex items-center gap-3">
                              <h4 :class="['font-medium text-sm', isDark ? 'text-white' : 'text-gray-900']">
                                {{ topic.name }}
                              </h4>
                              <span :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                                {{ topic.subtopics_count }} subtopics • {{ topic.total_questions }} questions
                              </span>
                            </div>
                            <p v-if="topic.description" :class="['text-xs mt-1', isDark ? 'text-gray-400' : 'text-gray-600']">
                              {{ topic.description }}
                            </p>
                          </div>
                        </div>
                        
                        <div class="flex items-center gap-1">
                          <button
                            @click.stop="editTopic(topic)"
                            :class="[
                              'p-1.5 rounded transition-colors',
                              isDark ? 'hover:bg-gray-700 text-gray-400 hover:text-white' : 'hover:bg-gray-200 text-gray-600 hover:text-gray-900'
                            ]"
                          >
                            <Edit2 class="h-3 w-3" />
                          </button>
                          <button
                            @click.stop="deleteTopic(topic)"
                            :class="[
                              'p-1.5 rounded transition-colors',
                              isDark ? 'hover:bg-gray-700 text-gray-400 hover:text-red-400' : 'hover:bg-gray-200 text-gray-600 hover:text-red-600'
                            ]"
                          >
                            <Trash2 class="h-3 w-3" />
                          </button>
                        </div>
                      </div>

                      <!-- Subtopics -->
                      <div v-if="expandedTopics.has(topic.id)" class="mt-3 ml-6 space-y-1">
                        <div v-for="subtopic in topic.subtopics" :key="subtopic.id" :class="[
                          'rounded-lg p-2 flex items-center justify-between',
                          isDark ? 'bg-gray-800/50' : 'bg-gray-50'
                        ]">
                          <div class="flex-1">
                            <div class="flex items-center gap-2">
                              <h5 :class="['text-sm', isDark ? 'text-white' : 'text-gray-900']">
                                {{ subtopic.name }}
                              </h5>
                              <span :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                                {{ subtopic.questions_count }} questions
                              </span>
                            </div>
                            <p v-if="subtopic.description" :class="['text-xs mt-0.5', isDark ? 'text-gray-400' : 'text-gray-600']">
                              {{ subtopic.description }}
                            </p>
                          </div>
                          
                          <div class="flex items-center gap-1">
                            <button
                              @click.stop="editSubtopic(subtopic)"
                              :class="[
                                'p-1 rounded transition-colors',
                                isDark ? 'hover:bg-gray-700 text-gray-400 hover:text-white' : 'hover:bg-gray-200 text-gray-600 hover:text-gray-900'
                              ]"
                            >
                              <Edit2 class="h-3 w-3" />
                            </button>
                            <button
                              @click.stop="deleteSubtopic(subtopic)"
                              :class="[
                                'p-1 rounded transition-colors',
                                isDark ? 'hover:bg-gray-700 text-gray-400 hover:text-red-400' : 'hover:bg-gray-200 text-gray-600 hover:text-red-600'
                              ]"
                            >
                              <Trash2 class="h-3 w-3" />
                            </button>
                          </div>
                        </div>
                        
                        <!-- Add Subtopic Button -->
                        <button
                          @click="showAddSubtopicDialog(topic.id)"
                          :class="[
                            'w-full flex items-center justify-center gap-1 py-1.5 px-2 rounded text-xs transition-colors',
                            isDark ? 'bg-gray-700/30 hover:bg-gray-700/50 text-gray-400' : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                          ]"
                        >
                          <Plus class="h-3 w-3" />
                          Add Subtopic
                        </button>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Add Topic Button -->
                  <button
                    @click="showAddTopicDialog(domain.id)"
                    :class="[
                      'w-full flex items-center justify-center gap-1 py-2 px-3 rounded-lg text-sm transition-colors',
                      isDark ? 'bg-gray-700/50 hover:bg-gray-700 text-gray-400' : 'bg-gray-100 hover:bg-gray-200 text-gray-700'
                    ]"
                  >
                    <Plus class="h-3 w-3" />
                    Add Topic
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add/Edit Domain Dialog -->
    <Dialog v-model:open="domainDialogOpen">
      <DialogContent :class="[
        isDark ? 'bg-gray-800 border-gray-700 text-white' : 'bg-white border-gray-200',
        'shadow-2xl'
      ]">
        <DialogHeader>
          <DialogTitle :class="[isDark ? 'text-white' : 'text-gray-900']">{{ editingDomain ? 'Edit Domain' : 'Add Domain' }}</DialogTitle>
        </DialogHeader>
        <form @submit.prevent="saveDomain" class="space-y-4">
          <div>
            <label for="domain-name" :class="['block text-sm font-medium mb-1', isDark ? 'text-gray-200' : 'text-gray-700']">Name</label>
            <input
              id="domain-name"
              v-model="domainForm.name"
              required
              :class="[
                'w-full px-3 py-2 rounded-lg transition-colors',
                isDark ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' : 'bg-white border-gray-300 text-gray-900',
                'border focus:outline-none focus:ring-2 focus:ring-blue-500'
              ]"
            />
          </div>
          <div>
            <label for="domain-description" :class="['block text-sm font-medium mb-1', isDark ? 'text-gray-200' : 'text-gray-700']">Description</label>
            <textarea
              id="domain-description"
              v-model="domainForm.description"
              rows="3"
              :class="[
                'w-full px-3 py-2 rounded-lg transition-colors',
                isDark ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' : 'bg-white border-gray-300 text-gray-900',
                'border focus:outline-none focus:ring-2 focus:ring-blue-500'
              ]"
            />
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="domain-code" :class="['block text-sm font-medium mb-1', isDark ? 'text-gray-200' : 'text-gray-700']">Code</label>
              <input
                id="domain-code"
                v-model="domainForm.code"
                placeholder="e.g., SRM"
                :class="[
                  'w-full px-3 py-2 rounded-lg transition-colors',
                  isDark ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400' : 'bg-white border-gray-300 text-gray-900',
                  'border focus:outline-none focus:ring-2 focus:ring-blue-500'
                ]"
              />
            </div>
            <div>
              <label for="domain-category" :class="['block text-sm font-medium mb-1', isDark ? 'text-gray-200' : 'text-gray-700']">Category</label>
              <select
                id="domain-category"
                v-model="domainForm.category"
                :class="[
                  'w-full px-3 py-2 rounded-lg transition-colors',
                  isDark ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-gray-900',
                  'border focus:outline-none focus:ring-2 focus:ring-blue-500'
                ]"
              >
                <option value="">Select category</option>
                <option value="foundational">Foundational</option>
                <option value="technical">Technical</option>
                <option value="managerial">Managerial</option>
              </select>
            </div>
          </div>
          <div class="flex items-center gap-2">
            <input
              type="checkbox"
              id="domain-active"
              v-model="domainForm.is_active"
              class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
            />
            <label for="domain-active" :class="['text-sm', isDark ? 'text-gray-200' : 'text-gray-700']">Active</label>
          </div>
          <div class="flex justify-end gap-2">
            <button
              type="button"
              @click="domainDialogOpen = false"
              :class="[
                'px-4 py-2 rounded-lg transition-colors',
                isDark ? 'bg-gray-700 hover:bg-gray-600 text-gray-300' : 'bg-gray-200 hover:bg-gray-300 text-gray-700'
              ]"
            >
              Cancel
            </button>
            <button
              type="submit"
              :class="[
                'px-4 py-2 rounded-lg transition-colors font-medium',
                'bg-blue-600 hover:bg-blue-700 text-white'
              ]"
            >
              {{ editingDomain ? 'Update' : 'Create' }}
            </button>
          </div>
        </form>
      </DialogContent>
    </Dialog>

    <!-- Add/Edit Topic Dialog -->
    <Dialog v-model:open="topicDialogOpen">
      <DialogContent :class="[
        'max-w-2xl',
        isDark ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200',
        'shadow-2xl'
      ]">
        <DialogHeader class="pb-6">
          <DialogTitle :class="['text-xl font-semibold', isDark ? 'text-white' : 'text-gray-900']">
            {{ editingTopic ? 'Edit Topic' : 'Add Topic' }}
          </DialogTitle>
          <p v-if="editingTopic && currentDomain" :class="['text-sm mt-2', isDark ? 'text-gray-400' : 'text-gray-600']">
            in <span class="font-medium">{{ currentDomain.name }}</span>
          </p>
        </DialogHeader>
        
        <form @submit.prevent="saveTopic" class="space-y-6">
          <!-- Visual Context Card -->
          <div v-if="currentDomain" :class="[
            'p-4 rounded-lg',
            isDark ? 'bg-gray-900/50 border border-gray-700' : 'bg-gray-50 border border-gray-200'
          ]">
            <div class="flex items-start gap-3">
              <div :class="[
                'w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0',
                isDark ? 'bg-gray-700' : 'bg-gray-200'
              ]">
                <GitBranch :class="['w-5 h-5', isDark ? 'text-gray-400' : 'text-gray-600']" />
              </div>
              <div>
                <h4 :class="['text-sm font-medium', isDark ? 'text-gray-200' : 'text-gray-700']">Parent Domain</h4>
                <p :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-600']">{{ currentDomain.name }}</p>
              </div>
            </div>
          </div>

          <!-- Form Fields -->
          <div class="space-y-5">
            <div>
              <label for="topic-name" :class="[
                'block text-sm font-medium mb-2',
                isDark ? 'text-gray-200' : 'text-gray-700'
              ]">
                Topic Name <span class="text-red-500">*</span>
              </label>
              <input
                id="topic-name"
                v-model="topicForm.name"
                required
                placeholder="Enter topic name"
                :class="[
                  'w-full px-4 py-2.5 rounded-lg transition-all duration-200',
                  isDark ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:bg-gray-600' : 'bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-500 focus:bg-white',
                  'border focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
                ]"
              />
              <p :class="['text-xs mt-1', isDark ? 'text-gray-400' : 'text-gray-500']">
                This will be displayed in the diagnostic hierarchy
              </p>
            </div>

            <div>
              <label for="topic-description" :class="[
                'block text-sm font-medium mb-2',
                isDark ? 'text-gray-200' : 'text-gray-700'
              ]">
                Description
              </label>
              <textarea
                id="topic-description"
                v-model="topicForm.description"
                rows="4"
                placeholder="Provide a clear description of what this topic covers"
                :class="[
                  'w-full px-4 py-2.5 rounded-lg transition-all duration-200 resize-none',
                  isDark ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:bg-gray-600' : 'bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-500 focus:bg-white',
                  'border focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
                ]"
              />
              <div class="flex justify-between mt-1">
                <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                  Help users understand the scope of this topic
                </p>
                <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                  {{ topicForm.description?.length || 0 }}/500
                </p>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-between items-center pt-6 border-t" :class="[isDark ? 'border-gray-700' : 'border-gray-200']">
            <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
              <span class="text-red-500">*</span> Required fields
            </p>
            <div class="flex gap-3">
              <button
                type="button"
                @click="topicDialogOpen = false"
                :class="[
                  'px-5 py-2.5 rounded-lg transition-all duration-200 font-medium',
                  isDark ? 'bg-gray-700 hover:bg-gray-600 text-gray-300' : 'bg-white hover:bg-gray-50 text-gray-700 border border-gray-300'
                ]"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="!topicForm.name"
                :class="[
                  'px-5 py-2.5 rounded-lg transition-all duration-200 font-medium',
                  'bg-blue-600 hover:bg-blue-700 text-white disabled:opacity-50 disabled:cursor-not-allowed',
                  'focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
                ]"
              >
                {{ editingTopic ? 'Update Topic' : 'Create Topic' }}
              </button>
            </div>
          </div>
        </form>
      </DialogContent>
    </Dialog>

    <!-- Add/Edit Subtopic Dialog -->
    <Dialog v-model:open="subtopicDialogOpen">
      <DialogContent :class="[
        'max-w-2xl',
        isDark ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200',
        'shadow-2xl'
      ]">
        <DialogHeader class="pb-6">
          <DialogTitle :class="['text-xl font-semibold', isDark ? 'text-white' : 'text-gray-900']">
            {{ editingSubtopic ? 'Edit Subtopic' : 'Add Subtopic' }}
          </DialogTitle>
          <p v-if="editingSubtopic && currentTopic" :class="['text-sm mt-2', isDark ? 'text-gray-400' : 'text-gray-600']">
            in <span class="font-medium">{{ currentTopic.name }}</span>
          </p>
        </DialogHeader>
        
        <form @submit.prevent="saveSubtopic" class="space-y-6">
          <!-- Visual Context Card -->
          <div v-if="currentTopic" :class="[
            'p-4 rounded-lg',
            isDark ? 'bg-gray-900/50 border border-gray-700' : 'bg-gray-50 border border-gray-200'
          ]">
            <div class="flex items-start gap-3">
              <div :class="[
                'w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0',
                isDark ? 'bg-gray-700' : 'bg-gray-200'
              ]">
                <FileText :class="['w-5 h-5', isDark ? 'text-gray-400' : 'text-gray-600']" />
              </div>
              <div>
                <h4 :class="['text-sm font-medium', isDark ? 'text-gray-200' : 'text-gray-700']">Parent Topic</h4>
                <p :class="['text-sm', isDark ? 'text-gray-400' : 'text-gray-600']">{{ currentTopic.name }}</p>
              </div>
            </div>
          </div>

          <!-- Form Fields -->
          <div class="space-y-5">
            <div>
              <label for="subtopic-name" :class="[
                'block text-sm font-medium mb-2',
                isDark ? 'text-gray-200' : 'text-gray-700'
              ]">
                Subtopic Name <span class="text-red-500">*</span>
              </label>
              <input
                id="subtopic-name"
                v-model="subtopicForm.name"
                required
                placeholder="Enter subtopic name"
                :class="[
                  'w-full px-4 py-2.5 rounded-lg transition-all duration-200',
                  isDark ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:bg-gray-600' : 'bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-500 focus:bg-white',
                  'border focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
                ]"
              />
              <p :class="['text-xs mt-1', isDark ? 'text-gray-400' : 'text-gray-500']">
                This will be displayed in the diagnostic hierarchy
              </p>
            </div>

            <div>
              <label for="subtopic-description" :class="[
                'block text-sm font-medium mb-2',
                isDark ? 'text-gray-200' : 'text-gray-700'
              ]">
                Description
              </label>
              <textarea
                id="subtopic-description"
                v-model="subtopicForm.description"
                rows="4"
                placeholder="Provide a clear description of what this subtopic covers"
                :class="[
                  'w-full px-4 py-2.5 rounded-lg transition-all duration-200 resize-none',
                  isDark ? 'bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:bg-gray-600' : 'bg-gray-50 border-gray-300 text-gray-900 placeholder-gray-500 focus:bg-white',
                  'border focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent'
                ]"
              />
              <div class="flex justify-between mt-1">
                <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                  Help users understand the scope of this subtopic
                </p>
                <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
                  {{ subtopicForm.description?.length || 0 }}/500
                </p>
              </div>
            </div>

            <!-- Preview Section -->
            <div :class="[
              'p-4 rounded-lg',
              isDark ? 'bg-gray-900/30 border border-gray-700' : 'bg-blue-50 border border-blue-200'
            ]">
              <h5 :class="['text-sm font-medium mb-2', isDark ? 'text-gray-300' : 'text-gray-700']">
                Preview
              </h5>
              <div :class="[
                'text-sm',
                isDark ? 'text-gray-400' : 'text-gray-600'
              ]">
                <span class="font-medium">{{ subtopicForm.name || 'Subtopic Name' }}</span>
                <span v-if="subtopicForm.description" class="block mt-1 text-xs">
                  {{ subtopicForm.description }}
                </span>
              </div>
            </div>
          </div>

          <!-- Action Buttons -->
          <div class="flex justify-between items-center pt-6 border-t" :class="[isDark ? 'border-gray-700' : 'border-gray-200']">
            <p :class="['text-xs', isDark ? 'text-gray-400' : 'text-gray-500']">
              <span class="text-red-500">*</span> Required fields
            </p>
            <div class="flex gap-3">
              <button
                type="button"
                @click="subtopicDialogOpen = false"
                :class="[
                  'px-5 py-2.5 rounded-lg transition-all duration-200 font-medium',
                  isDark ? 'bg-gray-700 hover:bg-gray-600 text-gray-300' : 'bg-white hover:bg-gray-50 text-gray-700 border border-gray-300'
                ]"
              >
                Cancel
              </button>
              <button
                type="submit"
                :disabled="!subtopicForm.name"
                :class="[
                  'px-5 py-2.5 rounded-lg transition-all duration-200 font-medium',
                  'bg-blue-600 hover:bg-blue-700 text-white disabled:opacity-50 disabled:cursor-not-allowed',
                  'focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2'
                ]"
              >
                {{ editingSubtopic ? 'Update Subtopic' : 'Create Subtopic' }}
              </button>
            </div>
          </div>
        </form>
      </DialogContent>
    </Dialog>
  </AdminLayout>
</template>

<script setup lang="ts">
import { ref, computed, inject, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/layouts/AdminLayout.vue'
import { 
  Plus, 
  ChevronRight, 
  Edit2, 
  Trash2, 
  GitBranch,
  FileText 
} from 'lucide-vue-next'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/components/shadcn/ui/dialog'

const props = defineProps({
  domains: {
    type: Array,
    required: true
  }
})

// Dark mode
const isDark = inject('isDark', ref(false))

// Also watch for changes
const checkDarkMode = () => {
  return document.documentElement.classList.contains('dark')
}

onMounted(() => {
  // Initial check
  isDark.value = checkDarkMode()
  
  // Watch for changes
  const observer = new MutationObserver(() => {
    isDark.value = checkDarkMode()
  })
  
  observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ['class']
  })
})

// State
const searchQuery = ref('')
const filterCategory = ref('all')
const expandedDomains = ref(new Set())
const expandedTopics = ref(new Set())

// Dialog states
const showAddDomainDialog = ref(false)
const domainDialogOpen = ref(false)
const topicDialogOpen = ref(false)
const subtopicDialogOpen = ref(false)

// Form data
const editingDomain = ref(null)
const editingTopic = ref(null)
const editingSubtopic = ref(null)

const domainForm = ref({
  name: '',
  description: '',
  code: '',
  category: '',
  is_active: true
})

const topicForm = ref({
  domain_id: null,
  name: '',
  description: ''
})

const subtopicForm = ref({
  topic_id: null,
  name: '',
  description: ''
})

// Computed
const currentDomain = computed(() => {
  if (!topicForm.value.domain_id) return null
  return props.domains.find(d => d.id === topicForm.value.domain_id) || null
})

const currentTopic = computed(() => {
  if (!subtopicForm.value.topic_id) return null
  
  for (const domain of props.domains) {
    for (const topic of domain.topics) {
      if (topic.id === subtopicForm.value.topic_id) {
        return topic
      }
    }
  }
  return null
})

const filteredHierarchy = computed(() => {
  let filtered = props.domains

  // Filter by category
  if (filterCategory.value !== 'all') {
    filtered = filtered.filter(domain => domain.category === filterCategory.value)
  }

  // Filter by search query
  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filtered = filtered.filter(domain => {
      // Check domain
      if (domain.name.toLowerCase().includes(query) || 
          (domain.description && domain.description.toLowerCase().includes(query))) {
        return true
      }
      
      // Check topics
      return domain.topics.some(topic => {
        if (topic.name.toLowerCase().includes(query) || 
            (topic.description && topic.description.toLowerCase().includes(query))) {
          return true
        }
        
        // Check subtopics
        return topic.subtopics.some(subtopic => 
          subtopic.name.toLowerCase().includes(query) || 
          (subtopic.description && subtopic.description.toLowerCase().includes(query))
        )
      })
    })
  }

  return filtered
})

// Methods
const toggleDomain = (domainId) => {
  if (expandedDomains.value.has(domainId)) {
    expandedDomains.value.delete(domainId)
  } else {
    expandedDomains.value.add(domainId)
  }
}

const toggleTopic = (topicId) => {
  if (expandedTopics.value.has(topicId)) {
    expandedTopics.value.delete(topicId)
  } else {
    expandedTopics.value.add(topicId)
  }
}


// Domain CRUD
const editDomain = (domain) => {
  editingDomain.value = domain
  domainForm.value = {
    name: domain.name,
    description: domain.description || '',
    code: domain.code || '',
    category: domain.category || '',
    is_active: domain.is_active
  }
  domainDialogOpen.value = true
}

const saveDomain = () => {
  if (editingDomain.value) {
    router.put(route('admin.diagnostics.domains.update', editingDomain.value.id), domainForm.value)
  } else {
    router.post(route('admin.diagnostics.domains.store'), domainForm.value)
  }
  domainDialogOpen.value = false
  resetDomainForm()
}

const deleteDomain = (domain) => {
  if (confirm(`Are you sure you want to delete "${domain.name}"? This action cannot be undone.`)) {
    router.delete(route('admin.diagnostics.domains.destroy', domain.id))
  }
}

const resetDomainForm = () => {
  editingDomain.value = null
  domainForm.value = {
    name: '',
    description: '',
    code: '',
    category: '',
    is_active: true
  }
}

// Topic CRUD
const showAddTopicDialog = (domainId) => {
  topicForm.value.domain_id = domainId
  topicDialogOpen.value = true
}

const editTopic = (topic) => {
  editingTopic.value = topic
  topicForm.value = {
    domain_id: topic.domain_id,
    name: topic.name,
    description: topic.description || ''
  }
  topicDialogOpen.value = true
}

const saveTopic = () => {
  if (editingTopic.value) {
    router.put(route('admin.diagnostics.domains.topics.update', editingTopic.value.id), topicForm.value)
  } else {
    router.post(route('admin.diagnostics.domains.topics.store'), topicForm.value)
  }
  topicDialogOpen.value = false
  resetTopicForm()
}

const deleteTopic = (topic) => {
  if (confirm(`Are you sure you want to delete "${topic.name}"? This action cannot be undone.`)) {
    router.delete(route('admin.diagnostics.domains.topics.destroy', topic.id))
  }
}

const resetTopicForm = () => {
  editingTopic.value = null
  topicForm.value = {
    domain_id: null,
    name: '',
    description: ''
  }
}

// Subtopic CRUD
const showAddSubtopicDialog = (topicId) => {
  subtopicForm.value.topic_id = topicId
  subtopicDialogOpen.value = true
}

const editSubtopic = (subtopic) => {
  editingSubtopic.value = subtopic
  subtopicForm.value = {
    topic_id: subtopic.topic_id,
    name: subtopic.name,
    description: subtopic.description || ''
  }
  subtopicDialogOpen.value = true
}

const saveSubtopic = () => {
  if (editingSubtopic.value) {
    router.put(route('admin.diagnostics.domains.subtopics.update', editingSubtopic.value.id), subtopicForm.value)
  } else {
    router.post(route('admin.diagnostics.domains.subtopics.store'), subtopicForm.value)
  }
  subtopicDialogOpen.value = false
  resetSubtopicForm()
}

const deleteSubtopic = (subtopic) => {
  if (confirm(`Are you sure you want to delete "${subtopic.name}"? This action cannot be undone.`)) {
    router.delete(route('admin.diagnostics.domains.subtopics.destroy', subtopic.id))
  }
}

const resetSubtopicForm = () => {
  editingSubtopic.value = null
  subtopicForm.value = {
    topic_id: null,
    name: '',
    description: ''
  }
}

// Handle domain dialog
const openAddDomainDialog = () => {
  resetDomainForm()
  domainDialogOpen.value = true
}

// Update the showAddDomainDialog ref binding
showAddDomainDialog.value = false
</script>