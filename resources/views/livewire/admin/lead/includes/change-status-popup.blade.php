<div class="modal fade" id="leadStatusSaveModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Change Lead Status</h4>

                <form method="POST" wire:submit.prevent="leadStatusSave">
                    @csrf
                    <label class="mb-1 mt-3">Select Status</label>
                    <div class="input-group input-group-outline">
                        <select class="form-control" wire:model="status" wire:change="statusChange">
                            <option value="">Select Status</option>
                            @foreach (config('app.leads') as $key => $lead)
                                @if($key != 0)
                                <option value="{{ $lead }}">{{ $lead }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('status') 
                         <span class="text-danger">{{ $message }}</span> 
                         <br>
                    @enderror

                    @if($status != 'Cancelled' && $status != 'Hold')
                        <label for="" class="form-check-label mt-3">Appointed Date Time</label>
                        <div class="input-group input-group-outline">
                            <input type="datetime-local" class="form-control" wire:model="appointed_date">
                        </div>

                        <label for="" class="form-check-label mt-3">Appointed Place</label>
                        <div class="input-group input-group-outline">
                            <input type="text" class="form-control" wire:model="appointed_place">
                        </div>
                        <label for="" class="form-check-label mt-3">Professional Fees</label>
                        <div class="input-group input-group-outline">
                            <input type="integer" class="form-control" wire:model="professional_fees">
                        </div>
                        <label class="mb-1 mt-3">Select Mode of Payment</label>
                        <div class="input-group input-group-outline">
                            <select class="form-control" wire:model="payment_mode">
                                <option value="">Select Mode of Payment</option>
                                <option value="Cash">Cash</option>
                                <option value="Banker Bill">Banker Bill</option>
                                <option value="Customer Bill">Customer Bill</option>
                            </select>
                        </div>
                        <label for="" class="form-check-label mt-3">Executive Charges</label>
                        <div class="input-group input-group-outline">
                            <input type="integer" class="form-control" wire:model="executive_charges">
                        </div> 
                    @endif
                    @if($status != 'Cancelled' && $status != 'Hold')
                        <label class="mb-1 mt-3">Select Executive</label>
                        <div class="input-group input-group-outline">
                            <select class="form-control" wire:model="executive_id">
                                <option value="">Select Executive</option>
                                @foreach ($executive as $user)
                                    @if($key != 0)
                                    <option value="{{ $user->id }}" {{ $user->id == $executive_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <label for="" class="form-check-label mt-3">Executive Message</label>
                        <div class="input-group input-group-outline">
                            <input type="text" class="form-control" wire:model="executive_message">
                        </div> 
                    @endif
                      <label for="" class="form-check-label mt-3">Remarks</label>
                    <div class="input-group input-group-outline">
                        <input type="text" class="form-control" wire:model="remarks">
                    </div> 

                    <div class="d-flex justify-content-end mt-5 mb-0">
                        <button type="submit" class="btn btn-primary mb-0">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
