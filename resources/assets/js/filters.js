/**
 * Format the given date.
 */
Vue.filter('date', value => {
    return moment.utc(value).local().format('dddd Do MMMM YYYY')
});

Vue.filter('datenoyear', value => {
    return moment.utc(value).local().format('ddd Do MMMM')
});

/**
 * Format the date to time only
 */
Vue.filter('time', value => {
    return moment.utc(value).local().format('h:mm')
});

/**
 * Format the given date as a timestamp.
 */
Vue.filter('datetime', value => {
    return moment.utc(value).local().format('MMMM Do, YYYY h:mm A');
});


/**
 * Format the given date into a relative time.
 */
Vue.filter('relative', value => {
    return moment.utc(value).local().locale('en-short').fromNow();
});


/**
 * Format the given month number into a month name.
 */
Vue.filter('numberToMonthName', value => {
    return moment().month(value-1).format('MMMM');
});


/**
 * Format the given date into a Slack time e.g. Today, Yesterday, February 1st etc
 */
Vue.filter('slack', value => {
    var day = moment.utc(value).local();

    if (day.isSame(moment().startOf('day'), 'd')) {
        return 'Today';
    } else if (day.isSame(moment().subtract(1, 'days').startOf('day'), 'd')) {
        return 'Yesterday';
    }

    return day.format('MMMM Do');
});


/**
 * Convert the first character to upper case.
 *
 * Source: https://github.com/vuejs/vue/blob/1.0/src/filters/index.js#L37
 */
Vue.filter('capitalize', value => {
    if (! value && value !== 0) {
        return '';
    }

    return value.toString().charAt(0).toUpperCase()
        + value.slice(1);
});


/**
 * Format the given money value.
 *
 * Source: https://github.com/vuejs/vue/blob/1.0/src/filters/index.js#L70
 */
Vue.filter('currency', value => {
    value = parseFloat(value);

    if (! isFinite(value) || (! value && value !== 0)){
        return '';
    }

    var stringified = Math.abs(value).toFixed(2);

    var _int = stringified.slice(0, -1 - 2);

    var i = _int.length % 3;

    var head = i > 0
        ? (_int.slice(0, i) + (_int.length > 3 ? ',' : ''))
        : '';

    var _float = stringified.slice(-1 - 2);

    var sign = value < 0 ? '-' : '';

    return sign + '£' + head +
        _int.slice(i).replace(/(\d{3})(?=\d)/g, '$1,') +
        _float;
});