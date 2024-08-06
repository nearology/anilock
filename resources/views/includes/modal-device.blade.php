@php
    if(!$device->hasAlive()){
        $device->status = false;
    }else{
        $device->status = true;
    }
@endphp
<div id="device-panel-{{ $device->id }}" class="modal fade device">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">دستگاه {{ $device->name }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">بستن</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="row align-self-center mb-2">
                    <div class="col-12">
                        <img src="/assets/img/lc.png" style="width:4rem;height:4rem">
                    </div>
                </div>
                <div class="category device-imei">{{ $device->imei }}</div>
                @if($device->ssid != 0)
                    <div class="category device-rssi">RSSI: {{ $device->rssi }}</div>
                    <div class="row text-left">
                        <div class="col-12 mb-3">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="act-title" data-field="status">
                                        <i class="la la-hourglass-2"></i>وضعیت
                                    </div>
                                </div>
                                <div class="media-right col-6 d-flex justify-content-center">
                                    {{-- <label class="mb-0 {{ $device->status ? "text-success" : "text-danger" }}">
                                        {{ $device->status ? "فعال" : "غیرفعال" }}
                                    </label> --}}
                                    <span class="badge-text badge-text-small {{ $device->status ? 'success' : 'danger' }} device-key-status">
                                        {{ $device->status ? 'فعال' : 'غیرفعال' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="act-title device-key-title" data-field="ssid">
                                        <i class="la la-hourglass-2"></i>SSID
                                    </div>
                                </div>
                                <div class="device-submit">
                                    <i class="la la-pencil-square mr-2"></i>
                                </div>
                                <div class="media-right col-6 p-0" style="direction: ltr">
                                    <input type="text" class="form-control device-key" data-field="ssid" value="{{ $device->ssid }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="act-title device-key-title" data-field="password">
                                        <i class="la la-hourglass-2"></i>PASSWORD
                                    </div>
                                </div>
                                <div class="device-submit">
                                    <i class="la la-pencil-square mr-2"></i>
                                </div>
                                <div class="media-right col-6 p-0" style="direction: ltr">
                                    <input type="text" class="form-control device-key" data-field="password" value="{{ $device->password }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="widget widget-12 has-shadow mb-0">
                                <div class="widget-body">
                                    <div class="row">
                                        <div class="col-3 align-self-center pl-5">
                                            @if($device->bat_status < 20)
                                                <i class="la la-battery-0 text-danger"></i>
                                            @elseif($device->bat_status < 40)
                                                <i class="la la-battery-1 text-warning"></i>
                                            @elseif($device->bat_status < 60)
                                                <i class="la la-battery-2 text-info"></i>
                                            @elseif($device->bat_status < 80)
                                                <i class="la la-battery-3 text-success"></i>
                                            @else
                                                <i class="la la-battery-4 text-success"></i>
                                            @endif
                                        </div>
                                        <div class="col-5 align-self-center">
                                            <div class="title">باطری</div>
                                            <div class="number"></div>
                                        </div>
                                        <div class="col-4 align-self-center text-right pr-5">
                                            <div class="title device-key-bat">
                                                {{ $device->bat_status }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="widget widget-12 has-shadow mb-2">
                                <div class="widget-body">
                                    <div class="row">
                                        <div class="col-3 align-self-center text-center">
                                            @if($device->temperature <= 15)
                                                <img src="/assets/img/cool.png" style="width:4rem;height:4rem">
                                            @elseif($device->temperature <= 35)
                                                <img src="/assets/img/warm.png" style="width:4rem;height:4rem">
                                            @else
                                                <img src="/assets/img/heat.png" style="width:4rem;height:4rem">
                                            @endif
                                        </div>
                                        <div class="col-2 align-self-center">
                                            <div class="title">دما</div>
                                            <div class="number"></div>
                                        </div>
                                        <div class="col-1 align-self-center text-right">
                                            <div class="title device-key-temperature pl-1">
                                                {{ $device->temperature }}°C
                                            </div>
                                        </div>
                                        <div class="col-3 align-self-center text-center">
                                            <i class="icon-big ion-flash text-warning"></i>
                                        </div>
                                        <div class="col-3 align-self-center">
                                            <div class="title device-key-ups">
                                                {{ $device->ups_status ? "برق شهری" : "برق باطری" }}
                                            </div>
                                            <div class="number"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2 hidable-locks {{ $device->lock_status1 === null && $device->lock_status2 === null ? "d-none" : '' }}">
                            <div class="widget widget-12 has-shadow mb-2">
                                <div class="widget-body">
                                    <div class="row">
                                        <div class="col align-self-center text-center hidable-lock1 {{ $device->lock_status1 === null ? "d-none" : '' }}">
                                            <div class="remove-lock1" style="cursor:pointer">
                                                <i class="la la-close text-danger" style="font-size:1.5rem;position:absolute;top:-0.5rem;right:0"></i>
                                            </div>
                                            <img src="/assets/img/lockclose.jpg" style="width:4rem;height:4rem" class="img-lock1-enable {{ $device->lock_status1 ? '' : 'd-none' }}">
                                            <img src="/assets/img/lockopen.jpg" style="width:4rem;height:4rem" class="img-lock1-disable {{ $device->lock_status1 ? 'd-none' : '' }}">
                                        </div>
                                        <div class="col align-self-center hidable-lock1 {{ $device->lock_status1 === null ? "d-none" : '' }}">
                                            <div class="title device-key-lock1">قفل 1: {{ $device->lock_status1 ? "بسته" : "باز" }}</div>
                                            <div class="number"></div>
                                        </div>
                                        <div class="col align-self-center text-center hidable-lock2 {{ $device->lock_status2 === null ? "d-none" : '' }}">
                                            <div class="remove-lock2" style="cursor:pointer">
                                                <i class="la la-close text-danger" style="font-size:1.5rem;position:absolute;top:-0.5rem;right:0"></i>
                                            </div>
                                            <img src="/assets/img/lockclose.jpg" style="width:4rem;height:4rem" class="img-lock2-enable {{ $device->lock_status2 ? '' : 'd-none' }}">
                                            <img src="/assets/img/lockopen.jpg" style="width:4rem;height:4rem" class="img-lock2-disable {{ $device->lock_status2 ? 'd-none' : '' }}">
                                        </div>
                                        <div class="col align-self-center hidable-lock2 {{ $device->lock_status2 === null ? "d-none" : '' }}">
                                            <div class="title device-key-lock2">قفل 2: {{ $device->lock_status2 ? "بسته" : "باز" }}</div>
                                            <div class="number"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="act-title device-key-title" data-field="alarm_status">
                                        <i class="la la-hourglass-2"></i>
                                        وضعیت هشدار
                                    </div>
                                </div>
                                <div class="media-right">
                                    <label class="pt-2 mb-0">
                                        <input class="toggle-checkbox-sm device-key" data-field="alarm_status" type="checkbox" {{ $device->alarm_status ? "checked" : '' }}>
                                        <span>
                                            <span></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="act-title device-key-title" data-field="door_status">
                                        <i class="la la-hourglass-2"></i>
                                        وضعیت درب
                                    </div>
                                </div>
                                <div class="media-right">
                                    <label class="pt-2 mb-0">
                                        <input class="toggle-checkbox-sm device-key" data-field="door_status" type="checkbox" {{ $device->door_status ? "checked" : '' }}>
                                        <span>
                                            <span></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <div class="act-title device-key-title" data-field="relay_module">
                                        <i class="la la-hourglass-2"></i>وضعیت ماژول رله
                                    </div>
                                </div>
                                <div class="media-right">
                                    <label class="pt-2 mb-0">
                                        <input class="toggle-checkbox-sm device-key" data-field="relay_module" type="checkbox" {{ $device->relay_module ? "checked" : '' }}>
                                        <span>
                                            <span></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 relay-module-terminals" style="display:{{ $device->relay_module ? "block" : "none" }}">
                            <div class="row">
                                @for($n = 1; $n <= 8; ++$n)
                                    <div class="col-6 mb-2">
                                        <div class="media align-items-center">
                                            <div class="device-submit">
                                                <i class="la la-pencil-square mr-2"></i>
                                            </div>
                                            <div class="media-body pr-2" style="direction: ltr">
                                                <input type="text" class="form-control device-key device-key-title" data-field="terminal{{ $n }}_title" value="{{ $device->{"terminal{$n}_title"} }}">
                                            </div>
                                            <div class="media-right">
                                                <label class="pt-2 mb-0">
                                                    <div class="device-key-title"></div>
                                                    <input class="toggle-checkbox-sm device-key" data-field="relay_module_terminal{{ $n }}" type="checkbox" {{ $device->relay_module_terminal & (1 << ($n - 1)) ? "checked" : '' }}>
                                                    <span>
                                                        <span></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                @else
                    <h4 class="mt-4">در انتظار اتصال به دستگاه...</h4>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-shadow" data-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>
