
import store from '@/services/store';
import qs from 'qs';

window.moment = require('moment');
window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['Content-Type'] = 'application/json';
window.axios.defaults.headers.common['Accept'] = 'application/json';
window.axios.defaults.baseURL = '/api';
window.axios.defaults.withCredentials = true;

// Disable query parameter encoding, otherwise axios ends up encoding
// array parameters twice
window.axios.defaults.paramsSerializer = params => {
    return qs.stringify(params, {arrayFormat: 'brackets', encode: false});
};

window.axios.defaults.transformRequest.unshift((data, headers) => {
    if (data && data.data) {
        for (let key in data.data) {
            // skip loop if the property is from prototype
            if (!data.data.hasOwnProperty(key)) continue;

            if (data.data[key] instanceof Date) {
                data.data[key] = moment(data.data[key]).format();
            }
        }
    }
    return data;
});


/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

if (store.getters.getAccessToken) {
    window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.getters.getAccessToken;
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
