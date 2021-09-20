<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- .ปุ่มซ่อนเมนู -->
                    <div class="float-left d-none d-sm-inline">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </div>
                    <!-- /.ปุ่มซ่อนเมนู -->
                    <h1 class="m-0 text-dark">ส่งสินค้าพร้อมใบกำกับ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">AccStar</li>
                        <li class="breadcrumb-item active">ส่งสินค้าพร้อมใบกำกับ</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- .List Sales Order -->
    <div class="content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <div class="d-flex justify-content-between mb-2">
                        <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle"
                                mr-1></i>
                            สร้างข้อมูลใหม่</button>                        
                        <div class="d-flex justify-content-center align-items-center border bg-while pr-2">
                            <input wire:model.lazy="searchTerm" type="text" class="form-control border-0"
                                placeholder="Search"> <!-- lazy=Lost Focus ถึงจะ Postback  -->
                            <div wire:loading.delay wire:target="searchTerm">
                                <div class="la-ball-clip-rotate la-dark la-sm">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <x-search-input />
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <table class="table table-md table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">เลขที่ใบสั่งขาย
                                    <a href="" wire:click.prevent="sortSO('sales.snumber')">
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>
                                <th scope="col">วันที่ใบสั่งขาย
                                    <a href="" wire:click.prevent="sortSO('sales.sodate')">
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>
                                <th scope="col">ผู้ซื้อ
                                    <a href="" wire:click.prevent="sortSO('customer.name')">
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>
                                    
                                <th scope="col">ยอดเงิน
                                    <a href="" wire:click.prevent="sortSO('sales.sototal')">
                                        <i class="fa fa-sort" aria-hidden="true"></i>
                                    </a>
                                </th>                                    
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesOrders as $salesOrder)
                            <tr>
                                <td scope="col">{{ $loop->iteration + $salesOrders->firstitem()-1  }}</td>
                                <td scope="col">{{ $salesOrder->snumber }} </td>
                                <td scope="col">{{ \Carbon\Carbon::parse($salesOrder->sodate)->format('Y-m-d') }} </td>
                                <td scope="col">{{ $salesOrder->name }} </td>
                                <td scope="col">{{ number_format($salesOrder->sototal,2) }} </td>
                                <td>
                                    <a href="" wire:click.prevent="edit('{{ $salesOrder->snumber }}')">
                                        <i class="fa fa-edit mr-2"></i>
                                    </a>
                                    <a href="" wire:click.prevent="confirmDelete('{{ $salesOrder->snumber }}')">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between footgrid">
                        <div>
                        {{ $salesOrders->links() }} จำนวน {{ number_format($salesOrders->Total(),0) }} รายการ
                        </div>                        
                        <div>                        
                            <select class="form-control" style="width: 70px;"
                                wire:model.lazy="numberOfPage">
                                <option value="10" selected>10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>                            
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!-- /.List Sales Order -->
    @include('livewire.accstar._modalSalesOrder')
    @include('livewire.accstar._modalGenGL')
    @include('livewire.accstar._mypopup')
    @include('livewire.accstar._mycss')
</div>