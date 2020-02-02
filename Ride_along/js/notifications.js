var prevNotifications = [];

function getNotifications() {
	let userID = $('#user_id_div').text();
	let notificationArr = [];

	$.ajax({
		method: 'POST',
		url: 'core/get_notifications.php',
		data: { user_id: userID }
	}).done(function(data) {
		notificationArr = JSON.parse(data);

		if (notificationArr.length > prevNotifications.length) {
			/* Let the user know they have new notifications */
			$('.notification_count').text('(' + notificationArr.length + ')');
		}

		prevNotifications = notificationArr;
	});
}

$(function() {
	getNotifications();

	setInterval(getNotifications, 60000);
});