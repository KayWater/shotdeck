import Vue from 'vue';
import moment from 'moment';
moment.locale('zh-cn');

Vue.filter('momentFromNow', function(date) {
    return moment(date).fromNow();
});

Vue.filter('momentFormat', function(date, string) {
    return moment(date).format(string);
});

Vue.filter('durationFormat', function(date) {
    let duration = moment.duration(date, 'seconds');
    let hours = duration.hours();
    hours = '0' + hours;
    hours = hours.substring(hours.length - 2);
    let minutes = duration.minutes();
    minutes = '0' + minutes;
    minutes = minutes.substring(minutes.length-2);
    let seconds = duration.seconds();
    seconds = '0' + seconds;
    seconds = seconds.substring(seconds.length -2);

    return hours + ":" + minutes + ":" + seconds;
});