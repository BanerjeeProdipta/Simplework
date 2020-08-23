authEndpoint: "../broadcasting/auth"

var commentNotificationsWrapper   = $('.dropdown-comment');
var commentNotificationsToggle    = commentNotificationsWrapper.find('a[data-toggle]');
var commentNotificationsCountElem = commentNotificationsToggle.find('i[comment-data-count]');
var commentNotificationsCount     = parseInt(commentNotificationsCountElem.data('comment-count'));
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
var channel = pusher.subscribe('private-App.User.'+userId);

// Bind a function to a Event (the full Laravel class)
channel.bind('Illuminate\\Notifications\\Events\\BroadcastNotificationCreated', function(data) {
  var commentExistingNotifications = commentNotifications.html();
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
  commentnotifications.html(commentNewNotificationHtml + commentExistingNotifications);
  commentNotificationsCount += 1;
  commentNotificationsCountElem.attr('comment-data-count', commentNotificationsCount);
  commentNotificationsWrapper.find('.comment-count').text(commentNotificationsCount);
  commentNotificationsWrapper.show();
});
