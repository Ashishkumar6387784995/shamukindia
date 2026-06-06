<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Profile Update</h4>
                </div>
                <div class="card-body px-3 pb-5">
                    <div class="row">
                        <div class="col-md-12 text-center mt-3">
                            <div class="mb-3">
                                @if ($profile_image)
                                    <img src="{{ $profile_image->temporaryUrl() }}" class="rounded-circle"
                                        style="width: 120px; height: 120px; object-fit: cover; border: 2px solid #ddd;">
                                @else
                                    <img src="{{ Storage::url($previous_image) }}" class="rounded-circle"
                                        style="width: 120px; height: 120px; object-fit: cover; border: 2px solid #ddd;">
                                @endif
                            </div>

                            <label class="btn btn-primary btn-sm">
                                <span wire:loading.remove wire:target="profile_image">
                                    Upload Profile Image
                                </span>
                                <span wire:loading wire:target="profile_image">
                                    Uploading...
                                </span>
                                <input type="file" wire:model="profile_image" accept="image/*" hidden>
                            </label>


                            @error('profile_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Name</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" wire:model="name" required
                                    placeholder="Enter user name" required>
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Email</label>
                            <div class="input-group input-group-outline">
                                <input type="email" class="form-control" wire:model="email" required
                                    placeholder="Enter email Id" required>
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Mobile Number</label>
                            <div class="input-group input-group-outline">
                                <input type="number" class="form-control" wire:model="mobile" required
                                    placeholder="Enter mobile number" required>
                            </div>
                            @error('mobile')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Pan Number</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" wire:model="pan_number"
                                    placeholder="Enter pan number" required>
                            </div>
                            @error('pan_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Password</label>
                            <div class="input-group input-group-outline">
                                <input type="password" class="form-control" wire:model="password"
                                    placeholder="Enter password" required>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Date Of Birth</label>
                            <div class="input-group input-group-outline">
                                <input type="date" class="form-control" wire:model="date_of_birth"
                                    placeholder="Enter Date of Birth" required>
                            </div>
                            @error('date_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Gender</label>
                            <div class="input-group input-group-outline">
                                <input type="radio" class="me-2" wire:model="gender" value="male"> Male
                                <span class="me-3"></span>
                                <input type="radio" class="me-2" wire:model="gender" value="female"> Female
                            </div>
                            @error('Gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Organization</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" wire:model="organization"
                                    placeholder="Enter Organization" required>
                            </div>
                            @error('organization')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Designation</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" wire:model="designation"
                                    placeholder="Enter Designation" required>
                            </div>
                            @error('designation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Department</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" wire:model="department"
                                    placeholder="Enter Department" required>
                            </div>
                            @error('department')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Branch</label>
                            <div class="input-group input-group-outline">
                                <input type="text" class="form-control" wire:model="branch"
                                    placeholder="Enter Branch" required>
                            </div>
                            @error('branch')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="" class="form-check-label mt-3">Address</label>
                            <div class="input-group input-group-outline">
                                <textarea name="" class="form-control" id="" wire:model="address" rows="3" required></textarea>
                            </div>
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6" wire:ignore>
                            <label class="mb-1 mt-3">Select State</label>
                            <div class="input-group input-group-outline">
                                <select class="form-control select2" wire:model="state_id" id="state_id"
                                    onchange="stateChange()" required>
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('state_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6" wire:ignore>
                            <label class="mb-1 mt-3">Select City</label>
                            <div class="input-group input-group-outline">
                                <select class="form-control select2" wire:model="city_id" id="city_id" required>
                                    <option value="">Select City</option>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('city_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-check-label mt-3">Pincode</label>
                            <div class="input-group input-group-outline">
                                <input type="number" class="form-control" wire:model="pincode"
                                    placeholder="Enter pincode" required>
                            </div>
                            @error('pincode')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary float-end btn-lg my-3" wire:click="saveUser()">Submit</button>
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
        function stateChange() {
            @this.set('state_id', $('#state_id').val());
            @this.call('stateChange');
            var cities = @this.get('cities');
            $('#city_id').empty();
            $('#city_id').append('<option value="">Select City</option>');
            $.each(cities, function(index, city) {
                $('#city_id').append('<option value="' + city.id + '">' + city.name + '</option>');
            });
        }
    </script>
@endsection
