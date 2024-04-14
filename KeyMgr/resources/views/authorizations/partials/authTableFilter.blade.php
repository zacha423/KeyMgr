<div>
  <form>
    {{-- People and Date Filters --}}
    <div class="row">  
      <div class="col">
        <x-user-selector id="holderSel" name="holderSel" label="Key Holder" :options="$holders" :selected="[]" multiple="a"/>
      </div>
      <div class="col">
        <x-user-selector id="requestorSel" name="requestorSel[]" label="Key Requestor" :options="$requestors" :selected="[]" multiple="a"/>
      </div>
      {{-- the date-range component has lots of $config, that can be configured dynamically based on available data. 
          See https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Advanced-Forms-Components#daterange  
        --}}  
        <div class="col">
          <x-adminlte-date-range label-class="text-info" name="range" placeholder="Select a date range..." label="Date Range" :config="['timePicker' => true]">
            <x-slot name="prependSlot">
              <div class="input-group-text bg-gradient-lightblue">
                <i class="far fa-g fa-calendar-alt"></i>
              </div>
            </x-slot>
          </x-adminlte-date-range>
      </div>
    </div>
    <br>
    {{-- Location and Quantity Filters --}}
    <div class="row">
      <div class="col-8">
        <x-room-selector :options="$buildings"/>
      </div>
      <div class="col-4">
          <x-adminlte-input label-class="text-info" name="count" label="Minimum Number of Keys" type="number" min=1 enable-old-support><x-slot name="prependSlot"><div class="input-group-text bg-gradient-lightblue"><i class="fas fa-hashtag"></i></div></x-slot></x-adminlte-input>
      </div>
    </div>
    <div class="row">
      <x-adminlte-button type="submit" theme="primary" label="Refine Search"/>
    </div>
  </form>
</div>