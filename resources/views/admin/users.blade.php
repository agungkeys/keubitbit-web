@extends('layouts.admin') @section('title', 'Master User') @section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="flex justify-end pb-6">
        <button class="btn btn-sm btn-primary">Tambah</button>
      </div>
      <div class="card bg-white rounded-lg">
        <div class="card-body">
          <div class="overflow-x-auto">
            <table class="table table-zebra border-[1px]">
              <!-- head -->
              <thead>
                <tr>
                  <th></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                    <th>{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="flex gap-2">
                            <button class="btn btn-xs">Detail</button>
                            <button class="btn btn-xs btn-primary">Edit</button>
                            <button class="btn btn-xs btn-error">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
