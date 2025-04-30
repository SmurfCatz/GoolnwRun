@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>{{ __('Create Event') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.create.step2') }}" method="POST">
                @csrf

                <h5>{{ __('Package Selected: ') }} <strong>{{ $package->name }}</strong></h5>

                <div class="mb-3">
                    <label for="event_name" class="form-label">{{ __('Event Name') }}</label>
                    <select name="sub_events[${subEventIndex}][sub_event_name]" class="form-select" required>
                        <option value="FunRun">{{ __('FunRun') }}</option>
                        <option value="Mini Marathon">{{ __('Mini Marathon') }}</option>
                        <option value="Half Marathon">{{ __('Half Marathon') }}</option>
                        <option value="Marathon">{{ __('Marathon') }}</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="event_date" class="form-label">{{ __('Event Date') }}</label>
                    <input type="date" name="event_date" id="event_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="registration_start" class="form-label">{{ __('Registration Start Date') }}</label>
                    <input type="date" name="registration_start" id="registration_start" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="registration_end" class="form-label">{{ __('Registration End Date') }}</label>
                    <input type="date" name="registration_end" id="registration_end" class="form-control" required>
                </div>

                <h5 class="mt-4">{{ __('Sub Events') }}</h5>
                <div id="subEventsContainer"></div>

                <button type="button" id="addSubEvent" class="btn btn-secondary mt-3">{{ __('Add Sub Event') }}</button>

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
                        <input type="text" name="sub_events[${subEventIndex}][sub_event_name]" class="form-control" placeholder="{{ __('Enter sub event name') }}" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Distance (km)') }}</label>
                        <input type="number" name="sub_events[${subEventIndex}][sub_event_distance]" class="form-control" placeholder="{{ __('Enter distance') }}" step="0.1" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">{{ __('Registration Fee (฿)') }}</label>
                        <input type="number" name="sub_events[${subEventIndex}][registration_fee]" class="form-control" placeholder="{{ __('Enter fee') }}" step="0.01" required>
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