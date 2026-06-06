 <div class="container-fluid py-2">
     <div class="row">
         <div class="col-12">
             <div class="card my-4">
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <h4>Users</h4>
                     <a href="{{ route('users.create') }}" class="btn btn-primary m-0"> + Create</a>
                 </div>
                 <div class="card-body px-0 pb-2">
                     <div class="table-responsive p-0">
                         <table class="table align-items-center mb-0">
                             <thead>
                                 <tr>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Name</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Email</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Mobile Number</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         User Type</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Approval Status</th>
                                     <th
                                         class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @if ($users->count() > 0)
                                     @foreach ($users as $user)
                                         <tr>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">{{ $user->email }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">{{ $user->mobile_number }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">{{ $user->getRole->name }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6
                                                             class="mb-0 text-sm {{ $user->is_approved == 1 ? 'text-success' : 'text-danger' }}">
                                                             {{ $user->is_approved == 1 ? 'Approved' : 'Not Approved' }}
                                                         </h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td class="text-center">
                                                 <a href="{{ route('users.edit', $user->id) }}" class="text-info"><i
                                                         class="fa fa-eye"></i></a>
                                                 <br>
                                                 @if ($user->is_approved == 0)
                                                     <button type="button" class="btn btn-primary"
                                                         wire:click="triggerPopup({{ $user->id }})">Approve</button>
                                                 @endif

                                             </td>
                                         </tr>
                                     @endforeach
                                 @else
                                     <tr>
                                         <td colspan="3" class="text-center">No Users found</td>
                                     </tr>
                                 @endif
                             </tbody>
                         </table>
                         @if (count($users) > 0)
                             {{ $users->links() }}
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <button type="button" class="d-none" data-bs-toggle="modal" data-bs-target="#exampleModal" id="assignRole">Assign
         Role</button>
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
         wire:ignore>
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-body">
                     <h4>Approved the user</h4>

                     <form method="POST" wire:submit.prevent="approveUser">
                         @csrf
                         <label class="mb-1 mt-3">Select Role</label>
                         <div class="input-group input-group-outline">
                             <select class="form-control" wire:model="role" wire:change="assignRole">
                                 <option value="">Select Role</option>
                                 @foreach ($roles as $role)
                                     <option value="{{ $role->id }}">{{ $role->name }}</option>
                                 @endforeach
                             </select>
                         </div>

                         <div id="product-assign" style="display: none;">
                             <p class="mb-1 mt-3">Assign Products</p>
                             @php
                                 $unique_products = \App\Models\ServiceType::all()->unique('name');
                             @endphp
                             @foreach ($unique_products as $product)
                                 <div class="">
                                     <div class="form-check form-check-inline ps-2">
                                         <input class="form-check-input" type="checkbox"
                                             id="checkbox_{{ $product->id }}" value="{{ $product->name }}"
                                             wire:click="checkProduct('{{ $product->id }}', 0)"
                                             onclick="checkProduct('{{ $product->id }}')">
                                         <label class="form-check-label" for="checkbox_{{ $product->id }}">
                                             <b>{{ $product->name }}</b>:
                                         </label>
                                     </div>
                                     @php
                                         $sub_products = \App\Models\ServiceType::where('name', $product->name)->get();
                                     @endphp
                                     @if ($sub_products->count() > 0)
                                         @foreach ($sub_products as $sub_product)
                                             <div class="form-check form-check-inline ps-2">
                                                 <input class="form-check-input product_{{ $product->id }}"
                                                     type="checkbox"
                                                     id="checkbox_{{ $sub_product->service_type_parent_id }}"
                                                     value="{{ $sub_product->id }}" wire:model="product_names[]"
                                                     wire:click="checkProduct('{{ $product->id }}', 1)">
                                                 <label class="form-check-label"
                                                     for="checkbox_{{ $sub_product->service_type_parent_id }}">
                                                     {{ $sub_product->service_type_parent_id }}
                                                 </label>
                                             </div>
                                         @endforeach
                                     @else
                                         @if ($product->service_type_parent_id != null)
                                             <div class="form-check form-check-inline ps-2">
                                                 <input class="form-check-input product_{{ $product->id }}"
                                                     type="checkbox"
                                                     id="checkbox_{{ $sub_product->service_type_parent_id }}"
                                                     value="{{ $product->id }}" wire:model="product_names[]"
                                                     wire:click="checkProduct('{{ $product->id }}', 1)">
                                                 <label class="form-check-label"
                                                     for="checkbox_{{ $sub_product->service_type_parent_id }}">
                                                     {{ $product->service_type_parent_id }}
                                                 </label>
                                             </div>
                                         @endif
                                     @endif
                                 </div>
                             @endforeach
                         </div>

                         <div class="d-flex justify-content-end mt-5 mb-0">
                             <button type="submit" class="btn btn-primary mb-0">Assign</button>
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
         window.addEventListener('triggerPopup', function() {
             document.getElementById('assignRole').click();
         })
         window.addEventListener('hideProducts', function() {
             document.getElementById('product-assign').style.display = 'none';
         })
         window.addEventListener('displayProducts', function() {
             document.getElementById('product-assign').style.display = 'block';
         })

         function checkProduct(name) {
             var main_checkbox = document.getElementById('checkbox_' + name);
             if (main_checkbox.checked) {
                 let checkboxes = document.querySelectorAll('.product_' + name);
                 checkboxes.forEach(item => {
                     item.checked = true;
                 });
             } else {
                 let checkboxes = document.querySelectorAll('.product_' + name);
                 checkboxes.forEach(item => {
                     item.checked = false;
                     item.click();
                 });
             }
         }
     </script>
 @endsection
