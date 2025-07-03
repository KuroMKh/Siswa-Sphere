<x-layouts.app :title="__('Meeting Details')">
    <div class="p-6 max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $meeting->title }}</h2>

            <p class="text-gray-600 dark:text-gray-300 mt-2">
                📅 {{ \Carbon\Carbon::parse($meeting->date)->format('F j, Y') }}
            </p>
            <p class="text-gray-600 dark:text-gray-300">
                ⏰ {{ \Carbon\Carbon::parse($meeting->time)->format('g:i A') }}
            </p>

            <div class="mt-6 space-y-3 text-gray-700 dark:text-gray-300">
                <p><strong>📝 Agenda:</strong> {{ $meeting->agenda ?: 'Not Provided' }}</p>
                <p><strong>🗒️ Memo:</strong> {{ $meeting->memo ?: 'Not Provided' }}</p>
            </div>

            <!-- Meeting Documents Section -->
            <div class="mt-6 space-y-3 text-gray-700 dark:text-gray-300">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">📁 Meeting Documents</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                        <p><strong>💰 Financial Path:</strong></p>
                        @if($meeting->financial_path)
                            <a href="{{ asset($meeting->financial_path) }}" target="_blank"
                                class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 break-all underline cursor-pointer">
                                {{ $meeting->financial_path }}
                            </a>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">Not Available</p>
                        @endif
                    </div>

                    <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                        <p><strong>📋 Minutes Path:</strong></p>
                        @if($meeting->minutes_path)
                            <a href="{{ asset($meeting->minutes_path) }}" target="_blank"
                                class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 break-all underline cursor-pointer">
                                {{ $meeting->minutes_path }}
                            </a>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">Not Available</p>
                        @endif
                    </div>

                    <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4">
                        <p><strong>📄 Official Letter Path:</strong></p>
                        @if($meeting->official_letter_path)
                            <a href="{{ asset($meeting->official_letter_path) }}" target="_blank"
                                class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 break-all underline cursor-pointer">
                                {{ $meeting->official_letter_path }}
                            </a>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">Not Available</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <form method="POST" action="{{ route('admin_meetingdetail', $meeting->id) }}">
                @csrf
                <button type="submit" name="meeting_status" value="Cancelled"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    ❌ Cancel Meeting
                </button>

                <button type="submit" name="meeting_status" value="Finished"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    ✔️ Mark as Finished
                </button>
            </form>

        </div>
    </div>
</x-layouts.app>