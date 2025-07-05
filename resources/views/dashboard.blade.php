<x-layouts.app :title="__('Member Dashboard')">
    <div class="p-6 max-w-6xl mx-auto">

        <!-- Top Cards Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Welcome Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Welcome Back!
                </h2>
                <p class="text-gray-600 dark:text-gray-300 mt-2">
                    {{ auth()->user()->name }}
                </p>
            </div>

            <!-- Meeting Count Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    This Week
                </h2>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $meetingCount }}</p>
                <p class="text-gray-600 dark:text-gray-300 text-sm">meetings scheduled</p>
            </div>

            <!-- Status Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Status
                </h2>
                <p class="text-green-600 font-medium mt-2">All caught up!</p>
            </div>
        </div>

        <!-- Meetings List Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">

            <!-- Section Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    📅 Upcoming Meetings
                </h2>
            </div>

            <!-- Meetings List -->
            <div class="p-6 space-y-4">
                @forelse ($meetings as $meeting)
                    <div
                        class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 border border-gray-200 dark:border-gray-600 hover:shadow-md transition-shadow">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $meeting->title }}
                        </h3>

                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $meeting->meeting_status }}
                        </h3>
                        <div class="text-gray-600 dark:text-gray-300 space-y-1">
                            <p>📅 {{ \Carbon\Carbon::parse($meeting->date)->format('F j, Y') }}</p>
                            <p>⏰ {{ \Carbon\Carbon::parse($meeting->time)->format('g:i A') }}</p>
                        </div>

                        {{-- ✅ Status badge --}}
                        <div class="mt-3">
                            <span class="text-sm font-semibold
                                                                @if ($meeting->user_status === 'coming') text-green-600
                                                                @elseif ($meeting->user_status === 'absent') text-red-600
                                                                @else text-yellow-500 @endif">
                                Status: {{ ucfirst($meeting->user_status) }}
                            </span>
                        </div>

                        <a href="{{ route('admin.meetingdetail', $meeting->id) }}"
                            class="mt-3 text-blue-600 dark:text-blue-400 hover:underline text-sm font-medium">
                            View Details & Confirm →
                        </a>

                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No meetings scheduled yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-layouts.app>