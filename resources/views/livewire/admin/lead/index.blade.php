 <div class="container-fluid py-2">
     @include('livewire.admin.lead.includes.change-status-popup')
     @include('livewire.admin.lead.includes.add-document-popup')
     <div class="row">
         <div class="col-12">
             <div class="card my-4">
                 <div class="card-header d-flex justify-content-between align-items-center">
                     <h4>Leads</h4>
                     <a href="{{ route('leads.create') }}" class="btn btn-warning font-weight-bold">+
                         Create Lead</a>
                 </div>
                 <div class="card-body px-0 pb-2">
                     <div class="table-responsive p-0">
                         <table class="table align-items-center mb-0">
                             <thead>
                                 <tr>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Lead Id</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Status</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Lead Date</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Client Name</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Service Name</th>
                                     <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Borrower's Name</th>
                                     <th
                                         class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                         Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @if ($leads->count() > 0)
                                     @php
                                         $i = 1;
                                     @endphp
                                     @foreach ($leads as $lead)
                                         <tr>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">
                                                             {{ config('app.lead_suffix') }}{{ str_pad($lead->id, 4, 0, STR_PAD_LEFT) }}
                                                         </h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td class="lead-status-td">
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <span
                                                             class="badge badge-sm bg-gradient-{{ config('app.leads_color')[$lead->status] }} blink">{{ config('app.leads')[$lead->status] }}</span>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         @php
                                                             $start = \Carbon\Carbon::parse($lead->created_at);
                                                             $end = \Carbon\Carbon::now();
                                                             $duration = $start->diffInHours($end);
                                                         @endphp
                                                         <h6 class="mb-0 text-sm">
                                                             {{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}
                                                         </h6>
                                                         <h6 class="mb-0 text-sm">{{ number_format($duration, 2) }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">{{ $lead->getClient->name }}</h6>
                                                         <h6 class="mb-0 text-sm">
                                                             {{ $lead->getClient->mobile_number ?? '' }}</h6>
                                                         <h6 class="mb-0 text-sm">
                                                             {{ $lead->getClient->organization ?? '' }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">
                                                             {{ $lead->getServiceType->service_type_parent_id }}</h6>
                                                         <h6 class="mb-0 text-sm">{{ $lead->purpose }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td>
                                                 <div class="d-flex px-2 py-1">
                                                     <div class="d-flex flex-column justify-content-center">
                                                         <h6 class="mb-0 text-sm">{{ $lead->borrower_name }}</h6>
                                                         <h6 class="mb-0 text-sm">{{ $lead->contact_name }}</h6>
                                                         <h6 class="mb-0 text-sm">{{ $lead->contact_number }}</h6>
                                                     </div>
                                                 </div>
                                             </td>
                                             <td class="text-center">
                                                 @if (auth()->user()->role_id != 3)
                                                     <a href="{{ route('leads.logs', $lead->id) }}"
                                                         class="text-dark me-2 fs-22"><i class="fas fa-cogs"></i></a>
                                                     <span class="cursor-pointer text-dark" data-bs-toggle="modal"
                                                         data-bs-target="#leadStatusSaveModal"
                                                         wire:click="setLead({{ $lead->id }})"><i
                                                             class="fas fa-edit fs-22"></i></span>
                                                 @endif
                                                 <div class="">
                                                     @if (auth()->user()->role_id != 3)
                                                         <a href="javascript:void(0);"
                                                             wire:click.prevent="settype('images', '{{ $lead->id }}')"
                                                             data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                             class=" me-2 text-dark"><i
                                                                 class="fas fa-camera fs-22"></i></a>
                                                     @endif
                                                     @if (auth()->user()->role_id == 3)
                                                         @if ($lead->pdfs != null)
                                                             <a href="javascript:void(0);"
                                                                 wire:click.prevent="settype('pdfs', '{{ $lead->id }}')"
                                                                 data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                                 class=" me-2 text-dark"><i
                                                                     class="fas fa-file-pdf fs-22"></i></a>
                                                         @endif
                                                     @else
                                                         <a href="javascript:void(0);"
                                                             wire:click.prevent="settype('pdfs', '{{ $lead->id }}')"
                                                             data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                             class=" me-2 text-dark"><i
                                                                 class="fas fa-file-pdf fs-22"></i></a>
                                                     @endif
                                                 </div>
                                                 <div class="">
                                                     @if (auth()->user()->role_id == 3)
                                                         @if ($lead->videos != null)
                                                             <a href="javascript:void(0);"
                                                                 wire:click.prevent="settype('videos', '{{ $lead->id }}')"
                                                                 data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                                 class=" me-2 text-dark"><i
                                                                     class="fas fa-video fs-22"></i></a>
                                                         @endif
                                                     @else
                                                         <a href="javascript:void(0);"
                                                             wire:click.prevent="settype('videos', '{{ $lead->id }}')"
                                                             data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                             class=" me-2 text-dark"><i
                                                                 class="fas fa-video fs-22"></i></a>
                                                     @endif
                                                     @if (auth()->user()->role_id != 3)
                                                         <a href="javascript:void(0);"
                                                             wire:click.prevent="settype('documents', '{{ $lead->id }}')"
                                                             data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                             class=" me-2 text-dark"><i
                                                                 class="fas fa-file fs-22"></i></a>
                                                     @endif
                                                 </div>
                                                 @if (auth()->user()->role_id != 3)
                                                     <div class="">
                                                         <a href="{{ route('leads.logs', $lead->id) }}"
                                                             class="text-dark mb-0 me-2"><i
                                                                 class="fas fa-eye fs-22"></i></a>
                                                     </div>
                                                 @endif
                                             </td>
                                         </tr>
                                     @endforeach
                                 @else
                                     <tr>
                                         <td colspan="9" class="text-center">No Leads found</td>
                                     </tr>
                                 @endif
                             </tbody>
                         </table>
                     </div>
                     <div class="d-flex justify-content-end">
                         {{ $leads->links() }}
                     </div>
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
         window.addEventListener('leadStatusSaveModal-model-close', event => {
             $('#leadStatusSaveModal').modal('hide');
         });
     </script>
 @endsection
