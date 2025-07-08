<x-layouts.app :title="__('Member Dashboard')">
    <div class="p-6 max-w-7xl mx-auto">

        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Admin Dashboard</h1>
            <p class="text-gray-600 dark:text-gray-400">Manage your meetings details</p>
        </div>

        <!-- Top Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Meeting Count Card -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                            Meeting in Line
                        </h2>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $meetingCount }}</p>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">meetings scheduled</p>
                    </div>
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Confirm Attend Meeting Card -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                            Finished
                        </h2>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400 mb-1">{{ $meetingFinished }}</p>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Meetings Finished</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Confirm Absent Meeting Card -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                            Cancelled
                        </h2>
                        <p class="text-3xl font-bold text-red-600 dark:text-red-400 mb-1">{{ $meetingCancelled }}</p>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Meetings Cancelled</p>
                    </div>
                    <div class="bg-red-50 dark:bg-red-900/20 p-3 rounded-full">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meetings List Section -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm max-w-5xl mx-auto">

            <!-- Section Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span class="text-xl">📅</span>
                        Upcoming Meetings
                    </h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $meetings->count() }} {{ $meetings->count() === 1 ? 'meeting' : 'meetings' }}
                    </div>
                </div>
            </div>

            <!-- Meetings List -->
            <div class="p-4">
                @forelse ($meetings as $meeting)
                    <div
                        class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 mb-3 last:mb-0">

                        <!-- Meeting Header -->
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1 truncate">
                                    {{ $meeting->title }}
                                </h3>

                                <!-- Meeting Status Badge -->
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                                                                                                @if($meeting->meeting_status === 'Finished') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400
                                                                                                                                                @elseif($meeting->meeting_status === 'Cancelled') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-400
                                                                                                                                                @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400 @endif">
                                    {{ $meeting->meeting_status }}
                                </span>
                            </div>

                        </div>

                        <!-- Meeting Details -->
                        <div class="flex flex-wrap items-center gap-4 text-gray-600 dark:text-gray-300 mb-3">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm">{{ \Carbon\Carbon::parse($meeting->date)->format('F j, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm">{{ \Carbon\Carbon::parse($meeting->time)->format('g:i A') }}</span>
                            </div>
                            {{ ucfirst($meeting->absent_reason) }}
                        </div>

                        <!-- Action Button -->
                        <div class="flex justify-end">
                            <a href="{{ route('admin.meetingdetail', $meeting->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 gap-2">
                                <span>View Details & Confirm</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No meetings scheduled</h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">You don't have any upcoming meetings at the
                            moment.</p>
                    </div>
                @endforelse

                <div class="mt-4">
                    {{ $meetings->links() }}
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>