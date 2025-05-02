<!-- Modal เพิ่มที่อยู่ใหม่ -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">{{ __('messages.deliver address') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('address.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="address_house_number" class="form-label">{{ __('messages.house number') }}</label>
                        <input type="text" class="form-control" id="address_house_number" name="address_house_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_village" class="form-label">{{ __('messages.village number') }}</label>
                        <input type="text" class="form-control" id="address_village" name="address_village">
                    </div>

                    <div class="mb-3">
                        <label for="address_alley" class="form-label">{{ __('messages.alley lane') }}</label>
                        <input type="text" class="form-control" id="address_alley" name="address_alley">
                    </div>

                    <div class="mb-3">
                        <label for="address_road" class="form-label">{{ __('messages.road street') }}</label>
                        <input type="text" class="form-control" id="address_road" name="address_road">
                    </div>

                    <div class="mb-3">
                        <label for="address_subdistrict" class="form-label">{{ __('messages.sub-district/ward') }}</label>
                        <input type="text" class="form-control" id="address_subdistrict" name="address_subdistrict" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_district" class="form-label">{{ __('messages.district') }}</label>
                        <input type="text" class="form-control" id="address_district" name="address_district" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_province" class="form-label">{{ __('messages.province') }}</label>
                        <input type="text" class="form-control" id="address_province" name="address_province" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_postal_code" class="form-label">{{ __('messages.postal code') }}</label>
                        <input type="text" class="form-control" id="address_postal_code" name="address_postal_code" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn-saveaddress">{{ __('messages.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-saveaddress {
        background-color: rgb(130, 66, 225);
        color: rgb(255, 255, 255);
        border: none;
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 500;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .btn-saveaddress:hover{
        background-color: rgb(130, 66, 225);
        transform: scale(1.05);
    }

</style>

