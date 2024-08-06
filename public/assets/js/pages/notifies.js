
setInterval(function() {
    $.get("/notifs").done((response) => {
        Array.from(response).forEach((notif, idx) => {
            setTimeout(() => {
                new Noty({
                    type: 'warning',
                    layout: 'bottomRight',
                    text: `کاربر ${notif.username} در دستگاه ${notif.device.name} مقدار ${notif.field_name} را به \"${notif.value}\" تغییر داد.`,
                    progressBar: true,
                    timeout: 3000,
                    animation: {
                        open: 'animated bounceInRight',
                        close: 'animated bounceOutRight',
                    },
                }).show();
            }, idx * 20 + 500);
        });
    });
}, 6000);
