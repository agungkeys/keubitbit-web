@extends('layouts.admin')
@section('title', 'Articles & News')
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
          <form action="{{ route('admin.news', request()->query()) }}">
            <div class="flex my-2">
              <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
              <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
              <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
              <button type="submit" class="btn btn-primary rounded-l-none">
                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
              </button>
            </div>
          </form>
          <button onclick="addNews()" class="btn btn-md btn-primary">Add</button>
        </div>
        <div class="card bg-white rounded-lg">
          <div class="card-body p-0">
            <div class="overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <x-column-header dataRoute="admin.news" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.news" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Title</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.news" column-name="slug" :sort-column="$sortColumn" :sortDirection="$sortDirection">Slug</x-column-header>
                    </th>
                    <th width="100">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($news as $news_item)
                    @php
                      $img = json_decode($news_item->image);
                    @endphp
                    <tr>
                      <td>{{ $news_item->id }}</td>
                      <td>
                        <div class="flex items-center space-x-3">
                          <div class="avatar">
                            <div class="mask mask-squircle w-9 h-9">
                              @if ($news_item->image != '')
                                <img src="{{ $img->realImage }}" alt="{{ $news_item->name }}">
                              @else
                                <img src="https://placehold.co/100x100" alt="blank" />
                              @endif
                            </div>
                          </div>
                          <div>
                            <div class="font-bold">{{ $news_item->name }}</div>
                          </div>
                      </td>
                      <td> {{ $news_item->slug }} </td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
                          <input data-id="{{ $news_item->id }}" type="checkbox" class="toggle toggle-sm toggle-info isActive" {{ $news_item->is_active == 1 ? 'checked' : '' }} />
                          <button onClick="handleDetail(`{{ $news_item->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-m-bars-3-bottom-left class="w-4 h-4" />
                          </button>
                          <button onClick="editNews(`{{ $news_item->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-o-pencil class="w-4 h-4" />
                          </button>
                          <button onClick="handleDelete(`{{ $news_item->id }}`)" class="btn btn-sm btn-square btn-ghost">
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
        {{ $news->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
      </div>
    </div>
  </section>

  <section id="add" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-6">Add New News</h3>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Title</span>
          </label>
          <input name="name" type="text" placeholder="Your news title" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
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
            <span class="label-text text-base-content undefined">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md mx-auto" id="newsPreview" hidden>
          <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnAdd()" class="file-input file-input-bordered w-full {{ $errors->has('image') ? ' input-error' : '' }}" />
          @if ($errors->has('image'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('image') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Reference</span>
          </label>
          <input name="reference" type="text" placeholder="Your news reference" class="input input-bordered w-full {{ $errors->has('reference') ? ' input-error' : '' }}" />
          @if ($errors->has('reference'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('reference') }}</span>
            </label>
          @endif
        </div>
        <x-form-action type="save" route="{{ $url }}" />
      </form>
    </div>
  </section>

  <section id="edit" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.news.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-6">Edit News</h3>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Title</span>
          </label>
          <input type="hidden" id="news_id" name="news_id">
          <input name="name" id="name" type="text" placeholder="News Title" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Slug</span>
          </label>
          <input name="slug" id="slug" type="text" placeholder="News Title" class="input input-bordered w-full {{ $errors->has('slug') ? ' input-error' : '' }}" disabled />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('slug') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Detail</span>
          </label>
          <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="detailEdit" placeholder="Enter the Description" name="detail"></textarea>
          @if ($errors->has('detail'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md mx-auto" id="newsPreviewEdit">
          <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnEdit()" class="file-input file-input-bordered w-full {{ $errors->has('image') ? ' input-error' : '' }}" />
          @if ($errors->has('image'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('image') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Reference</span>
          </label>
          <input name="reference" id="reference" type="text" placeholder="News Reference" class="input input-bordered w-full {{ $errors->has('reference') ? ' input-error' : '' }}" />
          @if ($errors->has('reference'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('reference') }}</span>
            </label>
          @endif
        </div>
        <x-form-action type="update" route="{{ $url }}" />
      </form>
    </div>
  </section>

  <dialog id="modal_news_detail" class="modal">
    <div class="modal-box">
      <a href="{{ $url }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
      <h3 class="font-semibold text-2xl pb-6 text-center">Detail News</h3>
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
      <span id="detail_detail" class="label text-base block">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Image</span>
      </label>
      <img id="newsPreviewDetail">
      <label class="label">
        <span class="label-text text-gray-500">Reference</span>
      </label>
      <span id="detail_reference" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">By :</span>
      </label>
      <span id="detail_user" class="label text-base">-</span>
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

    $(function() {
      $('.isActive').change(function() {
        var is_active = $(this).prop('checked') == true ? 1 : 0;
        var news_id = $(this).data('id');
        $.ajax({
          type: "GET",
          dataType: "json",
          url: "/admin/articles/changeactive",
          data: {
            'is_active': is_active,
            'news_id': news_id
          },
          success: function(response) {
            if (response.status == 200) {
              toastr.options = {
                "closeButton": true,
                "progressBar": true
              }
              toastr.success('Changed Successfuly!')
            }
          }
        });
      })
    })

    function previewImageOnAdd() {
      const file = event.target.files[0];
      if (file.size > 3080000) {
        toastr.options = {
          "closeButton": true,
          "progressBar": true
        }
        toastr.error("Your files to large, please resize!");
        $("#image").val("");
        newsPreview.src = "";
      } else {
        $("#newsPreview").show();
        newsPreview.src = URL.createObjectURL(event.target.files[0])
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
        $('#newsPreviewEdit').show();
        newsPreviewEdit.src = URL.createObjectURL(event.target.files[0])
      }
    }

    function backNews() {
      $("#list").show();
      $("#add").hide();
      $("#edit").hide();
    }

    function addNews() {
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

    function editNews(id) {
      $("#list").hide();
      $("#edit").show();
      $.ajax({
        type: "GET",
        url: "/admin/articles/edit/" + id,
        success: function(response) {
          const news = response?.news || {};
          const dataImage = news?.image || {};
          var image;
          if (response.news.image != '') {
            image = JSON.parse(dataImage);
          }
          $("#news_id").val(news.id);
          $("#name").val(news.name);
          $("#slug").val(news.slug);
          $("#reference").val(news.reference);
          $('#newsPreviewEdit').attr('src', image?.realImage || '');
          CKEDITOR.instances['detailEdit'].setData(news.detail);
        }
      })
    }

    function handleDetail(id) {
      modal_news_detail.showModal();
      $.ajax({
        type: "GET",
        url: "/admin/articles/edit/" + id,
        success: function(response) {
          const news = response?.news || {};
          const dataImage = news?.image || {};
          var image;
          if (response.news.image != '') {
            image = JSON.parse(dataImage);
          }
          $("#detail_name").text(news?.name);
          $("#detail_slug").text(news?.slug);
          $("#detail_detail").html(news?.detail);
          $("#detail_reference").text(news?.reference);
          $("#detail_user").text(news?.user_id);
          $('#newsPreviewDetail').attr('src', image?.realImage || '');
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
            url: "/admin/articles/delete/" + id,
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
