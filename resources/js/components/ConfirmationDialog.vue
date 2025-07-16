<template>
    <TransitionRoot appear :show="isOpen" as="template">
        <Dialog as="div" @close="handleClose" class="relative z-50">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div 
                    :class="[
                        'fixed inset-0 bg-black/25 backdrop-blur-sm',
                        isDark ? 'bg-black/40' : 'bg-black/25'
                    ]" 
                />
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
                        <DialogPanel 
                            :class="[
                                'w-full max-w-md transform overflow-hidden rounded-2xl p-6 text-left align-middle shadow-xl transition-all border',
                                isDark 
                                    ? 'bg-gray-800 border-gray-700' 
                                    : 'bg-white border-gray-200'
                            ]"
                        >
                            <!-- Icon -->
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full mb-4"
                                 :class="iconBackgroundClass">
                                <component :is="iconComponent" class="h-6 w-6" :class="iconColorClass" />
                            </div>

                            <!-- Title -->
                            <DialogTitle 
                                as="h3" 
                                :class="[
                                    'text-lg font-semibold leading-6 text-center mb-2',
                                    isDark ? 'text-gray-100' : 'text-gray-900'
                                ]"
                            >
                                {{ title }}
                            </DialogTitle>

                            <!-- Description -->
                            <div class="mt-2 mb-6">
                                <p :class="[
                                    'text-sm text-center',
                                    isDark ? 'text-gray-300' : 'text-gray-600'
                                ]">
                                    {{ description }}
                                </p>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3 justify-center">
                                <button
                                    v-if="cancelText"
                                    ref="cancelButtonRef"
                                    type="button"
                                    :class="[
                                        'flex-1 inline-flex justify-center rounded-lg border px-4 py-2 text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2',
                                        isDark 
                                            ? 'border-gray-600 bg-gray-700 text-gray-200 hover:bg-gray-600 focus:ring-gray-500' 
                                            : 'border-gray-300 bg-white text-gray-700 hover:bg-gray-50 focus:ring-gray-500'
                                    ]"
                                    @click="handleCancel"
                                >
                                    {{ cancelText }}
                                </button>
                                <button
                                    ref="confirmButtonRef"
                                    type="button"
                                    :class="[
                                        'flex-1 inline-flex justify-center rounded-lg px-4 py-2 text-sm font-medium text-white transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2',
                                        confirmButtonClass,
                                        'hover:opacity-90'
                                    ]"
                                    @click="handleConfirm"
                                >
                                    {{ confirmText }}
                                </button>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import { computed, nextTick, ref, watch } from 'vue'
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {
    ExclamationTriangleIcon,
    QuestionMarkCircleIcon,
    XCircleIcon,
    CheckCircleIcon,
    InformationCircleIcon
} from '@heroicons/vue/24/outline'

const props = defineProps({
    isOpen: {
        type: Boolean,
        default: false
    },
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: 'question', // question, warning, error, success, info
        validator: (value) => ['question', 'warning', 'error', 'success', 'info'].includes(value)
    },
    confirmText: {
        type: String,
        default: 'Confirm'
    },
    cancelText: {
        type: String,
        default: 'Cancel'
    },
    isDark: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['confirm', 'cancel', 'close'])

const cancelButtonRef = ref()
const confirmButtonRef = ref()

const iconComponent = computed(() => {
    const icons = {
        question: QuestionMarkCircleIcon,
        warning: ExclamationTriangleIcon,
        error: XCircleIcon,
        success: CheckCircleIcon,
        info: InformationCircleIcon
    }
    return icons[props.type]
})

const iconBackgroundClass = computed(() => {
    const classes = {
        question: 'bg-blue-100',
        warning: 'bg-yellow-100',
        error: 'bg-red-100',
        success: 'bg-green-100',
        info: 'bg-blue-100'
    }
    return classes[props.type]
})

const iconColorClass = computed(() => {
    const classes = {
        question: 'text-blue-600',
        warning: 'text-yellow-600',
        error: 'text-red-600',
        success: 'text-green-600',
        info: 'text-blue-600'
    }
    return classes[props.type]
})

const confirmButtonClass = computed(() => {
    const classes = {
        question: 'bg-blue-600 focus:ring-blue-500',
        warning: 'bg-yellow-600 focus:ring-yellow-500',
        error: 'bg-red-600 focus:ring-red-500',
        success: 'bg-green-600 focus:ring-green-500',
        info: 'bg-blue-600 focus:ring-blue-500'
    }
    return classes[props.type]
})

const handleConfirm = () => {
    emit('confirm')
    emit('close')
}

const handleCancel = () => {
    emit('cancel')
    emit('close')
}

const handleClose = () => {
    emit('close')
}

// Focus the appropriate button when the modal opens
watch(() => props.isOpen, (isOpen) => {
    if (isOpen) {
        nextTick(() => {
            // Focus cancel button if it exists, otherwise focus confirm button
            if (props.cancelText && cancelButtonRef.value) {
                cancelButtonRef.value.focus()
            } else if (confirmButtonRef.value) {
                confirmButtonRef.value.focus()
            }
        })
    }
})
</script>