@extends('layouts.admin')
@section('title', 'Master Articles & News')
@section('content')
  <div>
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
          <button class="btn btn-md btn-primary" onclick="modal_news.showModal()">Add</button>
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
                      <td> {{ $news_item->name }} </td>
                      <td> {{ $news_item->slug }} </td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
                          <input id="isActive" onchange="changeActiveStatus()" data-id="{{ $news_item->id }}" type="checkbox" class="toggle toggle-xs toggle-info" {{ $news_item->is_active == 1 ? 'checked' : '' }} />
                          <button onClick="handleDetail(`{{ $news_item->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-m-bars-3-bottom-left class="w-3 h-3" />
                          </button>
                          <button onClick="handleEdit(`{{ $news_item->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-o-pencil class="w-3 h-3" />
                          </button>
                          <button onClick="handleDelete(`{{ $news_item->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-o-trash class="w-3 h-3" />
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
  </div>
  <dialog id="modal_news" class="modal">
    <form class="modal-box w-11/12 max-w-5xl" action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <a href="{{ route('admin.news') }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
      <h3 class="font-semibold text-2xl pb-6 text-center">Add New News</h3>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Title</span>
        </label>
        <input name="name" type="text" placeholder="News Title" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
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
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Image</span>
        </label>
        <img class="my-2 max-w-lg rounded-md mx-auto" id="memberPreview" hidden>
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
        <input name="reference" type="text" placeholder="News Reference" class="input input-bordered w-full {{ $errors->has('reference') ? ' input-error' : '' }}" />
        @if ($errors->has('reference'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('reference') }}</span>
          </label>
        @endif
      </div>
      <div class="modal-action">
        <a href="{{ route('admin.news') }}" class="btn btn-light">Close</a>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </dialog>
@endsection
@section('js')
  <script>
    CKEDITOR.replace('detail');

    function changeActiveStatus() {
      var status = $('#isActive').prop('checked') == true ? 1 : 0;
      var news_id = $('#isActive').data('id');

      $.ajax({
        type: "GET",
        dataType: "json",
        url: "/admin/articles/changeactive",
        data: {
          'status': status,
          'news_id': news_id
        },
        success: function(response) {
          if (response.status == 200) {
            toastr.success('Changed Successfuly')
          }
        }
      });
    }

    function previewImageOnAdd() {
      const file = event.target.files[0];
      if (file.size > 3080000) {
        toastr.error("Your files to large, please resize!");
        $("#image").val("");
        memberPreview.src = "";
      } else {
        $("#memberPreview").show();
        memberPreview.src = URL.createObjectURL(event.target.files[0])
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
  </script>
@endsection
