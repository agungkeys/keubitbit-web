@extends('layouts.admin')
@section('title', 'Gallery')
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
          <form action="{{ route('admin.galleries', request()->query()) }}">
            <div class="flex my-2">
              <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
              <button type="submit" class="btn btn-primary rounded-l-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </button>
            </div>
          </form>
          <button class="btn btn-md btn-primary" onClick="addGallery()">Add</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-10">
          @foreach ($galleries as $gallery)
            @php
              $img = json_decode($gallery->image);
            @endphp
            <div class="card bg-base-100 shadow-xl">
              <div class="flex">
                <figure class="rounded-l-xl w-[130px] max-w-[130px]">
                  @if ($gallery->image != '')
                    <img src="{{ $img->realImage }}" alt="{{ $gallery->name }}">
                  @else
                    <img src="https://placehold.co/200x280" alt="blank" />
                  @endif
                </figure>
                <div class="card-body p-4">
                  <div class="card-actions justify-end">
                    <button onClick="photoGallery('{{ $gallery->id }}')" class="btn btn-sm btn-square btn-ghost">
                      <x-heroicon-o-photo class="w-4 h-4" />
                    </button>
                    <button onClick="editGallery('{{ $gallery->id }}')" class="btn btn-sm btn-square btn-ghost">
                      <x-heroicon-o-pencil class="w-4 h-4" />
                    </button>
                    <button onClick="handleDelete('{{ $gallery->id }}')" class="btn btn-sm btn-square btn-ghost">
                      <x-heroicon-o-trash class="w-4 h-4" />
                    </button>
                  </div>
                  <h2 class="card-title">{{ $gallery->name }}</h2>
                  <span class="text-gray-500 text-base">{{ $gallery->slug }}</span>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  <section id="add" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-2">Add New Gallery</h3>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Name</span>
          </label>
          <input name="name" type="text" placeholder="Your gallery name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
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
          <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="detail" placeholder="Enter the Description" name="detail"></textarea>
          @if ($errors->has('detail'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
            </label>
          @endif
        </div>
        <x-form-action type="save" route="{{ $url }}" />
      </form>
    </div>
  </section>

  <section id="edit" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.galleries.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-2">Edit Gallery</h3>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Name</span>
          </label>
          <input type="hidden" name="gallery_id" id="gallery_id">
          <input name="name" id="name" type="text" placeholder="Your gallery name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
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
          <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="edit_detail" placeholder="Enter the Description" name="detail"></textarea>
          @if ($errors->has('detail'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
            </label>
          @endif
        </div>
        <x-form-action type="update" route="{{ $url }}" />
      </form>
    </div>
  </section>

  <section id="photo" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.galleries.photo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-2" id="title"></h3>
        <div class="grid grid-cols-2 gap-4">
          <input type="hidden" name="gallery_id" id="gallery_id_photo">
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image1" src="https://placehold.co/512x160?text=No+Image">
            <input name="image1" id="image1" type="file" accept="image/*" onchange="previewImageOnAdd(image1)" class="file-input file-input-bordered w-full {{ $errors->has('image1') ? ' input-error' : '' }}" />
            @if ($errors->has('image1'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image1') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image2" src="https://placehold.co/512x160?text=No+Image">
            <input name="image2" id="image2" type="file" accept="image/*" onchange="previewImageOnAdd(image2)" class="file-input file-input-bordered w-full {{ $errors->has('image2') ? ' input-error' : '' }}" />
            @if ($errors->has('image2'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image2') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image3" src="https://placehold.co/512x160?text=No+Image">
            <input name="image3" id="image3" type="file" accept="image/*" onchange="previewImageOnAdd(image3)" class="file-input file-input-bordered w-full {{ $errors->has('image3') ? ' input-error' : '' }}" />
            @if ($errors->has('image3'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image3') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image4" src="https://placehold.co/512x160?text=No+Image">
            <input name="image4" id="image4" type="file" accept="image/*" onchange="previewImageOnAdd(image4)" class="file-input file-input-bordered w-full {{ $errors->has('image4') ? ' input-error' : '' }}" />
            @if ($errors->has('image4'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image4') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image5" src="https://placehold.co/512x160?text=No+Image">
            <input name="image5" id="image5" type="file" accept="image/*" onchange="previewImageOnAdd(image5)" class="file-input file-input-bordered w-full {{ $errors->has('image5') ? ' input-error' : '' }}" />
            @if ($errors->has('image5'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image5') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image6" src="https://placehold.co/512x160?text=No+Image">
            <input name="image6" id="image6" type="file" accept="image/*" onchange="previewImageOnAdd(image6)" class="file-input file-input-bordered w-full {{ $errors->has('image6') ? ' input-error' : '' }}" />
            @if ($errors->has('image6'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image6') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image7" src="https://placehold.co/512x160?text=No+Image">
            <input name="image7" id="image7" type="file" accept="image/*" onchange="previewImageOnAdd(image7)" class="file-input file-input-bordered w-full {{ $errors->has('image7') ? ' input-error' : '' }}" />
            @if ($errors->has('image7'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image7') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <img class="my-2 max-w-lg h-40 rounded-md" id="preview_image8" src="https://placehold.co/512x160?text=No+Image">
            <input name="image8" id="image8" type="file" accept="image/*" onchange="previewImageOnAdd(image8)" class="file-input file-input-bordered w-full {{ $errors->has('image8') ? ' input-error' : '' }}" />
            @if ($errors->has('image8'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('image8') }}</span>
              </label>
            @endif
          </div>
        </div>
        <x-form-action type="save" route="{{ $url }}" />
      </form>
    </div>
  </section>

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

    function previewImageOnAdd(t) {
      var id = t.id;
      const file = event.target.files[0];
      if (file.size > 3080000) {
        toastr.error("Your files to large, please resize!");
        $("#" + id).val("");
        $("#" + "preview_" + id).attr("src", "https://placehold.co/512x160?text=No+Image");
      } else {
        $("#" + "preview_" + id).attr("src", URL.createObjectURL(event.target.files[0]));
      }
    }


    function backGallery() {
      $("#list").show();
      $("#add").hide();
      $("#edit").hide();
    }

    function addGallery() {
      $("#list").hide();
      $("#add").show();
    }

    function editGallery(id) {
      $("#list").hide();
      $("#edit").show();
      $.ajax({
        type: "GET",
        url: "/admin/galleries/edit/" + id,
        success: function(response) {
          const gallery = response?.gallery || {};
          $("#gallery_id").val(gallery.id);
          $("#name").val(gallery.name);
          CKEDITOR.instances['edit_detail'].setData(gallery.detail);
        }
      })
    }

    function photoGallery(id) {
      $("#list").hide();
      $("#photo").show();
      $.ajax({
        type: "GET",
        url: "/admin/galleries/photo/" + id,
        success: function(response) {
          const gallery = response?.gallery || {};
          const photos = gallery.photo;
          const photo = [];
          $("#gallery_id_photo").val(gallery.id);
          $("#title").text("Add Photo at " + gallery.name);
          for (let i = 0; i < photos.length; i++) {
            var images = JSON.parse(photos[i].image);
            var realImage = images.realImage;
            var num = i + 1;
            $('#preview_image' + num).attr('src', realImage || '');
          }
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
            url: "/admin/galleries/delete/" + id,
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
