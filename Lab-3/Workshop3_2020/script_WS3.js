   
$(document).ready(function () {
    showAll();
	
    $("#button_all").click(showAll);
	
    $("#fM").click(function () {
				
    });

    $("#fC").click(function () {
		
    });
	
	$("#add").click(function () {
		
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
				
	});

});

function showAll() {
	$.get("demo_test.asp", function(data, status){
		alert("Data: " + data + "\nStatus: " + status);
	});
}

function changeState(elem) {
    var itemID = $(elem).parent().attr("id");
    

    if ($(elem).html() === 'PRESENT') {
        newvalue = 'ABSENT';
    } else {
        newvalue = 'PRESENT';
    }
	
}

