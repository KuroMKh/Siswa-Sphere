<x-layouts.app :title="__('Member Profile')">
    <div class="max-w-4xl mx-auto p-6">
        <!-- Profile Header -->
        <div class="bg-white border-l-4 border-blue-500 shadow-sm rounded-lg p-6 mb-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-2">Member Profile</h1>
            <p class="text-gray-600">Manage your academic information and profile details</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Current Profile Information -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Current Information</h2>

                <div class="space-y-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold">#</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Matrix Number</p>
                            <p class="font-medium text-gray-900">{{ auth()->user()->matrix_no }}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-green-600 font-semibold">👤</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Position</p>
                            <p class="font-medium text-gray-900">{{ auth()->user()->position ?: 'Not updated yet' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-purple-600 font-semibold">📅</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Academic Year</p>
                            <p class="font-medium text-gray-900">{{ auth()->user()->year ?: 'Not updated yet' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-orange-600 font-semibold">📚</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Current Semester</p>
                            <p class="font-medium text-gray-900">{{ auth()->user()->semester ?: 'Not updated yet' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Profile Form -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Update Profile</h2>

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4" id="profileForm">
                    @csrf

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                            Academic Year
                        </label>
                        <input type="number" id="year" name="year" value="{{ auth()->user()->year }}" min="1" max="6"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Enter your current academic year (1-6)</p>
                    </div>

                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                            Current Semester
                        </label>
                        <input type="number" id="semester" name="semester" value="{{ auth()->user()->semester }}"
                            min="1" max="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Enter your current semester (1-3)</p>
                    </div>

                    <div class="pt-4">
                        <button type="button" id="updateBtn"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 font-medium transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('updateBtn').addEventListener('click', function () {
            const form = document.getElementById('profileForm');
            const year = document.getElementById('year').value;
            const semester = document.getElementById('semester').value;

            // Basic validation
            if (!year || !semester) {
                alert('Please fill in both year and semester fields.');
                return;
            }

            if (year < 1 || year > 6) {
                alert('Please enter a valid academic year (1-6).');
                return;
            }

            if (semester < 1 || semester > 8) {
                alert('Please enter a valid semester (1-8).');
                return;
            }

            // Confirmation
            if (confirm('Are you sure you want to update your profile?\n\nYear: ' + year + '\nSemester: ' + semester)) {
                alert('Profile updated successfully!');
                form.submit();
            }
        });
    </script>
</x-layouts.app>