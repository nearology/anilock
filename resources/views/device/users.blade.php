@extends("layouts.master")

@section("title", "device users")

@section("container")
    @include("includes.preloader")
    <div class="page">
        @include("includes.header")
        <div class="page-content d-flex align-items-stretch">
            @include("includes.sidebar")
            <div class="content-inner">
                <div class="container-fluid">
                    <div class="row">
                        @include("includes.path-header", [
                            "title" => "مدیریت کاربرها {$device->name}",
                        ])
                    </div>
                    <div class="row" style="overflow-y:auto">
                        <div class="widget has-shadow">
                            <div class="widget-header bordered no-actions d-flex align-items-center">
                                <h2>دستگاه شما دارای {{ $device->accounts()->count() }} کاربر است.</h2>
                                <a href="/device/{{ $device->imei }}/user/new">
                                    <button type="button" class="btn btn-secondary btn-square mr-1 mb-2">افزودن</button>
                                </a>
                            </div>
                            <div class="widget-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام کاربری</th>
                                                <th>رمز عبور</th>
                                                <th>شروع از</th>
                                                <th>پایان در</th>
                                                <th>وضعیت</th>
                                                <th class="tabledit-toolbar-column">حذف</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($device->accounts as $idx => $account)
                                                <tr>
                                                    <td>
                                                        <span class="tabledit-span tabledit-identifier">{{ $idx + 1 }}</span>
                                                    </td>
                                                    <td class="tabledit-view-mode">
                                                        <span class="tabledit-span">{{ $account->username }}</span>
                                                    </td>
                                                    <td class="tabledit-view-mode">
                                                        <span class="tabledit-span">{{ $account->password }}</span>
                                                    </td>
                                                    <td class="tabledit-view-mode">
                                                        <span class="tabledit-span">{{ $account->start_at ? jdate($account->start_at)->format('Y/m/d H:i:s') : '-' }}</span>
                                                    </td>
                                                    <td class="tabledit-view-mode">
                                                        <span class="tabledit-span">{{ $account->end_at ? jdate($account->end_at)->format('Y/m/d H:i:s') : '-' }}</span>
                                                        <input class="tabledit-input form-control input-sm" type="text" name="country" value="ایران" style="display: none;" disabled="">
                                                    </td>
                                                    <td class="tabledit-view-mode">
                                                        <span class="tabledit-span">{{ match(intval($account->action)){
                                                            App\Models\Account::REPORTED => "ثبت شده",
                                                            App\Models\Account::REPORT_NEW => "افزوده شده",
                                                            App\Models\Account::REPORT_REMOVED => "حذف شده",
                                                        } }}</span>
                                                    </td>
                                                    <td class="toolbar" style="white-space: nowrap; width: 1%;">
                                                        <div class="tabledit-toolbar btn-toolbar" style="flex-wrap: nowrap;">
                                                            <div class="btn-group btn-group-sm">
                                                                @if($account->action != App\Models\Account::REPORT_REMOVED)
                                                                    <button type="button" class="tabledit-edit-button btn btn-sm btn-danger td-actions">
                                                                        <a href="/device/{{ $device->imei }}/user/{{ $account->id }}/remove">
                                                                            <i class="la la-remove p-1 mr-0 text-white"></i>
                                                                        </a>
                                                                    </button>
                                                                @else
                                                                    <span>-</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include("includes.footer")
                @include("includes.profile-editor")
            </div>
        </div>
    </div>
@endsection

@section("snippets")
    <script src="/assets/vendors/js/nicescroll/nicescroll.min.js"></script>
    <script src="/assets/js/pages/devices.js?8"></script>
@endsection
