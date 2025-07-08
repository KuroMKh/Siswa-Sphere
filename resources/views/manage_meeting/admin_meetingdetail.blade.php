<x-layouts.app :title="__('Meeting Details')">
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-6xl mx-auto px-4">
            <!-- Header Section -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $meeting->title }}</h1>
                    <p class="text-gray-600 dark:text-gray-400">Meeting ID: {{ $meeting->id }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column: Date & Time, Agenda, Memo -->
                <div class="space-y-6">
                    <!-- Date & Time Card -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <span class="text-blue-500 mr-2">📅</span>
                                Date & Time
                            </h2>
                            <form action="{{ route('meeting.updateDateTime', $meeting->id) }}" method="POST"
                                onsubmit="return confirmUpdate('date and time')">
                                @csrf
                                @method('POST')

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date</label>
                                        <input type="date" name="date"
                                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            value="{{ \Carbon\Carbon::parse($meeting->date)->format('Y-m-d') }}"
                                            required>
                                    </div>
                                    <div>
                                        <label
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Time</label>
                                        <input type="time" name="time"
                                            class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            value="{{ \Carbon\Carbon::parse($meeting->time)->format('H:i') }}" required>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center">
                                    <span class="mr-2">💾</span>
                                    Save Date & Time
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Agenda & Memo Card -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <span class="text-green-500 mr-2">📝</span>
                                Meeting Details
                            </h2>

                            <!-- Agenda Section -->
                            <div class="mb-6">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Agenda</label>
                                <form
                                    action="{{ route('meeting.updateAgendaMemo', ['id' => $meeting->id, 'type' => 'agenda']) }}"
                                    method="POST" onsubmit="return confirmUpdate('agenda')">
                                    @csrf
                                    @method('POST')
                                    <div class="flex space-x-2">
                                        <input type="text" name="agenda"
                                            class="flex-1 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            value="{{ $meeting->agenda ?: 'Not Provided' }}" placeholder="Enter agenda">
                                        <button type="submit"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                            ✏️ Update
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Memo Section -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Memo</label>
                                <form
                                    action="{{ route('meeting.updateAgendaMemo', ['id' => $meeting->id, 'type' => 'memo']) }}"
                                    method="POST" onsubmit="return confirmUpdate('memo')">
                                    @csrf
                                    @method('POST')
                                    <div class="flex space-x-2">
                                        <input type="text" name="memo"
                                            class="flex-1 border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                            value="{{ $meeting->memo ?: 'Not Provided' }}" placeholder="Enter memo">
                                        <button type="submit"
                                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                                            ✏️ Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Documents -->
                <div class="space-y-6">
                    <!-- Documents Card -->
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <span class="text-purple-500 mr-2">📁</span>
                                Meeting Documents
                            </h2>

                            <div class="space-y-4">
                                <!-- Financial Document -->
                                <div
                                    class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                                    <div class="flex items-center mb-3">
                                        <span class="text-green-500 mr-2">💰</span>
                                        <h3 class="font-medium text-gray-900 dark:text-white">Financial Document</h3>
                                    </div>

                                    @if($meeting->financial_path)
                                        <a href="{{ asset($meeting->financial_path) }}" target="_blank"
                                            class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 underline break-all mb-3 block">
                                            {{ basename($meeting->financial_path) }}
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">No document uploaded</p>
                                    @endif

                                    <form
                                        action="{{ route('meeting.updateDocument', ['id' => $meeting->id, 'type' => 'financial']) }}"
                                        method="POST" enctype="multipart/form-data"
                                        onsubmit="return confirmUpdate('financial document')">
                                        @csrf
                                        @method('POST')
                                        <div class="flex space-x-2">
                                            <input type="file" name="document"
                                                class="flex-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                                required>
                                            <button type="submit"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 whitespace-nowrap">
                                                ✏️ Update
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Minutes Document -->
                                <div
                                    class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                                    <div class="flex items-center mb-3">
                                        <span class="text-blue-500 mr-2">📋</span>
                                        <h3 class="font-medium text-gray-900 dark:text-white">Minutes Document</h3>
                                    </div>

                                    @if($meeting->minutes_path)
                                        <a href="{{ asset($meeting->minutes_path) }}" target="_blank"
                                            class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 underline break-all mb-3 block">
                                            {{ basename($meeting->minutes_path) }}
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">No document uploaded</p>
                                    @endif

                                    <form
                                        action="{{ route('meeting.updateDocument', ['id' => $meeting->id, 'type' => 'minutes']) }}"
                                        method="POST" enctype="multipart/form-data"
                                        onsubmit="return confirmUpdate('minutes document')">
                                        @csrf
                                        @method('POST')
                                        <div class="flex space-x-2">
                                            <input type="file" name="document"
                                                class="flex-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                                required>
                                            <button type="submit"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 whitespace-nowrap">
                                                ✏️ Update
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Official Letter Document -->
                                <div
                                    class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-700">
                                    <div class="flex items-center mb-3">
                                        <span class="text-red-500 mr-2">📄</span>
                                        <h3 class="font-medium text-gray-900 dark:text-white">Official Letter</h3>
                                    </div>

                                    @if($meeting->official_letter_path)
                                        <a href="{{ asset($meeting->official_letter_path) }}" target="_blank"
                                            class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 underline break-all mb-3 block">
                                            {{ basename($meeting->official_letter_path) }}
                                        </a>
                                    @else
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">No document uploaded</p>
                                    @endif

                                    <form
                                        action="{{ route('meeting.updateDocument', ['id' => $meeting->id, 'type' => 'official_letter']) }}"
                                        method="POST" enctype="multipart/form-data"
                                        onsubmit="return confirmUpdate('official letter document')">
                                        @csrf
                                        @method('POST')
                                        <div class="flex space-x-2">
                                            <input type="file" name="document"
                                                class="flex-1 text-sm border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                                required>
                                            <button type="submit"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200 whitespace-nowrap">
                                                ✏️ Update
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mt-6">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                        <span class="text-orange-500 mr-2">⚡</span>
                        Meeting Actions
                    </h2>

                    <form method="POST" action="{{ route('admin_meetingdetail', $meeting->id) }}"
                        class="flex flex-wrap gap-4">
                        @csrf
                        <button type="submit" name="meeting_status" value="Cancelled"
                            onclick="return confirmMeetingAction('cancel', '❌')"
                            class="flex-1 min-w-[200px] bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <span class="mr-2">❌</span>
                            Cancel Meeting
                        </button>

                        <button type="submit" name="meeting_status" value="Finished"
                            onclick="return confirmMeetingAction('mark as finished', '✅')"
                            class="flex-1 min-w-[200px] bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center justify-center">
                            <span class="mr-2">✅</span>
                            Mark as Finished
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Confirmation Scripts -->
    <script>
        // Confirmation for meeting status changes
        function confirmMeetingAction(action, emoji) {
            const title = document.querySelector('h1').textContent;
            return confirm(`${emoji} Are you sure you want to ${action} this meeting?\n\nMeeting: ${title}\n\nThis action cannot be undone.`);
        }

        // Confirmation for updates
        function confirmUpdate(type) {
            return confirm(`Are you sure you want to update the ${type}?\n\nThis will save the changes immediately.`);
        }

        // Enhanced form validation
        document.addEventListener('DOMContentLoaded', function () {
            // Add visual feedback for file inputs
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function () {
                    const fileName = this.files[0]?.name || 'No file selected';
                    const maxLength = 30;
                    const displayName = fileName.length > maxLength ?
                        fileName.substring(0, maxLength) + '...' : fileName;

                    // Create or update file name display
                    let display = this.parentNode.querySelector('.file-name-display');
                    if (!display) {
                        display = document.createElement('div');
                        display.className = 'file-name-display text-xs text-gray-600 dark:text-gray-400 mt-1';
                        this.parentNode.appendChild(display);
                    }
                    display.textContent = displayName;
                });
            });

            // Add loading states to buttons
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function (e) {
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        const originalText = submitButton.innerHTML;
                        submitButton.innerHTML = '<span class="mr-2">⏳</span>Processing...';
                        submitButton.disabled = true;

                        // Re-enable after 3 seconds in case of errors
                        setTimeout(() => {
                            submitButton.innerHTML = originalText;
                            submitButton.disabled = false;
                        }, 3000);
                    }
                });
            });
        });
    </script>
</x-layouts.app>