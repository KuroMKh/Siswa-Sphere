<x-layouts.app :title="__('Member Profile')">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-5xl mx-auto mt-6">
        {{-- 📌 Section 1: Display Only --}}
        <div
            class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Profile Info</h2>
            <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-200">
                <li><span class="font-medium">Matrix No:</span> {{ auth()->user()->matrix_no}}</li>
                <li><span class="font-medium">Position:</span> {{ auth()->user()->position ?: 'Not Update yet'}}</li>
                <li><span class="font-medium">Year:</span>{{ auth()->user()->year ?: 'Not Update Yet'}}</li>
                <li><span class="font-medium">Semester:</span> {{ auth()->user()->semester ?: 'Not Update Yet'}}</li>
            </ul>
        </div>

        {{-- ✏️ Section 2: Update Form --}}
        <div
            class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Update Info</h2>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Year</label>
                    <input type="number" name="year" value="{{ auth()->user()->year}}"
                        class="w-full mt-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-neutral-800 px-3 py-2 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Semester</label>
                    <input type="number" name="semester" value="{{ auth()->user()->semester}}"
                        class="w-full mt-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-neutral-800 px-3 py-2 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>