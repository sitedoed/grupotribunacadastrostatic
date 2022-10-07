$(document).ready(function(){



	$("button[name='btn_pesquisa']").click(function(e){


var pesquisar_publico =  $("input[type='text'][name='pesquisar_publico']").val();

var pesquisar_publico =  jQuery(this).serialize();

//alert(pesquisar_publico);

		//e.preventDefault();
		$( ".home" ).animate({
		    height: "500"
		  	}, 500, function() {


		  		var token = $('meta[name="_token"]').attr('content');

			$.ajaxSetup({
			        headers: {
			           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			        }
			    });

			$.ajax({
			  method: "POST",
			  url: "/ramais/pesquisar",
			  // data: { 'pesquisar_publico': 'Barbara', 'csrftoken' : '{{ csrf_token() }}' }
			  data: { "_method": 'POST', "pesquisar_publico": pesquisar_publico, "_token" : token, }
			})
			  .done(function( data ) {
			  	//alert(data);
    			$( ".clients_slider_container" ).append( data );
			}); //fechamento Ajax






		 }); //fechamento home.animate




	});//fechamento btn_pesquisa.click






}); //fechamento Inicialhome