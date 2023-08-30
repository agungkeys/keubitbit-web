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
          <button class="btn btn-md btn-primary" onclick="modal_user.showModal()">Add News</button>
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
                      <x-column-header dataRoute="admin.news" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.news" column-name="link" :sort-column="$sortColumn" :sortDirection="$sortDirection">Link</x-column-header>
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
                          {{-- <div class="avatar">
                            <div class="mask mask-squircle w-9 h-9">
                              @if ($news_item->image != '')
                                <img src="{{ $img->realImage }}" alt="{{ $news_item->name }}">
                              @else
                                <img src="https://placehold.co/100x100" alt="blank" />
                              @endif
                            </div>
                          </div> --}}
                          <div>
                            <div class="font-bold">{{ $news_item->name }}</div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <a href="{{ $news_item->link }}" target="_blank">{{ $news_item->link }}</a>
                      </td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
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
@endsection
