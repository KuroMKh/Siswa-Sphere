<x-layouts.app :title="__('Member Profile')">
    <div class="max-w-6xl mx-auto p-6">
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
                    <!-- Profile Picture -->
                    <div class="flex items-center">
                        <div
                            class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mr-3 overflow-hidden">
                            @if(auth()->user()->studentInformation?->profile_picture)
                                <img src="{{ asset('storage/' . auth()->user()->studentInformation->profile_picture) }}"
                                    alt="Profile Picture" class="w-full h-full object-cover">
                            @else
                                <span class="text-gray-400 text-2xl">📷</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Profile Picture</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->profile_picture ? 'Uploaded' : 'Not uploaded yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 font-semibold">#</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Matrix Number</p>
                            <p class="font-medium text-gray-900">{{ auth()->user()->studentInformation?->matrix_no ?: 'Not updated yet' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-green-600 font-semibold">👤</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Position</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->position ?: 'Not updated yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-pink-600 font-semibold">📞</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Phone Number</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->phone_number ?: 'Not updated yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-pink-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-pink-600 font-semibold">ℹ️</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Bio</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->bio ?: 'Not updated yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-yellow-600 font-semibold">🎂</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Date of Birth</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->date_of_birth ? date('d M Y', strtotime(auth()->user()->studentInformation->date_of_birth)) : 'Not updated yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-indigo-600 font-semibold">⚧</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Gender</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->gender ?: 'Not updated yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-red-600 font-semibold">🏠</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Address</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->address ?: 'Not updated yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-purple-600 font-semibold">📅</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Academic Year</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->year ?: 'Not updated yet' }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-orange-600 font-semibold">📚</span>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Current Semester</p>
                            <p class="font-medium text-gray-900">
                                {{ auth()->user()->studentInformation?->semester ?: 'Not updated yet' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Update Profile Form -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Update Profile</h2>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4" id="profileForm">
                    @csrf

                    <!-- Profile Picture -->
                    <div>
                        <label for="profile_picture" class="block text-sm font-medium text-gray-700 mb-2">
                            Profile Picture
                        </label>
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Upload a profile picture (JPG, PNG, GIF - Max 2MB)</p>
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">
                            Phone Number
                        </label>
                        <input type="tel" id="phone_number" name="phone_number"
                            value="{{ auth()->user()->studentInformation?->phone_number }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="e.g., +60123456789">
                        <p class="text-xs text-gray-500 mt-1">Enter your phone number with country code</p>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                            Bio
                        </label>
                        <textarea id="bio" name="bio" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Tell us about yourself">{{ auth()->user()->studentInformation?->bio }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Enter your bio</p>
                    </div>

                    <!-- Gender -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="Male" 
                                    {{ auth()->user()->studentInformation?->gender == 'Male' ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Male</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="gender" value="Female"
                                    {{ auth()->user()->studentInformation?->gender == 'Female' ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <span class="ml-2 text-sm text-gray-700">Female</span>
                            </label>
                        </div>
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">
                            Date of Birth
                        </label>
                        <input type="date" id="date_of_birth" name="date_of_birth"
                            value="{{ auth()->user()->studentInformation?->date_of_birth }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Select your date of birth</p>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Address
                        </label>
                        <textarea id="address" name="address" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter your full address">{{ auth()->user()->studentInformation?->address }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Enter your complete address</p>
                    </div>

                    <!-- Academic Year -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                            Academic Year
                        </label>
                        <input type="number" id="year" name="year"
                            value="{{ auth()->user()->studentInformation?->year }}" min="1" max="6"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-xs text-gray-500 mt-1">Enter your current academic year (1-6)</p>
                    </div>

                    <!-- Current Semester -->
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                            Current Semester
                        </label>
                        <input type="number" id="semester" name="semester"
                            value="{{ auth()->user()->studentInformation?->semester }}" min="1" max="3"
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
            const phoneNumber = document.getElementById('phone_number').value;
            const dateOfBirth = document.getElementById('date_of_birth').value;
            const address = document.getElementById('address').value;

            // Basic validation
            if (!year || !semester) {
                alert('Please fill in both year and semester fields.');
                return;
            }

            if (year < 1 || year > 6) {
                alert('Please enter a valid academic year (1-6).');
                return;
            }

            if (semester < 1 || semester > 3) {
                alert('Please enter a valid semester (1-3).');
                return;
            }

            // Phone number validation (basic)
            if (phoneNumber && !/^[\+]?[0-9\s\-\(\)]+$/.test(phoneNumber)) {
                alert('Please enter a valid phone number.');
                return;
            }

            // Date of birth validation
            if (dateOfBirth) {
                const birthDate = new Date(dateOfBirth);
                const today = new Date();
                const age = today.getFullYear() - birthDate.getFullYear();

                if (age < 10 || age > 100) {
                    alert('Please enter a valid date of birth.');
                    return;
                }
            }

            // Build confirmation message
            let confirmMessage = 'Are you sure you want to update your profile?\n\n';
            confirmMessage += 'Year: ' + year + '\n';
            confirmMessage += 'Semester: ' + semester + '\n';

            if (phoneNumber) confirmMessage += 'Phone: ' + phoneNumber + '\n';
            if (dateOfBirth) confirmMessage += 'Date of Birth: ' + dateOfBirth + '\n';

            if (address) confirmMessage += 'Address: ' + address.substring(0, 50) + (address.length > 50 ? '...' : '') + '\n';

            // Confirmation
            if (confirm(confirmMessage)) {
                alert('Profile updated successfully!');
                form.submit();
            }
        });

        // Preview profile picture
        document.getElementById('profile_picture').addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (2MB limit)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB.');
                    this.value = '';
                    return;
                }

                // Check file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select a valid image file.');
                    this.value = '';
                    return;
                }
            }
        });
    </script>
</x-layouts.app>