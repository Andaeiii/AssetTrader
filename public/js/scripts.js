var b;

function setFileOption(obj){
	fl = $(obj).find(':selected').attr('data-file');

	  if(fl != "docs"){
		 opt = 'Images - jpeg, pngs';
		 v = 'imgs';
	  }else{
		 opt = 'Documents - word, pdf';
		 v = 'docs';
	  } 

	$('#file_lb').text('Associated ' + opt);
	$('#as_img').val(v);

}


function mapAssetsTo(id){

	$('#assldr_'+Number(id)).css('display', 'block');
	/**/var setting = {
		type:'GET',
		url:'/ajax/'+Number(id)+'/relatives',
	}

	$.ajax(setting)
		.done(function(msg){
			shwBootBox(msg, id);
		}).fail(function(xhr,status,error){
			alert('..server error, try again later');
		});

		//shwBootBox(id);

}


function shwBootBox(selobj, aid){
	var dialog = bootbox.dialog({
		title:'<i class="fa fa-envelope"></i>&nbsp; Map Asset to Relative </b>',
		size:'small',
		backdrop: true,
		message: '<div class="bobj" align="center" style="padding:10px">'+selobj+'</div>',
		buttons: {
		    cancel: {
		        label: "Cancel !",
		        className: 'btn-alert',
		        callback: function(){
		            bootbox.hideAll();
		        }
		    },

		    ok: {
		        label: "MapAsset",
		        className: 'btn-success',
		        callback: function(){
		        	vobj = {
		        		rid:Number($('#rltoptn').val()),
		        		aid:Number(aid),
		        		rmsg: String($('#optin').val())
		        	};
		        	
		        	registerMapping(vobj);

		        	$('.bootbox .modal-footer').find('button').attr('disabled', 'disabled');
		            $('.bootbox').find('.modal-footer').append('<span class="flobj"><img src="/ajax/ajax4.gif" align="absmiddle"/></span>');
		        	return false;
		        }
		    }
		}
	});
}


function viewMapInfo(id){
	var dialog = bootbox.dialog({
		title:'<i class="fa fa-envelope"></i>&nbsp;Asset Mapping Info </b>',
		size:'small',
		backdrop: true,
		message: '<div id="bobj" class="bobj" align="center" style="padding:3px; text-align:justify;"><img src="/ajax/ajax4.gif" align="absmiddle"/>&nbsp; - &nbsp;getting data, please wait</div>',
		buttons: {
		    ok: {
		        label: "Close, Thanks",
		        className: 'btn-success',
		    }
		}
	});

	var settings = {
		type:'GET',
		url :'/mapping/'+Number(id)+'/pull'
	};
	$.ajax(settings)
	.done(function(response){
		$('#bobj').html(response);
	}).fail(function(xhr, status,error){
		alert('error mapping relative..');
		bootbox.hideAll();
	});

}

function registerMapping(o){
	var settings = {
		type:'POST',
		url :'/ajax/setmapping',
		data:o,
	};
	$.ajax(settings)
	.done(function(response){
		alert(response);
		window.location.href="/assets/map"; //reload page...
		bootbox.hideAll();
	}).fail(function(xhr, status,error){
		alert('error mapping relative..');
		bootbox.hideAll();
	});
}


function fixOptRel(o){
	v = $(o).find(':selected').attr('data-relation');
	$('#optrel').val(v);
}