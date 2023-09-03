@extends('layouts.admin')
@section('title', 'Master Banner')
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
          <form action="{{ route('admin.banners', request()->query()) }}">
            <div class="flex my-2">
              <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
              <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
              <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
              <button type="submit" class="btn btn-primary rounded-l-none">
                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
              </button>
            </div>
          </form>
          <button class="btn btn-md btn-primary" onclick="modal_banner.showModal()">Add</button>
        </div>
        <div class="card bg-white rounded-lg">
          <div class="card-body p-0">
            <div class="overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <x-column-header dataRoute="admin.banners" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.banners" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.banners" column-name="link" :sort-column="$sortColumn" :sortDirection="$sortDirection">Link</x-column-header>
                    </th>
                    <th width="100">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($banners as $banner)
                    @php
                      $img = json_decode($banner->image);
                    @endphp
                    <tr>
                      <td>{{ $banner->id }}</td>
                      <td>
                        <div class="flex items-center space-x-3">
                          <div class="avatar">
                            <div class="mask mask-squircle w-9 h-9">
                              @if ($banner->image != '')
                                <img src="{{ $img->realImage }}" alt="{{ $banner->name }}">
                              @else
                                <img src="https://placehold.co/100x100" alt="blank" />
                              @endif
                            </div>
                          </div>
                          <div>
                            <div class="font-bold">{{ $banner->name }}</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a>
                      </td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
                          <button onClick="handleDetail(`{{ $banner->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-m-bars-3-bottom-left class="w-4 h-4" />
                          </button>
                          <button onClick="handleEdit(`{{ $banner->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-o-pencil class="w-4 h-4" />
                          </button>
                          <button onClick="handleDelete(`{{ $banner->id }}`)" class="btn btn-sm btn-square btn-ghost">
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
        {{ $banners->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
      </div>
    </div>
  </section>

  <dialog id="modal_banner" class="modal">
    <form class="modal-box" action="{{ route('admin.banners.store') }}" onsubmit="disableButton()" method="POST" enctype="multipart/form-data">
      @csrf
      <a href="{{ $url }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
      <h3 class="font-semibold text-2xl pb-6 text-center">Add New Banner</h3>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Name</span>
        </label>
        <input name="name" type="text" placeholder="Banner Name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
        @if ($errors->has('name'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Image</span>
        </label>
        <img id="bannerPreview" class="rounded-md mx-auto" hidden>
        <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnAdd()" class="file-input file-input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
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
        <input name="link" type="text" placeholder="Link Banner" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
        @if ($errors->has('link'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('link') }}</span>
          </label>
        @endif
      </div>
      <x-form-action type="save" route="/admin/banners" />
    </form>
  </dialog>

  <dialog id="modal_banner_edit" class="modal">
    <form class="modal-box" action="{{ route('admin.banners.update') }}" onsubmit="disableButton()" method="POST" enctype="multipart/form-data">
      @csrf
      <a href="{{ $url }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
      <h3 class="font-semibold text-2xl pb-6 text-center">Edit Banner</h3>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Name</span>
        </label>
        <input id="name" name="name" type="text" placeholder="Banner Name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
        <input type="hidden" name="banner_id" id="banner_id" />
        @if ($errors->has('name'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Image</span>
        </label>
        <img id="bannerPreviewEdit" class="rounded-md mx-auto">
        <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnEdit()" class="file-input file-input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
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
        <input id="link" name="link" type="text" placeholder="Link Banner" class="input input-bordered w-full" />
      </div>
      <x-form-action type="update" route="/admin/banners" />
    </form>
  </dialog>

  <dialog id="modal_banner_detail" class="modal">
    <div class="modal-box">
      <a href="{{ $url }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
      <h3 class="font-semibold text-2xl pb-6 text-center">Detail Banner</h3>
      <label class="label">
        <span class="label-text text-gray-500">Name</span>
      </label>
      <span id="detail_name" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Image</span>
      </label>
      <img id="bannerPreviewDetail">
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
      modal_banner.showModal();
    </script>
  @endif
  <script>
    function previewImageOnAdd() {
      const file = event.target.files[0];
      if (file.size > 3080000) {
        toastr.error("Your files to large, please resize!");
        setTimeout(() => {
          window.location.replace("/admin/banners");
        }, 1500)
      } else {
        $('#bannerPreview').show();
        bannerPreview.src = URL.createObjectURL(event.target.files[0])
      }
    }

    function previewImageOnEdit() {
      const file = event.target.files[0];
      if (file.size > 3080000) {
        toastr.error("Your files to large, please resize!");
        setTimeout(() => {
          window.location.replace("/admin/banners");
        }, 1500)
      } else {
        $('#bannerPreviewEdit').show();
        bannerPreviewEdit.src = URL.createObjectURL(event.target.files[0])
      }
    }

    function handleEdit(id) {
      modal_banner_edit.showModal();
      $.ajax({
        type: "GET",
        url: "/admin/banners/edit/" + id,
        success: function(response) {
          const dataImage = response.banner.image;
          const image = JSON.parse(dataImage);
          $("#name").val(response.banner.name);
          $("#banner_id").val(response.banner.id);
          $("#link").val(response.banner.link);
          $('#bannerPreviewEdit').attr('src', image.realImage);
        }
      })
    }

    function handleDetail(id) {
      modal_banner_detail.showModal();
      $.ajax({
        type: "GET",
        url: "/admin/banners/edit/" + id,
        success: function(response) {
          const dataImage = response.banner.image;
          const image = JSON.parse(dataImage);
          $("#detail_name").text(response?.banner?.name || '-');
          $("#detail_link").text(response?.banner?.link || '-');
          $('#bannerPreviewDetail').attr('src', image.realImage);
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
            url: "/admin/banners/delete/" + id,
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
  </script>
@endsection
