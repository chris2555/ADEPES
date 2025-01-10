@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://dircom.unah.edu.hn/themes/portalunah-new/assets/images/logo-unah.png" class="logo" alt="Logo unah Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
