<x-layouts.app :title="__('Create Meeting')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Header Section -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create New Meeting</h1>
        </div>

        <!-- Form Container -->
        <div class="relative flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <div class="h-full overflow-y-auto p-6">
                <form action="{{ route('createmeeting') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">
                        <!-- Title -->
                        <flux:field>
                            <flux:label>Meeting Title</flux:label>
                            <flux:input name="title" type="text" placeholder="Enter meeting title"
                                value="{{ old('title') }}" required />
                            <flux:error name="title" />
                        </flux:field>

                        <!-- Date and Time Row -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Date -->
                            <flux:field>
                                <flux:label>Date</flux:label>
                                <flux:input name="date" type="date" value="{{ old('date') }}" required />
                                <flux:error name="date" />
                            </flux:field>

                            <!-- Time -->
                            <flux:field>
                                <flux:label>Time</flux:label>
                                <flux:input name="time" type="time" value="{{ old('time') }}" required />
                                <flux:error name="time" />
                            </flux:field>
                        </div>

                        <!-- Agenda -->
                        <flux:field>
                            <flux:label>Agenda</flux:label>
                            <flux:textarea name="agenda" placeholder="Enter meeting agenda" rows="4" required>
                                {{ old('agenda') }}
                            </flux:textarea>
                            <flux:error name="agenda" />
                        </flux:field>

                        <!-- Memo -->
                        <flux:field>
                            <flux:label>Memo</flux:label>
                            <flux:textarea name="memo" placeholder="Enter additional notes or memo" rows="3">
                                {{ old('memo') }}
                            </flux:textarea>
                            <flux:error name="memo" />
                        </flux:field>

                        <!-- File Uploads Section -->
                        <div class="border-t border-neutral-200 dark:border-neutral-700 pt-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Document Uploads</h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Financial Path File Upload -->
                                <flux:field>
                                    <flux:label>Financial Document</flux:label>
                                    <flux:input name="financial_path" type="file" accept=".pdf,.doc,.docx,.xlsx,.xls" />
                                    <flux:description>PDF, DOC, DOCX, XLS, XLSX</flux:description>
                                    <flux:error name="financial_path" />
                                </flux:field>

                                <!-- Minutes Path File Upload -->
                                <flux:field>
                                    <flux:label>Meeting Minutes</flux:label>
                                    <flux:input name="minutes_path" type="file" accept=".pdf,.doc,.docx" />
                                    <flux:description>PDF, DOC, DOCX</flux:description>
                                    <flux:error name="minutes_path" />
                                </flux:field>

                                <!-- Official Letter Path File Upload -->
                                <flux:field>
                                    <flux:label>Official Letter</flux:label>
                                    <flux:input name="official_letter_path" type="file" accept=".pdf,.doc,.docx" />
                                    <flux:description>PDF, DOC, DOCX</flux:description>
                                    <flux:error name="official_letter_path" />
                                </flux:field>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="border-t border-neutral-200 dark:border-neutral-700 pt-6">
                            <div class="flex justify-end gap-3">
                                <flux:button type="button" variant="ghost">
                                    Cancel
                                </flux:button>
                                <flux:button type="submit" variant="primary">
                                    Create Meeting
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>