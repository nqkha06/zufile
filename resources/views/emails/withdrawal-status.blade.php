@if (!empty($details['greeting']))
<p>{{ $details['greeting'] }}</p>
@endif
@if (!empty($details['body']))
{!! $details['body'] !!}
@endif
