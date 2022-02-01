

@extends('layouts.app')

@section('title')Index @endsection

@section('content')
@inject('Carbon', 'Carbon\Carbon')
<div class="text-center">
  <a href="{{ route('posts.create') }}" class="btn btn-success">Create Post</a>
</div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Posted By</th>
      <th scope="col">Created At</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($allPosts as $post)
    {{-- @dd($post->user, $post->user()) --}}
    <tr>
      <th scope="row">{{ $post->id }}</th>
      <td>{{ $post->title }}</td>
      <td>{{ isset($post->user) ? $post->user->name : 'Not Found' }}</td>
      
      <td>
      {{ $created_at = $Carbon::parse($post->created_at)->format('Y-m-d')}}
      </td>

      <td class="d-flex ">
        <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">View</a>
        <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info">Edit</a>
        
        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
              <input type="hidden" name="_method" value="DELETE">
              @csrf
            <button type="submit" id="btnDelete" class="btn btn-danger "
            >Delete</button>
        </form>

      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<ul class="pagination">
{{ $allPosts->render() }} 
</ul>
@endsection

@section('script')
<script >
       document.onsubmit=function(){
           return confirm('Are you Sure you want to delete?');
       }
</script>
@endsection