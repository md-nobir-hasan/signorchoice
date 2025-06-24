<div class="p-6 max-w-2xl mx-auto bg-white rounded-lg">
    <!-- Header -->
    <div class="border-b pb-4 mb-6">
        <h2 class="text-2xl font-semibold text-[#380D37]">Review for {{ $product->title }}</h2>
        <p class="text-gray-600 mt-1">Share your experience with this product</p>
    </div>

    <form wire:submit="submitReview">
        <!-- Rating -->
        <div class="mb-6">
            <label class="block text-lg font-medium text-gray-700 mb-3">Overall Rating</label>
            <div class="flex items-center gap-3">
                <div class="flex gap-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <button type="button"
                                wire:click="$set('rating', {{ $i }})"
                                class="transform transition-transform hover:scale-110 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-10 w-10 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-200"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        </button>
                    @endfor
                </div>
                <span class="text-lg font-medium ml-2 {{ $rating >= 4 ? 'text-green-600' : ($rating >= 2 ? 'text-yellow-600' : 'text-red-600') }}">
                    {{ $rating }} out of 5
                </span>
            </div>
            @error('rating')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Review Message -->
        <div class="mb-6">
            <label for="review" class="block text-lg font-medium text-gray-700 mb-3">Your Review</label>
            <div class="relative">
                <textarea
                    wire:model="review"
                    id="review"
                    rows="5"
                    class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-[#380D37] focus:ring focus:ring-[#380D37] focus:ring-opacity-20 transition-all duration-200 p-4 text-base"
                    placeholder="What did you like or dislike about this product? Share your honest opinion to help other shoppers..."></textarea>

            </div>
            @error('review')
                <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end gap-4 border-t pt-6">
            <button type="button"
                    class="px-6 py-3 text-base font-medium text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#380D37] transition-colors duration-200"
                    wire:click="$dispatch('closeModal')">
                Cancel
            </button>
            <button type="submit"
                    class="px-6 py-3 text-base font-medium text-white bg-[#380D37] border-2 border-[#380D37] rounded-lg hover:bg-[#380D37]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#380D37] transition-colors duration-200">
                Submit Review
            </button>
        </div>
    </form>
</div>
