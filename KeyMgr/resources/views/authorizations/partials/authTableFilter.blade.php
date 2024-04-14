<div>
  
<form>
  {{-- People Filters --}}
  <div class="card-info card-outline">
  <div class="row">  
    <div class="col"><x-user-selector id="holderSel" name="holderSel" label="Key Holder" :options="[]" :selected="[]" multiple=""></x-user-selector></div>

    <div class="col"><x-user-selector id="requestorSel" name="requestorSel[]" label="Key Requestor" :options="[]" :selected="[]" multiple="a"></x-user-selector></div>
</div>
</div>
  {{-- Date and Quantity Filters --}}
  <div class="card-info card-outline">
  <div class="row">
    <div class="col"><x-room-selector></x-room-selector></div>
  </div>
</div>
  {{-- Location Filters --}}
  <div class="card-info card-outline"><div class="row"><x-adminlte-card theme="info" theme-mode="outline" collapsible></x-adminlte-card></div></div>
</form>
</div>