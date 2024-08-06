@php
    $device->hasAlive();
@endphp
<tr>
    <td>
        <span class="text-primary">{{ $idx + 1 }}</span>
    </td>
    <td>{{ $device->name }}</td>
    @if(isset($show_user) && $show_user)
        <td>{{ $device->user->username }}</td>
    @endif
    <td>{{ $device->ssid == 0 ? "-" : ($device->door_status ? "باز" : "بسته") }}</td>
    <td>{{ $device->ssid == 0 ? "-" : ($device->alarm_status ? "فعال" : "غیرفعال") }}</td>
    <td>
        <span style="width:150px;">
            <span class="badge-text badge-text-small {{ $device->ssid == 0 ? 'info' : ($device->status ? 'success' : 'danger') }}" id="device_status_{{ $device->id }}">
                {{ $device->ssid == 0 ? 'در انتظار دستگاه' : ($device->status ? 'فعال' : 'غیرفعال') }}
            </span>
        </span>
    </td>
    <td class="td-actions">
        <a data-toggle="modal" data-target="#device-panel-{{ $device->id }}">
            <i class="la la-edit edit"></i>
        </a>
        <a href="{{ route("device.users", ["imei" => $device->imei]) }}">
            <i class="la la-user edit text-warning"></i>
        </a>
        <a href="{{ route("device.remove", ["imei" => $device->imei]) }}">
            <i class="la la-close delete"></i>
        </a>
    </td>
</tr>
