<template>
    <div class="flex flex-col lg:flex-row bg-gray-300 p-2 lg:p-4">
        <div
            class="transition-all duration-300 bg-white backdrop-blur-md rounded-2xl w-full lg:w-4/6"
        >
            <div
                :class="[
                    'border1',
                    {
                        'border-[#999]': !isReview,
                        'border-[#8addae]': answer.is_correct,
                        'border-[#cb7d75]': !answer.is_correct && isReview,
                    },
                ]"
            >
                <div
                    class="p-8 rounded font-medium"
                    v-html="question.content"
                ></div>
                <div class="relative overflow-hidden mb-8">
                    <img v-if="question.image && question.image.path" :src="question.image.path" class="pl-8" />
                    <template v-if="isReview">
                        <div
                            v-for="(option, i) in question.options"
                            :key="`option-${i}`"
                            :class="[
                                'h-[70px] w-[70px] absolute rounded-none z-[200] ml-[-35px] mt-[-35px]',
                                {
                                    'bg-[#8addae] border-[#22c55d] border bg-opacity-50':
                                        isCorrectOption(i),
                                    'bg-[#f8e7e6] border border-[#cb7d75] bg-opacity-50':
                                        isIncorrectOption(option),
                                },
                            ]"
                        :style="
                            'top:' + option.y + 'px; left:' + option.x + 'px'
                        "
                    ></div>
                    </template>
                    <template v-else>
                        <div
                            v-for="(option, i) in question.options"
                            :key="`interactive-${i}`"
                            :class="[
                                'h-[70px] w-[70px] absolute rounded-none cursor-pointer z-[200] ml-[-35px] mt-[-35px]',
                                selectedOptions == option
                                    ? 'bg-blue-500 border border-blue-700 bg-opacity-50'
                                    : 'hover:bg-blue-500 hover:bg-opacity-50 hover:border hover:border-blue-700',
                            ]"
                            :style="
                                'top:' + option.y + 'px; left:' + option.x + 'px'
                            "
                            @click="select(option)"
                        ></div>
                    </template>
                </div>
            </div>
            <div
                v-if="isReview"
                :class="[
                    'py-6 rounded-b-2xl shadow-md',
                    {
                        'bg-[#dcffdc] border-[#aaddae]': answer.is_correct,
                        'bg-[#f8e7e6] border-[#ab7d75]': !answer.is_correct,
                    },
                ]"
            >
                <span class="m-5">
                    <span class="font-semibold">Correct Answer is: </span>
                    <span class="font-semibold">
                        {{ bullets[correctOptionIndex] }}.
                    </span>
                    <div class="p-1.25 m-5">Justification</div>
                </span>
                <ul class="list-disc list-outside">
                    <li
                        v-for="(option, i) in question.justifications"
                        :key="`justification-${i}`"
                        class="m-5"
                        :class="{ 'font-semibold': isCorrectOption(i) }"
                    >
                        {{ bullets[i] }}. {{ option }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="my-4 lg:hidden flex justify-end px-4">
            <button
                @click="showMetadata = !showMetadata"
                class="bg-white text-gray-800 font-semibold px-4 py-2 border border-gray-300 rounded-full shadow-sm hover:bg-gray-100 transition duration-200"
                aria-label="Toggle Question Details"
            >
                {{
                    showMetadata
                        ? "Hide Question Details"
                        : "Show Question Details"
                }}
            </button>
        </div>

        <div
            v-show="showMetadata || isDesktop"
            class="bg-white backdrop-blur-md rounded-2xl w-full lg:w-2/6 p-6 lg:ml-4"
        >
            <div class="mb-3 font-semibold text-lg text-gray-700">
                Question Details
            </div>
            <div class="mb-2">
                <span class="font-semibold">Type:</span>
                {{ question.type.name }}
            </div>
            <div class="mb-2">
                <span class="font-semibold">Difficulty:</span>
                {{ question.difficulty.name }}
            </div>
            <div class="mb-2">
                <span class="font-semibold">Bloom Level:</span>
                {{ question.bloom?.name || 'Unknown' }}
            </div>
            <div v-if="question.topics && question.topics.length > 0">
                <span class="font-semibold">Topics:</span>
                {{ question.topics.map(topic => topic.name).join(', ') }}
            </div>

            <div
                v-if="
                    selectedOptions &&
                    selectedOptions.x !== undefined &&
                    selectedOptions.y !== undefined
                "
                class="mt-3"
            >
                <div class="font-semibold">Your Answer:</div>
                <ul class="list-disc ml-6 mt-1">
                    <li v-if="!isMultiChoice">
                        {{ bullets[selectedOptionIndex()] }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["question", "answer", "isReview"],
    data() {
        return {
            selectedOptions: [],
            bullets: ["A", "B", "C", "D", "E", "F", "G", "H"],
            showMetadata: false,
        };
    },
    methods: {
        select(option) {
            this.selectedOptions = option;
        },
        isCorrectOption(index) {
            return this.correctOptionIndex == index;
        },
        isIncorrectOption(option) {
            const selected = this.answer.selected_options;
            const correct = this.question.correct_options;
            return (
                selected?.x === option.x &&
                selected?.y === option.y &&
                !(correct?.x === option.x && correct?.y === option.y)
            );
        },
        selectedOptionIndex() {
            return this.question.options.findIndex(
                (option) =>
                    this.selectedOptions.x === option.x &&
                    this.selectedOptions.y === option.y
            );
        },
        findArrayIndex(mainArray, searchArray) {
            return mainArray.findIndex(
                (arr) =>
                    arr.length === searchArray.length &&
                    arr.every(
                        (element, index) => element === searchArray[index]
                    )
            );
        },
    },
    computed: {
        correctOptionIndex() {
            const target = this.question.correct_options;
            return this.question.options.findIndex(
                (item) => item.x === target.x && item.y === target.y
            );
        },
        isMultiChoice() {
            return (
                Array.isArray(this.question.correct_options) &&
                this.question.correct_options.length > 1
            );
        },
        isDesktop() {
            // A basic check for desktop, can be improved or replaced with a better approach
            return window.innerWidth >= 1024;
        },
    },
    watch: {
        question() {
            this.selectedOptions = [];
        },
        selectedOptions() {
            this.$emit("selected", this.selectedOptions);
        },
    },
};
</script>
