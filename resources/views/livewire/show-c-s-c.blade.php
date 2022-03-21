<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <select class="form-control" wire:model="country_id">
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" wire:model="state_id">
                @foreach($states as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-control" wire:model="city_id">
                @foreach($cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    
    
</div>
