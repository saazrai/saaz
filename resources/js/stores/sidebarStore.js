import { defineStore } from 'pinia'

export const useSidebarStore = defineStore('sidebar', {
    state: () => ({
        openGroups: [],
        scrollPosition: 0,
        isNavigating: false,
        initialized: false
    }),

    actions: {
        initializeFromStorage() {
            if (this.initialized) return
            
            // Ensure openGroups is always an array (fix persistence issues)
            if (!Array.isArray(this.openGroups)) {
                this.openGroups = []
            }
            
            // Default groups to be open if no stored state
            if (this.openGroups.length === 0) {
                this.openGroups = ['overview', 'content']
            }
            
            this.initialized = true
        },

        ensureActiveGroupOpen(activeGroup) {
            // Ensure openGroups is always an array
            if (!Array.isArray(this.openGroups)) {
                this.openGroups = []
            }
            
            if (activeGroup && !this.openGroups.includes(activeGroup)) {
                this.openGroups.push(activeGroup)
            }
        },

        toggleGroup(groupKey) {
            // Ensure openGroups is always an array
            if (!Array.isArray(this.openGroups)) {
                this.openGroups = []
            }
            
            const index = this.openGroups.indexOf(groupKey)
            if (index !== -1) {
                this.openGroups.splice(index, 1)
            } else {
                this.openGroups.push(groupKey)
            }
        },

        isGroupOpen(groupKey) {
            // Ensure openGroups is always an array
            if (!Array.isArray(this.openGroups)) {
                this.openGroups = []
            }
            
            return this.openGroups.includes(groupKey)
        },

        updateScrollPosition(position) {
            this.scrollPosition = position
        },

        setNavigating(value) {
            this.isNavigating = value
        }
    },

    persist: {
        enabled: true,
        strategies: [
            {
                storage: localStorage,
                paths: ['openGroups', 'scrollPosition']
            }
        ]
    }
})
