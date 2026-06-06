 <div class="container-fluid py-2">
     <div class="row">
         <div class="col-12">
             <div class="card my-4">
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <h4>Services</h4>
                     <button type="button" class="btn btn-warning font-weight-bold" data-bs-toggle="modal"
                         data-bs-target="#exampleModal" id="createServiceType">+
                         Create Service</button>
                 </div>
                 <div class="card-body px-0 pb-2">
                     <div class="table-responsive p-0">
                         <table class="table align-items-center mb-0">
                             <thead>
                                 <tr>
                                     <th class="text-uppercase text-xs font-weight-bolder">
                                         Product</th>
                                     <th class="text-uppercase text-xs font-weight-bolder">
                                         Services</th>
                                     <th class="text-center text-uppercase text-xs font-weight-bolder">
                                         Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @if ($service_types->count() > 0)
                                     @foreach ($service_types as $service_type)
                                         <tr>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">{{ $service_type->name }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">
                                                             {{ $service_type->service_type_parent_id }}
                                                         </h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td class="text-center">
                                                 <i class="fa fa-edit me-2 cursor-pointer"
                                                     wire:click="editServiceType({{ $service_type->id }})"></i>
                                             </td>
                                         </tr>
                                     @endforeach
                                 @else
                                     <tr>
                                         <td colspan="4" class="text-center">No Product found</td>
                                     </tr>
                                 @endif
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-body">
                     <h4>{{ $id != '' ? 'Edit' : 'Create' }} Service</h4>

                     <form method="POST" wire:submit.prevent="createServiceType">
                         @csrf
                         <div class="input-group input-group-outline mt-4">
                             <label class="form-label">Product Name</label>
                             <input type="text" class="form-control" wire:model="name" required>
                         </div>

                         <div class="input-group input-group-outline mt-4">
                             <label class="form-label">Service Name</label>
                             <input type="text" class="form-control" wire:model="parent_id">
                         </div>

                         <div class="d-flex justify-content-end mt-5">
                             <button type="submit"
                                 class="btn btn-primary">{{ $id != '' ? 'Update' : 'Create' }}</button>
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
         window.addEventListener('open-model', function() {
             document.getElementById('createServiceType').click();
         })
     </script>
 @endsection
