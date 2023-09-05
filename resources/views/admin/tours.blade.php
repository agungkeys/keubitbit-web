@extends('layouts.admin')
@section('title', 'Tour Schedule')
@section('content')
  @php
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $url = 'https://';
    } else {
        $url = 'http://';
    }
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
  @endphp
<section id="list">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="flex justify-between items-center pb-6">
        <form action="{{ route('admin.tours', request()->query()) }}">
          <div class="flex my-2">
            <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
            <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
            <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
            <button type="submit" class="btn btn-primary rounded-l-none">
              <x-heroicon-o-magnifying-glass class="h-6 w-6" />
            </button>
          </div>
        </form>
        <button onClick="addTour()" class="btn btn-md btn-primary">Add</button>
      </div>
      <div class="card bg-white rounded-lg">
        <div class="card-body p-0">
          <div class="overflow-x-auto">
            <table class="table">
              <!-- head -->
              <thead>
                <tr>
                  <th width="3%">
                    <x-column-header dataRoute="admin.tours" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                  </th>
                  <th>
                    <x-column-header dataRoute="admin.tours" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                  </th>
                  <th>
                    <x-column-header dataRoute="admin.tours" column-name="date_gigs" :sort-column="$sortColumn" :sortDirection="$sortDirection">Date</x-column-header>
                  </th>
                  <th>
                    <x-column-header dataRoute="admin.tours" column-name="location" :sort-column="$sortColumn" :sortDirection="$sortDirection">Location</x-column-header>
                  </th>
                  <th class="text-base" width="100">
                    Active
                  </th>
                  <th class="text-base" width="100">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($tours as $tour)
                  @php
                    $img = json_decode($tour->image);
                  @endphp
                  <tr>
                    <th>{{ $tour->id }}</th>
                    <td>
                      <div class="flex items-center space-x-3">
                        <div class="avatar">
                          <div class="mask mask-squircle w-9 h-9">
                            @if ($tour->image != '')
                              <img src="{{ $img->realImage }}" alt="{{ $tour->name }}">
                            @else
                              <img src="https://placehold.co/100x100" alt="blank" />
                            @endif
                          </div>
                        </div>
                        <div>
                          <div class="font-bold">{{ $tour->name }}</div>
                        </div>
                      </div>
                    </td>
                    <td>{{ date('d M Y', strtotime($tour->date_gigs)) }}</td>
                    <td>{{ $tour->location }}</td>
                    <td>
                      @if($tour->is_active)
                      <div class="text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>                        
                      </div>
                      @endif
                    </td>
                    <td>
                      <div class="flex items-center justify-end gap-2">
                        <button onClick="editTour(`{{ $tour->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <x-heroicon-o-pencil class="w-4 h-4" />
                        </button>
                        <button onClick="handleDelete(`{{ $tour->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <x-heroicon-o-trash class="w-4 h-4" />
                        </button>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{ $tours->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
    </div>
  </div>
</section>

<section id="add" hidden>
  <div class="card bg-white">
    <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.tours.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-semibold text-2xl pb-2">Add New Tour</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Name</span>
          </label>
          <input name="name" type="text" placeholder="Your tour name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Date Tour</span>
          </label>
          <input name="date" type="date" placeholder="Your date tour" class="input input-bordered w-full {{ $errors->has('date') ? ' input-error' : '' }}" />
          @if ($errors->has('date'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('date') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Link</span>
          </label>
          <input name="link" type="text" placeholder="Your tour link" class="input input-bordered w-full {{ $errors->has('link') ? ' input-error' : '' }}" />
          @if ($errors->has('link'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('link') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Location</span>
          </label>
          <input name="location" type="text" placeholder="Your tour location" class="input input-bordered w-full {{ $errors->has('location') ? ' input-error' : '' }}" />
          @if ($errors->has('location'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('location') }}</span>
            </label>
          @endif
        </div>
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Detail</span>
        </label>
        <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="detail" placeholder="Enter the Description" name="detail"></textarea>
        @if ($errors->has('detail'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Active</span>
        </label>
        <input name="is_active" type="checkbox" class="toggle" />
      </div>
      <div class="max-w-lg">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md" id="tourPreview">
          <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnAdd()" class="file-input file-input-bordered w-full {{ $errors->has('image') ? ' input-error' : '' }}" />
          @if ($errors->has('image'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('image') }}</span>
          </label>
          @endif
        </div>
      </div>
      <x-form-action type="save" route="{{ $url }}" />
    </form>
  </div>
</section>

<section id="edit" hidden>
  <div class="card bg-white">
    <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.tours.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-semibold text-2xl pb-2">Edit Tour</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Name</span>
          </label>
          <input name="edit_name" id="edit_name"  type="text" placeholder="Your tour name" class="input input-bordered w-full {{ $errors->has('edit_name') ? ' input-error' : '' }}" />
          <input type="hidden" name="tour_id" id="tour_id" />
          @if ($errors->has('edit_name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('edit_name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Date Tour</span>
          </label>
          <input name="edit_date" id="edit_date" type="date" placeholder="Your date tour" class="input input-bordered w-full {{ $errors->has('edit_date') ? ' input-error' : '' }}" />
          @if ($errors->has('edit_date'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('edit_date') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Link</span>
          </label>
          <input name="edit_link" id="edit_link" type="text" placeholder="Your tour link" class="input input-bordered w-full {{ $errors->has('edit_link') ? ' input-error' : '' }}" />
          @if ($errors->has('edit_link'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('edit_link') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Location</span>
          </label>
          <input name="edit_location" id="edit_location" type="text" placeholder="Your tour location" class="input input-bordered w-full {{ $errors->has('edit_location') ? ' input-error' : '' }}" />
          @if ($errors->has('edit_location'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('edit_location') }}</span>
            </label>
          @endif
        </div>
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Detail</span>
        </label>
        <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="edit_detail" placeholder="Enter the Description" name="edit_detail"></textarea>
        @if ($errors->has('edit_detail'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('edit_detail') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Active</span>
        </label>
        <input name="edit_is_active" id="edit_is_active" type="checkbox" class="toggle" />
      </div>
      <div class="max-w-lg">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md" id="tourPreviewEdit">
          <input name="edit_image" id="edit_image" type="file" accept="image/*" onchange="previewImageOnEdit()" class="file-input file-input-bordered w-full {{ $errors->has('edit_image') ? ' input-error' : '' }}" />
          @if ($errors->has('image'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('image') }}</span>
          </label>
          @endif
        </div>
      </div>
      <x-form-action type="update" route="{{ $url }}" />
    </form>
  </div>
</section>

<dialog id="imgPreview" class="modal">
  <form method="dialog" class="modal-box w-11/12 max-w-5xl">
    <h3 class="font-bold text-lg">Hello!</h3>
    <p class="py-4">Click the button below to close</p>
    <div class="modal-action">
      <!-- if there is a button, it will close the modal -->
      <button class="btn">Close</button>
    </div>
  </form>
</dialog>
@endsection

@section('js')
  @if (count($errors) > 0)
    <script>
      $("#list").hide();
      $("#add").show();
    </script>
  @endif
  <script>
    CKEDITOR.replace('detail');
    CKEDITOR.replace('edit_detail');

    function previewImageOnAdd() {
      const file = event.target.files[0];
      if(file.size > 3080000){
        toastr.error("Your files to large, please resize!");
        $("#image").val("");
        tourPreview.src = "";
      }else{
        $("#tourPreview").show();
        tourPreview.src = URL.createObjectURL(event.target.files[0])
      }
    }

    function previewImageOnEdit() {
      const file = event.target.files[0];
      if(file.size > 3080000){
        toastr.error("Your files to large, please resize!");
        $("#edit_image").val("");
        tourPreviewEdit.src = "";
      }else{
        $("#tourPreviewEdit").show();
        tourPreviewEdit.src = URL.createObjectURL(event.target.files[0])
      }
    }

    function backTour(){
      $("#list").show();
      $("#add").hide();
      $("#edit").hide();
    }

    function addTour(){
      $("#list").hide();
      $("#add").show();
    }

    function editTour(id){
      $("#list").hide();
      $("#edit").show();
      $.ajax({
        type: "GET",
        url: "/admin/tours/edit/" + id,
        success: function(response) {
          const tour = response?.tour || {};
          const dataImage = tour?.image || {};
          const image = tour.image ? JSON.parse(dataImage) : null;
          const value_is_active = tour.is_active == 1 ? true : false;

          $("#tour_id").val(tour.id);
          $("#edit_name").val(tour.name);
          $("#edit_date").val(tour.date_gigs);
          $("#edit_link").val(tour.link);
          $("#edit_location").val(tour.location);
          CKEDITOR.instances['edit_detail'].setData(tour.detail);
          image ? $('#tourPreviewEdit').attr('src', image.realImage || '') : null;
          $("#edit_is_active").prop('checked', value_is_active);
        }
      })
    }

    function handleDelete(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to delete this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          let _token = $('meta[name="csrf-token"]').attr('content');
          const url = window.location.href;
          $.ajax({
            type: "DELETE",
            url: "/admin/tours/delete/" + id,
            data: {
              _token: _token,
              id: id
            },
            success: function(response) {
              if (response.status == 200) {
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                ).then(function() {
                  window.location = url;
                });
              }
            }
          });
        }
      })
    }

    function disableButton() {
      var add = document.getElementById('submitAdd');
      var edit = document.getElementById('submitEdit');
      add.disabled = true;
      edit.disabled = true;
      $('#loadingAdd').show();
      $('#loadingEdit').show();
    }
  </script>
  @endsection