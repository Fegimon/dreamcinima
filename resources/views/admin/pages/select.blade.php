<option value="0">Select Name </option>
@if(!empty($category))
  @foreach($category as $value)
    <option value="{{ $value->firstname }}">{{ $value->firstname }}</option>
  @endforeach
@endif

