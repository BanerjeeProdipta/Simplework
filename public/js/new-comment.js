var commentNotificationsWrapper   = $('.dropdown-comment');
var commentNotificationsToggle    = commentNotificationsWrapper.find('a[data-toggle]');
var commentNotificationsCountElem = commentNotificationsToggle.find('i[data-count]');
var commentNotificationsCount     = parseInt(commentNotificationsCountElem.data('count'));
var commentNotifications          = commentNotificationsWrapper.find('ul.dropdown-menu');

if (commentNotificationsCount <= 0) {
//   commentNotificationsWrapper.hide();
}

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('5f53220af298e18653c8', {
  cluster: 'ap2' ,
  encrypted: true
});

// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe('private-App.User.' .userId);

// Bind a function to a Event (the full Laravel class)
channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
  var commentExistingNotifications = commentNotifications.html();
  var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
  var commentNewNotificationHtml = `
    <li class="notification active px-3">
        <div class="media">
          <div class="media-body">
            <strong class="notification-title">`+data.message+`</strong>
            <!--p class="notification-desc">Extra description can go here</p-->
            <div class="notification-meta">
              <small class="timestamp">about a minute ago</small>
            </div>
          </div>
        </div>
    </li>
  `;
  notifications.html(commentNewNotificationHtml + commentExistingNotifications);
  commentNotificationsCount += 1;
  commentNotificationsCountElem.attr('data-count', commentNotificationsCount);
  commentNotificationsWrapper.find('.notif-count').text(commentNotificationsCount);
  commentNotificationsWrapper.show();
});
window.Echo.private('App.User.'.userId)
    .notification((notification) => {
        console.log(notification.type);
    });