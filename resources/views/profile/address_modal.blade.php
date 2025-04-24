<!-- Modal เพิ่มที่อยู่ใหม่ -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">ที่อยู่ในการจัดส่ง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('address.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="address_house_number" class="form-label">บ้านเลขที่</label>
                        <input type="text" class="form-control" id="address_house_number" name="address_house_number" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_village" class="form-label">หมู่ที่</label>
                        <input type="text" class="form-control" id="address_village" name="address_village">
                    </div>

                    <div class="mb-3">
                        <label for="address_alley" class="form-label">ตรอก/ซอย</label>
                        <input type="text" class="form-control" id="address_alley" name="address_alley">
                    </div>

                    <div class="mb-3">
                        <label for="address_road" class="form-label">ถนน</label>
                        <input type="text" class="form-control" id="address_road" name="address_road">
                    </div>

                    <div class="mb-3">
                        <label for="address_subdistrict" class="form-label">ตำบล/แขวง</label>
                        <input type="text" class="form-control" id="address_subdistrict" name="address_subdistrict" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_district" class="form-label">อำเภอ/เขต</label>
                        <input type="text" class="form-control" id="address_district" name="address_district" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_province" class="form-label">จังหวัด</label>
                        <input type="text" class="form-control" id="address_province" name="address_province" required>
                    </div>

                    <div class="mb-3">
                        <label for="address_postal_code" class="form-label">รหัสไปรษณีย์</label>
                        <input type="text" class="form-control" id="address_postal_code" name="address_postal_code" required>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">บันทึกที่อยู่</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
