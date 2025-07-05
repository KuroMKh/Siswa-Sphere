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

            <form method="POST" action="{{ route('member_attendance', $meeting->id) }}">
                @csrf
                <button type="submit" name="attendance_status" value="Absent"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    ❌ Absent
                </button>

                <button type="submit" name="attendance_status" value="Attend"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                    ✔️ Attend
                </button>
            </form>

        </div>
    </div>
</x-layouts.app>