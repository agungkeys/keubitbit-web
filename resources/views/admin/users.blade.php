@extends('layouts.admin') @section('title', 'Master User') @section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="flex justify-between items-center pb-6">
        <form action="{{ route('admin.users', request()->query()) }}">
          <div class="flex my-2">
            <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
            <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
            <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
            <button type="submit" class="btn btn-primary rounded-l-none">
              <x-heroicon-o-magnifying-glass class="h-6 w-6" />
            </button>
          </div>
        </form>
        <button class="btn btn-md btn-primary" onclick="modal_user.showModal()">Add</button>
      </div>
      <div class="card bg-white rounded-lg">
        <div class="card-body p-0">
          <div class="overflow-x-auto">
            <table class="table">
              <!-- head -->
              <thead>
                <tr>
                  <th>
                    <x-column-header dataRoute="admin.users" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                  </th>
                  <th>
                    <x-column-header dataRoute="admin.users" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                  </th>
                  <th>
                    <x-column-header dataRoute="admin.users" column-name="email" :sort-column="$sortColumn" :sortDirection="$sortDirection">Email</x-column-header>
                  </th>
                  <th width="100">
                    Action
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                  <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                      <div class="flex items-center justify-end gap-2">
                        <button onClick="handleDetail(`{{ $user->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12" />
                          </svg>
                        </button>
                        <button onClick="handleEdit(`{{ $user->id }}`)" class="btn btn-sm btn-square btn-ghost">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
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
      {{ $users->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
    </div>
  </div>
</div>
<!-- Open the modal using ID.showModal() method -->
<dialog id="modal_user" class="modal">
  <form class="modal-box" action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
    <h3 class="font-semibold text-2xl pb-6 text-center">Add New User</h3>
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
        <span class="label-text text-base-content undefined">Email</span>
      </label>
      <input name="email" type="text" placeholder="Your email" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
      @if ($errors->has('email'))
        <label class="label">
          <span class="label-text-alt text-error">{{ $errors->first('email') }}</span>
        </label>
      @endif
    </div>
    <div class="form-control w-full mt-2">
      <label class="label">
        <span class="label-text text-base-content undefined">Password</span>
      </label>
      <input name="password" type="password" placeholder="Your password" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
      @if ($errors->has('password'))
        <label class="label">
          <span class="label-text-alt text-error">{{ $errors->first('password') }}</span>
        </label>
      @endif
    </div>

    <div class="modal-action">
      <a href="{{ route('admin.users') }}" class="btn btn-light">Close</a>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </form>
</dialog>

<!-- Open the modal user edit -->
<dialog id="modal_user_edit" class="modal">
  <form class="modal-box" action="{{ route('admin.users.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
    <h3 class="font-semibold text-2xl pb-6 text-center">Edit User</h3>
    <div class="form-control w-full mt-2">
      <label class="label">
        <span class="label-text text-base-content undefined">Fullname</span>
      </label>
      <input id="name" name="name" type="text" placeholder="Your fullname" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
      <input type="hidden" name="user_id" id="user_id" />
      @if ($errors->has('name'))
        <label class="label">
          <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
        </label>
      @endif
    </div>
    <div class="form-control w-full mt-2">
      <label class="label">
        <span class="label-text text-base-content undefined">Email</span>
      </label>
      <input id="email" name="email" type="text" placeholder="Your email" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
      @if ($errors->has('email'))
        <label class="label">
          <span class="label-text-alt text-error">{{ $errors->first('email') }}</span>
        </label>
      @endif
    </div>
    <div class="form-control w-full mt-2">
      <label class="label">
        <span class="label-text text-base-content undefined">Password</span>
      </label>
      <input id="password" name="password" type="password" placeholder="Your password" class="input input-bordered w-full" />
    </div>

    <div class="modal-action">
      <a href="{{ route('admin.users') }}" class="btn btn-light">Close</a>
      <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
  </form>
</dialog>

<!-- Open the modal user detail -->
<dialog id="modal_user_detail" class="modal">
  <div class="modal-box">
    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
    <h3 class="font-semibold text-2xl pb-6 text-center">Detail User</h3>
    <label class="label">
      <span class="label-text text-gray-500">Fullname</span>
    </label>
    <span id="detail_name" class="label text-base">-</span>
    <label class="label mt-3">
      <span class="label-text text-gray-500">Email</span>
    </label>
    <span id="detail_email" class="label text-base">-</span>
    <label class="label mt-3">
      <span class="label-text text-gray-500">Date Register</span>
    </label>
    <span id="detail_created_at" class="label text-base">-</span>
    <div class="modal-action">
      <a href="{{ route('admin.users') }}" class="btn btn-light">Close</a>
      <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
    </div>
  </div>
</dialog>

@endsection
@section('js')
@if (count($errors) > 0)
  <script>
    modal_user.showModal();
  </script>
@endif
<script>
  function handleEdit(id) {
    modal_user_edit.showModal();
    $.ajax({
      type: "GET",
      url: "/admin/users/edit/" + id,
      success: function(response) {
        $("#name").val(response.user.name);
        $('#user_id').val(response.user.id);
        $("#email").val(response.user.email);
      }
    })
  }

  function handleDetail(id) {
    modal_user_detail.showModal();
    $.ajax({
      type: "GET",
      url: "/admin/users/edit/" + id,
      success: function(response) {
        const tempDate = new Date(response?.user?.created_at || '-');
        const date = tempDate.toLocaleString('en-GB', {
          hour12: false,
        });
        $("#detail_name").text(response?.user?.name || '-');
        $("#detail_email").text(response?.user?.email || '-');
        $("#detail_created_at").text(date);
      }
    })
  }
</script>
@endsection
