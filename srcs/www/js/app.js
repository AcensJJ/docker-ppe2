(function($){

	$('.addPanier').click(function(event){
		event.preventDefault();
		$.get($(this).attr('href'),{},function(data){
			console.log(data);
			if(data.error){
				alert("data.message");
			}else{
				$('#total').empty().append(data.total);
				$('#count').empty().append(data.count);
				$('#total2').empty().append(data.total);
				alert("Le produit a bien été ajouté !");
				$("#panier").load("inc/panier.php");
			}
		},'json');
		return false;
	});

})(jQuery);
