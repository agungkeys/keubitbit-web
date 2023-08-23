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

      <div class="card card-side bg-base-100 shadow-xl">
        <div class="flex">
          <figure class="rounded-l-xl">
            <img src="https://placehold.co/200x300" alt="Movie"/>
          </figure>
          <div class="card-body">
            <h2 class="card-title">New movie is released!</h2>
            <p>Click the button to watch on Jetflix app.</p>
            <div class="card-actions justify-end">
              <button class="btn btn-primary">Watch</button>
            </div>
          </div>
        </div>
      </div>
    
      <div class="card card-side bg-base-100 shadow-xl">
        <div class="flex">
          <figure class="rounded-l-xl">
            <img src="https://placehold.co/200x300" alt="Movie"/>
          </figure>
          <div class="card-body">
            <h2 class="card-title">New movie is released!</h2>
            <p>Click the button to watch on Jetflix app.</p>
            <div class="card-actions justify-end">
              <button class="btn btn-primary">Watch</button>
            </div>
          </div>
        </div>
      </div>
    
      <div class="card card-side bg-base-100 shadow-xl">
        <div class="flex">
          <figure class="rounded-l-xl">
            <img src="https://placehold.co/200x300" alt="Movie"/>
          </figure>
          <div class="card-body">
            <h2 class="card-title">New movie is released!</h2>
            <p>Click the button to watch on Jetflix app.</p>
            <div class="card-actions justify-end">
              <button class="btn btn-primary">Watch</button>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection