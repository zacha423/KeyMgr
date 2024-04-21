{{-- Create a basic list using bootstrap classes. --}}
<div>
  <ul class="list-group">
    @foreach ($elements as $item)
      <li class="list-group-item">{{ $item }}</li>
    @endforeach
  </ul>
</div>