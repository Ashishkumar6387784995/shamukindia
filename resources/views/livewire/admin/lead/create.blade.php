<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Create Lead</h4>
                </div>
                <div class="card-body px-4 pb-5">
                    <form method="POST" wire:submit.prevent="store" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12" wire:ignore>
                                <label class="mb-1 mt-3">Select Client</label>
                                <div class="input-group input-group-outline">
                                    <select class="form-control select2" id="client_id">
                                        <option value="">Select Client</option>
                                        @foreach ($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12" wire:ignore>
                                <label class="mb-1 mt-3">Select Service</label>
                                <div class="input-group input-group-outline">
                                    <select class="form-control" wire:model.live="service_type"
                                        wire:change="serviceTypeChange()">
                                        <option value="">Select Service Type</option>
                                        @foreach ($service_types as $key => $service_type)
                                            @php
                                                $selected_service_type = \App\Models\ServiceType::find($service_type);
                                            @endphp
                                            <option value="{{ $selected_service_type->id }}">
                                                {{ $selected_service_type->service_type_parent_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="mb-1 mt-3">Select Purpose</label>
                                <div class="input-group input-group-outline">
                                    <select class="form-control" wire:model="purpose">
                                        <option value="">~ Select Purpose ~</option>
                                        <option value="Loan Purpose">Loan Purpose</option>
                                        <option value="Insurance Purpose">Insurance Purpose</option>
                                        <option value="Auction Purpose">Auction Purpose</option>
                                        <option value="Audit Purpose">Audit Purpose</option>
                                        <option value="Visa Purpose">Visa Purpose</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-outline mt-4">
                                    <label class="form-label">Borrower's Name</label>
                                    <input type="text" class="form-control" wire:model="borrower_name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-outline mt-4">
                                    <label class="form-label">Contact Person Name</label>
                                    <input type="text" class="form-control" wire:model="contact_name" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group input-group-outline mt-4">
                                    <label class="form-label">Contact Person Number</label>
                                    <input type="text" class="form-control" wire:model="contact_number" required>
                                </div>
                            </div>
                            <div class="col-12" id="registration_number">
                                <div class="input-group input-group-outline mt-4">
                                    <label class="form-label">Regsitration Number</label>
                                    <input type="text" class="form-control" wire:model="registration_number"
                                        required>
                                </div>
                            </div>
                            <div class="col-12" wire:ignore>
                                <label class="mb-1 mt-3">Asset City</label>
                                <div class="input-group input-group-outline">
                                    <select class="form-control select2" id="city_id">
                                        <option value="">~ Select City ~</option>
                                        @foreach ($city as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} -
                                                {{ $item->getState->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="input-group input-group-outline mt-4">
                                        <label class="form-label">Remarks</label>
                                        <input type="text" class="form-control" wire:model="remark" required>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label class="form-label">Documents</label>
                                    <div class="input-group input-group-outline">
                                        <input type="file" name="" wire:model="documents" multiple
                                            id="" class="form-control">
                                    </div>
                                </div>

                                <div class="row justify-content-start mt-4">
                                    <button class="btn btn-primary font-weight-bolder ms-2 w-25"
                                        type="submit">Create</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer py-4  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>, <b>Shamuk India </b> All Rights Reserved.
                    </div>
                </div>
                <div class="col-lg-6">
                </div>
            </div>
        </div>
    </footer>
</div>

@section('scripts')
    <script>
        window.addEventListener('displayRegisterNumber', function() {
            const el = document.getElementById('registration_number');
            if (el) {
                el.style.display = 'block';
            }
        })
        document.addEventListener('livewire:init', () => {
            $('#city_id').on('change', function() {
                @this.set('city_id', $(this).val());
            });
            $('#city_id').on('change', function() {
                @this.set('city_id', $(this).val());
            });
            $('#client_id').on('change', function() {
                @this.set('client', $(this).val());
            });
        })
    </script>
@endSection
