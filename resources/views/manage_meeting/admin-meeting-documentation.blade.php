<x-layouts.app :title="__('Meeting Documentation')">
    <div class="p-6 max-w-7xl mx-auto">

        <!-- Dashboard Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Meeting Documentation</h1>
            <p class="text-gray-600 dark:text-gray-400">Access your previous and current meeting document </p>
        </div>

        <!-- Meetings List Section -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm max-w-5xl mx-auto">

            <!-- Section Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <span class="text-xl">📋</span>
                        Meeting Documents Archive
                    </h2>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $meetings->count() }} {{ $meetings->count() === 1 ? 'document' : 'documents' }}
                    </div>
                </div>
            </div>

            <!-- Meetings List -->
            <div class="p-4">
                @forelse ($meetings as $meeting)
                    <div
                        class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4 border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all duration-200 hover:bg-gray-100 dark:hover:bg-gray-700 mb-4 last:mb-0">

                        <!-- Meeting Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 truncate">
                                    {{ $meeting->title }}
                                </h3>
                                <div class="mb-6">
                                    <h4
                                        class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase mb-2 tracking-wide">
                                        Agenda
                                    </h4>
                                    <p
                                        class="text-base text-gray-700 dark:text-gray-300 leading-relaxed italic border-l-4 border-indigo-400 pl-4">
                                        {{ $meeting->agenda }}
                                    </p>
                                </div>
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
                        <div class="flex flex-wrap items-center gap-4 text-gray-600 dark:text-gray-300 mb-4">
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
                            @if($meeting->user_status === 'Absent' && $meeting->absent_reason)
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span
                                        class="text-sm text-red-600 dark:text-red-400">{{ ucfirst($meeting->absent_reason) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Meeting Documentation Details -->
                        <div class="border-t border-gray-200 dark:border-gray-600 pt-4">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Meeting Documentation Details
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <!-- Financial Document -->
                                @if($meeting->financial_path)
                                    <a href="{{ asset('storage/' . $meeting->financial_path) }}" target="_blank"
                                        class="flex items-center gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-700 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors duration-200 group">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-blue-900 dark:text-blue-200">Financial Report</p>
                                            <p class="text-xs text-blue-600 dark:text-blue-400 truncate">
                                                {{ basename($meeting->financial_path) }}
                                            </p>
                                        </div>
                                        <svg class="w-4 h-4 text-blue-500 dark:text-blue-400 group-hover:translate-x-1 transition-transform duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                @else
                                    <div
                                        class="flex items-center gap-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 opacity-50">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Financial Report</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">Not available</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Official Letter -->
                                @if($meeting->official_letter_path)
                                    <a href="{{ asset('storage/' . $meeting->official_letter_path) }}" target="_blank"
                                        class="flex items-center gap-3 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-700 hover:bg-green-100 dark:hover:bg-green-900/30 transition-colors duration-200 group">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-green-900 dark:text-green-200">Official Letter
                                            </p>
                                            <p class="text-xs text-green-600 dark:text-green-400 truncate">
                                                {{ basename($meeting->official_letter_path) }}
                                            </p>
                                        </div>
                                        <svg class="w-4 h-4 text-green-500 dark:text-green-400 group-hover:translate-x-1 transition-transform duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                @else
                                    <div
                                        class="flex items-center gap-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 opacity-50">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Official Letter</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">Not available</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Meeting Minutes -->
                                @if($meeting->minute_path)
                                    <a href="{{ asset('storage/' . $meeting->minute_path) }}" target="_blank"
                                        class="flex items-center gap-3 p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg border border-purple-200 dark:border-purple-700 hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors duration-200 group">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-purple-900 dark:text-purple-200">Meeting Minutes
                                            </p>
                                            <p class="text-xs text-purple-600 dark:text-purple-400 truncate">
                                                {{ basename($meeting->minute_path) }}
                                            </p>
                                        </div>
                                        <svg class="w-4 h-4 text-purple-500 dark:text-purple-400 group-hover:translate-x-1 transition-transform duration-200"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                @else
                                    <div
                                        class="flex items-center gap-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 opacity-50">
                                        <div class="flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Meeting Minutes</p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">Not available</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No meeting documents available
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">There are no meeting documents to display
                            at the
                            moment.</p>
                    </div>
                @endforelse

                <div class="mt-6">
                    {{ $meetings->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>