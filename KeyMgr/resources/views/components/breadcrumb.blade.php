@php
  /**
   * @author Zachary Abela-Gale <abel1325@pacificu.edu>
   */

  $lastElement = array_key_last($crumbs);
@endphp

<nav aria-label="breadcrumb">
  <ol class="breadcrumb float-sm-right">
    @foreach ($crumbs as $key => $crumb)
      @if($key === $lastElement)
        <li class="breadcrumb-item active" aria-current="page">
          <a href="{{$crumb['link']}}">{{$crumb['text']}}</a>
        </li>
      @else
        <li class="breadcrumb-item">
          <a href="{{$crumb['link']}}">{{$crumb['text']}}</a>
        </li>
      @endif
    @endforeach
  </ol>
</nav>