@extends('layouts.admin')
@section('title', 'Stores')
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
          <form action="{{ route('admin.stores', request()->query()) }}">
            <div class="flex my-2">
              <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
              <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
              <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
              <button type="submit" class="btn btn-primary rounded-l-none">
                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
              </button>
            </div>
          </form>
          <button onclick="addStore()" class="btn btn-md btn-primary">Add</button>
        </div>
        <div class="card bg-white rounded-lg">
          <div class="card-body p-0">
            <div class="overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <x-column-header dataRoute="admin.stores" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.stores" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.stores" column-name="price" :sort-column="$sortColumn" :sortDirection="$sortDirection">Price</x-column-header>
                    </th>
                    <th class="text-base" width="100">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($stores as $store)
                    @php
                      $img = json_decode($store->image);
                    @endphp
                    <tr>
                      <td>{{ $store->id }}</td>
                      <td>
                        <div class="flex items-center space-x-3">
                          <div class="avatar">
                            <div class="mask mask-squircle w-9 h-9">
                              @if ($store->image != '')
                                <img src="{{ $img->realImage }}" alt="{{ $store->name }}">
                              @else
                                <img src="https://placehold.co/100x100" alt="blank" />
                              @endif
                            </div>
                          </div>
                          <div>
                            <div class="font-bold">{{ $store->name }}</div>
                          </div>
                      </td>
                      <td> Rp {{ number_format($store->price, 2, ',', '.') }} </td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
                          <button onClick="handleDetail(`{{ $store->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-m-bars-3-bottom-left class="w-4 h-4" />
                          </button>
                          <button onClick="editStore(`{{ $store->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-o-pencil class="w-4 h-4" />
                          </button>
                          <button onClick="handleDelete(`{{ $store->id }}`)" class="btn btn-sm btn-square btn-ghost">
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
        {{ $stores->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
      </div>
    </div>
  </section>

  <section id="add" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.stores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-6">Add New Store</h3>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Name</span>
          </label>
          <input name="name" type="text" placeholder="Your store name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Detail</span>
          </label>
          <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="detail" name="detail"></textarea>
          @if ($errors->has('detail'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Price</span>
          </label>
          <input name="price" min="0" placeholder="Your price store" type="number" class="input input-bordered w-full {{ $errors->has('price') ? ' input-error' : '' }}" />
          @if ($errors->has('price'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('price') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md mx-auto" id="storePreview" hidden>
          <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnAdd()" class="file-input file-input-bordered w-full {{ $errors->has('image') ? ' input-error' : '' }}" />
          @if ($errors->has('image'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('image') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Link</span>
          </label>
          <input name="link" type="text" placeholder="Your link store" class="input input-bordered w-full {{ $errors->has('link') ? ' input-error' : '' }}" />
          @if ($errors->has('link'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('link') }}</span>
            </label>
          @endif
        </div>
        <x-form-action type="save" route="{{ $url }}" />
      </form>
    </div>
  </section>

  <section id="edit" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.stores.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-6">Edit Store</h3>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Name</span>
          </label>
          <input type="text" name="store_id" id="store_id" hidden>
          <input name="name" id="name" type="text" placeholder="Your store name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Detail</span>
          </label>
          <textarea id="detailEdit" class="textarea h-60 textarea-bordered textarea-md w-full" id="detail" name="detail"></textarea>
          @if ($errors->has('detail'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Price</span>
          </label>
          <input name="price" id="price" min="0" placeholder="Your price store" type="number" class="input input-bordered w-full {{ $errors->has('price') ? ' input-error' : '' }}" />
          @if ($errors->has('price'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('price') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md mx-auto" id="storePreview" hidden>
          <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnAdd()" class="file-input file-input-bordered w-full {{ $errors->has('image') ? ' input-error' : '' }}" />
          @if ($errors->has('image'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('image') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Link</span>
          </label>
          <input name="link" id="link" type="text" placeholder="Your link store" class="input input-bordered w-full {{ $errors->has('link') ? ' input-error' : '' }}" />
          @if ($errors->has('link'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('link') }}</span>
            </label>
          @endif
        </div>
        <x-form-action type="save" route="{{ $url }}" />
      </form>
    </div>
  </section>

  <dialog id="modal_store_detail" class="modal">
    <div class="modal-box">
      <a href="{{ $url }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
      <h3 class="font-semibold text-2xl pb-6 text-center">Detail Store</h3>
      <label class="label">
        <span class="label-text text-gray-500">Name</span>
      </label>
      <span id="detail_name" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Slug</span>
      </label>
      <span id="detail_slug" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Detail</span>
      </label>
      <span id="detail_detail" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Price</span>
      </label>
      <span id="detail_price" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Image</span>
      </label>
      <img id="newsPreviewDetail">
      <label class="label">
        <span class="label-text text-gray-500">Link</span>
      </label>
      <span id="detail_link" class="label text-base">-</span>
      <div class="modal-action">
        <a href="{{ $url }}" class="btn btn-light">Close</a>
      </div>
    </div>
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
    CKEDITOR.replace('detailEdit');

    function previewImageOnAdd() {
      const file = event.target.files[0];
      if (file.size > 3080000) {
        toastr.options = {
          "closeButton": true,
          "progressBar": true
        }
        toastr.error("Your files to large, please resize!");
        $("#image").val("");
        storePreview.src = "";
      } else {
        $("#storePreview").show();
        storePreview.src = URL.createObjectURL(event.target.files[0])
      }
    }

    function previewImageOnEdit() {
      const file = event.target.files[0];
      if (file.size > 3080000) {
        toastr.options = {
          "closeButton": true,
          "progressBar": true
        }
        toastr.error("Your files to large, please resize!");
      } else {
        $('#storePreviewEdit').show();
        storePreviewEdit.src = URL.createObjectURL(event.target.files[0])
      }
    }

    function backStore() {
      $("#list").show();
      $("#add").hide();
      $("#edit").hide();
    }

    function addStore() {
      $("#list").hide();
      $("#add").show();
    }

    function disableButton() {
      var add = document.getElementById('submitAdd');
      var edit = document.getElementById('submitEdit');
      add.disabled = true;
      edit.disabled = true;
      $('#loadingAdd').show();
      $('#loadingEdit').show();
    }

    function editStore(id) {
      $("#list").hide();
      $("#edit").show();
      $.ajax({
        type: "GET",
        url: "/admin/stores/edit/" + id,
        success: function(response) {
          const store = response?.store || {};
          const dataImage = store?.image || {};
          var image;
          if (response.store.image != '') {
            image = JSON.parse(dataImage);
          }
          $("#store_id").val(store.id);
          $("#name").val(store.name);
          $("#slug").val(store.slug);
          $("#link").val(store.link);
          $("#price").val(store.price);
          $('#storePreviewEdit').attr('src', image?.realImage || '');
          CKEDITOR.instances['detailEdit'].setData(store.detail);
        }
      })
    }

    function handleDelete(id) {
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
            url: "/admin/stores/delete/" + id,
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

    function handleDetail(id) {
      modal_store_detail.showModal();
      $.ajax({
        type: "GET",
        url: "/admin/stores/edit/" + id,
        success: function(response) {
          const store = response?.store || {};
          const dataImage = store?.image || {};
          var image;
          if (response.store.image != '') {
            image = JSON.parse(dataImage);
          }
          $("#detail_name").text(store?.name);
          $("#detail_slug").text(store?.slug);
          $("#detail_detail").html(store?.detail);
          $("#detail_price").text(store?.price);
          $("#detail_link").text(store?.link);
          $('#storePreviewDetail').attr('src', image?.realImage || '');
        }
      })
    }
  </script>
@endsection
