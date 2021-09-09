<div class="modal fade bd-example-modal-xl" id="receiveOnSalesForm" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" data-backdrop="static" wire:ignore.self>
    <div class="modal-dialog" style="max-width: 95%;">
        <form autocomplete="off" wire:submit.prevent="createUpdateReceiveOnSales">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        @if($showEditModal)
                        แก้ไขใบสำคัญรับเงิน
                        @else
                        สร้างใบสำคัญรับเงิน
                        @endif
                    </h5>
                    <div class="float-right">
                        @if($showEditModal)
                        <button type="button" class="btn btn-secondary" wire:click.prevent="showGL">
                            Gen GL</button>
                        @endif
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fa fa-times mr-1"></i>Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save mr-1"></i>
                            @if($showEditModal)
                            <span>Save Changes</span>
                            @else
                            <span>Save</span>
                            @endif
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <!-- .Tab Header -->
                    <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">ทั่วไป</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-account-tab" data-toggle="pill" href="#pills-account"
                                role="tab" aria-controls="pills-account" aria-selected="false">บัญชี และอื่น ๆ</a>
                        </li>
                    </ul>
                    <!-- /.Tab Header -->

                    <!-- .Tab ข้อมูลทั่วไป -->
                    <div class="tab-content ml-2 mt-2" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="row mt-2 mb-0">
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">ชื่อ:</label>
                                </div>
                                <div class="col-5">
                                    <div {{ $showEditModal ? '' : 'class=d-none'}}>
                                        <input type="text" class="form-control mb-1" readonly
                                            wire:model.defer="bankHeader.customername">
                                    </div>
                                    <div {{ $showEditModal ? 'class=d-none' : 'class=float-top'}}>
                                        <div wire:ignore>
                                            <select id="customer-dropdown" class="form-control" style="width: 100%;"
                                                required wire:model.defer="bankHeader.customerid">
                                                <option value=''>--- โปรดเลือก ---</option>
                                                @foreach($customers_dd as $row)
                                                <option value='{{ $row->customerid }}'>
                                                    {{ $row->customerid . ': ' . $row->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">ภาษีถูกหัก:</label>
                                </div>
                                <div class="col-5">
                                    <div class="form-inline">
                                        <select class="form-control mb-1 mr-1" wire:model.lazy="bankHeader.taxscheme">
                                            <option value="0">---โปรดเลือก---</option>
                                            @foreach ($taxTypes_dd as $row)
                                            <option value='{{ $row->code }}'>
                                                {{ $row->code . ': ' . $row->description }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <input type="number" step="0.01" class="form-control mb-1 mr-1"
                                            style="text-align: right; width: 20%;"
                                            wire:model.defer="bankHeader.witholdamt">
                                        <input type="number" step="0.01" class="form-control mb-1 mr-1"
                                            style="text-align: right; width: 20%;"
                                            wire:model.defer="bankHeader.witholdtax">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">เลขที่:</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control mb-1 mr-1" readonly
                                        wire:model.defer="bankHeader.gltran">
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">วันที่:</label>
                                </div>
                                <div class="col-2">
                                    <div class="input-group mb-1 mr-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </span>
                                        </div>
                                        <x-datepicker wire:model.defer="bankHeader.gjournaldt" id="่jrDate"
                                            :error="'date'" required />
                                    </div>

                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">ภาษีถูกหัก-1:</label>
                                </div>
                                <div class="col-5">
                                    <div class="form-inline">
                                        <select class="form-control mb-1 mr-1" wire:model.lazy="bankHeader.taxscheme1">
                                            <option value="0">---โปรดเลือก---</option>
                                            @foreach ($taxTypes_dd as $row)
                                            <option value='{{ $row->code }}'>
                                                {{ $row->code . ': ' . $row->description }}
                                            </option>
                                            @endforeach
                                            <input type="number" step="0.01" class="form-control mb-1 mr-1" required
                                                style="text-align: right; width: 20%;"
                                                wire:model.lazy="bankHeader.witholdamt1">
                                            <input type="number" step="0.01" class="form-control mb-1 mr-1" required
                                                style="text-align: right; width: 20%;"
                                                wire:model.defer="bankHeader.witholdtax1">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">ชำระโดย:</label>
                                </div>
                                <div class="col-2">
                                    <select class="form-control mb-1 mr-1" wire:model.defer="bankHeader.payby">
                                        <option value="0" selected>ยังไม่ชำระ</option>
                                        <option value="1">เงินสด</option>
                                        <option value="2">เช็ค</option>
                                        <option value="3">บัตรเครดิต</option>
                                        <option value="4">โอนเงิน</option>
                                        <option value="5">อื่่น ๆ</option>
                                        <option value="9">รวม</option>
                                    </select>
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">เลขอ้างอิง:</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control mb-1 mr-1"
                                        wire:model.defer="bankHeader.documentref">
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">เลขภาษีหัก:</label>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control mb-1 mr-1"
                                        wire:model.defer="bankHeader.taxrunningno">
                                </div>
                                <div class="col-1" style="text-align: right;">
                                    <label class="mb-0 mr-1">ปิดรายการ:</label>
                                </div>
                                <div class="col-2">
                                    <input type="checkbox" wire:model.defer="bankHeader.posted" wire:change="">
                                </div>
                            </div>
                            <!-- .Grid -->
                            <div class="row mb-2">
                                <div class="col">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th scope="col">เลขที่อ้างอิง</th>
                                                <th scope="col" style="width: 50%;">รายละเอียด</th>
                                                <th scope="col" style="width: 15%;">ยอดคงเหลือ</th>
                                                <th scope="col" style="width: 15%;">รับชำระ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bankDetails as $index => $bankDetail)
                                            <tr>
                                                <td scope="row">
                                                    <center>{{ $loop->iteration }}</center>
                                                </td>
                                                <td>
                                                    {{ $bankDetails[$index]['taxref'] }}
                                                </td>
                                                <td>
                                                    {{ $bankDetails[$index]['description'] }}
                                                </td>
                                                <td>
                                                    <input type="number" step="0.01" class="form-control"
                                                        style="text-align: right;" readonly
                                                        wire:model.lazy="bankDetails.{{$index}}.balance">
                                                 </td>
                                                <td>
                                                    <input type="number" step="0.01" class="form-control"
                                                        style="text-align: right;"
                                                        wire:model.lazy="bankDetails.{{$index}}.amount">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr style="text-align: right; color: blue; font-weight: bold;">
                                                <td></td>
                                                <td></td>
                                                <td>เพิ่ม/<span style="color: red;">หัก</span></td>
                                                <td>{{ number_format($sumPlus,2) }}</td>
                                                <td><span style="color: red;">{{ number_format($sumDeduct,2) }}</td>
                                            <tr>
                                            <tr style="text-align: right; color: blue; font-weight: bold;">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>รับสุทธิ</td>
                                                <td>{{ number_format($bankHeader['amount'],2) }}</td>
                                            <tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /.Grid -->
                        </div>
                        <!-- .Tab Account -->
                        <div class="tab-pane fade" id="pills-account" role="tabpanel"
                            aria-labelledby="pills-account-tab">
                            <div class="row mb-0">
                                <div class="col-2" style="text-align: right;">
                                    <label class="mb-0 mr-1">ภาษีจ่าย:</label>
                                </div>
                                <div class="col-2">
                                    <select class="form-control mb-1 mr-1" wire:model.defer="soHeader.payby">
                                        <option value="0">---โปรดเลือก---</option>
                                    </select>
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-2" style="text-align: right;">
                                    <label class="mb-0 mr-1">ค่าปรับ:</label>
                                </div>
                                <div class="col-2">
                                    <select class="form-control mb-1 mr-1" wire:model.lazy="">
                                        <option value="0">---โปรดเลือก---</option>
                                    </select>
                                </div>
                                <div class="col-2" style="text-align: right;">
                                    <label class="mb-0 mr-1">จำนวนเงิน:</label>
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" class="form-control mb-1 mr-1"
                                        style="text-align: right;" wire:model.lazy="bankHeader.fincharge">
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-2" style="text-align: right;">
                                    <label class="mb-0 mr-1">ส่วนลด:</label>
                                </div>
                                <div class="col-2">
                                    <select class="form-control mb-1 mr-1" wire:model.lazy="">
                                        <option value="0">---โปรดเลือก---</option>
                                    </select>
                                </div>
                                <div class="col-2" style="text-align: right;">
                                    <label class="mb-0 mr-1">จำนวนเงิน:</label>
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" class="form-control mb-1 mr-1"
                                        style="text-align: right;" wire:model.lazy="bankHeader.findiscount">
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-2" style="text-align: right;">
                                    <label class="mb-0 mr-1">ค่าธรรมเนียม:</label>
                                </div>
                                <div class="col-2">
                                    <select class="form-control mb-1 mr-1" wire:model.lazy="">
                                        <option value="0">---โปรดเลือก---</option>
                                    </select>
                                </div>
                                <div class="col-2" style="text-align: right;">
                                    <label class="mb-0 mr-1">จำนวนเงิน:</label>
                                </div>
                                <div class="col-2">
                                    <input type="number" step="0.01" class="form-control mb-1 mr-1"
                                        style="text-align: right;" wire:model.lazy="bankHeader.feeamt">
                                </div>
                                <div class="col-4"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i>Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save mr-1"></i>
                        @if($showEditModal)
                        <span>Save Changes</span>
                        @else
                        <span>Save </span>
                        @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
$(document).ready(function() {
    $('#customer-dropdown').select2({
        placeholder: "--- โปรดเลือก ---"
    });
    $('#customer-dropdown').on('change', function(e) {
        let data = $(this).val();
        @this.set('bankHeader.customerid', data);
    });
});
</script>
@endpush