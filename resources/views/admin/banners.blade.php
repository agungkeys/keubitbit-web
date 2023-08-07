@extends('layouts.admin')
@section('title', 'Master Banner')
@section('content')
  <div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Master Banner
          </div>
          <div class="card-body bg-white">
            <div class="overflow-x-auto">
              <table class="table table-zebra">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($banners as $banner)
                    <tr>
                      <td>{{ $banner->id }}</td>
                      <td>
                        <div class="flex items-center space-x-3">
                          <div class="avatar">
                            <div class="mask mask-squircle w-12 h-12">
                              @if ($banner->image)
                                <img src="{{ $banner->image }}" alt="{{ $banner->name }}">
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
                        <button class="btn btn-info"><x-heroicon-o-pencil-square class="h-5 w-5" />EDIT</button>
                        <button class="btn btn-error"><x-heroicon-o-trash class="h-5 w-5" />DELETE</button>
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
