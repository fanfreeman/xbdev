/*
 * This file is part of the Geek-Zoo Projects.
 *
 * @copyright (c) 2010 Geek-Zoo Projects More info http://www.geek-zoo.com
 * @license http://opensource.org/licenses/gpl-2.0.php The GNU General Public License
 * @author xuanyan <xuanyan@geek-zoo.com>
 *
 */

(function(){

if (typeof window.realTime != "undefined") {
  return;
}

var realTime = {
  _lang : {},
  lang : 'auto',
  fixTime : null
};

realTime._lang['en'] = {
  month : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Aguest', 'September', 'October', 'November','December'],
  week : ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
  secend : '%1 second ago',
  secends : '%1 seconds ago',
  minute : '%1 minute ago',
  minutes : '%1 minutes ago',
  hour : '%1 hour ago',
  hours : '%1 hours ago',
  yesterday : 'yesterday at %1',
  lastweek : '%1 at %2',
  longago : '%1 %2, %3 at %4'
};

realTime._lang['zh-cn'] = {
  month : ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
  week : ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
  secend : '%1 秒前',
  secends : '%1 秒前',
  minute : '%1 分钟前',
  minutes : '%1 分钟前',
  hour : '%1 小时前',
  hours : '%1 小时前',
  yesterday : '昨日%1',
  lastweek : '%1%2',
  longago : '%1%2日, %3 %4'
};

realTime.outPut = function(time) {

  function sprintf() {
    var args = arguments;
    if (args.length == 1) {
      return args[0];
    }
    var pattern = new RegExp("%([1-"+args.length+"])", "g");
    return args[0].replace(pattern, function(match, index) {
      return args[index];
    });
  }

  if (this.lang == 'auto') {
    this.lang = navigator.browserLanguage || navigator.language;
    this.lang = this.lang.toLowerCase();
  }

  var lang = this._lang[this.lang] || this._lang['en'];

  var m = lang.month,
      w = lang.week,
      d = new Date();

  time = parseInt(time);

  var delta = (this.fixTime || parseInt(d.getTime() / 1000)) - time;
  // if the time is below 0 then set 0
  delta = delta > 0 ? delta : 0;
  
  if (delta < 3600 * 24) {
    if (delta < 60) {// less then 1 minute
      if (delta > 1) {
        delta = sprintf(lang.secends, delta);
      } else {
        delta = sprintf(lang.secend, delta);
      }
    } else if (delta < 3600) {// less then 1 hour
      delta = parseInt(delta / 60);
      if (delta > 1) {
        delta = sprintf(lang.minutes, delta);
      } else {
        delta = sprintf(lang.minute, delta);
      }
    } else {// less then 1 day
      delta = parseInt(delta / 3600);
      if (delta > 1) {
        delta = sprintf(lang.hours, delta);
      } else {
        delta = sprintf(lang.hour, delta);
      }
    }
  } else {
    d.setTime(time * 1000);
    var t = [parseInt(d.getHours()), parseInt(d.getMinutes())];
    var alpha = t[0] > 12 ? (t[0] - 12)+':'+t[1]+' pm' : t[0]+':'+t[1]+' am';
    if (delta < 3600 * 48) {// less then 2 days
      delta = sprintf(lang.yesterday, alpha);
    } else if (delta < 3600 * 24 * 7) {// less then 1 week
      delta = sprintf(lang.lastweek, w[d.getDay()], alpha);
    } else {// more then 1 week
      delta = sprintf(lang.longago, m[d.getMonth()], d.getDate(), d.getFullYear(), alpha);
    }
  }

  return delta;
};

window.realTime = realTime;

})();