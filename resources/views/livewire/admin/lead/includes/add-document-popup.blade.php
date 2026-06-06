  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
      wire:ignore.self>
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-body">
                @if(auth()->user()->role_id != 3)
                  <h4>Add more {{ ucwords($type) }}</h4>
                  @else
                  <h4>View {{ ucwords($type) }}</h4>
                  @endif

                  <form method="POST" wire:submit.prevent="addFiles" enctype="multipart/form-data">
                      @csrf
                      @if(auth()->user()->role_id != 3)
                      <label class="form-label">Select {{ ucwords($type) }}</label>
                      <div class="input-group input-group-outline">
                          <input type="file" class="form-control" multiple wire:model="files">
                      </div>
                      @error('files')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror
                      @error('files.*')
                          @if ($type == 'documents')
                              <span class="text-danger">Each file must be a PDF, DOC, DOCX.</span>
                          @elseif($type == 'images')
                              <span class="text-danger">Each file must be a JPEG, PNG, JPG, GIF, SVG or WEBP.</span>
                          @elseif($type == 'videos')
                              <span class="text-danger">Each file must be a MP4, MOV, AVI, MKV, WMV, WEBM.</span>
                          @elseif($type == 'pdfs')
                              <span class="text-danger">Each file must be a PDF.</span>
                          @endif
                      @enderror
                      @endif
                      @if (isset($lead) && isset($lead->$type) && $lead->$type != '' && $lead->$type != null)
                          @php
                              $files = json_decode($lead->$type, true);
                          @endphp

                          <div class="mt-3">
                              <div class="row g-3">
                                  @foreach ($files as $file)
                                      @php
                                          $extension = pathinfo($file, PATHINFO_EXTENSION);
                                      @endphp
                                      <div class="col-md-3 col-6">
                                          <div class="card shadow-sm border rounded text-center p-2">
                                              <a href="{{ asset('storage/' . $file) }}" target="_blank"
                                                  class="small text-decoration-none">
                                                  @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                      <img src="{{ asset('storage/' . $file) }}"
                                                          class="img-fluid rounded"
                                                          style="max-height:150px; object-fit:cover;" alt="Preview">
                                                  @elseif(in_array(strtolower($extension), ['pdf']))
                                                      <i class="fas fa-file-pdf fa-3x text-danger"></i>
                                                  @elseif(in_array(strtolower($extension), ['doc', 'docx']))
                                                      <i class="fas fa-file-word fa-3x text-primary"></i>
                                                  @elseif(in_array(strtolower($extension), ['xls', 'xlsx', 'csv']))
                                                      <i class="fas fa-file-excel fa-3x text-success"></i>
                                                  @else
                                                      <i class="fas fa-file fa-3x text-secondary"></i>
                                                  @endif
                                              </a>
                                          </div>
                                      </div>
                                  @endforeach
                              </div>
                          </div>
                      @endif

                      <div class="d-flex justify-content-end mt-5">
                        @if(auth()->user()->role_id != 3)
                          <button type="submit" class="btn btn-primary">Add {{ ucwords($type) }}</button>
                          @endif
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
