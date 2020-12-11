

function processBVN(){

	alert('started..');

	bvdata = {
	  "BVN": "14254152145",
	  "Auth": {
	    "username": "MacTayTestUser",
	    "password": "m@kt78!..Q9s"
	  }
	};   

	setting = {
		type: 'POST',
		url:'https://webservicestest.zenithbank.com:8443/MacTay/MacTay/api/BankingActivity/BVNEnquiry',
		data: bvdata
	}

	$.ajax(setting)
	.done(function(msg){
		console.log(msg);
		alert(msg);
	}).fail(function(xhr,status,error){
		alert('..server error, try again later');
	});

		//shwBootBox(id);

}
