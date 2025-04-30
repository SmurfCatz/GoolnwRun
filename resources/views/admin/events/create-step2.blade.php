@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>{{ __('Create Event - Step 2') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.create.step2') }}" method="POST">
                @csrf

                <!-- Display the selected package -->
                <h5>{{ __('Selected Package: ') }} <strong>{{ $package->package_name }}</strong></h5>
                <input type="hidden" name="package_id" value="{{ $package->id }}">

                <!-- Event Name -->
                <div class="mb-3">
                    <label for="event_name" class="form-label">{{ __('Event Name') }}</label>
                    <input type="text" name="event_name" id="event_name" class="form-control"
                        value="{{ old('event_name') }}" placeholder="{{ __('Enter event name') }}" required>
                </div>

                <!-- Event Category -->
                <div class="mb-3">
                    <label for="event_category" class="form-label">{{ __('Event Category') }}</label>
                    <select name="event_category" id="event_category" class="form-select" required>
                        <option value="Race">{{ __('Race') }}</option>
                        <option value="Virtual Run">{{ __('Virtual Run') }}</option>
                    </select>
                </div>

                <!-- Event Location -->
                <div class="mb-3">
                    <label for="event_location" class="form-label">{{ __('Event Location') }}</label>
                    <input type="text" name="event_location" id="event_location" class="form-control"
                        value="{{ old('event_location') }}" placeholder="{{ __('Enter event location') }}" required>
                </div>

                <!-- Event province -->
                <div class="mb-3">
                    <label for="event_province" class="form-label">{{ __('Event Province') }}</label>
                    <select name="event_province" id="event_province" class="form-select" required>
                        <option value="Bangkok">{{ __('Bangkok') }}</option>
                        <option value="Chiang Mai">{{ __('Chiang Mai') }}</option>
                        <option value="Phuket">{{ __('Phuket') }}</option>
                        <option value="Krabi">{{ __('Krabi') }}</option>
                        <option value="Pattaya">{{ __('Pattaya') }}</option>
                        <option value="Samui">{{ __('Samui') }}</option>
                        <option value="Hua Hin">{{ __('Hua Hin') }}</option>
                        <option value="Ayutthaya">{{ __('Ayutthaya') }}</option>
                        <option value="Nakhon Ratchasima">{{ __('Nakhon Ratchasima') }}</option>
                        <option value="Nakhon Si Thammarat">{{ __('Nakhon Si Thammarat') }}</option>
                        <option value="Surat Thani">{{ __('Surat Thani') }}</option>
                    </select>
                </div>

                <!-- Event Date -->
                <div class="mb-3">
                    <label for="event_date" class="form-label">{{ __('Event Date') }}</label>
                    <input type="date" name="event_date" id="event_date" class="form-control"
                        value="{{ old('event_date') }}" required>
                </div>

                <!-- Registration Start Date -->
                <div class="mb-3">
                    <label for="registration_start" class="form-label">{{ __('Registration Start Date') }}</label>
                    <input type="date" name="registration_start" id="registration_start" class="form-control"
                        value="{{ old('registration_start') }}" required>
                </div>

                <!-- Registration End Date -->
                <div class="mb-3">
                    <label for="registration_end" class="form-label">{{ __('Registration End Date') }}</label>
                    <input type="date" name="registration_end" id="registration_end" class="form-control"
                        value="{{ old('registration_end') }}" required>
                </div>

                <!-- Sub Events -->
                <h5 class="mt-4">{{ __('Sub Events') }}</h5>
                <div id="subEventsContainer"></div>
                <button type="button" id="addSubEvent" class="btn btn-secondary mt-3">{{ __('Add Sub Event') }}</button>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3">{{ __('Save Event') }}</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let subEventIndex = 0;
        const subEventsContainer = document.getElementById('subEventsContainer');
        const addSubEventButton = document.getElementById('addSubEvent');

        addSubEventButton.addEventListener('click', function() {
            const subEventItem = document.createElement('div');
            subEventItem.className = 'sub-event-item mb-3';
            subEventItem.innerHTML = `
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">{{ __('Sub Event Name') }}</label>
                        <select name="sub_events[${subEventIndex}][sub_event_name]" class="form-select" required>
                        <option value="FunRun">{{ __('FunRun') }}</option>
                        <option value="Mini Marathon">{{ __('Mini Marathon') }}</option>
                        <option value="Half Marathon">{{ __('Half Marathon') }}</option>
                        <option value="Marathon">{{ __('Marathon') }}</option>
                    </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Distance (km)') }}</label>
                        <input type="number" name="sub_events[${subEventIndex}][sub_event_distance]" class="form-control" 
                               placeholder="{{ __('Enter distance') }}" step="0.1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Registration Fee (฿)') }}</label>
                        <input type="number" name="sub_events[${subEventIndex}][registration_fee]" class="form-control" 
                               placeholder="{{ __('Enter fee') }}" step="0.01" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-sm remove-sub-event">{{ __('Remove') }}</button>
                    </div>
                </div>
            `;
            subEventsContainer.appendChild(subEventItem);

            subEventItem.querySelector('.remove-sub-event').addEventListener('click', function() {
                subEventItem.remove();
            });

            subEventIndex++;
        });
    });
</script>
@endsection