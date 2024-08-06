<div class="col-xl-4 col-md-6 col-sm-12 col-remove">
    <div class="widget-18 widget-image has-shadow device" id="device-{{ $device->id }}">
        <div class="group-card">
            <div class="widget-body">
                <h4 class="name" data-field="name">
                    {{ $device->name }}
                </h4>
                <div class="category device-imei">{{ $device->imei }}</div>
                @if($device->ssid != 0)
                    <div class="category device-rssi">{{ $device->rssi }}</div>
                    <div class="row">
                        <div class="col-xl-12">
                            <ul class="list-group w-100 mt-5">
                                <li class="list-group-item">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <div class="act-title">وضعیت</div>
                                        </div>
                                        <div class="media-right">
                                            <label class="pt-2 mb-0">
                                                <input class="toggle-checkbox-sm device-key" data-field="status" type="checkbox" {{ $device->status ? "checked" : '' }}>
                                                <span>
                                                    <span></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <div class="act-title">ssid</div>
                                        </div>
                                        <div class="device-submit">
                                            <i class="la la-pencil-square mr-2"></i>
                                        </div>
                                        <div class="media-right col-6 p-0" style="direction: ltr">
                                            <input type="number" class="form-control device-key" data-field="ssid" value="{{ $device->ssid }}">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <div class="act-title">رمز</div>
                                        </div>
                                        <div class="device-submit">
                                            <i class="la la-pencil-square mr-2"></i>
                                        </div>
                                        <div class="media-right col-6 p-0" style="direction: ltr">
                                            <input type="text" class="form-control device-key" data-field="password" value="{{ $device->password }}">
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <div class="act-title">باطری</div>
                                        </div>
                                        <div class="media-right">
                                            <span>
                                                <span data-field="bat_status">{{ $device->bat_status }}</span>%
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <div class="act-title">برق اضطراری</div>
                                        </div>
                                        <div class="media-right">
                                            <label class="pt-2 mb-0">
                                                <input class="toggle-checkbox-sm device-key" data-field="ups_status" type="checkbox" {{ $device->ups_status ? "checked" : '' }}>
                                                <span>
                                                    <span></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="media align-items-center">
                                        <div class="media-body">
                                            <div class="act-title">وضعیت درب</div>
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
                                </li>
                                <li>
                                    <a href="#dropdown-keys" aria-expanded="false" data-toggle="collapse" class="collapsed text-center w-100">
                                        <i class="la la-key"></i>
                                        <span>کلید ها</span>
                                    </a>
                                    <ul id="dropdown-keys" class="collapse list-unstyled pt-0">
                                        <li class="list-group-item">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <div class="act-title">قفل 1</div>
                                                </div>
                                                <div class="media-right">
                                                    <label class="pt-2 mb-0">
                                                        <input class="toggle-checkbox-sm device-key" data-field="lock_status1" type="checkbox" {{ $device->lock_status1 ? "checked" : '' }}>
                                                        <span>
                                                            <span></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <div class="act-title">قفل 2</div>
                                                </div>
                                                <div class="media-right">
                                                    <label class="pt-2 mb-0">
                                                        <input class="toggle-checkbox-sm device-key" data-field="lock_status2" type="checkbox" {{ $device->lock_status2 ? "checked" : '' }}>
                                                        <span>
                                                            <span></span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <div class="act-title">وضعیت هشدار</div>
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
                                        </li>
                                        <li class="list-group-item">
                                            <div class="media align-items-center">
                                                <div class="media-body">
                                                    <div class="act-title">وضعیت ماژول رله</div>
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
                                        </li>
                                        @for($n = 1; $n <= 8; ++$n)
                                            <li class="list-group-item">
                                                <div class="media align-items-center">
                                                    <div class="media-body">
                                                        <div class="act-title">ماژول {{ $n }}</div>
                                                    </div>
                                                    <div class="media-right">
                                                        <label class="pt-2 mb-0">
                                                            <input class="toggle-checkbox-sm device-key" data-field="relay_module_terminal{{ $n }}" type="checkbox" {{ $device->relay_module_terminal & (1 << ($n - 1)) ? "checked" : '' }}>
                                                            <span>
                                                                <span></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        @endfor
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="text-center mt-5 pb-3">
                        <a href="/device/{{ $device->imei }}/users">
                            <button type="button" class="btn btn-outline-primary mr-1 mb-2">کاربران</button>
                        </a>
                    </div> --}}
                @else
                    <h4 class="mt-4">در انتظار اتصال به دستگاه...</h4>
                @endif
            </div>
        </div>
    </div>
</div>
