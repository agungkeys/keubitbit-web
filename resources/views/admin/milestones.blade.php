@extends('layouts.admin')
@section('title', 'Milestone')
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
          <form action="{{ route('admin.milestones', request()->query()) }}">
            <div class="flex my-2">
              <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
              <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
              <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
              <button type="submit" class="btn btn-primary rounded-l-none">
                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
              </button>
            </div>
          </form>
          <button onClick="addMilestone()" class="btn btn-md btn-primary">Add</button>
        </div>
        <div class="card bg-white rounded-lg">
          <div class="card-body p-0">
            <div class="overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th>
                      <x-column-header dataRoute="admin.milestones" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.milestones" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.milestones" column-name="year" :sort-column="$sortColumn" :sortDirection="$sortDirection">Year</x-column-header>
                    </th>
                    <th class="text-base" width="100">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($milestones as $milestone)
                    <tr>
                      <th width="3%">{{ $milestone->id }}</th>
                      <td>{{ $milestone->name }}</td>
                      <td>{{ $milestone->year }}</td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
                          <button onClick="editMilestone(`{{ $milestone->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-o-pencil class="w-4 h-4" />
                          </button>
                          <button onClick="handleDelete(`{{ $milestone->id }}`)" class="btn btn-sm btn-square btn-ghost">
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
        {{ $milestones->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
      </div>
    </div>
  </section>

  <section id="add" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.milestones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-2">Add New Milestone</h3>
        <div class="grid grid-cols-2 gap-4">
          <div class="form-control w-full mt-2">
            <label class="label">
              <span class="label-text text-base-content">Milestone Name</span>
            </label>
            <input name="name" type="text" placeholder="Your milestone name" class="input input-bordered w-full {{ $errors->has('name') ? ' input-error' : '' }}" />
            @if ($errors->has('name'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('name') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <label class="label">
              <span class="label-text text-base-content">Milestone Year</span>
            </label>
            <input name="year" type="number" placeholder="Your milestone year" class="input input-bordered w-full {{ $errors->has('year') ? ' input-error' : '' }}" />
            @if ($errors->has('year'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('year') }}</span>
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
        <x-form-action type="save" route="{{ $url }}" />
      </form>
    </div>
  </section>

  <section id="edit" hidden>
    <div class="card bg-white">
      <form class="card-body p-4" onsubmit="disableButton()" action="{{ route('admin.milestones.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h3 class="font-semibold text-2xl pb-2">Edit Milestones</h3>
        <div class="grid grid-cols-2 gap-4">
          <div class="form-control w-full mt-2">
            <label class="label">
              <span class="label-text text-base-content">Milestone Name</span>
            </label>
            <input name="edit_name" id="edit_name" type="text" placeholder="Your milestone name" class="input input-bordered w-full {{ $errors->has('edit_name') ? ' input-error' : '' }}" />
            <input type="hidden" name="milestone_id" id="milestone_id" />
            @if ($errors->has('edit_name'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('edit_name') }}</span>
              </label>
            @endif
          </div>
          <div class="form-control w-full mt-2">
            <label class="label">
              <span class="label-text text-base-content">Year</span>
            </label>
            <input name="edit_year" id="edit_year" type="number" placeholder="Your date release" class="input input-bordered w-full {{ $errors->has('edit_year') ? ' input-error' : '' }}" />
            @if ($errors->has('edit_year'))
              <label class="label">
                <span class="label-text-alt text-error">{{ $errors->first('edit_year') }}</span>
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

    function addMilestone() {
      $("#list").hide();
      $("#add").show();
    }

    function editMilestone(id) {
      $("#list").hide();
      $("#edit").show();
      $.ajax({
        type: "GET",
        url: "/admin/milestones/edit/" + id,
        success: function(response) {
          const milestone = response?.milestone || {};
          $("#milestone_id").val(milestone.id);
          $("#edit_name").val(milestone.name);
          $("#edit_year").val(milestone.year);
          CKEDITOR.instances['edit_detail'].setData(milestone.detail);
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
          url: "/admin/milestones/delete/" + id,
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