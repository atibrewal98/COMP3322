   
$(document).ready(function () {
    showAll();
	
    $("#button_all").click(showAll);
	
    $("#fM").click(function () {
		$.get("queryEntries_WS3.php", {show: 'major', value: $("#major").val()}, function(data, status){
			if (status == 'success') {
				$("#entries").html(data);
				$("#major").val("");
				$("#button_all").show();
			}
		});
    });

    $("#fC").click(function () {
		$.get("queryEntries_WS3.php", {show: 'course', value: $("course").val()}, function(data, status){
			if (status == 'success') {
				$("#entries").html(data);
				$("#course").val("");
				$("#button_all").show();
			}
		});
    });
	
	$("#add").click(function () {
		if($('#newname').val() == ""){
			alert("Check your input Attendance record (PRESENT/ABSENT) and whether all fields are filled.");
			$('#newname').focus();
			return;
		} else if($('#newmajor').val() == ""){
			alert("Check your input Attendance record (PRESENT/ABSENT) and whether all fields are filled.");
			$('#newmajor').focus();
			return;
		} else if($('#newcourse').val() == ""){
			alert("Check your input Attendance record (PRESENT/ABSENT) and whether all fields are filled.");
			$('#newcourse').focus();
			return;
		} else if($('#newcoursedate').val() == ""){
			alert("Check your input Attendance record (PRESENT/ABSENT) and whether all fields are filled.");
			$('#newcoursedate').focus();
			return;
		} else if($('#newattendance').val() == "" || ($('#newattendance').val() != "PRESENT" && $('#newattendance').val() != "ABSENT")){
			alert("Check your input Attendance record (PRESENT/ABSENT) and whether all fields are filled.");
			$('#newattendance').focus();
			return;
		} 
		$.get("queryEntries_WS3.php", {show: 'add', value: $('#newname').val(), value2: $('#newmajor').val(), value3: $('#newcourse').val(), value4: $('#newcoursedate').val(), value5: $('#newattendance').val()}, function(data, status){
			if (status == 'success') {
				$("#entries").html(data);
				$("#newname").val("");
				$("#newmajor").val("");
				$("#newcourse").val("");
				$("#newcoursedate").val("");
				$("#newattendance").val("");
				showAll();
			}
		});
	});
	
	
    $("#orderByName").click(function () { //order by name
		
		$entrydivs=$("#entries").children();
		
		$entrydivs.sort(function(a,b){
			var an = $($(a).find('h3')[0]).text();
			var bn = $($(b).find('h3')[0]).text();

			if(an > bn) {
				return 1;
			}
			if(an < bn) {
				return -1;
			}
			return 0;
		});

		$entrydivs.detach().appendTo($("#entries"));
    });

	$("#orderByCourse").click(function () { //order by course
		
		$entrydivs=$("#entries").children();
		
		$entrydivs.sort(function(a,b){
			var an = $($(a).find('h5')[0]).text();
			var bn = $($(b).find('h5')[0]).text();

			if(an > bn) {
				return 1;
			}
			if(an < bn) {
				return -1;
			}
			return 0;
		});

		$entrydivs.detach().appendTo($("#entries"));
	});

});

function showAll() {
	$.get("queryEntries_WS3.php", {show: 'all'}, function(data, status){
		if (status == 'success') {
			$("#entries").html(data);
			$("#button_all").hide();
		}
	});
}

function changeState(elem) {
    var itemID = $(elem).parent().attr("id");
    

    if ($(elem).html() === 'PRESENT') {
        newvalue = 'ABSENT';
    } else {
        newvalue = 'PRESENT';
    }
	
	$(elem).load("updateState_WS3.php", {id: itemID, newValue: newvalue});
}

