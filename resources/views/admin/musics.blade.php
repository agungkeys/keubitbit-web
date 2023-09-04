@extends('layouts.admin')
@section('title', 'Music')
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
        <form action="{{ route('admin.musics', request()->query()) }}">
          <div class="flex my-2">
            <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
            <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
            <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
            <button type="submit" class="btn btn-primary rounded-l-none">
              <x-heroicon-o-magnifying-glass class="h-6 w-6" />
            </button>
          </div>
        </form>
        <button onClick="addMusic()" class="btn btn-md btn-primary">Add</button>
      </div>
      <div class="card bg-white rounded-lg">
        <div class="card-body p-0">
          <div class="overflow-x-auto">
            <table class="table">
              <!-- head -->
              <thead>
                <tr>
                  <th width="3%">
                    <x-column-header dataRoute="admin.musics" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                  </th>
                  <th>
                    <x-column-header dataRoute="admin.musics" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                  </th>
                  <th>
                    <x-column-header dataRoute="admin.musics" column-name="date_release" :sort-column="$sortColumn" :sortDirection="$sortDirection">Release</x-column-header>
                  </th>
                  <th class="text-base">
                    Featured
                  </th>
                  <th class="text-base" width="100">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($musics as $music)
                  @php
                    $img = json_decode($music->image);
                  @endphp
                  <tr>
                    <th>{{ $music->id }}</th>
                    <td>
                      <div class="flex items-center space-x-3">
                        <div class="avatar">
                          <div class="mask mask-squircle w-9 h-9">
                            @if ($music->image != '')
                              <img src="{{ $img->realImage }}" alt="{{ $music->name }}">
                            @else
                              <img src="https://placehold.co/100x100" alt="blank" />
                            @endif
                          </div>
                        </div>
                        <div>
                          <div class="font-bold">{{ $music->name }}</div>
                        </div>
                      </div>
                    </td>
                    <td>{{ $music->date_release }}</td>
                    <td>
                      @if($music->is_featured)
                      <div class="text-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>                        
                      </div>
                      @endif
                    </td>
                    <td>
                      <div class="flex items-center justify-end gap-2">
                        <button onClick="editMusic(`{{ $music->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <x-heroicon-o-pencil class="w-4 h-4" />
                        </button>
                        <button onClick="handleDelete(`{{ $music->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <x-heroicon-o-trash class="w-4 h-4" />
                        </button>
                        <!-- <button class="btn btn-sm btn-error">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                              </svg>
                            </button> -->
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      {{ $musics->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
    </div>
  </div>
</section>

<section id="add" hidden>
  <div class="card bg-white">
    <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.musics.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-semibold text-2xl pb-2">Add New Music</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Album Name</span>
          </label>
          <input name="name" type="text" placeholder="Your album name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Date Release</span>
          </label>
          <input name="date" type="number" placeholder="Your date release" class="input input-bordered w-full {{ $errors->has('date') ? ' input-error' : '' }}" />
          @if ($errors->has('date'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('date') }}</span>
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
          <span class="label-text text-base-content">Link IFrame</span>
        </label>
        <input name="iframe" type="text" placeholder="Your link iframe" class="input input-bordered w-full {{ $errors->has('iframe') ? ' input-error' : '' }}" />
        @if ($errors->has('iframe'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('iframe') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Link Spotify</span>
        </label>
        <input name="spotify" type="text" placeholder="Your link spotify" class="input input-bordered w-full {{ $errors->has('spotify') ? ' input-error' : '' }}" />
        @if ($errors->has('spotify'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('spotify') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Link Youtube</span>
        </label>
        <input name="youtube" type="text" placeholder="Your link youtube" class="input input-bordered w-full {{ $errors->has('youtube') ? ' input-error' : '' }}" />
        @if ($errors->has('youtube'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('youtube') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Link Apple</span>
        </label>
        <input name="apple" type="text" placeholder="Your link apple" class="input input-bordered w-full {{ $errors->has('apple') ? ' input-error' : '' }}" />
        @if ($errors->has('apple'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('apple') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Featured Album</span>
        </label>
        <input name="featured" type="checkbox" class="toggle" />
      </div>
      <div class="max-w-lg">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md" id="musicPreview">
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
    <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.musics.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-semibold text-2xl pb-2">Edit Music</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Album Name</span>
          </label>
          <input name="edit_name" id="edit_name" type="text" placeholder="Your album name" class="input input-bordered w-full {{ $errors->has('edit_name') ? ' input-error' : '' }}" />
          <input type="hidden" name="music_id" id="music_id" />
          @if ($errors->has('edit_name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('edit_name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Date Release</span>
          </label>
          <input name="edit_date" id="edit_date" type="number" placeholder="Your date release" class="input input-bordered w-full {{ $errors->has('edit_date') ? ' input-error' : '' }}" />
          @if ($errors->has('edit_date'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('edit_date') }}</span>
            </label>
          @endif
        </div>
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Detail</span>
        </label>
        <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="edit_detail" placeholder="Enter the Description" name="detail"></textarea>
        <!-- <input name="email" type="text" placeholder="Your email" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" /> -->
        @if ($errors->has('edit_detail'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('edit_detail') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Link IFrame</span>
        </label>
        <input name="edit_iframe" id="edit_iframe" type="text" placeholder="Your link iframe" class="input input-bordered w-full {{ $errors->has('edit_iframe') ? ' input-error' : '' }}" />
        @if ($errors->has('edit_iframe'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('edit_iframe') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Link Spotify</span>
        </label>
        <input name="edit_spotify" id="edit_spotify" type="text" placeholder="Your link spotify" class="input input-bordered w-full {{ $errors->has('edit_spotify') ? ' input-error' : '' }}" />
        @if ($errors->has('edit_spotify'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('edit_spotify') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Link Youtube</span>
        </label>
        <input name="edit_youtube" id="edit_youtube" type="text" placeholder="Your link youtube" class="input input-bordered w-full {{ $errors->has('edit_youtube') ? ' input-error' : '' }}" />
        @if ($errors->has('edit_youtube'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('edit_youtube') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Link Apple</span>
        </label>
        <input name="edit_apple" id="edit_apple" type="text" placeholder="Your link apple" class="input input-bordered w-full {{ $errors->has('edit_apple') ? ' input-error' : '' }}" />
        @if ($errors->has('edit_apple'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('edit_apple') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content">Featured Album</span>
        </label>
        <input name="edit_featured" id="edit_featured" type="checkbox" class="toggle" />
      </div>
      <div class="max-w-lg">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md" id="musicPreviewEdit">
          <input name="edit_image" id="edit_image" type="file" accept="image/*" onchange="previewImageOnEdit()" class="file-input file-input-bordered w-full {{ $errors->has('edit_image') ? ' input-error' : '' }}" />
          @if ($errors->has('edit_image'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('edit_image') }}</span>
          </label>
          @endif
        </div>
      </div>
      <x-form-action type="update" route="{{ $url }}" />
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

  function previewImageOnAdd() {
    const file = event.target.files[0];
    if(file.size > 3080000){
      toastr.error("Your files to large, please resize!");
      $("#image").val("");
      musicPreview.src = "";
    }else{
      $("#musicPreview").show();
      musicPreview.src = URL.createObjectURL(event.target.files[0])
    }
  }

  function previewImageOnEdit() {
    const file = event.target.files[0];
    if(file.size > 3080000){
      toastr.error("Your files to large, please resize!");
      $("#edit_image").val("");
      musicPreviewEdit.src = "";
    }else{
      $("#musicPreview").show();
      musicPreviewEdit.src = URL.createObjectURL(event.target.files[0])
    }
  }

  function backMusic(){
    $("#list").show();
    $("#add").hide();
    $("#edit").hide();
  }

  function addMusic(){
    $("#list").hide();
    $("#add").show();
  }

  function editMusic(id){
    $("#list").hide();
    $("#edit").show();
    $.ajax({
      type: "GET",
      url: "/admin/musics/edit/" + id,
      success: function(response) {
        const music = response?.music || {};
        const dataImage = music?.image || {};
        const image = JSON.parse(dataImage);
        const value_is_featured = music.is_featured == 1 ? true : false;
        $("#music_id").val(music.id);
        $("#edit_name").val(music.name);
        $("#edit_date").val(music.date_release);
        $("#edit_iframe").val(music.iframe);
        $("#edit_spotify").val(music.link_spotify);
        $("#edit_youtube").val(music.link_youtube);
        $("#edit_apple").val(music.link_apple);
        $('#musicPreviewEdit').attr('src', image.realImage || '');
        CKEDITOR.instances['edit_detail'].setData(music.detail);
        $("#edit_featured").prop('checked', value_is_featured);
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
          url: "/admin/musics/delete/" + id,
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