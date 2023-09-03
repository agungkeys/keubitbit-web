@extends('layouts.admin') 
@section('title', 'Member') 
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
        <form action="{{ route('admin.members', request()->query()) }}">
          <div class="flex my-2">
            <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
            <button type="submit" class="btn btn-primary rounded-l-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
          </div>
        </form>
        <button class="btn btn-md btn-primary" onClick="addMember()">Add</button>
      </div>
  
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-10">
        @foreach ($members as $member)
          @php
            $img = json_decode($member->image);
          @endphp
          <div class="card bg-base-100 shadow-xl">
            <div class="flex">
              <figure class="rounded-l-xl w-[130px] max-w-[130px]">
                @if ($member->image != '')
                  <img src="{{ $img->realImage }}" alt="{{ $member->name }}">
                @else
                  <img src="https://placehold.co/200x280" alt="blank" />
                @endif
              </figure>
              <div class="card-body p-4">
                <div class="card-actions justify-end">
                  <button onClick="editMember('{{$member->id}}')" class="btn btn-sm btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                    </svg>
                  </button>
                  <button onClick="handleDelete('{{$member->id}}')" class="btn btn-sm btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>                
                  </button>
                </div>
                <h2 class="card-title">{{$member->name}}</h2>
                <span class="text-gray-500 text-base">{{$member->position}}</span>
                <div class="flex items-center gap-1">
                  @if ($member->social_facebook)
                  <a href="{{$member->social_facebook}}" target="_blank">
                    <img class="w-8 h-8" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882266/icons/img.icons8.com_wvhfgi.webp" />
                  </a>
                  @endif
                  @if ($member->social_instagram)
                  <a href="{{$member->social_instagram}}" target="_blank">
                    <img class="w-8 h-8" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882217/icons/img.icons8.com_ooftuv.webp" />
                  </a>
                  @endif
                  @if ($member->social_twitter)
                  <a href="{{$member->social_twitter}}" target="_blank">
                    <img class="w-8 h-8" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882190/icons/img.icons8.com_blvbtt.webp" />
                  </a>
                  @endif
                  @if ($member->social_tiktok)
                  <a href="{{$member->social_tiktok}}" target="_blank">
                    <img class="w-8 h-8" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882239/icons/img.icons8.com_dqksbg.webp" />
                  </a>
                  @endif
                  @if ($member->social_youtube)
                  <a href="{{$member->social_youtube}}" target="_blank">
                    <img class="w-8 h-8" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882166/icons/img.icons8.com_ekvdqu.webp" />
                  </a>
                  @endif
                  @if ($member->social_linktree)
                  <a href="{{$member->social_linktree}}" target="_blank">
                    <img class="w-8 h-8" src="https://res.cloudinary.com/domqavi1p/image/upload/v1692882134/icons/img.icons8.com_ypsjli.webp" />
                  </a>
                  @endif
                </div>
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
    <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-semibold text-2xl pb-2">Add New Member</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Fullname</span>
          </label>
          <input name="name" type="text" placeholder="Your fullname" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Position</span>
          </label>
          <input name="position" type="text" placeholder="Your position" class="input input-bordered w-full {{ $errors->has('position') ? ' input-error' : '' }}" />
          @if ($errors->has('position'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('position') }}</span>
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
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Facebook</span>
          </label>
          <input name="facebook" type="text" placeholder="Your facebook" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Instagram</span>
          </label>
          <input name="instagram" type="text" placeholder="Your facebook" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Twitter</span>
          </label>
          <input name="twitter" type="text" placeholder="Your twitter" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Tiktok</span>
          </label>
          <input name="tiktok" type="text" placeholder="Your tiktok" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Youtube</span>
          </label>
          <input name="youtube" type="text" placeholder="Your youtube" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Linktree</span>
          </label>
          <input name="linktree" type="text" placeholder="Your linktree" class="input input-bordered w-full" />
        </div>
      </div>
      <div class="max-w-lg">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md" id="memberPreview" hidden>
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
    <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.members.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <h3 class="font-semibold text-2xl pb-2">Edit Member</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Fullname</span>
          </label>
          <input id="edit_name" name="edit_name" type="text" placeholder="Your fullname" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
          <input type="hidden" name="member_id" id="member_id" />
          @if ($errors->has('name'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
            </label>
          @endif
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Position</span>
          </label>
          <input id="edit_position" name="edit_position" type="text" placeholder="Your position" class="input input-bordered w-full {{ $errors->has('position') ? ' input-error' : '' }}" />
          @if ($errors->has('position'))
            <label class="label">
              <span class="label-text-alt text-error">{{ $errors->first('position') }}</span>
            </label>
          @endif
        </div>
      </div>
      
      <div class="form-control w-full mt-2">
        <label class="label">
          <span class="label-text text-base-content undefined">Detail</span>
        </label>
        <textarea class="textarea h-60 textarea-bordered textarea-md w-full" id="edit_detail" placeholder="Enter the Description" name="edit_detail"></textarea>
        <!-- <input name="email" type="text" placeholder="Your email" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" /> -->
        @if ($errors->has('detail'))
          <label class="label">
            <span class="label-text-alt text-error">{{ $errors->first('detail') }}</span>
          </label>
        @endif
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Facebook</span>
          </label>
          <input id="edit_facebook" name="edit_facebook" type="text" placeholder="Your facebook" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Instagram</span>
          </label>
          <input id="edit_instagram" name="edit_instagram" type="text" placeholder="Your facebook" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Twitter</span>
          </label>
          <input id="edit_twitter" name="edit_twitter" type="text" placeholder="Your twitter" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Tiktok</span>
          </label>
          <input id="edit_tiktok" name="edit_tiktok" type="text" placeholder="Your tiktok" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Youtube</span>
          </label>
          <input id="edit_youtube" name="edit_youtube" type="text" placeholder="Your youtube" class="input input-bordered w-full" />
        </div>
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Linktree</span>
          </label>
          <input id="edit_linktree" name="edit_linktree" type="text" placeholder="Your linktree" class="input input-bordered w-full" />
        </div>
      </div>
      <div class="max-w-lg">
        <div class="form-control w-full mt-2">
          <label class="label">
            <span class="label-text text-base-content undefined">Image</span>
          </label>
          <img class="my-2 max-w-lg rounded-md" id="memberPreviewEdit">
          <input name="edit_image" id="edit_image" type="file" accept="image/*" onchange="previewImageOnEdit()" class="file-input file-input-bordered w-full {{ $errors->has('image') ? ' input-error' : '' }}" />
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
      memberPreview.src = "";
    }else{
      $("#memberPreview").show();
      memberPreview.src = URL.createObjectURL(event.target.files[0])
    }
  }

  function previewImageOnEdit() {
    const file = event.target.files[0];
    if(file.size > 3080000){
      toastr.error("Your files to large, please resize!");
      $("#edit_image").val("");
      memberPreviewEdit.src = "";
    }else{
      $("#memberPreview").show();
      memberPreviewEdit.src = URL.createObjectURL(event.target.files[0])
    }
  }

  function backMember(){
    $("#list").show();
    $("#add").hide();
    $("#edit").hide();
  }
  
  function addMember(){
    $("#list").hide();
    $("#add").show();
  }

  function editMember(id){
    $("#list").hide();
    $("#edit").show();
    $.ajax({
      type: "GET",
      url: "/admin/members/edit/" + id,
      success: function(response) {
        const member = response?.member || {};
        const dataImage = member.image;
        const image = JSON.parse(dataImage);
        $("#member_id").val(member.id);
        $("#edit_name").val(member.name);
        $("#edit_position").val(member.position);
        $("#edit_facebook").val(member.social_facebook);
        $("#edit_instagram").val(member.social_instagram);
        $("#edit_twitter").val(member.social_twitter);
        $("#edit_tiktok").val(member.social_tiktok);
        $("#edit_youtube").val(member.social_youtube);
        $("#edit_linktree").val(member.social_linktree);

        $('#memberPreviewEdit').attr('src', image.realImage);
        CKEDITOR.instances['edit_detail'].setData(member.detail);
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
          url: "/admin/members/delete/" + id,
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