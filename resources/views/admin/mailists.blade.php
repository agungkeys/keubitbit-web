@extends('layouts.admin') @section('title', 'Master Newsletter')

@section('content')
  <div class="">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="flex justify-between items-center pb-6">
          <form action="{{ route('admin.mailists', request()->query()) }}">
            <div class="flex my-2">
              <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
              <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
              <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
              <button type="submit" class="btn btn-primary rounded-l-none">
                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
              </button>
            </div>
          </form>
          <button class="btn btn-md btn-primary" onclick="modal_user.showModal()">Export CSV</button>
        </div>
        <div class="card bg-white rounded-lg">
          <div class="card-body p-0">
            <div class="overflow-x-auto">
              <table class="table">
                <!-- head -->
                <thead>
                  <tr>
                    <th>
                      <x-column-header dataRoute="admin.mailists" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.mailists" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.mailists" column-name="email" :sort-column="$sortColumn" :sortDirection="$sortDirection">Email</x-column-header>
                    </th>
                    <th width="100">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mailists as $mailist)
                    <tr>
                      <th>{{ $mailist->id }}</th>
                      <td>{{ $mailist->email }}</td>
                      <td>{{ $mailist->email }}</td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
                          <button onClick="handleCopy(`{{ $mailist->email }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-o-clipboard class="w-3 h-3" />
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
        {{ $mailists->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
      </div>
    </div>
  </div>
@endsection
@section('js')
  <script>
    function handleCopy(TextToCopy) {
      var TempText = document.createElement("input");
      TempText.value = TextToCopy;
      document.body.appendChild(TempText);
      TempText.select();

      document.execCommand("copy");
      document.body.removeChild(TempText);
      let timerInterval
      Swal.fire({
        icon: 'success',
        title: 'Copied!',
        text: 'Copied the text : ' + TempText.value,
        timer: 1500,
        timerProgressBar: true,
      })
    }
  </script>
@endsection
