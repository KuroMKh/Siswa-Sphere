<x-layouts.app :title="__('Member Profile')">
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 w-full max-w-7xl mx-auto mt-6">
        @forelse($listalluser as $listallusers)
            {{-- 📌 Section 1: Basic Profile Info --}}
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Basic Information</h2>

                {{-- Profile Picture --}}
                @if($listallusers->profile_picture)
                    <div class="flex justify-center mb-4">
                        <img src="{{ asset('storage/' . $listallusers->profile_picture) }}" alt="Profile Picture"
                            class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-600">
                    </div>
                @endif

                <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-200">
                    <li><span class="font-medium">Name:</span> {{ $listallusers->name }}</li>
                    <li><span class="font-medium">Email:</span> {{ $listallusers->email }}</li>
                    <li><span class="font-medium">Matrix No:</span> {{ $listallusers->matrix_no }}</li>
                    <li><span class="font-medium">Gender:</span> {{ $listallusers->gender ?: 'Not specified' }}</li>
                    <li><span class="font-medium">Phone:</span> {{ $listallusers->phone_number ?: 'Not provided' }}</li>
                    <li><span class="font-medium">Date of Birth:</span>
                        {{ $listallusers->date_of_birth ? \Carbon\Carbon::parse($listallusers->date_of_birth)->format('d M Y') : 'Not provided' }}
                    </li>
                </ul>
            </div>

            {{-- 📌 Section 2: Academic Information --}}
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Academic Details</h2>
                <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-200">
                    <li><span class="font-medium">Position:</span> {{ $listallusers->position ?: 'Not assigned yet' }}</li>
                    <li><span class="font-medium">Year:</span> {{ $listallusers->year ?: 'Not specified' }}</li>
                    <li><span class="font-medium">Semester:</span> {{ $listallusers->semester ?: 'Not specified' }}</li>
                </ul>
            </div>

            {{-- 📌 Section 3: Additional Information --}}
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Additional Information</h2>

                {{-- Address --}}
                <div class="mb-4">
                    <span class="font-medium text-gray-700 dark:text-gray-200">Address:</span>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        {{ $listallusers->address ?: 'Not provided' }}
                    </p>
                </div>

                {{-- Bio --}}
                <div>
                    <span class="font-medium text-gray-700 dark:text-gray-200">Bio:</span>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                        {{ $listallusers->bio ?: 'No bio available' }}
                    </p>
                </div>
            </div>

            {{-- ✏️ Section 4: Update Form --}}
            <div
                class="lg:col-span-2 xl:col-span-3 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-6 shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Update Member Position</h2>
                <form method="POST">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Current Position</label>
                        <input type="text" name="position" value="{{ $listallusers->position }}"
                            class="w-full mt-1 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-neutral-800 px-3 py-2 text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter new position">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Update Position
                        </button>
                    </div>
                </form>
            </div>

        @empty
            <div class="col-span-full">
                <div
                    class="rounded-xl border border-red-200 dark:border-red-700 bg-red-50 dark:bg-red-900/20 p-6 text-center">
                    <svg class="w-12 h-12 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                        </path>
                    </svg>
                    <p class="text-red-600 dark:text-red-400 font-medium">No user data found.</p>
                    <p class="text-red-500 dark:text-red-500 text-sm mt-1">Please check if the user exists in the system.
                    </p>
                </div>
            </div>
        @endforelse
    </div>
</x-layouts.app>