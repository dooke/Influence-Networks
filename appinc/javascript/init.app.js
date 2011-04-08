

var keepFooterOpen = false;
    
$(document).ready(function () {
    
    // centre les éléments avec la classe .center millieu de l'écran (ici l'app)
    $(".center").center();

    
    // Déclenche les infobulles personnalisées sur les éléments .share et leur ajoute la classe "shareTitle"
    // Seulement si le visiteur n'est pas sur Ipad'
    if(! RR_UTILS.isIpad()) {
        $(".share").addTitle("shareTitle");
        $(".copier").addTitle("copierTitle");
    }

    // cache le mask si on lui clique dessus
    // sauf si il contient la classe "hold"
    
    $("#mask").click(function () {

        // une classe hold permet de bloquer la fermeture du mask
        if( ! $(this).hasClass("hold") && onClickCloseMask == true ) {
		// pas de fondu sur IPAD et IPHONE
            if(RR_UTILS.isApple())
                $(this).hide(0);
            else
                $(this).stop().fadeOut(300);
        }
    });

    $(".showFooter .trigger").mouseenter(function () { showFooter(); });
    $("footer").mouseenter(function () { showFooter(); });

    $("#workspace").mouseenter(function () {  hideFooter(); });
    $("#app").mouseleave(function () {  hideFooter();  });


    if( RR_UTILS.isApple() )  {
        $(".showFooter .trigger").click(function () { showFooter(); });
        $("footer").click(function () { showFooter(); });
        $("#workspace").click(function () {  hideFooter(); });
    }

});


// Affiche le code d'embed pour les apps
function doEmbed() {

	$("#mask").fadeIn(500);
	$(".inputEmbed").fadeIn(500);

	// cache l'embed au click sur le masque
	$("#mask").click(function () {
		$(".inputEmbed").fadeOut(500);
	});
}


function showFooter() {

    keepFooterOpen = true;

    if( RR_UTILS.isApple() ) {
        $(".showFooter .trigger").stop().css({opacity:0});
        $(".showFooter").stop().css({marginTop:-85});
    } else {
        $(".showFooter").stop().animate({marginTop:-85}, 500, function () {
            $(".showFooter .trigger").stop().animate({opacity:0,marginTop:30,marginBottom:-100}, 250);
        });
    }

}

function hideFooter() {

    keepFooterOpen = false;

    if( RR_UTILS.isApple() ) {
        $(".showFooter .trigger").stop().css({opacity:1});
        $(".showFooter").stop().css( {marginTop:-30} );
    } else {
        setTimeout( function () {
            if(!keepFooterOpen) {
                $(".showFooter .trigger").stop().animate({opacity:1,marginTop:-36,marginBottom:0}, 250);
                $(".showFooter").stop().animate({marginTop:-30}, 500);
            }
        }, 3000);
    }
}
