import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

Echo.private('App.Models.Admin.' + userId)
    .notification((notification) => {
        toastr.success(notification.msg);
    });
