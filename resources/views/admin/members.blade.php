@extends('layouts.admin') 
@section('title', 'Master Member') 

@section('content')
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="flex justify-between items-center pb-6">
      <form action="{{ route('admin.members', request()->query()) }}">
        <div class="flex my-2">
          <input type="text" name="q" placeholder="Search" class="py-2 px-2 text-md border border-gray-200 rounded-l focus:outline-none" value="" />
          <button type="submit" class="btn btn-primary rounded-l-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
          </button>
        </div>
      </form>
      <button class="btn btn-md btn-primary" onclick="modal_member.showModal()">Add Member</button>
    </div>

    <div class="grid grid-cols-3 gap-6">
      <div class="card bg-base-100 shadow-xl">
        <div class="flex">
          <figure class="rounded-l-xl">
            <img src="https://placehold.co/200x280" alt="Movie"/>
          </figure>
          <div class="card-body p-4">
            <h2 class="card-title">Personel Name Long Text Bla Bla</h2>
            <span>Position</span>
            <p>fb:</p>
            <div class="card-actions justify-end">
              <button class="btn btn-sm btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                </svg>
              </button>
              <button class="btn btn-sm btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                </svg>                
              </button>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection