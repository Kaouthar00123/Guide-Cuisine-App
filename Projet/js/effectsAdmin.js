$(document).ready( function(){

    $("#btn_add_recette").click(function(){
        $("#add_recette").css("display", "flex"); 
    }); 
    

    $("#annuler_add_recette").click(function(){
        $("#add_recette").css("display", "none"); 
    }); 



    $("#btn_add_news").click(function(){
        $("#add_news").css("display", "flex"); 
    }); 
    
    $("#annuler_add_news").click(function(){
        $("#add_news").css("display", "none"); 
    }); 






    $("#btn_add_user").click(function(){
        $("#add_user").css("display", "flex"); 
    }); 
    
    $("#annuler_add_user").click(function(){
        $("#add_user").css("display", "none"); 
    }); 




    $("#btn_add_ing").click(function(){
        $("#add_ing").css("display", "flex"); 
    }); 
    

    $("#annuler_add_ing").click(function(){
        $("#add_ing").css("display", "none"); 
    }); 

    

    $("#btn_add_para").click(function(){
        $("#add_para").css("display", "flex"); 
    }); 
    

    $("#annuler_add_para").click(function(){
        $("#add_para").css("display", "none"); 
    }); 




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
        //console.log("buuton add ing is ",$(".add_ingred").last() ); 
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

        console.log( div_ings );
    });

    ($(".del_etape").last()).click(function(){
        var e = $("div#etapes div:last");
        e.remove();
        
        let num = $("div#etapes").children().length;
        $("#nb_etape").val( num  ); 
    });


    $("#trie_catego").click(function(){
        sortTable(10);
    })
    $("#trie_notation").click(function(){
        sortTable(8);
    })
    $("#trie_TP").click(function(){
        sortTable(11);
    })
    $("#trie_TC").click(function(){
        sortTable(13);
    })
    $("#trie_TT").click(function(){
        sortTable(14);
    })

    $("#trie_calories").click(function(){
        sortTable(15);
    })
    $("#trie_sasion").click(function(){
        sortTable(16);
    })
    

    function sortTable(n) {
        var table, rows, switching, i, x, y, xi, yi, shouldSwitch;
        table = document.getElementById("TableRecettes");
        switching = true;
        /*Make a loop that will continue until
        no switching has been done:*/
        while (switching) {
          //start by saying: no switching is done:
          switching = false;
          rows = table.rows;
          /*Loop through all table rows (except the
          first, which contains table headers):*/
          for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = (rows[i].getElementsByTagName("TD")[n]).children[0];
            y = (rows[i + 1].getElementsByTagName("TD")[n]).children[0];
            //check if the two rows should switch place:

            console.log( x.value.toLowerCase());
            console.log( y.value.toLowerCase());
            console.log( x.value.toLowerCase() > y.value.toLowerCase() );

            if ( x.value.toLowerCase() > y.value.toLowerCase() ) {
                //if so, mark as a switch and break the loop:
              shouldSwitch = true;
              break;
            }
          }
          if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
          }
        }
      }
    
})