
var user = $('#username-plate').html();
var socket = io("http://localhost:8080/", { query: "user=" + user });

socket.on('feed', function(data){
  console.log('client feed');
//	console.log(data.streamItem);
  $(data.streamItem).hide().prependTo('#feeder').slideDown("slow");
});

socket.on('noti', function(data) {
	var noti_count = $('#mainmenu-noti-count').html();

	if(data.IncOrDec == '+')
		noti_count++;
	else
		noti_count--;
	$('#dbmenu-noti-label').html(noti_count);
	$('#mainmenu-noti-count').html(noti_count);
});

socket.on('confirmation', function(data) {
	console.log('confirmation noti sent to ' + user);
//	format(data);
	$('#noti-table').bootstrapTable('append', format(data, 1));
});

socket.on('approve', function(data) {
	console.log(data.from + ' approved a notification');
	$('#noti-table').bootstrapTable('append', format(data, 2));
});

socket.on('decline', function(data) {
	console.log(data.from + ' declined a notification');
	$('#noti-table').bootstrapTable('append', format(data, 3));
});

// miscellaneus functions
function format(data, mode) {
	var rows = [];
	var stringReq = "";

	// if confirmation noti
	if(mode == 1) {
		stringReq += '<a href="http://localhost/xiphias/index.php/pages/profile/' + data.from + '">' + data.from + '</a>';
		stringReq += " asked you to be the ";
		stringReq += " <i>";
		stringReq += data.role;
		stringReq += "</i> of ";
		stringReq += data.office;
		stringReq += ".";
		stringReq += '<div class="row-fluid"><div class="form-group">';
		stringReq += '<a href="#" class="btn btn-success btn-xs btn-noti-approve" data-notiId="';
		stringReq += data.officeid + "_" + data.userid + "_" + data.from;
		stringReq += '" data-ofcName="';
		stringReq += data.office + '">Approve</a> ';
		stringReq += '<a href="#" class="btn btn-danger btn-xs btn-noti-decline" data-notiId="';
		stringReq += data.officeid + "_" + data.userid + "_" + data.from;
		stringReq += ' data-ofcName="';
		stringReq += data.office + '">Decline</a>';
		stringReq += '</div></div>';
		rows.push({
			request: stringReq,
			date: 'today'
		});
	}

	// if approve
	else if(mode == 2) {
		stringReq += '<a href="http://localhost/xiphias/index.php/pages/profile/' + data.from + '">' + data.from + '</a>';
		stringReq += ' agreed to be <i>';
		stringReq += data.role;
		stringReq += '</i> of ';
		stringReq += data.office;
		stringReq += '.';
		stringReq += '<div class="row-fluid"><div class="form-group"><a href="#" class="btn btn-success btn-xs btn-noti-ok" data-notiId="';
		stringReq += data.officeid + "_" + data.userid + "_" + data.from;
		stringReq += '>OK</a></div></div>';
		rows.push({
			request: stringReq,
			data: 'today'
		});
	}

	// if decline
	else if(mode == 3) {
		stringReq += '<a href="http://localhost/xiphias/index.php/pages/profile/' + data.from + '">' + data.from + '</a>';
		stringReq += ' declined to be <i>';
		stringReq += data.role;
		stringReq += '</i> of ';
		stringReq += data.office;
		stringReq += '.';
		stringReq += '<div class="row-fluid"><div class="form-group"><a href="#" class="btn btn-success btn-xs btn-noti-ok" data-notiId="';
		stringReq += data.officeid + "_" + data.userid + "_" + data.from;
		stringReq += '>OK</a></div></div>';
		rows.push({
			request: stringReq,
			data: 'today'
		});
	}

	return rows;

}
