
//create some global helpers
window._ = require('lodash');
window.URI = require('urijs');
window.moment = require('moment');
window.Promise = require('promise');
window.Cookies = require('js-cookie');

/*
 * Define Moment locales
 */
window.moment.defineLocale('en-short', {
    parentLocale: 'en',
    relativeTime : {
        future: "in %s",
        past:   "%s",
        s:  "1s",
        m:  "1m",
        mm: "%dm",
        h:  "1h",
        hh: "%dh",
        d:  "1d",
        dd: "%dd",
        M:  "1 month ago",
        MM: "%d months ago",
        y:  "1y",
        yy: "%dy"
    }
});
window.moment.locale('en');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
require('vue-resource');

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    if (Cookies.get('XSRF-TOKEN') !== undefined) {
    request.headers.set('X-XSRF-TOKEN', Cookies.get('XSRF-TOKEN'));
}

request.headers.set('X-CSRF-TOKEN', Limitless.csrfToken);

    /**
     * Intercept the incoming responses.
     *
     * Handle any unexpected HTTP errors and pop up modals, etc.
     */
    next(response => {
        switch (response.status) {
            case 401:
                console.log("Interceptor caught 401")
                //Vue.http.get('/logout');
                //$('#modal-session-expired').modal('show');
                break;

            case 402:
                console.log("Interceptor caught 402")
                //window.location = '/settings#/subscription';
                break;
            }

    });
});

/**
 * Define the Vue filters.
 */
require('./filters');

/**
 * Load the pdp form utilities.
 */
require('./forms/bootstrap');

/**
 * Grab our custom components
 */
require('./components/bootstrap');

/**
 * Grab the admin vue components
 */
require('./admin/bootstrap');

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
