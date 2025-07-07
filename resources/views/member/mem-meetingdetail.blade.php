<x-layouts.app :title="__('Meeting Details')">
    <div class="max-w-4xl mx-auto p-6">
        @php $isLocked = isset($existingAttendance); @endphp

        <!-- Meeting Header -->
        <div class="bg-white dark:bg-gray-800 border-l-4 border-blue-600 shadow rounded p-6 mb-8">
            <div class="flex items-center gap-4 mb-6">
                <div class="p-3 bg-blue-600 rounded text-white">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $meeting->title }}</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded p-4">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-blue-600 dark:text-blue-300">Date</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($meeting->date)->format('F j, Y') }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded p-4">
                    <div class="w-12 h-12 bg-green-600 text-white rounded flex items-center justify-center mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-green-600 dark:text-green-300">Time</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ \Carbon\Carbon::parse($meeting->time)->format('g:i A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Meeting Details Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Agenda -->
            <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Meeting Agenda</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $meeting->agenda ?: 'No agenda has been provided for this meeting.' }}
                    </p>
                </div>
            </div>

            <!-- Memo -->
            <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Additional Information</h3>
                <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                    <p class="text-gray-700 dark:text-gray-300">
                        {{ $meeting->memo ?: 'No additional information provided.' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Meeting Minute -->
        <div class="bg-white dark:bg-gray-800 shadow rounded p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Meeting Minute</h3>
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded">
                <p>
                    <a href="{{ asset($meeting->minute_path) }}" target="_blank"
                        class="text-blue-600 dark:text-blue-400 underline break-all">
                        {{ $meeting->financial_path }}
                    </a>
                </p>
            </div>
        </div>

        <!-- Attendance -->
        <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Attendance Confirmation</h2>

            @if($isLocked)
                <div class="bg-green-100 dark:bg-green-900 p-4 rounded mb-6">
                    <p class="text-green-800 dark:text-green-300 font-semibold mb-1">Attendance Recorded</p>
                    <p class="text-sm">Status:
                        <span class="inline-block px-3 py-1 rounded bg-green-200 dark:bg-green-700 text-green-800 dark:text-green-300 font-bold text-xs">
                            {{ $existingAttendance->status }}
                        </span>
                    </p>
                </div>
            @else
                <div class="bg-blue-100 dark:bg-blue-900 p-4 rounded mb-6">
                    <p class="text-blue-800 dark:text-blue-300 font-medium">Please confirm your attendance for this meeting</p>
                </div>
            @endif

            <form method="POST" action="{{ route('member_attendance', $meeting->id) }}" id="attendanceForm">
                @csrf
                <input type="hidden" name="absent_reason" id="hiddenAbsentReason" value="">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <button type="button" id="attendBtn"
                        class="px-6 py-4 text-white font-bold rounded bg-green-600 hover:bg-green-700 transition {{ $isLocked ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $isLocked ? 'disabled' : '' }}>
                        I Will Attend
                    </button>

                    <button type="button" id="absentBtn"
                        class="px-6 py-4 text-white font-bold rounded bg-red-600 hover:bg-red-700 transition {{ $isLocked ? 'opacity-50 cursor-not-allowed' : '' }}"
                        {{ $isLocked ? 'disabled' : '' }}>
                        Cannot Attend
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        @if(!$isLocked)
            document.getElementById('attendBtn').addEventListener('click', function () {
                if (confirm('Please confirm that you will attend this meeting.')) {
                    const form = document.getElementById('attendanceForm');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'attendance_status';
                    input.value = 'Attend';
                    form.appendChild(input);
                    alert('Thank you. Your attendance has been confirmed.');
                    form.submit();
                }
            });

            document.getElementById('absentBtn').addEventListener('click', function () {
                if (confirm('Please confirm that you cannot attend this meeting.')) {
                    const reason = prompt('Please provide a reason for your absence:');
                    if (reason !== null && reason.trim() !== '') {
                        if (confirm('Reason for absence: "' + reason + '"\n\nConfirm submission?')) {
                            document.getElementById('hiddenAbsentReason').value = reason;
                            const form = document.getElementById('attendanceForm');
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'attendance_status';
                            input.value = 'Absent';
                            form.appendChild(input);
                            alert('Thank you. Your absence has been recorded.');
                            form.submit();
                        }
                    } else {
                        alert('A reason for absence is required.');
                    }
                }
            });
        @endif
    </script>
</x-layouts.app>
