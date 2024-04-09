@section('title', 'test')
@section('content_header')
@stop
@section('content')
<?php dump($data) ?>
<div class="row">
  <button class="btn btn-primary" data-toggle="collapse" href="#lock">Locks Toggle</button>
  <button class="btn btn-primary" data-toggle="collapse" href="#build">Buildings Toggle</button>
  <button class="btn btn-primary" data-toggle="collapse" href="#keyway">Keyways Toggle</button>
  <button class="btn btn-primary" data-toggle="collapse" href="#models">Lock Models Toggle</button>
</div>
<div class="collapse" id="lock">
{{var_dump ($locks)}}
</div>
<div class="collapse" id="build">
{{var_dump ($buildings)}}
</div>
<div class="collapse" id="keyway">
{{var_dump ($keyways)}}
</div>
<div class="collapse" id="models">
{{var_dump ($models)}}
</div>
@stop
