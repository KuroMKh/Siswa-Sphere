<x-layouts.app :title="'Member Dashboard'">
    <div class="p-6 max-w-7xl mx-auto">

        <!-- Top Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                    Welcome Back!
                </h2>
                <p class="text-gray-600 dark:text-gray-300">
                    Total Members: {{ $usercount ?? 0 }}
                </p>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                    Quick Actions
                </h2>
                <p class="text-gray-600 dark:text-gray-300">
                    Manage & Export
                </p>
            </div>

        </div>

        <!-- Members List Section -->
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">

            <!-- Section Header -->
            <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            👥 All Members
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                            Manage and view all registered members
                        </p>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" placeholder="Search members..."
                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                    </div>
                    <select
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
                        @foreach($positiondropdown as $position)
                            <option value="{{ $position }}">{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Members List -->
            <div class="divide-y divide-gray-200 dark:divide-gray-600">
                @forelse($listalluser as $listallusers)
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            <!-- Member Info -->
                            <div class="flex items-start sm:items-center gap-4">
                                <!-- Avatar -->
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br {{ collect(['from-blue-400 to-blue-600', 'from-green-400 to-green-600', 'from-purple-400 to-purple-600', 'from-pink-400 to-pink-600', 'from-yellow-400 to-yellow-600'])->random() }} rounded-full flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($listallusers->name ?? 'U', 0, 1)) }}
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">
                                        {{ $listallusers->name ?? 'Unknown User' }}
                                    </h3>
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                        <div class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-4 0v2m4-2v2">
                                                </path>
                                            </svg>
                                            <span>{{ $listallusers->matrix_no ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status and Actions -->
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <!-- Status Badge -->
                                <div class="flex items-center gap-2">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                        {{ $listallusers->position ?? 'No Position' }}
                                    </span>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex items-center gap-2">


                                    <a href="{{ route('all-mem-profile-detail', $listallusers->matrix_no) }}"
                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="p-12 text-center">
                        <div
                            class="mx-auto w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No members found</h3>
                        <p class="text-gray-500 dark:text-gray-400 mb-6">Get started by adding your first member to the
                            system.</p>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add First Member
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Footer -->
            @if(count($listalluser ?? []) > 0)
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-600">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600 dark:text-gray-400">
                            Showing {{ count($listalluser) }} members
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400">Previous</button>
                            <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded">1</button>
                            <button
                                class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400">Next</button>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-layouts.app>