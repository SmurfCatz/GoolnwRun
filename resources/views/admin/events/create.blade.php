@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{ __('Create Event') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.events.store') }}" method="POST">
                        @csrf

                        <!-- Step 1: เลือกแพ็กเกจ -->
                        <div class="mb-4">
                            <label for="package" class="form-label">{{ __('Select Package') }}</label>
                            <select name="package" id="package" class="form-select" required>
                                <option value="" disabled selected>{{ __('Select a package') }}</option>
                                @foreach ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }} - ฿{{ number_format($package->price, 2) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Step 2: กรอกข้อมูล Event -->
                        <div class="mb-4">
                            <label for="event_name" class="form-label">{{ __('Event Name') }}</label>
                            <input type="text" name="event_name" id="event_name" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="event_date" class="form-label">{{ __('Event Date') }}</label>
                            <input type="date" name="event_date" id="event_date" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="registration_start" class="form-label">{{ __('Registration Start Date') }}</label>
                            <input type="date" name="registration_start" id="registration_start" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label for="registration_end" class="form-label">{{ __('Registration End Date') }}</label>
                            <input type="date" name="registration_end" id="registration_end" class="form-control" required>
                        </div>

                        <!-- Step 3: เพิ่ม Sub Event -->
                        <div id="subEventsContainer">
                            <h5>{{ __('Sub Events') }}</h5>
                            <div class="sub-event-item mb-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" name="sub_events[0][sub_event_name]" class="form-control" placeholder="{{ __('Sub Event Name') }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="sub_events[0][sub_event_distance]" class="form-control" placeholder="{{ __('Distance (km)') }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="number" name="sub_events[0][registration_fee]" class="form-control" placeholder="{{ __('Registration Fee (฿)') }}" required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-sm remove-sub-event">{{ __('Remove') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="addSubEvent" class="btn btn-secondary btn-sm mb-4">{{ __('Add Sub Event') }}</button>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">{{ __('Save Event') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript สำหรับเพิ่ม Sub Event -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let subEventIndex = 1;

        document.getElementById('addSubEvent').addEventListener('click', function() {
            const container = document.getElementById('subEventsContainer');
            const subEventItem = document.createElement('div');
            subEventItem.className = 'sub-event-item mb-3';
            subEventItem.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="sub_events[${subEventIndex}][sub_event_name]" class="form-control" placeholder="{{ __('Sub Event Name') }}" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="sub_events[${subEventIndex}][sub_event_distance]" class="form-control" placeholder="{{ __('Distance (km)') }}" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="sub_events[${subEventIndex}][registration_fee]" class="form-control" placeholder="{{ __('Registration Fee (฿)') }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-sub-event">{{ __('Remove') }}</button>
                    </div>
                </div>
            `;
            container.appendChild(subEventItem);
            subEventIndex++;

            subEventItem.querySelector('.remove-sub-event').addEventListener('click', function() {
                subEventItem.remove();
            });
        });

        document.querySelectorAll('.remove-sub-event').forEach(button => {
            button.addEventListener('click', function() {
                button.closest('.sub-event-item').remove();
            });
        });
    });
</script>
@endsection