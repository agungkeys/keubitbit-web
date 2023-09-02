@extends('layouts.admin')
@section('title', 'Music')
@section('content')
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
                  <th>
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
                        <button onClick="handleDetail(`{{ $music->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                          </svg>
                        </button>
                        <button onClick="handleEdit(`{{ $music->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                          </svg>
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
    <form class="card-body p-4" action="{{ route('admin.musics.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-semibold text-2xl pb-2">Add New Music</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Album Name</span>
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
            <span class="label-text text-base-content undefined">Date Release</span>
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
          <span class="label-text text-base-content undefined">Detail</span>
        </label>
        <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="detail" placeholder="Enter the Description" name="detail"></textarea>
        <!-- <input name="email" type="text" placeholder="Your email" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" /> -->
        @if ($errors->has('detail'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
          </label>
        @endif
      </div>
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Link IFrame</span>
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
          <span class="label-text text-base-content undefined">Link Spotify</span>
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
          <span class="label-text text-base-content undefined">Link Youtube</span>
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
          <span class="label-text text-base-content undefined">Link Apple</span>
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
          <span class="label-text text-base-content undefined">Featured Album</span>
        </label>
        <input name="featured" type="checkbox" class="toggle" />
      </div>
      <div class="max-w-lg">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md" id="musicPreviewEdit">
          <input name="image" id="image" type="file" accept="image/*" onchange="previewImageOnEdit()" class="file-input file-input-bordered w-full {{ $errors->has('image') ? ' input-error' : '' }}" />
          @if ($errors->has('image'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('image') }}</span>
          </label>
          @endif
        </div>
      </div>

      <div class="modal-action">
        <button type="button" onClick="backMusic()" class="btn btn-light">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</section>

<section id="edit" hidden></section>

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
  // CKEDITOR.replace('edit_detail');

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
  }

  function handleDelete(id){

  }
</script>
@endsection