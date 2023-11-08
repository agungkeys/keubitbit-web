@extends('layouts.admin') @section('title', 'Contacts')

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
          <form action="{{ route('admin.contacts', request()->query()) }}">
            <div class="flex my-2">
              <input type="hidden" name="sortColumn" value="{{ $sortColumn }}" />
              <input type="hidden" name="sortDirection" value="{{ $sortDirection }}" />
              <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="{{ $searchParam }}" />
              <button type="submit" class="btn btn-primary rounded-l-none">
                <x-heroicon-o-magnifying-glass class="h-6 w-6" />
              </button>
            </div>
          </form>
        </div>
        <div class="card bg-white rounded-lg">
          <div class="card-body p-0">
            <div class="overflow-x-auto">
              <table class="table">
                <thead>
                  <tr>
                    <th width="3%">
                      <x-column-header dataRoute="admin.contacts" column-name="id" :sort-column="$sortColumn" :sortDirection="$sortDirection">#</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.contacts" column-name="name" :sort-column="$sortColumn" :sortDirection="$sortDirection">Name</x-column-header>
                    </th>
                    <th>
                      <x-column-header dataRoute="admin.contacts" column-name="email" :sort-column="$sortColumn" :sortDirection="$sortDirection">Email</x-column-header>
                    </th>
                    <th width="100">
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($contacts as $contact)
                    <tr>
                      <th>{{ $contact->id }}</th>
                      <td>{{ $contact->name }}</td>
                      <td>{{ $contact->email }}</td>
                      <td>
                        <div class="flex items-center justify-end gap-2">
                          <button onClick="handleDetail(`{{ $contact->id }}`)" class="btn btn-sm btn-square btn-ghost">
                            <x-heroicon-m-bars-3-bottom-left class="w-4 h-4" />
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
        {{ $contacts->appends(['sortDirection' => request()->sortDirection, 'sortColumn' => request()->sortColumn, 'q' => request()->q])->onEachSide(5)->links() }}
      </div>
    </div>
  </section>

  <dialog id="modal_contact_detail" class="modal">
    <div class="modal-box">
      <a href="{{ $url }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</a>
      <h3 class="font-semibold text-2xl pb-6 text-center">Detail Contact</h3>
      <label class="label">
        <span class="label-text text-gray-500">Name</span>
      </label>
      <span id="detail_name" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Email</span>
      </label>
      <span id="detail_email" class="label text-base">-</span>
      <label class="label">
        <span class="label-text text-gray-500">Message</span>
      </label>
      <span id="detail_message" class="label text-base">-</span>
      <div class="modal-action">
        <a href="{{ $url }}" class="btn btn-light">Close</a>
      </div>
    </div>
  </dialog>
@endsection
@section('js')
  <script>
    function handleDetail(id) {
      modal_contact_detail.showModal();
      $.ajax({
        type: "GET",
        url: "/admin/contacts/detail/" + id,
        success: function(response) {
          const contact = response?.contact || {};
          $("#detail_name").text(contact?.name);
          $("#detail_email").text(contact?.email);
          $("#detail_message").html(contact?.message);
          console.log(response);
        }
      })
    }
  </script>
@endsection
