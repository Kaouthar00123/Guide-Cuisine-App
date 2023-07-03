$(document).ready( function(){

    $(".page_idee_recettes #btn_rech").click(function(){
        $("#form_nb_ingredient").css("display", "block"); 
    }); 

    $("#compte").click(function(){
        $("#container_user").css("display", "flex"); 
    });

    $("#entree .btn_plus").click(function(){
        $("#entree .recettes_autres").animate({
            width: "show"
        });
        $("#entree .btn_moins").animate({
            width: "show"
        });
    });

    $("#entree .btn_moins").click(function(){
        $("#entree .recettes_autres").animate({
            width: "hide"
        });
        $("#entree .btn_moins").animate({
            width: "hide"
        });
    });




    $("#plat .btn_plus").click(function(){
        $("#plat .recettes_autres").animate({
            width: "show"
        });
        $("#plat .btn_moins").animate({
            width: "show"
        });
    });

    $("#plat .btn_moins").click(function(){
        $("#plat .recettes_autres").animate({
            width: "hide"
        });
        $("#plat .btn_moins").animate({
            width: "hide"
        });
    });



    $("#dessert .btn_plus").click(function(){
        $("#dessert .recettes_autres").animate({
            width: "show"
        });
        $("#dessert .btn_moins").animate({
            width: "show"
        });
    });

    $("#dessert .btn_moins").click(function(){
        $("#dessert .recettes_autres").animate({
            width: "hide"
        });
        $("#dessert .btn_moins").animate({
            width: "hide"
        });
    });



    $("#boisson .btn_plus").click(function(){
        $("#boisson .recettes_autres").animate({
            width: "show"
        });
        $("#boisson .btn_moins").animate({
            width: "show"
        });
    });

    $("#boisson .btn_moins").click(function(){
        $("#boisson .recettes_autres").animate({
            width: "hide"
        });
        $("#boisson .btn_moins").animate({
            width: "hide"
        });
    });



    $("#entree .next").click(function(){
        var current = $("#entree .recettes_afficher");
        var nexte = current.next();
        if(nexte.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            nexte.addClass("recettes_afficher").css("z-index", 10);
        }
    }); 

    $("#entree .prev").click(function(){
        var current = $("#entree .recettes_afficher");
        var preve = current.prev();

        if(preve.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            preve.addClass("recettes_afficher").css("z-index", 10);
        }
    });

    $("#plat .next").click(function(){
        var current = $("#plat .recettes_afficher");
        var nexte = current.next();
        if(nexte.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            nexte.addClass("recettes_afficher").css("z-index", 10);
        }
    }); 

    $("#plat .prev").click(function(){
        var current = $("#plat .recettes_afficher");
        var preve = current.prev();

        if(preve.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            preve.addClass("recettes_afficher").css("z-index", 10);
        }
    });


    $("#dessert .next").click(function(){
        var current = $("#dessert .recettes_afficher");
        var nexte = current.next();
        if(nexte.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            nexte.addClass("recettes_afficher").css("z-index", 10);
        }
    }); 

    $("#dessert .prev").click(function(){
        var current = $("#dessert .recettes_afficher");
        var preve = current.prev();

        if(preve.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            preve.addClass("recettes_afficher").css("z-index", 10);
        }
    });


    $("#boisson .next").click(function(){
        var current = $("#boisson .recettes_afficher");
        var nexte = current.next();
        if(nexte.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            nexte.addClass("recettes_afficher").css("z-index", 10);
        }
    }); 

    $("#boisson .prev").click(function(){
        var current = $("#boisson .recettes_afficher");
        var preve = current.prev();

        if(preve.length){
            current.removeClass("recettes_afficher").css("z-index", -10);
            preve.addClass("recettes_afficher").css("z-index", 10);
        }
    });




//****************************************************** ajoute et supression dynaic d'une recette
    ($(".add_ingred").last()).click(function(){
        let div_ings = $("div#ings");
        let num = div_ings.children().length;
        let txt1 = "<div> <label>Ingredient</label> <input type='text' name = 'ing_"+((num)+1)+"' >  <br> <br> </div>";
        div_ings.append(txt1);
        $("#nb_ing").val( num +1 ); 
    });

    ($(".del_ingred").last()).click(function(){
        var e = $("div#ings div:last");
        e.remove();

        let num = $("div#ings").children().length;
        $("#nb_ing").val( num  ); 
    });



    ($(".add_meto").last()).click(function(){
        let div_ings = $("div#metos");
        let num = div_ings.children().length;
        let txt1 = "<div> <label>Methode de cuissance</label> <input type='text' name = 'meto_"+((num)+1)+"' >  <br> <br> </div>";
        div_ings.append(txt1);
        $("#nb_meto").val( num +1 ); 
    });

    ($(".del_meto").last()).click(function(){
        var e = $("div#metos div:last");
        e.remove();
        let num = $("div#metos").children().length;
        $("#nb_meto").val( num  ); 
    });


    ($(".add_etape").last()).click(function(){
        let div_ings = $("div#etapes");
        let num = div_ings.children().length;
        let txt1 = "<div> <label>Etape</label> <input type='text' name = 'etape_"+((num)+1)+"' >  <br> <br> </div>";
        div_ings.append(txt1);
        $("#nb_etape").val( num +1 ); 

    });

    ($(".del_etape").last()).click(function(){
        var e = $("div#etapes div:last");
        e.remove();
        
        let num = $("div#etapes").children().length;
        $("#nb_etape").val( num  ); 
    });

    
})